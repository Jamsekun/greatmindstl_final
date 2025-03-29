<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    
    public function index()
    {
        return view('admin.users.index');
    }

    public function create()
    {
        return view('admin.users.create');
    }


    public function edit($id)
    {
        $model = \App\Models\UserInformation::leftJoin('users', function ($query) {
            $query->on('users.id', '=', 'user_id');
        })
        ->where('user_id', $id)
        ->firstOrFail();

        return view('admin.users.edit', compact('model'));
    }

    public function load(Request $request)
    {
        $model = \App\Models\User::leftJoin('users_informations', function ($query) {
            $query->on('users.id', '=', 'user_id');
        })
        ->select([
            'users.*',
            'users_informations.first_name',
            'users_informations.last_name',
            'users_informations.email',
        ])
        ->get();

        return datatables()
                ->of($model)
                ->addColumn('full_name', function ($query) {
                    return "{$query->first_name} {$query->last_name}";
                })
                ->toJson();
    }


    public function store(Request $request)
    {
        $this->validate($request, [
            'username' => [
                'required', 
                'string', 
                'max:255', 
                'unique:users'],
            'email' => [
                'required', 
                'email'
            ],
            'password' => [
                'required', 
                'string', 
                'confirmed'
            ],
        ]);

        $model = new \App\Models\User;
        $model->username = $request->username;
        $model->password = \Hash::make($request->password);
        $model->status = 1;
        $model->save();

        $model = $model->UserInformation()->firstOrNew([
            'user_id' => $model->id
        ]);

        $model->email = $request->email;
        $model->save();

        return response()->json([
            'message' => 'Account has been successfully added.'
        ]);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'first_name' => 'required',
            'last_name' => 'required',
            'birthday' => [
                'nullable',
                'date',
                'date_format:Y-m-d'
            ],
            'email' => [
                'nullable',
                'email',
            ],
            'gender' => [
                'nullable',
                'in:M,F'
            ],
            'picture' => 'mimes:jpg,png'
        ]);

        $model = \App\Models\UserInformation::where(function ($query) use ($id) {
            $query->where('user_id', $id);
        })->firstOrFail();

        if($request->file()) {
            $e = $request->file('picture')->extension();
            $base64 = 'data:image/' . $e . ';base64,' . base64_encode(file_get_contents($request->file('picture')));
            $model->picture = $base64;
        }

        $model->employee_number = $request->employee_number;
        $model->nick_name = $request->nick_name;
        $model->first_name = $request->first_name;
        $model->middle_name = $request->middle_name;
        $model->last_name = $request->last_name;
        $model->suffix = $request->suffix;
        $model->birthday = $request->birthday;
        $model->gender = $request->gender;
        $model->telephone_number = $request->telephone_number;
        $model->phone_number = $request->phone_number;
        $model->email = $request->email;
        $model->address = $request->address;
        $model->area_of_operation = $request->area_of_operation;
        $model->operating_manager = $request->operating_manager;
        $model->branch_manager = $request->branch_manager;
        $model->position = $request->position;
        
        $model->save();

        return response()->json([
            'message' => 'Account details has been updated.'
        ]);
    }

    public function change_password(Request $request, $id)
    {
        $this->validate($request, [
            'password' => ['required', 'string', 'confirmed'],
        ]);

        $model = \App\Models\User::findOrFail($id);
        $model->password = \Hash::make($request->password);

        return response()->json([
            'message' => 'Password has been successfully changed.'
        ]);
    }

    public function search(Request $request)
    {
        if($request->filled('method')) {
            $this->validate($request, [
                'username' => 'required'
            ]);

            $model = \App\Models\User::where(function ($query) use ($request) {
                if($request->filled('method')) {
                    $query->where('username', $request->username);
                }
            })->first();

            return response()->json([
                'valid' => !is_null($model) ? false : true
            ]);
        }

        if($request->filled('filter')) {
            $model = \App\Models\User::where(function ($query) use ($request) {
                $query->where('username', 'LIKE', "%{$request->username}%");
            })->get();

            return $model;
        }
    }

    public function set_status(Request $request, $id)
    {
        if($request->ajax()) {
            $model = \App\Models\User::findOrFail($id);
            $model->status = $model->status == 1 ? 0: 1;
            $model->save();

            return $model->status;
        }
    }

    public function delete(Request $request, $id)
    {
        if($request->ajax()) {
            $model = \App\Models\User::findOrFail($id);
            $model->delete();
        }
    }

    public function count(Request $request)
    {
        if($request->ajax()) {
            return \App\Models\User::where('status', 1)->count();
        }
    }

    public function role(Request $request, $id)
    {
        $model = \App\Models\UserInformation::leftJoin('users', function ($query) {
            $query->on('users.id', '=', 'user_id');
        })
        ->where('user_id', $id)
        ->firstOrFail();

        return view('admin.users.role.index', compact('model'));
    }

    public function manage_role(Request $request, $id)
    {
        if($request->ajax()) {
            $this->validate($request, [
                'role' => [
                    'required',
                    'exists:roles,name'
                ]
            ]);

            $model = \App\Models\User::findOrFail($id);

            if($model->hasRole($request->role)) {
                $model->removeRole($request->role);
            } else {
                $model->assignRole($request->role);
            }
        }
    }

    public function get_role(Request $request, $id)
    {
        if($request->ajax()) {
            $model = \App\Models\User::findOrFail($id);

            return $model->getRoleNames();
        }
    }

    public function permission(Request $request, $id)
    {
        $model = \App\Models\UserInformation::leftJoin('users', function ($query) {
            $query->on('users.id', '=', 'user_id');
        })
        ->where('user_id', $id)
        ->firstOrFail();
        
        return view('admin.users.permission.index', compact('model'));
    }

    public function manage_permission(Request $request, $id)
    {
        if($request->ajax()) {
            $this->validate($request, [
                'permission' => [
                    'required',
                    'exists:permissions,name'
                ]
            ]);

            $model = \App\Models\User::findOrFail($id);

            if($model->hasPermissionTo($request->permission)) {
                $model->revokePermissionTo($request->permission);
            } else {
                $model->givePermissionTo($request->permission);
            }
        }
    }

    public function get_permission(Request $request, $id)
    {
        if($request->ajax()) {
            $model = \App\Models\User::findOrFail($id);

            return $model->getAllPermissions()->map(function ($user) {
                return collect($user->toArray())
                    ->only(['name'])
                    ->all();
            })->flatten();
        }
    }

}

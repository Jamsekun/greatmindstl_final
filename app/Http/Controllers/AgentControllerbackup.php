<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class AgentController extends Controller
{
    
    public function index()
    {
        return view('admin.agents.index');
    }

    public function create()
    {
        return view('admin.agents.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'first_name' => 'required',
            'last_name' => 'required',
            'employee_number' => 'unique:users_informations,employee_number',
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
            'picture' => 'mimes:jpg,jpeg,png',
            'address' => 'required'
        ]);

        $model = new \App\Models\UserInformation;

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
        $model->station = $request->station;
        $model->field_coordinator = $request->field_coordinator;
        $model->field_supervisor = $request->field_supervisor;
        $model->position = $request->position;
        $model->status = 'Active';
        $model->is_agent = 1;
        
        $model->save();

        return response()->json([
            'message' => 'Member has been successfully added.'
        ]);
    }

    public function edit($id)
    {
        $model = \App\Models\UserInformation::where(function ($query) use ($id) {
            $query->where('id', $id);
        })
        ->firstOrFail();

       return view('admin.agents.edit', compact('model'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'first_name' => 'required',
            'last_name' => 'required',
            'employee_number' => 'unique:users_informations,employee_number,' . $id,
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
            'picture' => 'mimes:jpg,jpeg,png',
            'address' => 'required'
        ]);

        $model = \App\Models\UserInformation::findOrFail($id);

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
        $model->station = $request->station;
        $model->field_coordinator = $request->field_coordinator;
        $model->field_supervisor = $request->field_supervisor;
        $model->position = $request->position;
        $model->status = $request->status;
        $model->remarks = $request->remarks;
        $model->save();

        return response()->json([
            'message' => 'Member Infornation has been successfully updated.'
        ]);
    }

    public function search(Request $request)
    {
        if($request->filled('method')) {
            $this->validate($request, [
                'employee_number' => 'required'
            ]);

            $model = \App\Models\UserInformation::where(function ($query) use ($request) {
                if($request->filled('method')) {
                    $query->where('employee_number', $request->employee_number);
                }

                if($request->filled('filter')) {
                    $query->orWhere('employee_number', 'LIKE', "%{$request->search}%");
                    $query->orWhere('first_name', "%{$request->search}%");
                    $query->orWhere('last_name', "%{$request->search}%");
                }
            })
            ->first();

            return response()->json([
                'valid' => !is_null($model) ? false : true
            ]);
        }

        if($request->filled('filter')) {
            $model = \App\Models\UserInformation::where(function ($query) use ($request) {
                $query->orWhere('employee_number', 'LIKE', "%{$request->search}%");
                $query->orWhere('first_name', 'LIKE', "%{$request->search}%");
                $query->orWhere('last_name', 'LIKE', "%{$request->search}%");
            })
            ->where('is_agent', 1)
            ->select([
                'id',
                'employee_number',
                'first_name',
                'last_name'
            ])
            ->orderBy('employee_number')
            ->orderBy('first_name')
            ->get();

            return $model;
        }
    }

    public function show($id)
    {
        $model = \App\Models\UserInformation::where(function ($query) use ($id) {
            $query->where('employee_number', $id);
        })
        ->firstOrFail();

        return view('agents.index', compact('model'));
    }

    public function delete(Request $request, $id)
    {
        if($request->ajax()) {
            $model = \App\Models\UserInformation::findOrFail($id);
            $model->delete();
        }
    }

    public function load(Request $request)
    {
        $model = \App\Models\UserInformation::where(function ($query) use ($request) {
            if($request->filled('latest')) {
                $query->where('created_at', '>', \Carbon::now()->subDays(5));
            }
        })
        ->where(function ($query) {
            $query->where('is_agent', 1);
        })
        ->select([
            'id',
            'employee_number',
            'first_name',
            'middle_name',
            'last_name',
            'position',
            'birthday',
            'telephone_number',
            'phone_number',
            'email',
            'station',
            'field_coordinator',
            'status'
        ])
        ->get();

        return datatables()
                ->of($model)
                ->addColumn('full_name', function ($query) {
                    return "{$query->first_name} {$query->last_name}";
                })
                ->toJson();
    }

    public function qr_code(Request $request, $id)
    {
        if($request->ajax()) {
            $model = \App\Models\UserInformation::findOrFail($id);
                     \QR::generate("http://greatmindstl.com/agent/{$model->employee_number}", 'resources/assets/image/user/qrcode.svg');

            return response()->json([
                'url' => asset('assets/image/user/qrcode.svg'),
                'title' => $model->employee_number
            ]);
        }
    }

    public function import(Request $request)
    {

    }

    public function export(Request $request)
    {
        return (new \App\Exports\AgentExport)->download('Masterlist.xlsx');
    }

    public function count(Request $request)
    {
        if($request->ajax()) {
            return \App\Models\UserInformation::where('is_agent', 1)->count();
        }
    }

}

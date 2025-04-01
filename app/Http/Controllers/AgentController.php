<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Storage;

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
        \Log::info('Last print date in edit: ' . $model->last_print_date); // Add this
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
        'address' => 'required',
        'date_hired' => 'nullable|date|date_format:Y-m-d', // Add validation for date_hired
    ]);

    $model = \App\Models\UserInformation::findOrFail($id);

  if ($request->hasFile('picture')) {
    $e = $request->file('picture')->extension();
    $base64 = 'data:image/' . $e . ';base64,' . base64_encode(file_get_contents($request->file('picture')));
    $model->picture = $base64;
}
   // Handle signature upload
    if ($request->hasFile('signature')) {
        $e = $request->file('signature')->extension();
        $base64 = 'data:image/' . $e . ';base64,' . base64_encode(file_get_contents($request->file('signature')));
        $model->signature = $base64;
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

    // Update created_at with date_hired
    if ($request->has('date_hired') && $request->date_hired) {
        $model->created_at = $request->date_hired . ' 00:00:00';
    }
    
 

    $model->save();

    return response()->json([
        'message' => 'Member Information has been successfully updated.'
    ]);
}
    
 
public function generateIdImage($id)
{
    $model = \App\Models\UserInformation::findOrFail($id);

    // Load the template image
    $img = Image::make(public_path('images/id_template.png')); // Adjust path

    // Overlay the employee's photo
    if ($model->picture) {
        $photo = Image::make(public_path($model->picture))->resize(200, 250); // Adjust size
        $img->insert($photo, 'top-left', 50, 50); // Adjust position
    }

    // Add the home address
    $img->text($model->address, 50, 600, function ($font) {
        $font->size(16); // Adjust font size
        $font->color('#000'); // Adjust color
    });

    // Save the generated image
    $imagePath = 'generated_ids/' . $model->id . '.png';
    Storage::disk('public')->put($imagePath, $img->encode('jpg'));

    // Return the image URL
    $imageUrl = Storage::disk('public')->url($imagePath);
    return response()->json(['imageUrl' => $imageUrl]);
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
        $model = \App\Models\UserInformation::where('employee_number', $id)->firstOrFail();
        $token = request()->query('token');
    
        // Check employee status
        if ($model->status === 'Lost ID' || $model->status === 'Inactive') {
            return response('Access denied: This ID is no longer valid', 403);
        }
    
        // For active employees, require a valid token
        if ($model->status === 'Active') {
            if (empty($token) || $token !== $model->latest_qr_token) {
                return response('Access denied: Invalid or outdated ID', 403);
            }
        }
    
        // If valid, redirect or show the agent page
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
            if ($request->ajax()) {
                $model = \App\Models\UserInformation::findOrFail($id);
                
                // Use the latest_qr_token if it exists, otherwise generate a new one
                if (!$model->latest_qr_token) {
                    $model->latest_qr_token = \Illuminate\Support\Str::random(32);
                    $model->save();
                }
        
                // Generate QR code with token
                $qrData = "http://greatmindstl.com/agent/{$model->employee_number}?token={$model->latest_qr_token}";
                $filePath = "resources/assets/image/user/qrcode_{$model->id}.svg"; // Unique file per employee
                \QR::generate($qrData, $filePath);
        
                return response()->json([
                    'url' => asset("assets/image/user/qrcode_{$model->id}.svg"),
                    'title' => $model->employee_number
                ]);
            }
    }
    
    public function generateQrToken(Request $request, $id)
    {
        $model = \App\Models\UserInformation::findOrFail($id);
        $model->latest_qr_token = \Illuminate\Support\Str::random(32); // Generate a 32-char random token
        $model->save();
    
        return response()->json([
            'token' => $model->latest_qr_token,
            'employee_number' => $model->employee_number
        ]);
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
    
    public function updateLastPrintDate(Request $request)
    {
        $this->validate($request, [
            'id' => 'required|exists:users_informations,id',
            'last_print_date' => 'required|date|date_format:Y-m-d'
        ]);

        $model = \App\Models\UserInformation::findOrFail($request->id);
        $model->last_print_date = $request->last_print_date;
        $model->save();

        return response()->json([
            'message' => 'Last print date updated successfully',
            'last_print_date' => $model->last_print_date
        ]);
    }

}

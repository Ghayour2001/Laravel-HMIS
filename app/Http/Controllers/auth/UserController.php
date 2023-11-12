<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\Position;
use App\Models\User;
use Illuminate\Http\Request;
use DataTables;

class UserController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $user = User::with('position')->get();
            return DataTables::of($user)
                ->addColumn('action', function ($user) {
                    $action = '<div class="dropdown">
                <button class="btn btn-outline-secondary dropdown-toggle" type="button" id="actionDropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-patient-id="' . $user->id . '">
                    Actions
                </button>
                <div class="dropdown-menu" aria-labelledby="actionDropdown">
                    <button class="dropdown-item viewButton" data-id="' . $user->id . '">View</button>
                    <button class="dropdown-item editButton" data-id="' . $user->id . '">Edit</button>
                    <button class="dropdown-item delete" data-id="' . $user->id . '">delete</button>
                </div>
            </div>';

                    return $action;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('auth.users.index');
    }
    /* Store a newly created resource in storage.*/
    public function store(Request $request)
    {
        $data = $request->all();
        if ($file = $request->file('image')) {
            $fileName = $this->uploadFile($file);
            $data['image'] = $fileName;
        }

        $user = User::create($data);
        if ($user) {
            return response()->json(['message' => 'Data inserted successfully'], 200);
        } else {
            return response()->json(['message' => 'Data insertion failed'], 500);
        }
    }
    public function show($id)
    {
        try {
            $user = User::find($id);

            if (!$user) {
                return response()->json(['error' => 'Employee not found'], 404);
            }
            $departmentName = $user->department->name;
            $user->department_id = $departmentName;
            if ($user->image == '') {
                $user->image = asset('assets/auth/images/avatars/avatar1.avif');
            } else {
                $user->image = asset('storage/auth/employees/' . $user->image);
            }

            return response()->json($user);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Internal Server Error'], 500);
        }
    }
    public function delete($id)
    {
        $user = User::findOrFail($id); // Find the patient by its ID

        $user->delete(); // Delete the patient
        return response()->json([
            "message" => "Employee Deleted Successfully"
        ], 200);
    }
    public function edit($id)
    {
        $user = User::find($id);
        if ($user->image == '') {
            $user->image = asset('assets/auth/images/avatars/avatar1.avif');
        } else {
            $user->image = asset('storage/auth/employees/' . $user->image);
        }
        if (!$user) {
            abort(404);
        }
        return response()->json($user);
    }
    public function update(Request $request)
    {

        $data = $request->only([
            'name',
            'father_name',
            'email',
            'dob',
            'cnic',
            'contact_no',
            'position_id',
            'qualification',
            'probation_period',
            'address'
        ]);


        $id = $request->user_id; // Assuming you have an input field with name "employee_id"

        $user = User::findOrFail($id);
        $oldImage = $user->image;

        if ($request->hasFile('updateImage')) {
            $path = public_path('storage/auth/employees');

            // Upload new file
            $file = $request->file('updateImage');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move($path, $filename);

            // Update the table with the new filename
            $data['image'] = $filename;

            // Delete the old image file
            if ($oldImage && file_exists($path . '/' . $oldImage)) {
                unlink($path . '/' . $oldImage);
            }
        }

        $user->update($data);
        if ($user) {
            return response()->json(['message' => 'Data updated successfully'], 200);
        } else {
            return response()->json(['message' => 'Data update failed'], 500);
        }
    }
    private function uploadFile($file)
    {
        $fileName = time() . '_' . $file->getClientOriginalName();
        $filepath = public_path('storage/auth/employees');
        $file->move($filepath, $fileName);
        return $fileName;
    }
    public function fetchAllDepartments()
    {
        $departments = Department::all();

        return response()->json($departments);
    }
    public function fetchuserpositions()
{
    $positions = Position::where('is_active', 1)->get();

    return response()->json($positions);
}

}

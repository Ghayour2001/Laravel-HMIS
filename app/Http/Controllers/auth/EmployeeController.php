<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\Employee;
use Illuminate\Http\Request;
use DataTables;

class EmployeeController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $employees = Employee::all();

            return DataTables::of($employees)
                ->addColumn('action', function ($employees) {
                    $action = '<div class="dropdown">
                <button class="btn btn-outline-secondary dropdown-toggle" type="button" id="actionDropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-patient-id="' . $employees->id . '">
                    Actions
                </button>
                <div class="dropdown-menu" aria-labelledby="actionDropdown">
                    <button class="dropdown-item viewButton" data-id="' . $employees->id . '">View</button>
                    <button class="dropdown-item editButton" data-id="' . $employees->id . '">Edit</button>
                    <button class="dropdown-item delete" data-id="' . $employees->id . '">delete</button>
                </div>
            </div>';

                    return $action;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('auth.employee.index');
    }
    /* Store a newly created resource in storage.*/
    public function store(Request $request)
    {
        $data = $request->all();
        if ($file = $request->file('image')) {
            $fileName = $this->uploadFile($file);
            $data['image'] = $fileName;
        }

        $employee = Employee::create($data);
        if ($employee) {
            return response()->json(true);
        } else {
            return response()->json(false, 500);
        }
    }
    public function show($id)
    {
        try {
            $employee = Employee::find($id);

            if (!$employee) {
                return response()->json(['error' => 'Employee not found'], 404);
            }
            $departmentName=$employee->department->name;
            $employee->department_id=$departmentName;
            $employee->image = asset('storage/auth/employees/' . $employee->image);

            return response()->json($employee);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Internal Server Error'], 500);
        }
    }
    public function delete($id)
    {
        $employee = Employee::findOrFail($id); // Find the patient by its ID

        $employee->delete(); // Delete the patient
        return response()->json([
            "message" => "Employee Deleted Successfully"
        ], 200);
    }
    public function edit($id)
    {
        $employee = Employee::find($id);
        $employee->image = asset('storage/auth/employees/' . $employee->image);
        if (!$employee) {
            abort(404);
        }
        return response()->json($employee);
    }
    public function update(Request $request)
    {

        $data = $request->only([
            'employee_name',
            'father_name',
            'email',
            'dob',
            'cnic',
            'contact_no',
            'position',
            'qualification',
            'probation_period',
            'address'
        ]);

        $id = $request->employee_id; // Assuming you have an input field with name "employee_id"

        $employee = Employee::findOrFail($id);
        $oldImage = $employee->image;

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

        $employee->update($data);
        return response()->json(['success' => 'Employee updated successfully']);
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
}

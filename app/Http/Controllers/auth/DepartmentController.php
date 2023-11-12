<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use App\Models\Department;
use GuzzleHttp\Psr7\Request as Psr7Request;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $departments = Department::all();
        return view('auth.departments.index', compact('departments'));
    }
    public function fetchdepartment()
    {
        $departments = Department::all();
        return response()->json(['departments' => $departments,]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $department = Department::create($request->all());
        if ($department) {
            $response['success'] = true;
            $response['message'] = 'Department saved successfully';
            return response()->json(['success' => 'Department saved successfully']);
        } else {
            return response()->json(['error' => 'Failed to save department'], 500);
        }
    }

    public function getDepartments(Request $request)
    {
        $id = $request->pid;
        $department = Department::find($id);

        // return response()->json($department);
        return response()->json($department);
    }

    public function destroy($id)
    {
        $department = Department::find($id);
        if ($department) {
            $department->delete();
            return response()->json(['success' => true]);
        } else {
            return response()->json(['success' => false, 'message' => 'Department not found']);
        }
    }
    public function updateDepartment(Request $request)
    {
        // dd($request->all());
        // $id = $request->pid;
        $department = Department::find($request->dept_id);

        // Update the department data based on the values passed in the request
        $department->name = $request->dep_name;
        $department->order_by = $request->order_by;
        $department->is_open_for_admission = $request->edit_open_admission;
        $department->is_active = $request->edit_is_active ?: 0;

        // Save the updated department
        $department->save();
        if ($department) {
            $response['success'] = true;
            $response['message'] = 'Department Update successfully';
        } else {
            $response['success'] = false;
            $response['message'] = 'Error';
        }

        // Return a response indicating the success of the update if needed
        return response()->json($response);
    }
    public function deleteDepartment(Request $request)
    {
        $id = $request->id;
        $department = Department::find($id);

        if ($department) {
            $department->delete();
            return response()->json(['success' => true]);
        }

        return response()->json(['error' => 'Department not found'], 404);
    }
    public function updateDepartmentStatus(Request $request, Department $department)
    {
        try {
            // Toggle the value of is_active
            $department->is_active = !$department->is_active;
            $department->save();

            // Return a success response
            return response()->json([
                'status' => 'success',
                'message' => 'Department status updated successfully.'
            ]);
        } catch (\Exception $e) {
            // Return an error response if there was an issue with updating the department status
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to update department status.'
            ], 500);
        }
    }


}

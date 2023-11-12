<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use App\Models\Floor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;


class FloorController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $floor = Floor::all();
            return DataTables::of($floor)
                ->addColumn('action', function ($floor) {
                    $action = '<div class="dropdown actionDropdown">
                        <button class="btn btn-outline-secondary dropdown-toggle" type="button" id="actionDropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-floor-id="' . $floor->id . '">
                            Actions
                        </button>
                        <div class="dropdown-menu" aria-labelledby="actionDropdown">
                            <button class="dropdown-item viewButton" data-id="' . $floor->id . '">View</button>
                            <button class="dropdown-item floor-edit-btn" data-id="' . $floor->id . '">Edit</button>
                            <button class="dropdown-item delete" data-id="' . $floor->id . '">Delete</button>
                        </div>
                    </div>';

                    return $action;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('auth.bedsetup.index');
    }
    public function store(Request $request)
    {
        $data = $request->all();
        $floor = Floor::create($data);
        if ($floor) {
            return response()->json(['message' => 'Data Inserted successfully'], 200);
        } else {
            return response()->json(['error' => 'Data Insertion failed'], 500);
        }
    }
    public function edit($id)
    {
        $floor = Floor::find($id);
        if (!$floor) {
            abort(404);
        }
        return response()->json($floor);
    }
    public function update(Request $request)
    {
        $id = $request->id; // Assuming the ID is passed as 'id' in the request data
        $floor = Floor::find($id);

        if (!$floor) {
            abort(404);
        }

        $floor->name = $request->name;
        $floor->description = $request->description;
        $floor->is_active = $request->has('edit-is-active') ? 1 : 0;
        $floor->save();
        if ($floor) {
            return response()->json(['message' => 'Data Updated successfully'], 200);
        } else {
            return response()->json(['error' => 'Data Updation failed'], 500);
        }
    }
    // public function delete($id)
    // {
    //     $floor = Floor::findOrFail($id); // Find the patient by its ID

    //     $floor->delete(); // Delete the patient
    //     if ($floor) {
    //         return response()->json(['message' => 'Data Deleted successfully'], 200);
    //     } else {
    //         return response()->json(['error' => 'Data Deletion failed'], 500);
    //     }
    // }

    public function delete($id)
    {
            // Find the floor by its ID
            $floor = Floor::find($id);
                // Loop through the bedgroups related to this floor
                foreach ($floor->bedgroups as $bedgroup) {
                    // Check if any of the beds have status equal to 1
                    if ($bedgroup->beds()->where('is_active', 1)->exists()) {
                        // Alert: Cannot delete the floor because there are beds with status equal to 1.
                        return response()->json(['error' => 'Cannot delete the floor because there are some beds available in this floor.'], 400);
                    }
                    $bedgroup->beds()->delete();
                }
                // Delete related bedgroup records
                $floor->bedgroups()->delete();
            // Delete the floor
            $floor->delete();
            return response()->json(['message' => 'Floor and its related bed-group and beds are deleted Successfully'], 200);
    }



}

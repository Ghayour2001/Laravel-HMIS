<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use App\Models\Bedgroup;
use App\Models\Floor;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class BedgroupController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $bedgroups = Bedgroup::with('floor')->get();
            return DataTables::of($bedgroups)
                ->addColumn('action', function ($bedgroup) {
                    $action = '<div class="dropdown actionDropdown">
                    <button class="btn btn-outline-secondary dropdown-toggle viewButton" type="button" id="actionDropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-bedgroup-id="' . $bedgroup->id . '">
                        Actions
                    </button>
                    <div class="dropdown-menu" aria-labelledby="actionDropdown">
                        <button class="dropdown-item view" data-id="' . $bedgroup->id . '">View</button>
                        <button class="dropdown-item bedgroup-edit-btn" data-id="' . $bedgroup->id . '">Edit</button>
                        <button class="dropdown-item bedgroup-delete" data-id="' . $bedgroup->id . '">Delete</button>
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
        $bedgroup = Bedgroup::create($data);
        if ($bedgroup) {
            return response()->json(['message' => 'Data Inserted successfully'], 200);
        } else {
            return response()->json(['error' => 'Data Insertion failed'], 500);
        }
    }
    public function fetchallfloors()
    {
        $floors = Floor::all();

        return response()->json($floors);
    }
    public function edit($id)
    {
        $bedgroup = Bedgroup::find($id);

        return response()->json($bedgroup);
    }
    public function update(Request $request)
    {
        $id = $request->id; // Assuming the ID is passed as 'id' in the request data
        $bedgroup = Bedgroup::find($id);

        if (!$bedgroup) {
            return response()->json(['error' => 'Bed group not found'], 404);
        }

        $bedgroup->name = $request->name;
        $bedgroup->description = $request->description;
        $bedgroup->floor_id = $request->floor_id;
        $bedgroup->is_active = $request->has('edit-is-active') ? 1 : 0;
        $bedgroup->save();

        if ($bedgroup) {
            return response()->json(['message' => 'Data Updated successfully'], 200);
        } else {
            return response()->json(['error' => 'Data Updation failed'], 500);
        }
    }
    // public function delete($id)
    // {
    //     $bedgroup = Bedgroup::findOrFail($id); // Find the patient by its ID

    //     $bedgroup->delete(); // Delete the patient
    //     if ($bedgroup) {
    //         return response()->json(['message' => 'Data Deleted successfully'], 200);
    //     } else {
    //         return response()->json(['error' => 'Data Deletion failed'], 500);
    //     }
    // }
    public function delete($id)
    {
        // Find the bedgroup by its ID
        $bedgroup = Bedgroup::findOrFail($id);

        // Check if any of the beds have is_active equal to 1
        if ($bedgroup->beds()->where('is_active', 1)->exists()) {
            // Alert: Cannot delete the bedgroup because there are beds with status equal to 1.
            return response()->json(['error' => 'Cannot delete the bedgroup because there are some beds available in this bed group.'], 400);
        }

        // Delete the related beds
        $bedgroup->beds()->delete();

        // Now, delete the bedgroup
        $bedgroup->delete();

        return response()->json(['message' => 'Bedgroup and its related beds are deleted successfully'], 200);
    }
}

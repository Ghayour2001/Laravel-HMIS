<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use App\Models\Bedtype;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class BedtypeController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $bedtypes = Bedtype::all(); // Replace 'Bedtype' with the appropriate model name for the bed types

            return DataTables::of($bedtypes)
                ->addColumn('action', function ($bedtype) {
                    $action = '<div class="dropdown actionDropdown">
                    <button class="btn btn-outline-secondary dropdown-toggle viewButton" type="button" id="actionDropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-bedtype-id="' . $bedtype->id . '">
                        Actions
                    </button>
                    <div class="dropdown-menu" aria-labelledby="actionDropdown">
                        <button class="dropdown-item view" data-id="' . $bedtype->id . '">View</button>
                        <button class="dropdown-item bedtype-edit-btn" data-id="' . $bedtype->id . '">Edit</button>
                        <button class="dropdown-item bedtype-delete" data-id="' . $bedtype->id . '">Delete</button>
                    </div>
                </div>';

                    return $action;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('your-view-name'); // Replace 'your-view-name' with the appropriate view name for the "bedtype-table" DataTable
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $bedtype = Bedtype::create($data);
        if ($bedtype) {
            return response()->json(['message' => 'Data Inserted successfully'], 200);
        } else {
            return response()->json(['error' => 'Data Insertion failed'], 500);
        }
    }
    public function edit($id)
    {
        $bedtype = Bedtype::find($id);

        return response()->json($bedtype);
    }
    public function update(Request $request)
    {
        $id = $request->id; // Assuming the ID is passed as 'id' in the request data
        $bedtype = Bedtype::find($id);

        if (!$bedtype) {
            return response()->json(['error' => 'Bed group not found'], 404);
        }

        $bedtype->name = $request->name;
        $bedtype->save();

        if ($bedtype) {
            return response()->json(['message' => 'Data Updated successfully'], 200);
        } else {
            return response()->json(['error' => 'Data Updation failed'], 500);
        }
    }
    // public function delete($id)
    // {
    //     $bedtype = Bedtype::findOrFail($id); // Find the patient by its ID

    //     $bedtype->delete(); // Delete the patient
    //     if ($bedtype) {
    //         return response()->json(['message' => 'Data Deleted successfully'], 200);
    //     } else {
    //         return response()->json(['error' => 'Data Deletion failed'], 500);
    //     }
    // }
    public function delete($id)
    {
        // Find the bed type by its ID
        $bedtype = Bedtype::findOrFail($id);

        // Check if any of the beds have is_active equal to 1
        if ($bedtype->beds()->where('is_active', 1)->exists()) {
            // Alert: Cannot delete the bed type because there are beds with status equal to 1 related to this bed type.
            return response()->json(['error' => 'Cannot delete the bed type because there are some beds available in this bed type.'], 400);
        }

        // Delete the related beds
        $bedtype->beds()->delete();

        // Now, delete the bed type
        $bedtype->delete();

        return response()->json(['message' => 'Bed type and its related beds are deleted successfully'], 200);
    }
}

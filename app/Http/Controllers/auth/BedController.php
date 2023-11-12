<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use App\Models\Bed;
use App\Models\Bedgroup;
use App\Models\Bedtype;
use App\Models\Floor;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class BedController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $beds = Bed::with('bedtype', 'bedgroup.floor')->get();

            return DataTables::of($beds)
                ->addColumn('bedgroup_with_floor', function ($bed) {
                    return $bed->bedgroup->name . ' - ' . ($bed->bedgroup->floor ? $bed->bedgroup->floor->name : 'No Floor');
                })
                ->addColumn('action', function ($bed) {
                    $status = $bed->is_active; // Assuming that 'status' is the attribute representing the status of the Bed model.

                    $action = '<div class="dropdown actionDropdown">
                        <button class="btn btn-outline-secondary dropdown-toggle viewButton" type="button" id="actionDropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-bed-id="' . $bed->id . '">
                            Actions
                        </button>
                        <div class="dropdown-menu" aria-labelledby="actionDropdown">';

                    // Check the status and add appropriate buttons accordingly
                    if ($status == 0) {
                        $action .= '<button class="dropdown-item bed-status" data-id="' . $bed->id . '">Inactive</button>';
                    } elseif ($status == 2) {
                        $action .= '<button class="dropdown-item bed-status" data-id="' . $bed->id . '">Active</button>';
                    } else {
                    }

                    // Add the other buttons (View, Edit, Delete) irrespective of status
                    $action .= '<button class="dropdown-item view" data-id="' . $bed->id . '">View</button>
                        <button class="dropdown-item bed-edit-btn" data-id="' . $bed->id . '">Edit</button>
                        <button class="dropdown-item bed-delete" data-id="' . $bed->id . '">Delete</button>
                    </div>
                </div>';

                    return $action;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('auth.bedsetup.index');
    }


    // Othe

    public function store(Request $request)
    {
        $data = $request->all();
        $bed = Bed::create($data);
        if ($bed) {
            return response()->json(['message' => 'Data Inserted successfully'], 200);
        } else {
            return response()->json(['error' => 'Data Insertion failed'], 500);
        }
    }
    public function edit($id)
    {
        $bed = Bed::find($id);

        return response()->json($bed);
    }
    public function update(Request $request)
    {
        $id = $request->id; // Assuming the ID is passed as 'id' in the request data
        $bed = Bed::find($id);

        if (!$bed) {
            return response()->json(['error' => 'Bed not found'], 404);
        }

        $bed->name = $request->name;
        $bed->bedtype_id = $request->bedtype_id;
        $bed->bedgroup_id = $request->bedgroup_id;
        $bed->save();

        if ($bed) {
            return response()->json(['message' => 'Data Updated successfully'], 200);
        } else {
            return response()->json(['error' => 'Data Updation failed'], 500);
        }
    }
    public function delete($id)
    {
        // Find the bed by its ID
        $bed = Bed::findOrFail($id);

        // Check if the bed is active (is_active equals 1)
        if ($bed->is_active == 1) {
            // Alert: Cannot delete the bed because it is currently assigned to a patient.
            return response()->json(['error' => 'Cannot delete the bed because it is currently assigned to a patient.'], 400);
        }

        // Delete the bed
        $bed->delete();

        return response()->json(['message' => 'Data Deleted successfully'], 200);
    }

    public function fetchallbedtypes()
    {
        $bedtype = Bedtype::all();

        return response()->json($bedtype);
    }
    public function fetchallbedgroups()
    {
        $bedgroups = Bedgroup::with('floor')->get();

        $formattedBedgroups = $bedgroups->map(function ($bedgroup) {
            $floorName = $bedgroup->floor ? $bedgroup->floor->name : 'No Floor'; // If no related floor, use 'No Floor'
            $nameWithFloor = $bedgroup->name . ' - ' . $floorName;
            return [
                'id' => $bedgroup->id,
                'nameWithFloor' => $nameWithFloor,
            ];
        });

        return response()->json($formattedBedgroups);
    }
    public function status($id)
    {
        $bed = Bed::find($id);

        if (!$bed) {
            return response()->json(['error' => 'Bed not found'], 404);
        }

        if ($bed->is_active == 0) {
            $bed->is_active = 2;
        } else if ($bed->is_active == 2) {
            $bed->is_active = 0;
        }

        $bed->save();

        return response()->json(['message' => 'Bed status changed successfully'], 200);
    }


    public function getallbeds()
    {
        // Fetch all floors along with their bed groups and beds
        $floors = Floor::with('bedgroups.beds')->get();

        $hasActiveBeds = false; // Flag to track if there are active beds with 'is_active' attribute 1 or 0

        $html = '
            <div class="parent-div d-flex justify-content-end mb-5 mr-5">
                <button id="close-beds-modal-btn" class="close cross-icon-btn rounded-circle"
                    style="font-size: 20px; color:#ffffff" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>';

        foreach ($floors as $floor) {
            $hasActiveFloorBeds = false; // Flag to track if the floor has active beds

            foreach ($floor->bedgroups as $bedgroup) {
                foreach ($bedgroup->beds as $bed) {
                    if ($bed->is_active === 1 || $bed->is_active === 0) {
                        $hasActiveBeds = true; // Set the global flag if any active bed is found
                        $hasActiveFloorBeds = true; // Set the floor-specific flag if active bed is found on this floor
                        break; // No need to check further once an active bed is found
                    }
                }
            }

            // Check if the floor has active beds and its 'is_active' attribute is either 1 or 0
            if ($hasActiveFloorBeds && in_array($floor->is_active, [0, 1])) {
                $html .= '
                    <fieldset style="border: 1px solid gray">
                        <legend>
                            <span class="floor-heading">' . $floor->name . '</span>
                        </legend>
                        <div class="container-fluid gray-div">';

                if (count($floor->bedgroups) === 0) {
                    // If there are no bedgroups in the floor, display "No bedgroup found" message
                    $html .= '
                        <fieldset>
                            <legend class="text-center">
                                <div class="single-bed text-center" style="margin:auto; width:auto;">
                                    <span>No bedgroup found</span>
                                </div>
                            </legend>
                            <div class="row beds-row">';
                } else {
                    // Loop through the bedgroups and generate the HTML for each bedgroup
                    foreach ($floor->bedgroups as $bedgroup) {
                        $html .= '
                            <fieldset>
                                <legend class="text-center bedgroup-legend">
                                    <span class="bedgroup-heading">' . $bedgroup->name . '</span>
                                </legend>
                                <div class="row beds-row">';

                        if (count($bedgroup->beds) === 0) {
                            // If there are no beds in the bedgroup, display "No bed found" message
                            $html .= '
                                <div class="single-bed">
                                    <h3>No bed found</h3>
                                </div>';
                        } else {
                            // Loop through the beds and generate the HTML for each bed
                            foreach ($bedgroup->beds as $bed) {
                                if ($bed->is_active === 1 || $bed->is_active === 0) {
                                    $bedColorClass = $bed->is_active ? 'bed-red' : 'bed-green'; // Set bed color based on 'is_active' attribute
                                    $textColor = $bed->is_active ? 'color: red;' : 'color: green;'; // Set text color style based on 'is_active' attribute

                                    // <a href="' . route('ipd.store', ['bed_id' => $bed->id]) . '" class="bed-anchor">
                                if($bed->is_active === 1){
                                    $html .= '
                                    <div class="single-bed">
                                    <div class="' . $bedColorClass . '">
                                        <i class="fas fa-bed fa-3x"></i>
                                        <span class="bed-name" style="' . $textColor . '">' . $bed->name . '</span>
                                        <div class="popover">This is the popover content.</div>
                                    </div>
                                </div>';

                                }else{
                                    $html .= '
                                    <a href="javascript:void(0)" class="single-bed" data-bed_id="'.$bed->id.'"  data-bedgroup_id="'.$bedgroup->id.'">
                                        <div class="' . $bedColorClass . '">
                                            <i class="fas fa-bed fa-3x"></i>
                                            <span class="bed-name" style="' . $textColor . '">' . $bed->name . '</span>
                                        </div>
                                    </a>';
                                }
                                }
                            }
                        }





                        $html .= '
                                </div>
                            </fieldset>';
                    }
                }

                $html .= '
                        </div>
                    </fieldset>';
            }
        }

        if (!$hasActiveBeds) {
            // If no active beds with 'is_active' attribute 1 or 0 are found, display the empty animated icon with "No data found" message
            $html = '
            <div class="d-flex justify-content-center align-items-center no-data-found-container" style="height:100vh";>
            <button id="close-beds-modal-btn" class="close cross-icon-btn rounded-circle"
            style="font-size: 20px; color:#ffffff" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
            <div class="animated-icon">
                <i class="fas fa-spinner fa-pulse fa-3x"></i>
            </div>
            <div class="no-data-found-msg">
                <span>No data found</span>
            </div>
            </div>';
        }

        return response($html)->header('Content-Type', 'text/html');
    }
}

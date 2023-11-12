<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use App\Models\Bed;
use App\Models\Bedgroup;
use App\Models\Department;
use App\Models\Insurance;
use App\Models\Ipd;
use App\Models\Symptom;
use App\Models\User;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class IpdController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $ipds = Ipd::select([
                'id',
                'name', // Replace 'name' with the actual field name for the patient name in the IPD table
                'bed_id',
                'user_id',
                'bedgroup_id',
                'pat_gender',
                'contact_no',
                'age',
                'dob',
                'symptom_description' // Replace 'description' with the actual field name for the description in the IPD table
            ])->with('user','bedgroup','bed')->get();

            return DataTables::of($ipds)
                ->addColumn('action', function ($ipd) {
                    $action = '<div class="dropdown actiondropdown">
                        <button class="btn btn-outline-secondary dropdown-toggle" type="button" id="actionDropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-ipd-id="' . $ipd->id . '">
                            <i class="fas fa-ellipsis-v"></i>
                        </button>
                        <div class="dropdown-menu" aria-labelledby="actionDropdown">
                            <button class="dropdown-item viewButton" data-id="' . $ipd->id . '">View</button>
                            <button class="dropdown-item editButton" data-id="' . $ipd->id . '">Edit</button>
                            <button class="dropdown-item delete" data-id="' . $ipd->id . '">Delete</button>
                        </div>
                    </div>';

                    return $action;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('auth.ipd.index');
    }

    public function fetchAlldoctor()
    {
        $doctors = User::whereHas('position', function ($query) {
            $query->where('name', 'doctor');
        })->get();

        return response()->json($doctors);
    }

    public function fetchAllInsurances()
    {
        $Insurances = Insurance::all();

        return response()->json($Insurances);
    }
    public function fetchAllSymptoms()
    {
        try {
            $symptoms = Symptom::all(); // Assuming you have a 'symptoms' table in the database

            return response()->json($symptoms);
        } catch (\Exception $e) {
            // Handle the exception if something goes wrong
            return response()->json(['error' => 'Failed to fetch symptom information'], 500);
        }
    }

    public function fetchSymptomDescription(Request $request)
    {
        try {
            $symptomId = $request->id;

            // Ensure $symptomNames is an array
            if (!is_array($symptomId)) {
                return response()->json(['error' => 'Invalid input format'], 400);
            }

            // Fetch symptoms based on the provided IDs
            $symptoms = Symptom::whereIn('name', $symptomId)->get();

            $descriptions = [];
            foreach ($symptoms as $symptom) {
                $descriptions[] = ['description' => $symptom->description];
            }

            if (!empty($descriptions)) {
                return response()->json($descriptions); // Return the array of objects
            } else {
                return response()->json(['description' => 'No Symptoms Found']);
            }
        } catch (\Exception $e) {
            // Handle the exception if something goes wrong
            return response()->json(['error' => 'Failed to fetch symptom description'], 500);
        }
    }

    public function fetchAlldepartment()
    {
        $Department = Department::all();


        return response()->json($Department);
    }
    public function store(Request $request)
    {
        // Get all the form input data
        $input = $request->all();

        // Convert the 'symptom_name' array to a comma-separated string if it's an array
        if (isset($input['symptom']) && is_array($input['symptom'])) {
            $input['symptom'] = implode(',', $input['symptom']);
        }

        // Check if the request has an image file
        if ($file = $request->file('image')) {
            $fileName = $this->uploadFile($file); // Assuming you have a method called "uploadFile" to handle file upload
            $input['image'] = $fileName; // Add the file name to the $input array
        }

        // Create a new Ipd record and save it to the database
        $ipd = Ipd::create($input);

        if ($ipd) {
            return response()->json(["success" => "Inserted Successfully"], 200);
        } else {
            return response()->json(['error' => 'Failed to save Data'], 500);
        }
    }

    public function fetchbedgroups()
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
    public function fetchBedNumbers(Request $request)
    {
        $selectedBedgroup_id = $request->id;

        // Assuming you have a relationship between BedGroup and Bed models, and 'bed_group_id' is the foreign key for bed group in the Bed model
        $bedNumbers = Bed::where('bedgroup_id', $selectedBedgroup_id)->where('is_active', 0)->get();
        // dd($bedNumbers);
        // Return the bed numbers as JSON response
        return response()->json($bedNumbers);
    }
    private function uploadFile($file)
    {
        $fileName = time() . '_' . $file->getClientOriginalName();
        $filepath = public_path('storage/auth/ipd');
        $file->move($filepath, $fileName);
        return $fileName;
    }
    public function delete($id)
    {

        $ipd = Ipd::find($id);

        if ($ipd) {
            $ipd->delete();
            return response()->json(["success" => "Data Delete Successfully"], 200);
        }

        return response()->json(['error' => 'Failed to Delete Data'], 404);
    }
    public function show($id)
    {
        try {
            $ipd = Ipd::find($id);

            if (!$ipd) {
                return response()->json(['error' => 'IPD not found'], 404);
            }

            // Get the doctor's name
            $userName = $ipd->user->name;
            $departmentName = $ipd->department->name;
            $insuranceName = $ipd->insurance->organization_name;
            $bedgroupName = $ipd->bedgroup->name;
            $bednumberName = $ipd->bed->name;

            // Convert the comma-separated symptoms string to an array
            $symptomNames = explode(', ', $ipd->symptom);

            // Update the attributes with the respective names
            $ipd->user_id = $userName;
            $ipd->department_id = $departmentName;
            $ipd->bedgroup_id = $bedgroupName;
            $ipd->bednumber_id = $bednumberName;
            $ipd->symptom_names = $symptomNames;

            // Handle the image URL
            if ($ipd->image == '') {
                $ipd->image = asset('assets/auth/images/avatars/avatar1.avif');
            } else {
                $ipd->image = asset('storage/auth/ipd/' . $ipd->image);
            }

            return response()->json($ipd);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Internal Server Error'], 500);
        }
    }
    public function edit($id)
    {
        try {
            $ipd = Ipd::find($id);

            if (!$ipd) {
                return response()->json(['error' => 'IPD not found'], 404);
            }

            // $symptomNames = explode(', ', $ipd->symptom);
            // $ipd->symptom_names = $symptomNames;

            // Handle the image URL
            if ($ipd->image == '') {
                $ipd->image = null; // Set to null, so the response will contain an empty image property
            } else {
                $ipd->image = asset('storage/auth/ipd/' . $ipd->image);
            }

            return response()->json($ipd);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Internal Server Error'], 500);
        }
    }

    public function update(Request $request)
    {
        // Find the record to update
        $id = $request->id;
        $ipd = Ipd::find($id);


        if (!$ipd) {
            return response()->json(['error' => 'Record not found'], 404);
        }

        // Get all the form input data
        $input = $request->all();
        $input['food'] = $request->has('food') ? 1 : 0;
        // dd($input);
        // Convert the 'symptom_name' array to a comma-separated string if it's an array
        if (isset($input['symptom']) && is_array($input['symptom'])) {
            $input['symptom'] = implode(',', $input['symptom']);
        }

        // Check if a new image is selected
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $fileName = $this->uploadFile($file); // Assuming you have a method called "uploadFile" to handle file upload
            $input['image'] = $fileName; // Add the file name to the $input array

        } else {
            // If no new image is selected, keep the old image stored in the database
            $input['image'] = $ipd->image;
        }
        // dd($input);
        // Update the record in the database
        $updateResult = $ipd->update($input);


        if ($updateResult) {
            return response()->json(["success" => "Updated Successfully"], 200);
        } else {
            return response()->json(['error' => 'Failed to update Data'], 500);
        }
    }
}


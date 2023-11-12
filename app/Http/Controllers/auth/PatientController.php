<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\Doctor;
use App\Models\Insurance;
use App\Models\Patient;
use App\Models\Symptom;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;
use DateTime;

class PatientController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            // $patients = Patient::all();
            $patients = Patient::with('user')->get();
            return DataTables::of($patients)
                ->addColumn('action', function ($patients) {
                    $action = '<div class="dropdown actiondropdown">
                    <button class="btn btn-outline-secondary dropdown-toggle viewButton" type="button" id="actionDropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-patient-id="' . $patients->id . '">
                        Actions
                    </button>
                    <div class="dropdown-menu" aria-labelledby="actionDropdown">
                        <button class="dropdown-item view" data-id="' . $patients->id . '">View</button>
                        <button class="dropdown-item edit" data-id="' . $patients->id . '">Edit</button>
                        <button class="dropdown-item delete" data-id="' . $patients->id . '">delete</button>
                    </div>
                </div>';

                    return $action;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('auth.patient.index');
    }

    public function fetchalldoctors()
    {
        $doctors = User::whereHas('position', function ($query) {
            $query->where('name', 'doctor');
        })->get();

        return response()->json($doctors);
    }

    public function fetchalldepartments()
    {
        $departments = Department::all();

        return response()->json($departments);
    }
    /* Store a newly created resource in storage.*/
    public function store(Request $request)
    {
        $data = $request->all();
        if ($file = $request->file('image')) {
            $fileName = $this->uploadFile($file);
            $data['image'] = $fileName;
        }

        $patient = Patient::create($data);
        if ($patient) {
            return response()->json(true);
        } else {
            return response()->json(false, 500);
        }
    }
    private function uploadFile($file)
    {
        $fileName = time() . '_' . $file->getClientOriginalName();
        $filepath = public_path('storage/auth/patients');
        $file->move($filepath, $fileName);
        return $fileName;
    }
    public function show($id)
    {
        $patient = Patient::find($id);
        if (!$patient) {
            abort(404);
        }
        $userName = $patient->user->name; // Get the doctor's name
        $departmentName = $patient->department->name; // Get the department's name
        $insuranceName = $patient->insurance->organization_name; // Get the department's name

        // Replace doctor and department IDs with their names
        $patient->user_id = $userName;
        $patient->department_id = $departmentName;
        $patient->insurance_id = $insuranceName;
        if ($patient->image == '') {
            $patient->image = asset('assets/auth/images/avatars/avatar1.avif');
        } else {
            $patient->image = asset('storage/auth/patients/' . $patient->image);
        }

        return response()->json($patient);
    }
    public function edit($id)
    {
        $patient = Patient::find($id);
        if (!$patient) {
            abort(404);
        }
        if ($patient->image == '') {
            $patient->image = asset('assets/auth/images/avatars/avatar1.avif');
        } else {
            $patient->image = asset('storage/auth/patients/' . $patient->image);
        }

        return response()->json($patient);
    }
    public function update(Request $request)
    {
        $data = $request->only([
            'name',
            'type',
            'age',
            'dob',
            'pat_gender',
            'cnic',
            'contact_no',
            'user_id',
            'department_id',
            'date_of_birth',
            'city',
            'guardian_name',
            'guardian_contact',
            'insurance_id',
            'reference',
            'address'
        ]);
        $id = $request->id;

        $patient = Patient::findOrFail($id);
        $oldImage = $patient->image;

        if ($request->hasFile('updateImage')) {
            $path = public_path('storage/auth/patients');

            // Upload new file
            $file = $request->file('updateImage');
            $filename = $file->getClientOriginalName();
            $file->move($path, $filename);

            // Update the table with the new filename
            $data['image'] = $filename;

            // Delete the old image file
            if ($oldImage && file_exists($path . '/' . $oldImage)) {
                unlink($path . '/' . $oldImage);
            }
        }

        $patient->update($data);
        return response()->json(['success' => 'Patient updated successfully']);
    }
    public function delete($id)
    {
        $patient = Patient::findOrFail($id); // Find the patient by its ID

        $patient->delete(); // Delete the patient
        return response()->json([
            "message" => "Patient Deleted Successfully"
        ], 200);
    }
    public function fetchallinsurances(){
        $insurance = Insurance::all();

        return response()->json($insurance);
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
}

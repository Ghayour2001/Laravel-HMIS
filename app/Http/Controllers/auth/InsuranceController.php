<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use App\Models\Insurance;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class InsuranceController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $insurances = Insurance::select([
                'id',
                'organization_name',
                'contact_no',
                'email',
                'limit',
                'from_date',
                'to_date',
                'contact_person_name',
                'contact_person_phone',
                'position',
                'address'
            ]);

            return DataTables::of($insurances)
                ->addColumn('action', function ($insurance) {
                    $action = '<div class="dropdown actiondropdown">
            <button class="btn btn-outline-secondary dropdown-toggle" type="button" id="actionDropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-patient-id="' . $insurance->id . '">
                <i class="fas fa-ellipsis-v"></i>
            </button>
            <div class="dropdown-menu" aria-labelledby="actionDropdown">
                <button class="dropdown-item viewButton" data-id="' . $insurance->id . '">View</button>
                <button class="dropdown-item editButton" data-id="' . $insurance->id . '">Edit</button>
                <button class="dropdown-item delete" data-id="' . $insurance->id . '">Delete</button>
            </div>
        </div>';

                    return $action;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('auth.insurance.index');
    }

    public function store(Request $request)
    {
        $insurance = Insurance::create($request->all());
        if ($insurance) {
            return response()->json(["success" => "Inserted Successfully"], 200);
        } else {
            return response()->json(['error' => 'Failed to save insurance'], 500);
        }
    }

    public function show($id)
    {
        try {
            $insurance = Insurance::find($id);

            if (!$insurance) {
                return response()->json(['error' => 'Insurance not found'], 404);
            }

            return response()->json($insurance);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Internal Server Error'], 500);
        }
    }
    public function updateInsurance(Request $request)
    {
        // Find the insurance record based on the provided identifier (e.g., organization_id)
        $insurance = Insurance::find($request->id);

        if (!$insurance) {
            return response()->json(['error' => 'Failed to Update insurance'], 500);
        }

        // Update the insurance data with the values from the form
        $insurance->organization_name = $request->organization_name;
        $insurance->contact_no = $request->contact_no;
        $insurance->email = $request->email;
        $insurance->limit = $request->limit;
        $insurance->from_date = $request->from_date;
        $insurance->to_date = $request->to_date;
        $insurance->contact_person_name = $request->contact_person_name;
        $insurance->contact_person_phone = $request->contact_person_phone;
        $insurance->position = $request->position;
        $insurance->address = $request->address;

        $insurance->save();

        return response()->json(["success" => "Insurance Update Successfully"], 200);
    }
    public function deleteinsurance($id)
    {

        $Insurance = Insurance::find($id);

        if ($Insurance) {
            $Insurance->delete();
            return response()->json(["success" => "Data Delete Successfully"], 200);
        }

        return response()->json(['error' => 'Failed to Delete insurance'], 404);
    }
}

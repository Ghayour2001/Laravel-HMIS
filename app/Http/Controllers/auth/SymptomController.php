<?php

namespace App\Http\Controllers\auth;



use App\Http\Controllers\Controller;
use App\Models\Symptom;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class SymptomController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $symptoms = Symptom::select([
                'id',
                'name',
                'description'
            ]);

            return DataTables::of($symptoms)
                ->addColumn('action', function ($symptom) {
                    $action = '<div class="dropdown actiondropdown">
                        <button class="btn btn-outline-secondary dropdown-toggle" type="button" id="actionDropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-patient-id="' . $symptom->id . '">
                            <i class="fas fa-ellipsis-v"></i>
                        </button>
                        <div class="dropdown-menu" aria-labelledby="actionDropdown">
                            <button class="dropdown-item viewButton" data-id="' . $symptom->id . '">View</button>
                            <button class="dropdown-item editButton" data-id="' . $symptom->id . '">Edit</button>
                            <button class="dropdown-item delete" data-id="' . $symptom->id . '">Delete</button>
                        </div>
                    </div>';

                    return $action;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('auth.symptoms.index');
    }

    public function store(Request $request)
    {
        $Symptom = Symptom::create($request->all());
        if ($Symptom) {
            return response()->json(["success" => "Inserted Successfully"], 200);
        } else {
            return response()->json(['error' => 'Failed to save Data'], 500);
        }
    }

    public function show($id)
    {
        $symptom = Symptom::find($id);

        if (!$symptom) {
            return response()->json(['error' => 'Symptom not found'], 404);
        }

        return response()->json($symptom);
    }

    public function update(Request $request)
    {
        // Find the symptom record based on the provided identifier (e.g., symptom ID)
        $symptom = Symptom::find($request->id);

        if (!$symptom) {
            return response()->json(['error' => 'Failed to update symptom'], 500);
        }

        // Update the symptom data with the values from the form
        $symptom->name = $request->name;
        $symptom->description = $request->description;

        // You can add more fields here if you have additional properties to update

        $symptom->save();

        return response()->json(["success" => "Symptom updated successfully"], 200);
    }

    public function delete($id)
    {

        $Symptom = Symptom::find($id);

        if ($Symptom) {
            $Symptom->delete();
            return response()->json(["success" => "Data Delete Successfully"], 200);
        }

        return response()->json(['error' => 'Failed to Delete Data'], 404);
    }
}

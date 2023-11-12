<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use App\Models\Position;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class PositionController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $positions = Position::select(['id', 'name', 'order_by', 'is_active']);

            return DataTables::of($positions)
            ->addColumn('action', function ($position) {
                $isActive = $position->is_active;
                $activeButton = $isActive ? '<button class="dropdown-item setActive" data-id="'.$position->id.'">InActive</button>' : '<button class="dropdown-item setActive" data-id="'.$position->id.'">Active</button>';

                $action = '<div class="dropdown actiondropdown">
                    <button class="btn btn-outline-secondary dropdown-toggle" type="button" id="actionDropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-patient-id="' . $position->id . '">
                        <i class="fas fa-ellipsis-v"></i>
                    </button>
                    <div class="dropdown-menu" aria-labelledby="actionDropdown">
                        '.$activeButton.'
                        <button class="dropdown-item view" data-id="'.$position->id.'">View</button>
                        <button class="dropdown-item edit" data-id="'.$position->id.'">Edit</button>
                        <button class="dropdown-item delete" data-id="'.$position->id.'">Delete</button>
                    </div>
                </div>';

                return $action;
            })
            ->rawColumns(['action'])
            ->make(true);


                ;
        }

        return view('auth.positions.index');
    }

    public function store(Request $request)
{
    $position = Position::create($request->all());
    if ($position) {
        return response()->json(['success' => true]);
    } else {
        return response()->json(['error' => 'Failed to save insurance'], 500);
    }
}

    public function fetchposition()
    {
        $Positions = Position::all();
        return response()->json(['positions' => $Positions,]);
    }
    public function edit($id)
{
    $positions = Position::find($id);

    return response()->json($positions);
}
public function updatePosition(Request $request)
{
    $position = Position::find($request->position_id);

    if (!$position) {
        $response['success'] = false;
        $response['message'] = 'Position not found';
        return response()->json($response);
    }

    $position->name = $request->position;
    $position->order_by = $request->order_by;
    $position->is_active = $request->has('edit_is_active') ? 1 : 0;

    $position->save();

    if ($position->wasChanged()) {
        $response['success'] = true;
        $response['message'] = 'Position updated successfully';
    } else {
        $response['success'] = false;
        $response['message'] = 'No changes were made';
    }

    return response()->json($response);
}
public function deletePosition(Request $request)
{
    $id = $request->input('id');
    $position = Position::find($id);

    if ($position) {
        $position->delete();
        return response()->json(['success' => true]);
    }

    return response()->json(['error' => 'Position not found'], 404);
}
public function updateActive(Request $request, $id)
{
    $position = Position::findOrFail($id);
    $position->is_active = !$position->is_active; // toggle the value of is_active
    $position->save();

    // You can return a response if needed
    return response()->json(['message' => 'Is active updated successfully']);
}


}

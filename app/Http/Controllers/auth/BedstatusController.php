<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;
class BedstatusController extends Controller
{
    public function index()
    {
        // Fetch the data by joining the tables using the DB facade
        $data = DB::table('beds')
            ->join('bedgroups', 'beds.bedgroup_id', '=', 'bedgroups.id')
            ->join('bedtypes', 'beds.bedtype_id', '=', 'bedtypes.id')
            ->join('floors', 'bedgroups.floor_id', '=', 'floors.id')
            ->select(
                'beds.name as bed_name',
                'floors.name as floor_name',
                'bedgroups.name as bedgroup_name',
                'bedtypes.name as bedtype_name',
                'beds.is_active as status'
            )
            ->get();

        // Return the data as a JSON response to the DataTable
        return DataTables::of($data)->toJson();
    }

}

<?php

namespace App\Http\Controllers\Branch;

use App\DataTables\Branch\DeliveryParcelDataTable;
use App\Http\Controllers\Controller;
use App\Models\Parcel;
use App\Models\RiderRun;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use NunoMaduro\Collision\Adapters\Phpunit\Style;
use Yajra\DataTables\Html\Builder;

class DeliveryParcelController extends Controller
{

    public function index(DeliveryParcelDataTable $dataTables, Request $request)
    {
        return $dataTables->render('themes.frest.branchPanel.delivery-parcel.list');
    }

    public function modifyStatus($id, Request $request)
    {
        if ($request->type === '1') {
            $parcel = Parcel::find($id);
            $riderRun = new RiderRun();
            $riderRun->branch_id = Auth::user()->branch_id;
            $riderRun->merchant_id = $parcel->merchant_id;
            $riderRun->run_type = 'delivery';
            $riderRun->create_date_time = now();
            $riderRun->total_parcel = 1;
            $riderRun->status = 1;

            if ($riderRun->save()) {
                riderRunStart($riderRun, $id);
                $parcel->status = 'dispatched-to-rider';
                $parcel->delivery_rider_run_id = $riderRun->id;
                $parcel->save();
            }

            return response()->json([
                'success' => true,
                'message' => 'Status updated successfully',
                'dd' =>  $riderRun,
            ]);
        } else {
            // TODO:://return to merchant
            return response()->json([
                'success' => true,
                'message' => 'Cancel updated successfully',
            ]);
        }
    }

    public function generate()
    {
        return view('themes.frest.branchPanel.pickup-percel.generate');
    }

    public function deliveryRiderList(Builder $builder)
    {
        $html = $builder->columns([
            ['data' => 'id', 'name' => 'id', 'title' => 'ID'],
            ['data' => 'name', 'name' => 'name', 'title' => 'Consignment'],
            ['data' => 'sl_no', 'name' => 'sl_no', 'title' => 'Rider Name'],
            ['data' => 'number', 'name' => 'number', 'title' => 'Rider Address'],
            ['data' => 'number', 'name' => 'number', 'title' => 'Created Date'],
            ['data' => 'number', 'name' => 'number', 'title' => 'Complete Date'],
            ['data' => 'number', 'name' => 'number', 'title' => 'Run Parcel'],
            ['data' => 'number', 'name' => 'number', 'title' => 'Complete Parcel'],
            ['data' => 'status', 'name' => 'status', 'title' => 'Status'],
            ['data' => 'created_at', 'name' => 'created_at', 'title' => 'Action'],
        ]);
        return view('themes.frest.branchPanel.delivery-rider.list', compact('html'));
    }

    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}

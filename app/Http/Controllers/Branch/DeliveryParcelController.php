<?php

namespace App\Http\Controllers\Branch;

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
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Builder $builder, Request $request)
    {
        $html = $builder->columns([
            ['data' => 'DT_RowIndex', 'name' => 'DT_RowIndex', 'title' => 'SL', 'orderable' => false, 'searchable' => false],
            ['data' => 'parcel_id', 'name' => 'parcel_id', 'title' => 'Parcel'],
            ['data' => 'customer_name', 'name' => 'customer_name', 'title' => 'Customer Name'],
            ['data' => 'customer_phone', 'name' => 'customer_phone', 'title' => 'Customer Phone'],
            ['data' => 'delivery_address', 'name' => 'delivery_address', 'title' => 'Customer Address'],
            ['data' => 'district.name', 'name' => 'number', 'title' => 'District'],
            ['data' => 'zone.name', 'name' => 'number', 'title' => 'Zone'],
            ['data' => 'area.name', 'name' => 'number', 'title' => 'Area'],
            ['data' => 'status.message_en', 'name' => 'status', 'title' => 'Status'],
            ['data' => 'created_at', 'name' => 'created_at', 'title' => 'Date'],
            ['data' => 'action', 'name' => 'action', 'title' => 'Actions', 'orderable' => false, 'searchable' => false, 'style' => 'width:12%;'],
        ])->parameters([
            'initComplete' => 'function() {
                $("[data-toggle=\'tooltip\']").tooltip();

             }',
        ])->setTableId('delivery-table');
        if ($request->ajax()) {
            $bookings = Parcel::query()->deleviry()->where('branch_id', Auth::user()->branch_id)->with(['district', 'zone', 'area', 'status'])->get();
            return datatables()->of($bookings)
                ->addIndexColumn()
                ->editColumn('created_at', function ($booking) {
                    return $booking->created_at->diffForHumans();
                })

                ->addColumn('action', function ($booking) {
                    return '
                     <div class="demo-inline-spacing">
                        <button class="btn btn-success btn-icon btn-sm accept_parcel" data-toggle="tooltip" onclick="statusChange(' . $booking->id . ',1)" title="Start Parcel Delivery"> <i class="bx bx-play-circle"></i></button>
                        <button class="btn btn-danger btn-sm btn-icon" data-toggle="tooltip" onclick="statusChange(' . $booking->id . ',2)" title="Return Parcel to Merchant"> <i class="bx bx-reset"></i></button>
                        <button class="btn btn-warning btn-sm btn-icon"> <i class="bx bx-edit-alt"></i></button>
                    </div>
                    ';
                })
                ->make(true);
        }
        return view('themes.frest.branchPanel.delivery-parcel.list', compact('html'));
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
            // $riderRunx =  RiderRun::branch()
            //     ->whereDateBetween('created_at', [Carbon::now()->startOfDay(), Carbon::now()->endOfDay()])
            //     ->where('run_type', 'delivery')
            //     ->whereIn('status', [2, 1])
            //     ->first();
            // if ($riderRunx) {
            //     $riderRunx->total_parcel = $riderRunx->total_parcel + 1;
            //     if ($riderRunx->save()) {
            //         riderRunStart($riderRunx, $id);
            //         $parcel->status = 'dispatched-to-rider';
            //         $parcel->delivery_rider_run_id = $riderRunx->rider_id;
            //         $parcel->save();
            //         return response()->json([
            //             'success' => true,
            //             'message' => 'Status updated successfully',

            //         ]);
            //     }
            // } else {
            //     $riderRun = new RiderRun();
            //     $riderRun->branch_id = Auth::user()->branch_id;
            //     $riderRun->merchant_id = $parcel->merchant_id;
            //     $riderRun->run_type = 'delivery';
            //     $riderRun->create_date_time = now();
            //     $riderRun->total_parcel = 1;
            //     $riderRun->status = 1;

            //     if ($riderRun->save()) {
            //         riderRunStart($riderRun, $id);
            //         $parcel->status = 'dispatched-to-rider';
            //         $parcel->delivery_rider_run_id = $riderRun->id;
            //         $parcel->save();
            //     }

            //     return response()->json([
            //         'success' => true,
            //         'message' => 'Status updated successfully',
            //         'dd' =>  $riderRun,
            //     ]);
            // }
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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
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

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

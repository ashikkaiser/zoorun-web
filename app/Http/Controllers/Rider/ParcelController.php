<?php

namespace App\Http\Controllers\Rider;

use App\Http\Controllers\Controller;
use App\Models\Parcel;
use App\Models\Rider;
use App\Models\RiderParcel;
use App\Models\RiderRun;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;
use Yajra\DataTables\Html\Builder;

class ParcelController extends Controller
{

    public function pickup(Builder $builder, Request $request)
    {
        $html = $builder->columns([
            ['data' => 'DT_RowIndex', 'name' => 'DT_RowIndex', 'title' => 'SL', 'orderable' => false, 'searchable' => false],
            ['data' => 'parcel_id', 'name' => 'parcel_id', 'title' => 'Parcel ID'],
            ['data' => 'merchant.name', 'name' => 'merchant.name', 'title' => 'Merchant Name'],
            ['data' => 'pickup_address.address', 'name' => 'pickup_address.address', 'title' => 'Merchant Address'],
            ['data' => 'customer_name', 'name' => 'customer_name', 'title' => 'Customer Name'],
            ['data' => 'customer_phone', 'name' => 'customer_phone', 'title' => 'Customer Phone'],
            ['data' => 'total', 'name' => 'total', 'title' => 'Total Charge'],
            ['data' => 'status', 'name' => 'status', 'title' => 'Status'],
            ['data' => 'action', 'name' => 'action', 'title' => 'Actions', 'orderable' => false, 'searchable' => false, 'width' => '15%'],

        ])->parameters([
            'initComplete' => 'function() {
                $("[data-tooltip=\'tooltip\']").tooltip();

             }',
        ])
            ->setTableId('pickup-table');

        if ($request->ajax()) {
            if ($request->type === 'running') {
                $parcels_ids = RiderRun::where('rider_id', Auth::user()->rider()->first()->id)->where('run_type', 'pickup')->where('status', 2)
                    ->with('rider_parcel')->get()->map(function ($item) {
                        return $item->rider_parcel->map(function ($item) {
                            return $item->parcel_id;
                        });
                    })->flatten();
            } else {
                $parcels_ids = RiderRun::whereNull('rider_id')->where('run_type', 'pickup')->where('status', 1)
                    ->with('rider_parcel')->get()->map(function ($item) {
                        return $item->rider_parcel->map(function ($item) {
                            return $item->parcel_id;
                        });
                    })->flatten();
            }
            $parcels = Parcel::query()->whereIn('id', $parcels_ids)->with(['merchant', 'pickup_address', 'riderParcel'])->withRiderRun();
            return DataTables::of($parcels)
                ->addIndexColumn()
                ->addColumn('action', function ($parcel) use ($request) {

                    if ($request->type === 'running') {
                        $type = 'pickup-running';
                        // return $parcel->status;
                        return view('themes.frest.riderPanel.parcel.actions', compact('parcel', 'type'));
                    } else {
                        $type = 'pickup-pending';
                        return view('themes.frest.riderPanel.parcel.actions', compact('parcel', 'type'));
                    }
                })
                ->editColumn('status', function ($parcel) {
                    // if ($parcel->status == 'delivery-assigned') {
                    //     return '<span class="badge bg-warning">Collect from Warehouse</span>';
                    // }

                    if ($parcel->rider_parcel['status'] === 1) {
                        return '<span class="badge bg-red">Pending</span>';
                    }
                    if ($parcel->rider_parcel['status'] === 2) {
                        return '<span class="badge bg-info">Pickup Started</span>';
                    }
                    if ($parcel->rider_parcel['status'] === 3) {
                        return '<span class="badge bg-success">Pickup Completed</span>';
                    }
                })
                ->rawColumns(['action', 'status'])
                ->make(true);
        }
        return view('themes.frest.riderPanel.parcel.pickup', compact('html'));
    }


    public function pickupStatus(Request $request, $id)
    {

        $parcel = Parcel::find($id);
        $parcel->riderParcel->status = 2;
        $parcel->riderParcel->rider_id = Auth::user()->rider()->first()->id;
        $parcel->status = 'pickup-assigned';
        $run = RiderRun::find($parcel->riderParcel->rider_run_id);
        $run->rider_id = Auth::user()->rider()->first()->id;
        $run->status = 2;
        $run->save();
        $parcel->push();

        return response()->json(['status' => $parcel->status, 'run' => $run]);
    }




    public function viewParcel($id)
    {
        $parcel = Parcel::query()->where('id', $id)->with(['merchant', 'status', 'pickup_address'])->first();
        return view('themes.frest.riderPanel.parcel.modal.parcel_info', compact('parcel'));
    }
    public function confirmParcel($id, Request $request)
    {

        $parcel = Parcel::find($id);
        if ($request->has('confirmParcel')) {
            $parcel->status = 'pickup-completed';
            $parcel->riderParcel->status = 3;
            $parcel->rider_run->complete_parcel = $parcel->rider_run->complete_parcel + 1;
            $parcel->push();
            return response()->json([
                'status' => 'success',
                'message' => 'Parcel Confirmed'
            ]);
        }
        return view('themes.frest.riderPanel.parcel.modal.confirm', compact('parcel'));
    }
    public function rescheduleParcel($id)
    {
        $parcel = Parcel::query()->where('id', $id)->with(['merchant', 'status', 'pickup_address'])->first();
        return view('themes.frest.riderPanel.parcel.modal.pickup_reschedule', compact('parcel'));
    }
    //delivery

    public function delivery(Builder $builder, Request $request)
    {


        $html = $builder->columns([
            ['data' => 'DT_RowIndex', 'name' => 'DT_RowIndex', 'title' => 'SL', 'orderable' => false, 'searchable' => false],
            ['data' => 'parcel_id', 'name' => 'parcel_id', 'title' => 'Parcel ID'],
            ['data' => 'merchant.name', 'name' => 'merchant.name', 'title' => 'Merchant Name'],
            ['data' => 'pickup_address.address', 'name' => 'pickup_address.address', 'title' => 'Merchant Address'],
            ['data' => 'customer_name', 'name' => 'customer_name', 'title' => 'Customer Name'],
            ['data' => 'customer_phone', 'name' => 'customer_phone', 'title' => 'Customer Phone'],
            ['data' => 'total', 'name' => 'total', 'title' => 'Total Charge'],
            ['data' => 'status', 'name' => 'status', 'title' => 'Status'],
            ['data' => 'action', 'name' => 'action', 'title' => 'Actions', 'orderable' => false, 'searchable' => false, 'width' => '15%'],

        ])->parameters([
            'initComplete' => 'function() {
                $("[data-tooltip=\'tooltip\']").tooltip();

             }',
        ])
            ->setTableId('pickup-table');

        if ($request->ajax()) {
            if ($request->type === 'running') {
                $parcels_ids = RiderRun::where('rider_id', Auth::user()->rider()->first()->id)->where('run_type', 'delivery')->where('status', 2)
                    ->with('rider_parcel')->get()->map(function ($item) {
                        return $item->rider_parcel->map(function ($item) {
                            return $item->parcel_id;
                        });
                    })->flatten();
            } else {
                $parcels_ids = RiderRun::whereNull('rider_id')->where('run_type', 'delivery')->where('status', 1)
                    ->with('rider_parcel')->get()->map(function ($item) {
                        return $item->rider_parcel->map(function ($item) {
                            return $item->parcel_id;
                        });
                    })->flatten();
            }
            $parcels = Parcel::query()->whereIn('id', $parcels_ids)->with(['merchant', 'pickup_address', 'riderParcel'])->withRiderRun();
            return DataTables::of($parcels)
                ->addIndexColumn()
                ->addColumn('action', function ($parcel) use ($request) {
                    if ($request->type === 'running') {
                        $type = 'delivery-running';
                        return view('themes.frest.riderPanel.parcel.delivery_action', compact('parcel', 'type'));
                    } else {
                        $type = 'delivery-pending';
                        return view('themes.frest.riderPanel.parcel.delivery_action', compact('parcel', 'type'));
                    }
                })
                ->editColumn('status', function ($parcel) {

                    if ($parcel->rider_parcel['status'] === 1) {
                        return '<span class="badge bg-danger">Pending</span>';
                    }
                    if ($parcel->rider_parcel['status'] === 2) {
                        return '<span class="badge bg-info">Delivery Started</span>';
                    }
                    if ($parcel->rider_parcel['status'] === 3) {
                        return '<span class="badge bg-success">Delivery Completed</span>';
                    }
                })
                ->rawColumns(['action', 'status'])
                ->make(true);
        }
        return view('themes.frest.riderPanel.parcel.delivery', compact('html'));
    }
    public function deliveryStatus(Request $request, $id)
    {

        $parcel = Parcel::find($id);
        $parcel->riderParcel->status = 2;
        $parcel->riderParcel->rider_id = Auth::user()->rider()->first()->id;
        $parcel->status = 'delivery-assigned';
        $run = RiderRun::find($parcel->riderParcel->rider_run_id);
        $run->rider_id = Auth::user()->rider()->first()->id;
        $run->status = 2;
        $run->save();
        $parcel->push();

        return response()->json(['status' => $parcel->status, 'run' => $run]);
    }

    public function deliveryViewParcel($id)
    {
        $parcel = Parcel::query()->where('id', $id)->with(['merchant', 'status', 'pickup_address'])->first();
        return view('themes.frest.riderPanel.parcel.modal.delivery_parcel_info', compact('parcel'));
    }
    public function deliveryConfirmParcel($id, Request $request)
    {

        $parcel = Parcel::find($id);
        if ($request->has('confirmParcel')) {
            $parcel->status = 'delivery-completed';
            $parcel->riderParcel->status = 3;
            $parcel->rider_run->complete_parcel = $parcel->rider_run->complete_parcel + 1;
            $parcel->push();
            return response()->json([
                'status' => 'success',
                'message' => 'Parcel Confirmed'
            ]);
        }
        return view('themes.frest.riderPanel.parcel.modal.delivery_confirm', compact('parcel'));
    }
    public function deliveryRescheduleParcel($id)
    {
        $parcel = Parcel::query()->where('id', $id)->with(['merchant', 'status', 'pickup_address'])->first();
        return view('themes.frest.riderPanel.parcel.modal.delivery_reschedule', compact('parcel'));
    }

    public function sendDeliveryOtp()
    {
        $parcel = Parcel::find(request()->parcel_id);
        $parcel->delivery_otp = rand(10000, 99999);
        $parcel->save();
        return response()->json(['status' => 'success', 'message' => 'Confirmation OTP Sent']);
    }

    public function deliveryVerifyOtp()
    {
        $parcel = Parcel::find(request()->parcel_id);
        if ($parcel->delivery_otp == request()->otp) {

            return response()->json(['status' => 'success', 'message' => 'Parcel Confirmed']);
        }
        return response()->json(['status' => 'error', 'message' => 'Invalid OTP']);
    }







    public function return(Builder $builder, Request $request)
    {
        $html = $builder->columns([
            ['data' => 'DT_RowIndex', 'name' => 'DT_RowIndex', 'title' => 'SL', 'orderable' => false, 'searchable' => false],
            ['data' => 'parcel_id', 'name' => 'parcel_id', 'title' => 'Parcel ID'],
            ['data' => 'customer_name', 'name' => 'customer_name', 'title' => 'Merchant Name'],
            ['data' => 'delivery_address', 'name' => 'delivery_address', 'title' => 'Merchant Address'],
            ['data' => 'delivery_address', 'name' => 'delivery_address', 'title' => 'Customer Name'],
            ['data' => 'delivery_address', 'name' => 'delivery_address', 'title' => 'Customer Phone'],
            ['data' => 'delivery_address', 'name' => 'delivery_address', 'title' => 'Total Charge'],
            ['data' => 'status.message_en', 'name' => 'status', 'title' => 'Status'],
            ['data' => 'action', 'name' => 'action', 'title' => 'Actions', 'orderable' => false, 'searchable' => false],

        ]);


        return view('themes.frest.riderPanel.parcel.return', compact('html'));
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

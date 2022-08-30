<?php

namespace App\Http\Controllers\Warehouse;

use App\Http\Controllers\Controller;
use App\Models\Branch;
use App\Models\Parcel;
use App\Models\Rider;
use App\Models\RiderParcel;
use App\Models\RiderRun;
use App\Models\User;
use App\Models\Warehouse;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Html\Builder;

class BookingController extends Controller
{

    public function index(Builder $builder)
    {
        $html = $builder->columns([
            ['data' => 'id', 'name' => 'id', 'title' => 'ID'],
            ['data' => 'name', 'name' => 'name', 'title' => 'Date'],
            ['data' => 'sl_no', 'name' => 'sl_no', 'title' => 'Parcel No'],
            ['data' => 'number', 'name' => 'number', 'title' => 'Sender Contact'],
            ['data' => 'number', 'name' => 'number', 'title' => 'Sender Branch'],
            ['data' => 'number', 'name' => 'number', 'title' => 'Receiver Contact'],
            ['data' => 'number', 'name' => 'number', 'title' => 'Receiver Branch'],
            ['data' => 'number', 'name' => 'number', 'title' => 'Net Amount'],
            ['data' => 'number', 'name' => 'number', 'title' => 'Delivery Type'],
            ['data' => 'status', 'name' => 'status', 'title' => 'Status'],
            ['data' => 'created_at', 'name' => 'created_at', 'title' => 'Action'],
        ]);
        return view('themes.frest.warehousePanel.booking.index', compact('html'));
    }


    public function operation(Builder $builder, Request $request)
    {
        $warehouses = Warehouse::all();

        $html = $builder->columns([
            [
                'title'          => '<div class="icheck-primary d-inline"> <input type="checkbox" id="checkAllAssign" class="form-check-input"> <label for="checkAllAssign"> All  </label> </div>',
                'data'           => 'checkbox',
                'name'           => 'checkbox',
                'orderable'      => false,
                'searchable'     => false,
                'exportable'     => false,
                'printable'      => false,
                'width'          => '41px',
                'class' => 'sorting_disabled'
            ],
            ['data' => 'DT_RowIndex', 'name' => 'DT_RowIndex', 'title' => 'SL', 'orderable' => false, 'searchable' => false, 'shorting' => false],
            ['data' => 'parcel_id', 'name' => 'parcel_id', 'title' => 'Parcel No'],
            ['data' => 'merchant.name', 'name' => 'merchant.name', 'title' => 'Sender Contact'],
            ['data' => 'branch', 'name' => 'branch', 'title' => 'Receiver Branch'],
            ['data' => 'delivery_charge', 'name' => 'delivery_charge', 'title' => 'Charge'],
            ['data' => 'reschedule', 'name' => 'delivery_reschedule_attempts', 'title' => 'Reshedule'],
            ['data' => 'action', 'name' => 'action', 'title' => 'Actions', 'orderable' => false, 'searchable' => false],

        ])->setTableId('booking_table');
        $warehouse = Warehouse::find(Auth::user()->warehouse_id);
        $riders = Rider::where('branch_id', $warehouse->branch_id)->where('status', 1)->get();
        if ($request->ajax()) {
            $runner = RiderRun::where('rider_id', $request->rider_id)->where('status', 2)->pluck('id');

            $rParcelIds = \App\Models\RiderParcel::whereIn('rider_run_id', $runner)->pluck('parcel_id');
            $bookings = Parcel::query()->whereIn('id', $rParcelIds)->with(['zone', 'status', 'merchant']);
            if ($request->type === 'pickup') {
                $bookings = $bookings->whereIn('status', ['pickup-completed', 'delivery-rescheduled']);
            } else {
                $bookings = $bookings->where('status', ['delivery-assigned']);
            }



            return datatables()->of($bookings)
                ->addIndexColumn()
                ->editColumn('created_at', function ($booking) {
                    return $booking->created_at->diffForHumans();
                })
                ->editColumn('branch', function ($booking) {
                    // $branch = Branch::where('zone_id', $booking->zone_id)->first();
                    // return $branch ? $branch->name : 'N/A';
                    return $booking->merchant->name;
                })
                ->editColumn('reschedule', function ($booking) {
                    if ($booking->status === 'delivery-rescheduled') {
                        return '<span class="badge bg-danger">' . $booking->delivery_reschedule_attempts . '</span>';
                    } else {
                        return '<span class="badge bg-success">' . $booking->pickup_reschedule_attempts . '</span>';
                    }
                })
                ->editColumn('checkbox', function ($booking) {
                    return '<input type="checkbox" data-name="' . $booking->parcel_id . '" data-runid="' . $booking->pickup_rider_run_id . '" class="form-check-input checkboxPercel" value="' . $booking->id . '">';
                })
                ->editColumn('delivery_charge', function ($booking) {
                    return $booking->delivery_charge . ' Tk';
                })

                ->addColumn('action', function ($booking) {
                    return '<a href="" class="btn btn-primary btn-sm">View</a>';
                })
                ->rawColumns(['status', 'action', 'checkbox', 'reschedule'])
                ->make(true);
        }
        return view('themes.frest.warehousePanel.booking.operation', compact('warehouse', 'riders', 'html', 'warehouses'));
    }

    public function ajax_get_parcels_by_riders(Request $request)
    {
        $runner = RiderRun::where('rider_id', $request->rider_id)->pluck('id');
        $rider_parcels = \App\Models\RiderParcel::whereIn('rider_run_id', $runner)->get();
        return response()->json($rider_parcels);
    }

    public function dispatchWarehouse(Request $request)
    {

        if ($request->type === 'pickup') {
            foreach ($request->parcels as $parcel) {
                $p = Parcel::find($parcel);
                if ($p->status === 'delivery-rescheduled') {
                    $riderRunx = RiderRun::find($p->delivery_rider_run_id);
                    RiderParcel::where('rider_run_id', $riderRunx->id)->where('parcel_id', $p->id)->delete();

                    $riderRun = new RiderRun();
                    $riderRun->branch_id = $p->branch_id;
                    $riderRun->merchant_id = $p->merchant_id;
                    $riderRun->run_type = 'delivery';
                    $riderRun->create_date_time = Carbon::parse($request->reschedule_date);
                    $riderRun->total_parcel = 1;
                    $riderRun->status = 1;
                    if ($riderRun->save()) {
                        riderRunStart($riderRun, $p->id);
                        $p->status = 'dispatched-to-rider';
                        $p->delivery_rider_run_id = $riderRun->id;
                        $p->save();
                    }
                } else {
                    $p->status = 'received-to-warehouse';
                    $p->save();
                    riderRunEnd($p->pickup_rider_run_id);
                }
            }
        }
        if ($request->type === 'delivery') {
            foreach ($request->parcels as $parcel) {
                $p = Parcel::find($parcel);
                $p->status = 'delivery-in-progress';
                $p->save();
            }
        }
        return redirect()->back()->with('success', 'Parcels has been dispatched');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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

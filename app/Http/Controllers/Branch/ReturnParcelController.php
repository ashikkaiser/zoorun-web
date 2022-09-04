<?php

namespace App\Http\Controllers\Branch;

use App\Http\Controllers\Controller;
use App\Models\Parcel;
use App\Models\ParcelStatus;
use App\Models\Rider;
use App\Models\RiderRun;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Html\Builder;

class ReturnParcelController extends Controller
{
    public function returnParcelList(Builder $builder, Request $request)
    {
        $html = $builder->columns([
            ['data' => 'DT_RowIndex', 'name' => 'DT_RowIndex', 'title' => 'SL', 'orderable' => false, 'searchable' => false],
            ['data' => 'parcel_id', 'name' => 'parcel_id', 'title' => 'Parcel'],
            ['data' => 'customer_name', 'name' => 'customer_name', 'title' => 'Customer Name'],
            ['data' => 'customer_phone', 'name' => 'customer_phone', 'title' => 'Customer Phone'],
            ['data' => 'district.name', 'name' => 'number', 'title' => 'District'],
            ['data' => 'zone.name', 'name' => 'number', 'title' => 'Zone'],
            ['data' => 'area.name', 'name' => 'number', 'title' => 'Area'],
            ['data' => 'status', 'name' => 'status', 'title' => 'Status'],
            ['data' => 'created_at', 'name' => 'created_at', 'title' => 'Date'],
            ['data' => 'action', 'name' => 'action', 'title' => 'Actions', 'orderable' => false, 'searchable' => false, 'width' => '15%'],

        ])->setTableId('pickup-table');
        if ($request->ajax()) {
            $bookings = Parcel::query()->where('is_return', true)->branch()->with(['district', 'zone', 'area', 'status'])->get();
            return datatables()->of($bookings)
                ->addIndexColumn()
                ->editColumn('created_at', function ($booking) {
                    return $booking->created_at->diffForHumans();
                })
                ->addColumn('action', function ($booking) {
                    return '
                     <div class="demo-inline-spacing">
                        <button class="btn btn-success btn-icon btn-sm accept_parcel" onclick="statusChange(' . $booking->id . ',1)"> <i class="bx bx-check-circle"></i></button>
                        <button class="btn btn-danger btn-sm btn-icon" onclick="statusChange(' . $booking->id . ',2)"> <i class="bx bxs-x-square"></i></button>
                        <button class="btn btn-warning btn-sm btn-icon"> <i class="bx bx-edit-alt"></i></button>
                    </div>
                    ';
                })
                ->editColumn('status', function ($booking) {
                    if ($booking->is_return) {
                        return '<span class="badge bg-success">' . $booking->return_status . '</span>';
                    } else {
                        if ($booking->is_hold) {
                            return '<span class="badge bg-warning">Hold</span>';
                        } else {
                            return '<span class="badge bg-success">' . $booking->status . '</span>';
                        }
                    }
                })
                ->rawColumns(['status', 'action'])
                ->make(true);
        }
        return view('themes.frest.branchPanel.return-parcel.parcel-list', compact('html'));
    }



    public function modifyStatus($id, Request $request)
    {
        if ($request->type === '1') {
            $parcel = Parcel::find($id);
            $riderRunx =  RiderRun::branch()
                ->where('run_type', 'return')
                ->where('merchant_id', $parcel->merchant_id)
                ->whereIn('status', [1, 2])
                ->first();
            if ($riderRunx) {
                $riderRunx->total_parcel = $riderRunx->total_parcel + 1;
                if ($riderRunx->save()) {
                    riderRunStart($riderRunx, $id);
                    if ($parcel->return_status == 'return-delivery-requested') {
                        $parcel->return_status = 'parcel-delivery-returning';
                        $parcel->return_delivery_rider_run_id = $riderRunx->id;
                    } else {
                        $parcel->return_status = 'parcel-pickup-returning';
                        $parcel->return_pickup_rider_run_id = $riderRunx->id;
                    }

                    $parcel->save();
                    return response()->json([
                        'success' => true,
                        'message' => 'Status updated successfully',

                    ]);
                }
            } else {
                $riderRun = new RiderRun();
                $riderRun->branch_id = Auth::user()->branch_id;
                $riderRun->merchant_id = $parcel->merchant_id;
                $riderRun->run_type = 'return';
                $riderRun->create_date_time = now();
                $riderRun->total_parcel = 1;
                $riderRun->status = 1;

                if ($riderRun->save()) {
                    riderRunStart($riderRun, $id);
                    if ($parcel->return_status == 'return-delivery-requested') {
                        $parcel->return_status = 'parcel-delivery-returning';
                        $parcel->return_delivery_rider_run_id = $riderRun->id;
                    } else {
                        $parcel->return_status = 'parcel-pickup-returning';
                        $parcel->return_pickup_rider_run_id = $riderRun->id;
                    }
                    $parcel->save();
                }
                return response()->json([
                    'success' => true,
                    'message' => 'Status updated successfully',
                ]);
            }
        } else {
            // $parcel = Parcel::find($id);
            // $parcel->status_id = $request->status_id;
            // return response()->json([
            //     'success' => true,
            //     'message' => 'Cancel updated successfully',
            // ]);
        }
    }

    public function returnRiderList(Builder $builder, Request $request)
    {
        $riders = Rider::branchRider()->get();
        $html = $builder->columns([
            ['data' => 'DT_RowIndex', 'name' => 'DT_RowIndex', 'title' => 'SL', 'orderable' => false, 'searchable' => false],
            ['data' => 'run_id', 'name' => 'run_id', 'title' => 'Consignment'],
            ['data' => 'rider.name', 'name' => 'rider.name', 'title' => 'Rider Name'],
            ['data' => 'rider.phone', 'name' => 'rider.phone', 'title' => 'Rider Phone'],
            ['data' => 'created_at', 'name' => 'created_at', 'title' => 'Create Date'],
            ['data' => 'updated_at', 'name' => 'updated_at', 'title' => 'Complete Date'],
            ['data' => 'total_parcel', 'name' => 'total_parcel', 'title' => 'Total Parcel'],
            ['data' => 'complete_parcel', 'name' => 'complete_parcel', 'title' => 'Complete Parcel'],
            ['data' => 'status', 'name' => 'status', 'title' => 'Status'],
            ['data' => 'action', 'name' => 'action', 'title' => 'Action', "width" => "18%", 'orderable' => false, 'searchable' => false],

        ])->parameters([
            'initComplete' => 'function() {
                $("[data-toggle=\'tooltip\']").tooltip();
             }',
        ])
            ->setTableId('pickupRiderList');
        if ($request->ajax()) {
            $riderRuns = RiderRun::query()->where('run_type', 'return')->branch()->with('rider');
            return datatables()->of($riderRuns)
                ->addIndexColumn()
                ->editColumn('created_at', function ($riderRun) {
                    return $riderRun->created_at->format('d-m-Y');
                })
                ->editColumn('updated_at', function ($riderRun) {
                    return $riderRun->updated_at->format('d-m-Y');
                })
                ->editColumn('rider.name', function ($riderRun) {
                    return $riderRun->rider ? $riderRun->rider->name : 'N/A';
                })
                ->editColumn('rider.phone', function ($riderRun) {
                    return $riderRun->rider ? $riderRun->rider->phone : 'N/A';
                })
                ->editColumn('status', function ($riderRun) {
                    if ($riderRun->status == 1) {
                        return '<span class="badge bg-info">Return Created</span>';
                    } else if ($riderRun->status == 2) {
                        return '<span class="badge bg-primary">Return Started</span>';
                    } else if ($riderRun->status == 3) {
                        return '<span class="badge bg-success">Return Completed</span>';
                    }
                })
                ->editColumn('action', function ($riderRun) {
                    return view('themes.frest.branchPanel.pickup-rider.action', compact('riderRun'));
                })
                ->rawColumns(['status'])
                ->make(true);
        }
        return view('themes.frest.branchPanel.return-parcel.rider-list', compact('html', 'riders'));
    }
}

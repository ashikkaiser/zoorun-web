<?php

namespace App\Http\Controllers\Warehouse;

use App\Http\Controllers\Controller;
use App\Models\Branch;
use App\Models\Parcel;
use App\Models\Rider;
use App\Models\RiderRun;
use App\Models\Warehouse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Html\Builder;

class TransfarController extends Controller
{
    public function send(Builder $builder, Request $request)
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
        $isReturn = $request->id === 'return' ? true : false;
        $warehouse = Warehouse::find(Auth::user()->warehouse_id);
        $riders = Rider::where('branch_id', $warehouse->branch_id)->where('status', 1)->get();
        $branches = Branch::whereNotIn('id', [$warehouse->branch_id])->get();
        // dd($branches);
        if ($request->ajax()) {
            $runner = RiderRun::where('rider_id', $request->rider_id)->where('status', 2)->pluck('id');

            $rParcelIds = \App\Models\RiderParcel::whereIn('rider_run_id', $runner)->pluck('parcel_id');
            $bookings = Parcel::query()->whereIn('id', $rParcelIds)->with(['zone', 'status', 'merchant']);
            if ($request->type === 'pickup') {
                if ($isReturn) {
                    $bookings = $bookings->whereIn('return_status', ['return-pickup-completed']);
                } else {
                    $bookings = $bookings->whereIn('status', ['pickup-completed', 'delivery-rescheduled',]);
                }
            } else {
                if ($isReturn) {
                    $bookings = $bookings->whereIn('return_status', ['return-pickup-in-progress']);
                } else {
                    $bookings = $bookings->where('status', 'delivery-assigned');
                }
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
                    return '<button type="button" data-bs-target="#viewModal" data-bs-toggle="modal"  parcel_id="' . $booking->id . '" class="btn btn-primary btn-sm view-modal" >View</button>';
                })
                ->rawColumns(['status', 'action', 'checkbox', 'reschedule'])
                ->make(true);
        }
        return view('themes.frest.warehousePanel.transfar.index', compact('html', 'warehouses', 'riders', 'branches', 'warehouse'));
    }
    public function recieve(Builder $builder, Request $request)
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
        $isReturn = $request->id === 'return' ? true : false;
        $warehouse = Warehouse::find(Auth::user()->warehouse_id);
        $riders = Rider::where('branch_id', $warehouse->branch_id)->where('status', 1)->get();
        $branches = Branch::whereNotIn('id', [$warehouse->branch_id])->get();
        // dd($branches);
        if ($request->ajax()) {
            $runner = RiderRun::where('rider_id', $request->rider_id)->where('status', 2)->pluck('id');

            $rParcelIds = \App\Models\RiderParcel::whereIn('rider_run_id', $runner)->pluck('parcel_id');
            $bookings = Parcel::query()->whereIn('id', $rParcelIds)->with(['zone', 'status', 'merchant']);
            if ($request->type === 'pickup') {
                if ($isReturn) {
                    $bookings = $bookings->whereIn('return_status', ['return-pickup-completed']);
                } else {
                    $bookings = $bookings->whereIn('status', ['pickup-completed', 'delivery-rescheduled',]);
                }
            } else {
                if ($isReturn) {
                    $bookings = $bookings->whereIn('return_status', ['return-pickup-in-progress']);
                } else {
                    $bookings = $bookings->where('status', 'delivery-assigned');
                }
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
                    return '<button type="button" data-bs-target="#viewModal" data-bs-toggle="modal"  parcel_id="' . $booking->id . '" class="btn btn-primary btn-sm view-modal" >View</button>';
                })
                ->rawColumns(['status', 'action', 'checkbox', 'reschedule'])
                ->make(true);
        }
        return view('themes.frest.warehousePanel.transfar.recieve', compact('html', 'warehouses', 'riders', 'branches', 'warehouse'));
    }
}

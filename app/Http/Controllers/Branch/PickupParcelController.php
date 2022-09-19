<?php

namespace App\Http\Controllers\Branch;

use App\DataTables\Branch\PickupParcelDataTable;
use App\DataTables\Branch\PickupRiderDataTable;
use App\Http\Controllers\Controller;
use App\Models\Parcel;
use App\Models\ParcelHistory;
use App\Models\ParcelStatus;
use App\Models\Rider;
use App\Models\RiderRun;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Html\Builder;

class PickupParcelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(PickupParcelDataTable $dataTables)
    {
        return $dataTables->render('themes.frest.branchPanel.pickup-percel.list');
    }


    public function modifyStatus($id, Request $request)
    {
        if ($request->type === "1") {
            $parcel = Parcel::find($id);
            $riderRunx =  RiderRun::branch()
                ->where('run_type', 'pickup')
                ->where('merchant_id', $parcel->merchant_id)
                ->whereIn('status', [1, 2])
                ->first();
            if ($riderRunx) {
                $riderRunx->total_parcel = $riderRunx->total_parcel + 1;
                if ($riderRunx->save()) {
                    riderRunStart($riderRunx, $id);
                    $parcel->status = 'pickup-accepted';
                    $parcel->pickup_rider_run_id = $riderRunx->id;
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
                $riderRun->run_type = 'pickup';
                $riderRun->create_date_time = now();
                $riderRun->total_parcel = 1;
                $riderRun->status = 1;

                if ($riderRun->save()) {
                    riderRunStart($riderRun, $id);
                    $parcel->status = 'pickup-accepted';
                    $parcel->pickup_rider_run_id = $riderRun->id;
                    $parcel->save();
                }
                return response()->json([
                    'success' => true,
                    'message' => 'Status updated successfully',
                    'dd' =>  $riderRun,
                ]);
            }
        } else {
            $parcel = Parcel::find($id);
            $parcel->status_id = $request->status_id;
            // $parcel->save();
            // $parcelHistory = new ParcelHistory();
            // $parcelHistory->parcel_id = $parcel->id;
            // $parcelHistory->status_id = $request->status_id;
            // $parcelHistory->save();
            return response()->json([
                'success' => true,
                'message' => 'Cancel updated successfully',
            ]);
        }
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function generate(Builder $builder, Request $request)
    {
        $riders = Rider::branchRider()->get();
        $html = $builder->columns([
            [
                'title'          => '<input type="checkbox" id="selectAll">',  'data' => 'checkbox',  'name' => 'checkbox',
                'orderable'      => false,
                'searchable'     => false,
                'exportable'     => false,
                'printable'      => true,
                'width'          => '10px',
            ],
            ['data' => 'DT_RowIndex', 'name' => 'DT_RowIndex', 'title' => 'SL', 'orderable' => false, 'searchable' => false],
            ['data' => 'parcel_id', 'name' => 'parcel_id', 'title' => 'Parcel'],
            ['data' => 'merchant_order_id', 'name' => 'merchant_order_id', 'title' => 'Marchent Order'],
            ['data' => 'merchant.name', 'name' => 'customer_phone', 'title' => 'Marchent Name'],
            ['data' => 'merchant.phone', 'name' => 'delivery_address', 'title' => 'Marchent Number'],
            ['data' => 'pickup_address', 'name' => 'number', 'title' => 'Marchent Address'],
            ['data' => 'customer_name', 'name' => 'customer_name', 'title' => 'Customer Name'],

        ]);
        if ($request->ajax()) {
            $bookings = Parcel::query()->branch()->pickup()->with(['district', 'zone', 'area', 'status', 'merchant', 'pickup_address'])->get();
            return datatables()->of($bookings)
                ->addIndexColumn()
                ->editColumn('created_at', function ($booking) {
                    return $booking->created_at->diffForHumans();
                })
                ->editColumn('pickup_address', function ($booking) {
                    return $booking->pickup_address->zone->name;
                })
                ->editColumn('checkbox', function ($booking) {
                    return '<input type="checkbox" data-name="' . $booking->parcel_id . '" class="checkboxPercel" value="' . $booking->id . '">';
                })
                ->rawColumns(['checkbox'])
                ->make(true);
        }
        return view('themes.frest.branchPanel.pickup-percel.generate', compact('riders', 'html'));
    }

    public function storeRiderRun(Request $request)
    {
        $ids = $request->parcels;
        $last_id = RiderRun::latest('id')->first();
        $run_id = isset($last_id) ? $last_id->id + 1000  : 1000;
        $riderRun = new RiderRun();
        $riderRun->run_id = 'RUN-' . $run_id;
        $riderRun->rider_id = $request->rider_id;
        $riderRun->branch_id = Auth::user()->branch_id;
        $riderRun->run_type = 'pickup';
        $riderRun->create_date_time = now();
        $riderRun->total_parcel = count($ids);
        $riderRun->complete_parcel = 0;
        $riderRun->parcels = json_encode($ids);
        $riderRun->notes = $request->notes;
        $riderRun->status = 1;
        if ($riderRun->save()) {
            foreach ($ids as $id) {
                $parcel = Parcel::find($id);
                $parcel->pickup_rider_id = $riderRun->rider_id;
                $parcel->save();
            }

            return redirect()->route('branch.parcel.pickup.rider.list')->with('success', 'Rider Run Created Successfully');
        }
    }


    public function pickupRiderList(PickupRiderDataTable $dataTables, Request $request)
    {
        $riders = Rider::branchRider()->get();
        return $dataTables->render('themes.frest.branchPanel.pickup-rider.list', compact('riders'));
    }

    public function ViewModal($id)
    {
        $riderRun = RiderRun::find($id);
        return view('themes.frest.branchPanel.pickup-rider.view-modal', compact('riderRun'));
    }

    public function riderRunStart(Request $request)
    {
        $riderRun = RiderRun::find($request->id);
        $riderRun->status = 2;
        if ($riderRun->save()) {
            Parcel::findMany(json_decode($riderRun->parcels))->where('status', 'pickup-pending')->each(function ($parcel) {
                $parcel->status = 'pickup-assigned';
                $parcel->save();
                $history = new ParcelHistory();
                $history->parcel_id = $parcel->id;
                $history->status_id = ParcelStatus::where('key', 'pickup-assigned')->first()->id;
                $history->save();
            });
        }
        return response()->json(['status' => 'success', 'message' => 'Rider Run Started Successfully']);
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function generateBranchTransfer(Builder $builder, Request $request)
    {

        return view('themes.frest.branchPanel.pickup-percel.generate-branch-transfer');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function deliveryBrachTransferList(Builder $builder)
    {
        $html = $builder->columns([
            ['data' => 'id', 'name' => 'id', 'title' => 'ID'],
            ['data' => 'name', 'name' => 'name', 'title' => 'Consignment'],
            ['data' => 'sl_no', 'name' => 'sl_no', 'title' => 'Branch Name'],
            ['data' => 'number', 'name' => 'number', 'title' => 'Branch Address'],
            ['data' => 'number', 'name' => 'number', 'title' => 'Branch Phone'],
            ['data' => 'number', 'name' => 'number', 'title' => 'Created Date'],
            ['data' => 'number', 'name' => 'number', 'title' => 'Complete Date'],
            ['data' => 'number', 'name' => 'number', 'title' => 'Transfer Parcel'],
            ['data' => 'number', 'name' => 'number', 'title' => 'Complete Parcel'],
            ['data' => 'created_at', 'name' => 'created_at', 'title' => 'Action'],
        ]);
        return view('themes.frest.branchPanel.pickup-percel.delivery-branch-transfer-list', compact('html'));
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

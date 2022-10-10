<?php

namespace App\Http\Controllers\Merchant;

use App\Http\Controllers\Controller;
use App\Models\Parcel;
use App\Models\ParcelHistory;
use App\Models\ServiceArea;
use App\Models\WeightPackage;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Yajra\DataTables\Html\Builder;

class PageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function orderTrack()
    {
        if (isset($_GET['merchant_order_id'])) {
            $parcel = Parcel::where('merchant_order_id', $_GET['merchant_order_id'])->first();
            if ($parcel) {
                return redirect()->route('merchant.order.track.details', $_GET['merchant_order_id']);
            } else {
                session()->now('error', 'Sorry! No Parcel Found.');
            }
        }
        // session()->now('error', 'Sorry! No Parcel Found.');
        return view('themes.frest.merchantPanel.order-tracking.index');
    }
    public function orderTrackDetails($merchant_order_id)
    {
        $parcel = Parcel::where('merchant_order_id', $merchant_order_id)->first();
        $parcel_history = ParcelHistory::where('parcel_id', $parcel->id)->get();
        if ($parcel) {
            return view('admin::merchantPanel.order-tracking.details', compact('parcel', 'parcel_history'));
        } else {
            return redirect()->route('merchant.order.track')->with('error', 'Sorry! No Parcel Found.');
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function coverageArea(Request $request, Builder $builder)
    {
        $html = $builder->columns([
            ['data' => 'DT_RowIndex', 'name' => 'DT_RowIndex', 'title' => 'SL', 'orderable' => false, 'searchable' => false],
            ['data' => 'name', 'name' => 'name', 'title' => 'Name'],
            ['data' => 'description', 'name' => 'description', 'title' => 'Description', 'orderable' => false, 'searchable' => false],
            ['data' => 'cod', 'name' => 'cod', 'title' => 'COD %'],
            ['data' => 'status', 'name' => 'status', 'title' => 'Status'],
        ]);
        if (request()->ajax()) {
            $rowData = ServiceArea::all();
            return datatables()->of($rowData)
                ->addIndexColumn()
                ->editColumn('status', function ($rowData) {
                    if ($rowData->status == true) {
                        return '<span class="badge bg-success">Active</span>';
                    } else {
                        return '<span class="badge bg-danger">Inactive</span>';
                    }
                })
                ->rawColumns(['status'])
                ->make(true);
        }
        return view('themes.frest.merchantPanel.coverage-area.index', compact('html'));
    }

    public function serviceCharge(Builder $builder, Request $request)
    {

        $html = $builder->columns([
            ['data' => 'DT_RowIndex', 'name' => 'DT_RowIndex', 'title' => 'SL', 'orderable' => false, 'searchable' => false],
            ['data' => 'name', 'name' => 'name', 'title' => 'Name'],
            ['data' => 'description', 'name' => 'description', 'title' => 'Description'],
            ['data' => 'rate', 'name' => 'rate', 'title' => 'Rate'],
        ]);
        if ($request->ajax()) {
            $service_charge = WeightPackage::where('status', true)->get();
            return datatables()->of($service_charge)
                ->addIndexColumn()
                ->editColumn('description', function ($service_charge) {
                    if ($service_charge->description == null) {
                        return 'No Description';
                    } else {
                        return $service_charge->description;
                    }
                })
                ->editColumn('rate', function ($service_charge) {
                    return '<span class="badge bg-info fw-bold">' . $service_charge->rate . '/=</span>';
                })
                ->rawColumns(['description', 'rate'])
                ->make(true);
        }
        return view('themes.frest.merchantPanel.service-charge.index', compact('html'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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

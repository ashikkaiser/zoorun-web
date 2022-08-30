<?php

namespace App\Http\Controllers\Merchant;

use App\Http\Controllers\Controller;
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
    public function orderTrack(Request $request)
    {
        return view('themes.frest.merchantPanel.order-tracking.index');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function coverageArea(Request $request, Builder $builder)
    {
        $rowData = ServiceArea::all();


        // dd($rowData);
        if (request()->ajax()) {
            return DataTables::of($rowData)->toJson();
        }
        $html = $builder->columns([
            ['data' => 'id', 'name' => 'id', 'title' => 'ID'],
            ['data' => 'name', 'name' => 'name', 'title' => 'Name'],
            ['data' => 'description', 'name' => 'description', 'title' => 'Description'],
            ['data' => 'cod', 'name' => 'cod', 'title' => 'COD %'],
            ['data' => 'status', 'name' => 'status', 'title' => 'Status'],
        ]);
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
                ->rawColumns(['description'])
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

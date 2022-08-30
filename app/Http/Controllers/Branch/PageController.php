<?php

namespace App\Http\Controllers\Branch;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Yajra\DataTables\Html\Builder;

class PageController extends Controller
{
    /**
     * Display a listing of the Merchnat.
     *
     * @return \Illuminate\Http\Response
     */
    public function merchantList(Request $request, Builder $builder)
    {

        $html = $builder->columns([
            ['data' => 'id', 'name' => 'id', 'title' => 'ID'],
            ['data' => 'name', 'name' => 'name', 'title' => 'Name'],
            ['data' => 'sl_no', 'name' => 'sl_no', 'title' => 'Address'],
            ['data' => 'number', 'name' => 'number', 'title' => 'Contact Number'],
            ['data' => 'status', 'name' => 'status', 'title' => 'Status'],
            ['data' => 'created_at', 'name' => 'created_at', 'title' => 'Joined At'],
        ]);
        return view('themes.frest.branchPanel.merchants.index', compact('html'));
    }

    /**
     * Display a listing of the Rider.
     *
     * @return \Illuminate\Http\Response
     */
    public function riderList(Request $request, Builder $builder)
    {
        $html = $builder->columns([
            ['data' => 'id', 'name' => 'id', 'title' => 'ID'],
            ['data' => 'name', 'name' => 'name', 'title' => 'Name'],
            ['data' => 'sl_no', 'name' => 'sl_no', 'title' => 'Address'],
            ['data' => 'number', 'name' => 'number', 'title' => 'Contact Number'],
            ['data' => 'status', 'name' => 'status', 'title' => 'Status'],
            ['data' => 'created_at', 'name' => 'created_at', 'title' => 'Joined At'],
        ]);
        return view('themes.frest.branchPanel.riders.index', compact('html'));
    }

    /**
     * Show the form for track your order.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function orderTrack(Request $request)
    {
        return view('themes.frest.branchPanel.order-tracking.index');
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

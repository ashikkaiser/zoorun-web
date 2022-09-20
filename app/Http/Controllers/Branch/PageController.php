<?php

namespace App\Http\Controllers\Branch;

use App\Http\Controllers\Controller;
use App\Models\Area;
use App\Models\Branch;
use App\Models\District;
use App\Models\Merchant;
use App\Models\ServiceArea;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
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
        $merchants = Merchant::where('branch_id', Auth::user()->branch_id)->get();
        if ($request->ajax()) {
            return datatables()->of($merchants)
                ->addColumn('action', function ($row) {
                    return view('themes.frest.branchPanel.merchants.action', compact('row'));
                })->editColumn('created_at', '{{date("d-M-Y", strtotime($created_at))}}')->editColumn('color', function ($row) {
                    return view('themes.frest.partials.color', compact('row'));
                })->addColumn('status', function ($row) {
                    return view('themes.frest.partials.status', compact('row'));
                })
                ->addIndexColumn()->toJson();
        }
        $html = $builder->columns([
            ['data' => 'DT_RowIndex', 'DT_RowIndex' => 'name', 'title' => 'SL', 'orderable' => false, 'searchable' => false,],
            ['data' => 'name', 'name' => 'name', 'title' => 'Name'],
            ['data' => 'email', 'name' => 'email', 'title' => 'Email'],
            ['data' => 'cod', 'name' => 'cod', 'title' => 'COD'],
            ['data' => 'status', 'name' => 'status', 'title' => 'Status'],
            ['data' => 'action', 'name' => 'action', 'title' => 'Action'],
        ]);
        return view('themes.frest.branchPanel.merchants.index', compact('html'));
    }

    public function editMerchant($id)
    {
        $merchant = Merchant::find($id);
        $districts = District::all();
        $serviceAreas = ServiceArea::all();
        $branchs = Branch::all();
        return view('themes.frest.branchPanel.merchants.edit-merchant', compact('districts', 'serviceAreas', 'branchs', 'merchant'));
    }

    public function modifyMerchant(Request $request)
    {
        $area = Area::find($request->area_id);
        $merchant = Merchant::findOrNew($request->id);
        $merchant->name = $request->name;
        $merchant->company = $request->company;
        $merchant->personal_address = $request->personal_address;
        $merchant->company_address = $request->company_address;
        // $merchant->district_id = $request->district_id;
        // $merchant->zone_id = $area->zone_id;
        // $merchant->area_id = $request->area_id;
        // $merchant->branch_id = $request->branch_id;
        $merchant->phone = $request->phone;
        $merchant->facebook = $request->facebook;
        $merchant->website = $request->website;
        if ($request->hasFile('profile_image')) {
            $merchant->profile_image = $request->profile_image;
        }
        $merchant->cod = $request->cod_charge;
        $merchant->email = $request->email;
        $merchant->service_area_id = json_encode($request->service_area_id);
        $merchant->charge = json_encode($request->charge);
        $merchant->return_charge = json_encode($request->return_charge);
        $merchant->bank_acc_name = $request->bank_acc_name;
        $merchant->bank_acc_number = $request->bank_acc_number;
        $merchant->bank_name = $request->bank_name;
        $merchant->bkash = $request->bkash;
        $merchant->nagad = $request->nagad;
        $merchant->rocket = $request->rocket;
        if ($request->hasFile('nid_image_url')) {
            $merchant->nid_image_url = $request->nid_image_url;
        }
        if ($request->hasFile('trade_license_image_url')) {
            $merchant->trade_license_image_url = $request->trade_license_image_url;
        }
        if ($request->hasFile('tin_certificate_image_url')) {
            $merchant->tin_certificate_image_url = $request->tin_certificate_image_url;
        }

        // dd($request->all());
        $merchant->status = true;
        $merchant->is_active = $request->is_active;
        if ($merchant->save()) {
            $user = User::firstOrNew(['user_type' => 'merchant', 'merchant_id' => $merchant->id, 'email' => $request->email]);
            $user->user_type = 'merchant';
            $user->merchant_id = $merchant->id;
            $user->branch_id = $merchant->branch_id;
            $user->name = $request->name;
            $user->email = $request->email;
            $user->username = $request->email;
            $user->phone = $request->phone;
            $user->password = Hash::make($request->password);
            if ($merchant->is_active === 'active') {
                $user->status = true;
            } else {
                $user->status = false;
            }
            $user->save();
            $merchant->user_id = $user->id;
            $merchant->save();
            return redirect()->route('branch.merchant.list')->with('success', 'Merchant Updated Successfully');
        }
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

<?php

namespace App\Http\Controllers\Admin\Team;

use App\Http\Controllers\Controller;
use App\Models\Area;
use App\Models\Branch;
use App\Models\District;
use App\Models\Merchant;
use App\Models\ServiceArea;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\Html\Builder;
use Yajra\DataTables\DataTables;

class MerchantController extends Controller
{


    public function __construct()
    {
        $this->middleware(['auth', 'admin.gaurd']);
    }


    public function index(Request $request, Builder $builder)
    {
        $rowData = Merchant::query()->with('district')->with('zone')->with('area')->with('branch');

        if ($request->status === "trash") {
            $rowData->where('status', false)->get();
        } else {
            $rowData->where('status', true)->get();
        }

        if (request()->ajax()) {
            return DataTables::of($rowData)->addColumn('action', function ($row) {
                return view('themes.frest.team.merchant.action', compact('row'));
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
            ['data' => 'branch.name', 'name' => 'branch', 'title' => 'Branch'],
            ['data' => 'cod', 'name' => 'cod', 'title' => 'COD'],
            ['data' => 'area.name', 'name' => 'area', 'title' => 'Area'],
            ['data' => 'zone.name', 'name' => 'Zone', 'title' => 'Zone'],
            ['data' => 'district.name', 'name' => 'district', 'title' => 'District'],
            ['data' => 'status', 'name' => 'status', 'title' => 'Status'],
            ['data' => 'action', 'name' => 'action', 'title' => 'Action'],
        ]);
        return view('themes.frest.team.merchant.index', compact('html'));
    }


    public function create(Request $request)
    {
        $districts = District::all();
        $serviceAreas = ServiceArea::all();
        $branchs = Branch::all();
        return view('themes.frest.team.merchant.create', compact('districts', 'serviceAreas', 'branchs'));
    }




    public function modify(Request $request)
    {
        $area = Area::find($request->area_id);
        $merchant = Merchant::findOrNew($request->id);
        $merchant->name = $request->name;
        $merchant->company = $request->company;
        $merchant->personal_address = $request->personal_address;
        $merchant->company_address = $request->company_address;
        $merchant->district_id = $request->district_id;
        $merchant->zone_id = $area->zone_id;
        $merchant->area_id = $request->area_id;
        $merchant->branch_id = $request->branch_id;
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


        $merchant->status = true;
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
            $user->status = true;
            $user->save();
            $merchant->user_id = $user->id;
            $merchant->save();
            return redirect()->route('admin.team.merchant');
        }
    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        $merchant = Merchant::find($id);
        $districts = District::all();
        $serviceAreas = ServiceArea::all();
        $branchs = Branch::all();
        return view('themes.frest.team.merchant.edit', compact('districts', 'serviceAreas', 'branchs', 'merchant'));
    }


    public function update(Request $request, $id)
    {
        //
    }


    public function destroy($id)
    {
        //
    }
}

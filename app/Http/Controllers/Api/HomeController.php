<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Area;
use App\Models\Branch;
use App\Models\Merchant;
use App\Models\ServiceWeightPackageSetting;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class HomeController extends Controller
{
    //
    public function get_weight_package(Request $request)
    {
        $weight_package = \App\Models\WeightPackage::all();
        return response()->json($weight_package);
    }

    // public function geta_area(Request $request)
    // {
    //     $area = \App\Models\Area::all();
    //     return response()->json($area);
    // }

    public function service_areas(Request $request)
    {
        $service_area = \App\Models\ServiceArea::all();
        return response()->json($service_area);
    }


    public function get_locations(Request $request)
    {

        // dd(Area::where('name', 'like', "%$request->q%")->get()->groupBy('district_id'));
        $d =  Area::where('name', 'like', "%$request->q%")->get()->map(function ($item) {
            return [
                'id' => $item->id,
                'name' => $item->name,
                'district_id' => $item->district_id,
                'district_name' => $item->district->name,

            ];
        });
        $districts = $d->groupBy('district_id')->map(function ($item) {
            return [
                'id' => $item[0]['district_id'],
                'name' => $item[0]['district_name'],
                'children' => $item
            ];
        });
        return  collect($districts)->values();
    }

    public function get_price(Request $request)
    {
        $p = $request->pickup_area_id['value'];
        $d = $request->delivery_area_id['value'];
        $w = $request->weight;
        $a  = $request->amount;
        $pickup = \App\Models\Area::find($p);
        $delivery = \App\Models\Area::find($d);
        $weight = \App\Models\WeightPackage::find($w);
        $service_areas = json_decode($delivery->service_area_ids);

        $service_area = \App\Models\ServiceArea::find($service_areas[0]);
        $weightPackages = ServiceWeightPackageSetting::where('service_area_id', $service_area->id)->first();
        $w_ids = json_decode($weightPackages->weight_package_id);
        $w_rates = json_decode($weightPackages->rates);
        $package_key = array_search($weight, $w_ids);
        $delevery_charge = intval($w_rates[$package_key]);
        $total = intval($a) - $delevery_charge;

        $codPercent = $total * intval($service_area->cod) / 100;
        $values = array(
            'delevery_charge' => $delevery_charge + $codPercent,
            'total' => intval($a) + ($delevery_charge + $codPercent),
            'from' => $pickup->district->name . " > " . $pickup->name,
            'to' =>  $delivery->district->name . " > " . $delivery->name,
            'weight' => $weight->name,
            'amount' => $a,
            'cod' => "$service_area->cod%",
        );
        return $values;
    }


    public function geta_areas(Request $request)
    {
        $area = Area::with('district')->whereJsonContains('service_area_ids', $request->service_area_id)->get();
        return response()->json($area);
    }

    public function get_districts(Request $request)
    {
        $district = \App\Models\District::all();
        return response()->json($district);
    }

    public function get_area(Request $request)
    {
        $area = \App\Models\Area::where('district_id', $request->district_id)->get();
        return response()->json($area);
    }
    public function get_service_charge(Request $request)
    {
        $service_charge = \App\Models\WeightPackage::all();
        return response()->json($service_charge);
    }

    public function become_a_merchant(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:merchants',
            'password' => 'required',
            'phone' => 'required|numeric|unique:users',
            'district' => 'required',
            'area' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => false, 'message' => $validator->errors()->first()], 202);
        }

        $area = Area::find($request->area);
        $branch = Branch::whereJsonContains('zone_ids', "$area->zone_id")->first();
        $merchant = new Merchant();
        $merchant->name = $request->name;
        $merchant->email = $request->email;
        $merchant->phone = $request->phone;
        $merchant->district_id = $request->district;
        $merchant->area_id = $request->area;
        $merchant->zone_id =  $area->zone_id;
        $merchant->company = $request->company;
        $merchant->branch_id = $branch->id;
        $merchant->service_area_id = json_encode(array());
        $merchant->status = true;
        $merchant->is_active = 'pending';

        if ($merchant->save()) {
            $user = User::firstOrNew(['user_type' => 'merchant', 'merchant_id' => $merchant->id, 'email' => $request->email]);
            $user->user_type = 'merchant';
            $user->merchant_id = $merchant->id;
            $user->branch_id = $branch->id;
            $user->name = $request->name;
            $user->email = $request->email;
            $user->username = $request->email;
            $user->phone = $request->phone;
            $user->password = Hash::make($request->password);
            $user->status = false;
            $user->save();
            $merchant->user_id = $user->id;
            $merchant->save();
            return response()->json(['status' => true, 'message' => 'Merchant Signup successfully']);
        }
        return response()->json(['status' => true, 'message' => 'Merchant Signup successfully']);
    }
}

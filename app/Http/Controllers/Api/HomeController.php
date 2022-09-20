<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Area;
use Illuminate\Http\Request;

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
    public function geta_areas(Request $request)
    {
        $area = Area::with('district')->whereJsonContains('service_area_ids', $request->service_area_id)->get();
        return response()->json($area);
    }
}

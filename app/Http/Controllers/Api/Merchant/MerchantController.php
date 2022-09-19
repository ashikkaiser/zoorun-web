<?php

namespace App\Http\Controllers\Api\Merchant;

use App\Http\Controllers\Controller;
use App\Models\Area;
use App\Models\District;
use App\Models\ItemCategory;
use App\Models\PickupAddress;
use App\Models\WeightPackage;
use App\Models\Zone;
use Illuminate\Http\Request;

class MerchantController extends Controller
{
    public function __construct()
    {
        $this->middleware('jwt');
    }

    public function create(Request $request)
    {
        $districts = District::active()->get();
        $item_categories = ItemCategory::all();
        $pickupAddress = PickupAddress::all();
        $weightPackage = WeightPackage::all();
        $zone = Zone::all();
        return response()->json([
            'status' => true,
            'data' => [
                'districts' => $districts,
                'item_categories' => $item_categories,
                'pickup_address' => $pickupAddress,
                'weight_package' => $weightPackage,
            ]
        ]);
    }

    public function getarea(Request $request)
    {
        $district = $request->district;
        $areas = Area::where('status', true)->where('district_id', $district)
            ->where('name', 'ILIKE', '%' . $request->search . '%')->get();
        return $areas;
    }
}

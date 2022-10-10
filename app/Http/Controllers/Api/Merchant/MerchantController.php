<?php

namespace App\Http\Controllers\Api\Merchant;

use App\Http\Controllers\Controller;
use App\Models\Area;
use App\Models\Branch;
use App\Models\District;
use App\Models\ItemCategory;
use App\Models\MerchantPayment;
use App\Models\Parcel;
use App\Models\ParcelHistory;
use App\Models\ParcelStatus;
use App\Models\PickupAddress;
use App\Models\User;
use App\Models\WeightPackage;
use App\Models\Zone;
use GrahamCampbell\ResultType\Success;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class MerchantController extends Controller
{
    public function __construct()
    {
        $this->middleware('jwt');
    }

    public function dashboard(Request $request)
    { {
            $merchant_id = Auth::user()->merchant->id;
            $total_parcels = Parcel::where('merchant_id', $merchant_id)->count(); //completed
            $total_cancel_parcels = Parcel::where('merchant_id', $merchant_id)->count();
            $total_delivery_parcels = Parcel::where('merchant_id', $merchant_id)->count();
            $total_return_parcels = Parcel::where('merchant_id', $merchant_id)->count();
            $total_pickup_pending = Parcel::where('merchant_id', $merchant_id)->whereIn('status', ['pickup-pending', 'pickup-assigned'])->count(); //completed
            $total_delivery_parcel_pending = Parcel::where('merchant_id', $merchant_id)->whereIn('status', ['pickup-completed', 'received-to-warehouse', 'dispatched-to-rider', 'delivery-in-progress'])->count();
            $total_delivery_parcel_complete = Parcel::where('merchant_id', $merchant_id)->where('status', 'delivery-completed')->count();
            $total_return_parcel_complete = Parcel::where('merchant_id', $merchant_id)->where('status', 'delivery-completed')->count(); //completed
            $total_pending_collect_amount = Parcel::where('merchant_id', $merchant_id)->where('status', 'delivery-completed')->count();
            $total_collect_amount = Parcel::where('merchant_id', $merchant_id)->where('status', 'delivery-completed')->count();
            return response()->json([
                'status' => true,
                'data' => [
                    'total_pickup_pending' => $total_pickup_pending,
                    'total_parcels' => $total_parcels,
                    'total_cancel_parcels' => $total_cancel_parcels,
                    'total_delivery_parcels' => $total_delivery_parcels,
                    'total_return_parcels' => $total_return_parcels,
                    'total_delivery_parcel_pending' => $total_delivery_parcel_pending,
                    'total_delivery_parcel_complete' => $total_delivery_parcel_complete,
                    'total_return_parcel_complete' => $total_return_parcel_complete,
                    'total_pending_collect_amount' => $total_pending_collect_amount,
                    'total_collect_amount' => $total_collect_amount,

                ]
            ]);
        }
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


    public function getpickupaddress(Request $request)
    {
        $pickupAddress = PickupAddress::where('merchant_id', $request->merchant_id)->get();
        return $pickupAddress;
    }
    public function modifypickupaddress(Request $request)
    {

        $data = $request->validate([
            'name' => 'required',
            'address' => 'required',
            'district_id' => 'required',
            'zone_id' => 'required',
            'area_id' => 'required',
            'phone' => 'required'
        ]);
        $area = Area::find($request->area_id);
        $pickup_address = PickupAddress::findOrNew($request->id);
        $pickup_address->merchant_id = $request->merchant_id;
        $pickup_address->name = $request->name;
        $pickup_address->address = $request->address;
        $pickup_address->district_id = $request->district_id;
        $pickup_address->zone_id = $area->zone_id;
        $pickup_address->area_id = $request->area_id;
        $pickup_address->phone = $request->phone;
        $pickup_address->alt_phone = $request->alt_phone;
        $pickup_address->status = true;
        $pickup_address->save();
        if ($request->id) {
            return response()->json([
                'status' => true,
                'message' => 'Pickup Address Updated Successfully',
            ]);
        }
        return response()->json([
            'status' => true,
            'message' => 'Pickup Address Added Successfully'
        ]);
    }



    public function newParcel(Request $request)
    {
        $last_id = Parcel::latest('id')->first();
        $id = isset($last_id) ? $last_id->id  : 0;
        $total = delevery_charge_calculation(
            $request->area_id,
            $request->weight_package_id,
            $request->delivery_type,
            $request->category_id,
            $request->collection_amount
        );
        $area = Area::find($request->area_id);
        $destination_branch_id = Branch::where('zone_ids', 'like', '%' . $area->zone_id . '%')->first()->id;

        $parcel = new Parcel();
        $parcel->parcel_id = "ZCS" . date("ymd") . Auth::user()->id . $id;
        $parcel->merchant_id = User::find(auth()->user()->id)->merchant->id;
        $parcel->customer_name = $request->customer_name;
        $parcel->customer_phone = $request->customer_phone;
        $parcel->delivery_address = $request->delivery_address;
        $parcel->district_id = $request->district_id;
        $parcel->zone_id = $area->zone_id;
        $parcel->area_id = $request->area_id;
        $parcel->delivery_type = $request->delivery_type;
        $parcel->destination_branch_id = $destination_branch_id;
        $parcel->branch_id = Auth::user()->branch_id;
        $parcel->merchant_order_id = $request->merchant_order_id;
        $parcel->delivery_charge = $total['delevery_charge'];
        $parcel->product_amount = $request->product_amount;
        $parcel->product_details = $request->product_details;
        $parcel->pickup_address_id = $request->pickup_address_id;
        $parcel->collection_amount = $request->collection_amount;
        $parcel->category_id = $request->category_id;
        $parcel->remarks = $request->remarks;
        $parcel->status = 'pickup-pending';
        $parcel->total = $total['total'];
        if ($parcel->save()) {
            $history = new \App\Models\ParcelHistory();
            $history->parcel_id = $parcel->id;
            $history->status_id = ParcelStatus::where('key', 'pickup-pending')->first()->id;
            $history->save();
            return response()->json([
                'status' => true,
                'message' => 'Parcel Created Successfully',
            ]);
        }
    }

    public function getParcels(Request $request)
    {
        $parcels = Parcel::merchantParcels()->orderBy('id', 'desc')->get();
        return $parcels;
    }

    public function orderTracking(Request $request)
    {
        $parcel_id = Str::upper($request->parcel_id);
        $parcel = Parcel::where('parcel_id', $parcel_id)->first();
        if ($parcel) {
            $history = ParcelHistory::with('message')->where('parcel_id', $parcel->id)->get();
            // $parcelx =
            //     array_merge(
            //         $parcel->toArry(),
            //         ['histories' => $history]
            //     );
            return response()->json([
                'success' => true,
                'data' => ['parcel' => $parcel, 'history' => $history],

            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => "parcel not found",
                'ss' => $parcel_id
            ]);
        }
    }

    public function getDeliveryParcelList(Request $request)
    {
        $data = Parcel::query()->where('merchant_id', Auth::user()->merchant->id)->with(['district', 'zone', 'area', 'status'])->where('status', 'delivery-completed')->get();
        return response()->json([
            'data' => $data,
            'status' => true,
        ]);
    }
    public function getDeliveryPaymentList(Request $request)
    {
        $data = MerchantPayment::query()->where('merchant_id', Auth::user()->merchant->id)->get();
        return response()->json([
            'data' => $data,
            'status' => true,
        ]);
    }
}

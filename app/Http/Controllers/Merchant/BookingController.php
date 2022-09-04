<?php

namespace App\Http\Controllers\Merchant;

use App\DataTables\Merchant\MerchantBookingDatatable;
use App\Http\Controllers\Controller;
use App\Models\Area;
use App\Models\District;
use App\Models\ItemCategory;
use App\Models\Parcel;
use App\Models\ParcelStatus;
use App\Models\PickupAddress;
use App\Models\ServiceArea;
use App\Models\ServiceWeightPackageSetting;
use App\Models\User;
use App\Models\Zone;
use App\Models\WeightPackage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Html\Builder;
use Barryvdh\DomPDF\Facade\Pdf;

// use PDF;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(MerchantBookingDatatable $dataTable, Request $request)
    {
        return $dataTable->render('themes.frest.merchantPanel.booking.index');
    }


    public function create()
    {
        $districts = District::active()->get();
        $item_categories = ItemCategory::all();
        $pickupAddress = PickupAddress::all();
        return view('themes.frest.merchantPanel.booking.create', compact('districts', 'item_categories', 'pickupAddress'));
    }

    public function store(Request $request)
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
        $parcel = new Parcel();
        $parcel->parcel_id = "ZCS" . date("ymd") . Auth::user()->id .
            $id;
        $parcel->merchant_id = User::find(auth()->user()->id)->merchant->id;
        $parcel->customer_name = $request->customer_name;
        $parcel->customer_phone = $request->customer_phone;
        $parcel->delivery_address = $request->delivery_address;
        $parcel->district_id = $request->district_id;
        $parcel->zone_id = $area->zone_id;
        $parcel->area_id = $request->area_id;
        $parcel->delivery_type = $request->delivery_type;
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
            return redirect()->route('merchant.parcel.booking.list')->with('success', 'Booking Created Successfully');
        }
    }

    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        //
    }

    public function generatePrintLabels($id)
    {
        $parcel = Parcel::find($id);

        $pdf = Pdf::loadView('themes.frest.merchantPanel.booking.print_labels', compact('parcel'));
        return $pdf->stream('document.pdf');
    }

    public function requestReturn($id)
    {
        $parcel = Parcel::find($id);
        $parcel->return_status = type($parcel->status, 'request');
        $parcel->is_return = true;
        $parcel->save();
        return response()->json(['success' => 'Parcel Requested For Return']);
    }
    public function holdParcel(Request $request)
    {
        $parcel = Parcel::find($request->id);
        $parcel->is_hold = !$parcel->is_hold;
        $parcel->save();
        return response()->json(['success' => 'Parcel Pickup Cancelled']);
    }

    public function cancelPickup(Request $request)
    {
        $parcel = Parcel::find($request->id);
        $parcel->status = 'pickup-cancelled';
        $parcel->save();
        return response()->json(['success' => 'Parcel Pickup Cancelled']);
    }




    public function update(Request $request, $id)
    {
        //
    }


    public function destroy($id)
    {
        //
    }

    public function get_weight_packages(Request $request)
    {
        if (!$request->area_id) {
            return response()->json(['type' => 'none',]);
        }

        $area = Area::find($request->area_id);
        $areas = json_decode($area->service_area_ids);
        if (count($areas) == 1) {
            $delevery_types = ServiceArea::find($areas[0]);
            $weightPackages = ServiceWeightPackageSetting::where('service_area_id', $delevery_types->id)->first();
            $w_ids = json_decode($weightPackages->weight_package_id);
            $w_packages = array();
            foreach ($w_ids as $id) {
                $w_packages[] = WeightPackage::find($id);
            }
            return response()->json([
                'packages' =>  collect($w_packages)->map(function ($item) {
                    return [
                        'id' => $item->id,
                        'text' => $item->name,

                    ];
                }),
                'service_area' => $delevery_types,
                'type' => 'single',

            ]);
        } else {
            $delevery_types = ServiceArea::findMany($areas);
            return response()->json([
                'delevery_types' => collect($delevery_types)->map(function ($item) {
                    return [
                        'id' => $item->id,
                        'text' => $item->name,
                    ];
                }),
                'type' => 'multiple',
            ]);
        }
    }

    public function get_weight_package(Request $request)
    {
        $delevery_types = ServiceArea::find($request->delivery_type_id);
        $weightPackages = ServiceWeightPackageSetting::where('service_area_id', $delevery_types->id)->first();
        $w_ids = json_decode($weightPackages->weight_package_id);
        $w_packages = array();
        foreach ($w_ids as $id) {
            $w_packages[] = WeightPackage::find($id);
        }
        return response()->json([
            'packages' =>  collect($w_packages)->map(function ($item) {
                return [
                    'id' => $item->id,
                    'text' => $item->name,

                ];
            }),
            'service_area' => $delevery_types,
            'type' => 'single',
            'dtype' => true,

        ]);
    }

    public function get_total_calculation(Request $request)
    {
        $area = Area::find($request->area_id);
        if ($request->dtype) {
            $service_area = ServiceArea::find($request->dtype);
        } else {
            $service_area = ServiceArea::find(json_decode($area->service_area_ids)[0]);
        }
        $w_packages = WeightPackage::find($request->package_id);
        $weightPackages = ServiceWeightPackageSetting::where('service_area_id', $service_area->id)->first();
        $w_ids = json_decode($weightPackages->weight_package_id);
        $w_rates = json_decode($weightPackages->rates);
        $package_key = array_search($request->package_id, $w_ids);
        $category = ItemCategory::find($request->category_id);
        $cat_rate = $category->rate ?? 0;
        $delevery_charge = intval($w_rates[$package_key]) + intval($cat_rate);
        $total = intval($request->amount) - $delevery_charge;
        $codPercent = $total * intval($service_area->cod) / 100;
        return response()->json([
            'packageTitle' => $w_packages->name,
            'packageRate' => $w_rates[$package_key],
            'service_area_name' => $service_area->name,
            'service_area_cod' => $service_area->cod . "%",
            'category_charge' => $category->rate ?? 0,
            'coe_percent' => $codPercent,
            'total' => round($total - $codPercent),
        ]);
    }
    public function get_area_by_zip(Request $request)
    {
        $area = Area::where('postal_code', $request->postal_code)->first();
        $zone = Zone::find($area->zone_id);
        return response()->json([
            'area' => $area,
            'zone' => $zone,
            'district' => District::find($zone->district_id),
        ]);
    }
}

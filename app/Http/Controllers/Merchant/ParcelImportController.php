<?php

namespace App\Http\Controllers\Merchant;

use App\Http\Controllers\Controller;
use App\Imports\ParcelsImport;
use App\Models\Area;
use App\Models\Branch;
use App\Models\ItemCategory;
use App\Models\Parcel;
use App\Models\PickupAddress;
use App\Models\ServiceArea;
use App\Models\WeightPackage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Maatwebsite\Excel\Facades\Excel;

class ParcelImportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        return view('themes.frest.merchantPanel.bulk-upload.index');
    }

    public function showData(Request $request)
    {
        if (!Session::get('parcelsImports')) {
            return redirect()->route('merchant.parcel.booking.bulk.upload');
        }

        $data = array(
            'parcelsImports' => Session::get('parcelsImports'),
            'parcelsImportsErros' => Session::get('parcelsImportsErros'),
        );
        // dd($data);
        if ($request->method() == 'POST') {
            // dd($request->all());
            foreach ($request->data as $key => $row) {
                $pickup_address = PickupAddress::where('merchant_id', Auth::user()->id)->first();
                $last_id = Parcel::latest('id')->first();
                $id = isset($last_id) ? $last_id->id  : 0;
                $area = Area::where('postal_code', $row['zip_code'])->first();
                $service_area =  json_decode($area->service_area_ids);
                $service_areas = ServiceArea::findMany($service_area);
                if ($row['same_day'] === 'yes') {
                    $s_area = $service_areas->where('name', 'ilike', '%' . 'same day' . '%');
                } else {
                    $s_area = $service_areas->first();
                }
                if ($s_area->count() > 0) {
                    $delivery_type = $s_area->id;
                } else {
                    $delivery_type = null;
                }

                $w = $row['weight'];
                $destination_branch_id = Branch::whereJsonContains('zone_ids', "$area->zone_id")->first();

                $category = ItemCategory::where('name', 'ilike', '%' . $row['category'] . '%')->first();
                $weight_package = WeightPackage::where('title', 'ilike', "%$w kg%")->first();
                $total = delevery_charge_calculation(
                    $area->id,
                    $weight_package->id,
                    $delivery_type,
                    $category->id,
                    $row['collection_amount']
                );

                $parcel = new Parcel([
                    'merchant_id' => Auth::user()->merchant_id,
                    'branch_id' => Auth::user()->branch_id,
                    'pickup_address_id' => $pickup_address->id,
                    'parcel_id' => "ZCS" . date("ymd") . Auth::user()->id . $id,
                    'district_id' => 1,
                    'customer_name' => $row['customer_name'],
                    'customer_phone' => "0" . $row['customer_phone'],
                    'delivery_address' => $row['delivery_address'],
                    'merchant_order_id' => $row['order_id'],
                    'product_details' => $row['product_details'],
                    'product_amount' => $row['product_amount'],
                    'delivery_charge' => $total['delevery_charge'],
                    'collection_amount' => $row['collection_amount'],
                    'remarks' => $row['note'],
                    'zone_id' => 2,
                    'status' => 'pickup-pending',
                    'is_return' => false,
                    'area_id' => $area->id,
                    'category_id' => $category->id,
                    'destination_branch_id' => $destination_branch_id->id ?? null,
                    'total' => $total['total'],
                ]);
                $parcel->save();
                session()->forget('parcelsImports');
                session()->forget('parcelsImportsErros');
            }
            return redirect()->route('merchant.parcel.booking.list')->with('success', 'Data Imported successfully!');
        }
        // dd($data);
        return view('themes.frest.merchantPanel.bulk-upload.show', compact('data'));
    }


    public function fileImport(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xls,xlsx'
        ]);
        Excel::import(new ParcelsImport, $request->file('file')->store('temp'));
        return redirect()->route('merchant.parcel.booking.bulk.upload.show')->with('success', 'Data Read successfully!');
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

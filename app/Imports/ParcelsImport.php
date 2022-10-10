<?php

namespace App\Imports;

use App\Models\Area;
use App\Models\Branch;
use App\Models\ItemCategory;
use App\Models\Parcel;
use App\Models\ParcelHistory;
use App\Models\PickupAddress;
use App\Models\ServiceArea;
use App\Models\WeightPackage;
use App\Models\Zone;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use PhpOffice\PhpSpreadsheet\Calculation\Category;
use Maatwebsite\Excel\Concerns\ToCollection;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Session;

class ParcelsImport implements ToCollection, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function collection(Collection $rows)
    {

        $newData = new Collection();
        $errosData = new Collection();
        foreach ($rows as  $row) {
            $validator = Validator::make($row->toArray(), [
                'customer_name' => 'required',
                'customer_phone' => 'required',
                'delivery_address' => 'required',
                'zip_code' => 'required',
                'weight' => 'required',
                'category' => 'required',
                'collection_amount' => 'required',
                'same_day' => 'required',
            ]);
            if ($validator->fails()) {
                $errosData->push($row);
            } else {
                $newData->push($row);
            }
        }
        Session::put('parcelsImports', $newData);
        Session::put('parcelsImportsErros', $errosData);
        return  $newData;
    }


    public function model(array $row)
    {


        // Validator::make($row, [
        //     'customer_name' => 'required',
        //     'customer_phone' => 'required',
        //     'delivery_address' => 'required',
        //     'zip_code' => 'required',
        //     'weight' => 'required',
        //     'category' => 'required',
        //     'collection_amount' => 'required',
        //     'same_day' => 'required',
        // ])->validate();
        // $pickup_address = PickupAddress::where('merchant_id', Auth::user()->id)->first();
        // $last_id = Parcel::latest('id')->first();
        // $id = isset($last_id) ? $last_id->id  : 0;
        // $area = Area::where('postal_code', $row['zip_code'])->first();
        // $service_area =  json_decode($area->service_area_ids);
        // $service_areas = ServiceArea::findMany($service_area);
        // if ($row['same_day'] === 'yes') {
        //     $s_area = $service_areas->where('name', 'ilike', '%' . 'same day' . '%');
        // } else {
        //     $s_area = $service_areas->first();
        // }
        // if ($s_area->count() > 0) {
        //     $delivery_type = $s_area->id;
        // } else {
        //     $delivery_type = null;
        // }

        // $w = $row['weight'];
        // $destination_branch_id = Branch::whereJsonContains('zone_ids', "$area->zone_id")->first();

        // $category = ItemCategory::where('name', 'ilike', '%' . $row['category'] . '%')->first();
        // $weight_package = WeightPackage::where('title', 'ilike', "%$w kg%")->first();


        // $total = delevery_charge_calculation(
        //     $area->id,
        //     $weight_package->id,
        //     $delivery_type,
        //     $category->id,
        //     $row['collection_amount']
        // );

        // $parcel = new Parcel([
        //     'merchant_id' => Auth::user()->merchant_id,
        //     'branch_id' => Auth::user()->branch_id,
        //     'pickup_address_id' => $pickup_address->id,
        //     'parcel_id' => "ZCS" . date("ymd") . Auth::user()->id . $id,
        //     'district_id' => 1,
        //     'customer_name' => $row['customer_name'],
        //     'customer_phone' => "0" . $row['customer_phone'],
        //     'delivery_address' => $row['delivery_address'],
        //     'merchant_order_id' => $row['order_id'],
        //     'product_details' => $row['product_details'],
        //     'product_amount' => $row['product_amount'],
        //     'delivery_charge' => $total['delevery_charge'],
        //     'collection_amount' => $row['collection_amount'],
        //     'remarks' => $row['note'],
        //     'zone_id' => 2,
        //     'status' => 'pickup-pending',
        //     'is_return' => false,
        //     'area_id' => $area->id,
        //     'category_id' => $category->id,
        //     'destination_branch_id' => $destination_branch_id->id ?? null,
        //     'total' => $total['total'],
        // ]);

        // if ($parcel) {
        //     $history = new ParcelHistory();
        //     $history->parcel_id = $parcel->id;
        //     $history->status = 'pickup-pending';
        //     $history->save();
        // }

        // return $parcel;
    }
}

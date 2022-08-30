<?php

use App\Models\ItemCategory;
use App\Models\ServiceWeightPackageSetting;

function delevery_charge_calculation($area_id, $weight_package_id, $delivery_type, $category_id, $amount)
{
    $area = \App\Models\Area::find($area_id);
    $service_areas = json_decode($area->service_area_ids);
    if ($delivery_type) {
        $service_area = \App\Models\ServiceArea::find($delivery_type);

        // dd($values);

    } else {

        $service_area = \App\Models\ServiceArea::find($service_areas[0]);
        $weightPackages = ServiceWeightPackageSetting::where('service_area_id', $service_area->id)->first();
        $w_ids = json_decode($weightPackages->weight_package_id);
        $w_rates = json_decode($weightPackages->rates);
        $package_key = array_search($weight_package_id, $w_ids);
        $category = ItemCategory::find($category_id);
        $cat_rate = $category->rate ?? 0;
        $delevery_charge = intval($w_rates[$package_key]) + intval($cat_rate);
        $total = intval($amount) - $delevery_charge;

        $codPercent = $total * intval($service_area->cod) / 100;
        $values = array(
            'delevery_charge' => $delevery_charge + $codPercent,
            'total' => intval($amount) - ($delevery_charge + $codPercent),

        );
        return $values;
    }
}

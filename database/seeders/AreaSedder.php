<?php

namespace Database\Seeders;

use App\Models\Area;
use App\Models\Zone;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AreaSedder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = collect(json_decode(file_get_contents(__DIR__ . "/areas.json")));
        $dhaka = $data->where('name', 'Dhaka')->first();
        foreach ($dhaka->zones as $zones) {
            $zone = new Zone();
            $zone->name = $zones->name;
            $zone->district_id = 1;
            $zone->color = "red";
            $zone->status = true;
            if ($zone->save()) {
                foreach ($zones->areas as $area) {
                    Area::create([
                        'name' => $area->name,
                        'district_id' => 1,
                        'zone_id' => $zone->id,
                        'service_area_ids' => json_encode(array("1")),
                        'postal_code' => $area->zip,
                        'status' => true,
                    ]);
                }
            }
        }
    }
}

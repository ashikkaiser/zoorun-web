<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ParcelStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $data = json_decode(file_get_contents(__DIR__ . "/parcel_status.json"));

        foreach ($data as $value) {
            \App\Models\ParcelStatus::create([
                'key' => $value->key,
                'message_en' => $value->en,
                'message_bn' => $value->bn,
                'group' => $value->group,
            ]);
        }
        //
    }
}

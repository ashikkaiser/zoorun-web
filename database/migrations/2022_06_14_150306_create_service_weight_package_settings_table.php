<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */

    //   $new = new ServiceAreaSetting();
    //     $new->service_area_id = $request->service_area_id;
    //     $new->packages = $request->weight_package_id;
    //     $new->rates = $request->rate;
    //     $new->status = true;
    //     $new->save();
    public function up()
    {
        Schema::create('service_weight_package_settings', function (Blueprint $table) {
            $table->id();
            $table->integer('service_area_id');
            $table->json('weight_package_id');
            $table->json('rates');
            $table->boolean('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('service_weight_package_settings');
    }
};

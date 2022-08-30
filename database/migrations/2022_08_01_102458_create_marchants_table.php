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
    public function up()
    {
        Schema::create('merchants', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->nullable();
            $table->string('name');
            $table->string('company');
            $table->string('personal_address')->nullable();
            $table->string('company_address')->nullable();
            $table->integer('district_id');
            $table->integer('zone_id');
            $table->integer('area_id');
            $table->integer('branch_id');
            $table->string('email');
            $table->string('phone');
            $table->string('facebook')->nullable();
            $table->string('website')->nullable();
            $table->string('cod')->nullable();
            $table->json('service_area_id');
            $table->json('charge')->nullable();
            $table->json('return_charge')->nullable();
            $table->string('bank_acc_name')->nullable();
            $table->string('bank_acc_number')->nullable();
            $table->string('bank_name')->nullable();
            $table->string('bkash')->nullable();
            $table->string('nagad')->nullable();
            $table->string('rocket')->nullable();
            $table->string('nid_image_url')->nullable();
            $table->string('trade_license_image_url')->nullable();
            $table->string('tin_certificate_image_url')->nullable();
            $table->string('profile_image')->nullable();
            $table->boolean("status");
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
        Schema::dropIfExists('merchants');
    }
};

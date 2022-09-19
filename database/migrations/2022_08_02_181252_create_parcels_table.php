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
        Schema::create('parcels', function (Blueprint $table) {
            $table->id();
            $table->string('parcel_id');
            $table->integer('merchant_id');
            $table->string('customer_name');
            $table->string('customer_phone');
            $table->string('delivery_address');
            $table->integer('district_id');
            $table->integer('zone_id');
            $table->integer('area_id');
            $table->integer('branch_id');
            $table->string('delivery_type')->nullable();
            $table->string('merchant_order_id');
            $table->double('delivery_charge');
            $table->double('product_amount');
            $table->string('product_details')->nullable();
            $table->integer('pickup_address_id');
            $table->double('collection_amount');
            $table->double('collected_amount')->default(0);
            $table->integer('category_id');
            $table->integer('pickup_rider_run_id')->nullable();
            $table->integer('delivery_rider_run_id')->nullable();
            $table->dateTime('pickup_reschedule_date')->nullable();
            $table->dateTime('delivery_reschedule_date')->nullable();
            $table->integer('pickup_reschedule_attempts')->default(0);
            $table->integer('delivery_reschedule_attempts')->default(0);
            $table->integer('destination_branch_id')->nullable();
            $table->string('remarks');
            $table->double('total');
            $table->string('delivery_otp')->nullable();
            $table->string('return_otp')->nullable();
            $table->string('status');
            $table->boolean('is_return')->default(false);
            $table->integer('return_pickup_rider_run_id')->nullable();
            $table->integer('return_delivery_rider_run_id')->nullable();
            $table->boolean('is_hold')->default(false);
            $table->string('return_status')->nullable();
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
        Schema::dropIfExists('parcels');
    }
};

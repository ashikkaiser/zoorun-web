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
        Schema::create('merchant_payments', function (Blueprint $table) {
            $table->id();
            $table->integer('merchant_id');
            $table->string('invoice_id');
            $table->integer('total_parcel');
            $table->integer('branch_id');
            $table->double('total_amount')->default(0);
            $table->double('discount')->default(0);
            $table->string('payment_method');
            $table->string('payment_status')->default('pending');
            $table->string('payment_date');
            $table->string('payment_slip')->nullable();
            $table->string('payment_note')->nullable();
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
        Schema::dropIfExists('merchant_payments');
    }
};

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
        Schema::create('rider_runs', function (Blueprint $table) {
            $table->id();
            $table->string('run_id');
            $table->enum('run_type', ['pickup', 'delivery', 'return']);
            $table->integer('rider_id')->nullable();
            $table->integer('merchant_id');
            $table->string('notes')->nullable();
            $table->integer('branch_id');
            $table->dateTime('create_date_time')->default(now());
            $table->dateTime('complete_date_time')->nullable();
            $table->integer('total_parcel')->default(0);
            $table->integer('complete_parcel')->default(0);
            $table->integer('status');
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
        Schema::dropIfExists('rider_runs');
    }
};

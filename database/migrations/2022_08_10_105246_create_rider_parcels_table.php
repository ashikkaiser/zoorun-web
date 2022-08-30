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
        Schema::create('rider_parcels', function (Blueprint $table) {
            $table->id();
            $table->enum('type', ['pickup', 'delivery', 'return']);
            $table->integer('rider_run_id');
            $table->integer('rider_id')->nullable();
            $table->integer('parcel_id');
            $table->string('notes')->nullable();
            $table->integer('status')->default(0);
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
        Schema::dropIfExists('rider_parcels');
    }
};

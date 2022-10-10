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
        Schema::create('transfar_parcels', function (Blueprint $table) {
            $table->id();
            $table->enum('type', ['send', 'return']);
            $table->integer('transfar_id');
            $table->integer('vehicle_id')->nullable();
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
        Schema::dropIfExists('transfar_parcels');
    }
};

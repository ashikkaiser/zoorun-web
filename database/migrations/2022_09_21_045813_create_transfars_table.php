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
        Schema::create('transfars', function (Blueprint $table) {
            $table->id();
            $table->string('transfar_id');
            $table->enum('type', ['send', 'return']);
            $table->integer('vehicle_id')->nullable();
            $table->string('notes')->nullable();
            $table->integer('src_branch_id');
            $table->integer('dst_branch_id');
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
        Schema::dropIfExists('transfars');
    }
};

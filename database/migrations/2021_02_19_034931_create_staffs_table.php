<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStaffsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('staffs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('province_id')->nullable();
            $table->unsignedBigInteger('district_id')->nullable();
            $table->unsignedBigInteger('ward_id')->nullable();
            $table->unsignedBigInteger('country_id')->nullable();
            $table->integer('level')->nullable();
            $table->unsignedBigInteger('bank_id')->nullable();
            $table->timestamps();
//            $table->foreign('user_id')->references('id')->on('users');
//            $table->foreign('bank_id')->references('id')->on('banks');
//            $table->foreign('country_id')->references('id')->on('countries');
//            $table->foreign('province_id')->references('id')->on('provinces');
//            $table->foreign('district_id')->references('id')->on('districts');
//            $table->foreign('ward_id')->references('id')->on('wards');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('staffs');
    }
}

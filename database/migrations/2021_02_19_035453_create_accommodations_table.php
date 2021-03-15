<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAccommodationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('accommodations', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->nullable();
            $table->unsignedBigInteger('category_id')->nullable();
            $table->text('description');
            $table->string('phone')->nullable();
            $table->string('address')->nullable();
            $table->double('lowest_price')->nullable();
            $table->integer('number_of_rooms')->nullable();
            $table->integer('status')->nullable();
            $table->string('latitude')->nullable();
            $table->string('longitude')->nullable();
            $table->string('avatar')->nullable();
            $table->string('thumbnail')->nullable();
            $table->unsignedBigInteger('province_id')->nullable();
            $table->unsignedBigInteger('district_id')->nullable();
            $table->unsignedBigInteger('ward_id')->nullable();
            $table->unsignedBigInteger('country_id')->nullable();
            $table->timestamps();
//            $table->foreign('category_id')->references('id')->on('categories');
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
        Schema::dropIfExists('accommodations');
    }
}

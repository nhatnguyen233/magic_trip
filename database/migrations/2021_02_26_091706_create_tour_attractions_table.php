<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTourAttractionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('travel_tours', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('attraction_id')->nullable();
            $table->unsignedBigInteger('tour_id')->nullable();
            $table->timestamps();
//            $table->foreign('attraction_id')->references('id')->on('tourist_attractions');
//            $table->foreign('tour_id')->references('id')->on('tours');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('travel_tours');
    }
}

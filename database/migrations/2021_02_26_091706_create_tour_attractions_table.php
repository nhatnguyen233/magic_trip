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
        Schema::create('tour_attractions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('attraction_id')->nullable();
            $table->unsignedBigInteger('tour_id')->nullable();
            $table->unsignedBigInteger('accommodation_id')->nullable();
            $table->string('title')->nullable();
            $table->string('vehicle')->nullable();
            $table->text('summary')->nullable();
            $table->timestamp('start_time')->nullable();
            $table->timestamp('limit_time')->nullable();
            $table->integer('order_number')->nullable();
            $table->timestamps();
//            $table->foreign('attraction_id')->references('id')->on('tourist_attractions');
//            $table->foreign('tour_id')->references('id')->on('tours');
//            $table->foreign('accommodation_id')->references('id')->on('accommodations');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tour_attractions');
    }
}

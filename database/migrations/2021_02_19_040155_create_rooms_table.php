<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRoomsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rooms', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->text('description')->nullable();
            $table->string('phone')->nullable();
            $table->integer('room_number')->nullable();
            $table->string('acreages');
            $table->text('policy')->nullable();
            $table->integer('number_max_customers');
            $table->integer('number_of_bathroom');
            $table->integer('number_of_kitchen');
            $table->timestamp('checkin')->nullable();
            $table->timestamp('checkout')->nullable();
            $table->unsignedBigInteger('accommodation_id');
            $table->timestamps();
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
        Schema::dropIfExists('rooms');
    }
}

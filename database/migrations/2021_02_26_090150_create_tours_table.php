<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateToursTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tours', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->string('name');
            $table->string('description')->nullable();
            $table->string('vehicle')->nullable();
            $table->double('price')->nullable();
            $table->string('total_time')->nullable();
            $table->integer('discount')->nullable();
            $table->string('avatar')->nullable();
            $table->string('thumbnail')->nullable();
            $table->timestamps();
//            $table->foreign('accommodation_id')->references('id')->on('accommodations');
//            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tours');
    }
}

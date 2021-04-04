<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookTourTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('book_tour', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('tour_id')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->timestamp('start_time')->nullable();
            $table->timestamp('end_time')->nullable();
            $table->integer('quantity')->nullable();
            $table->double('total_price')->nullable();
            $table->integer('status')->default(0);
            $table->timestamps();
//            $table->foreign('user_id')->references('id')->on('users');
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
        Schema::dropIfExists('book_tour');
    }
}

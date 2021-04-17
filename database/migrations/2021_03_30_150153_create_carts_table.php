<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCartsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('carts', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('tour_id');
            $table->unsignedInteger('payment_id')->nullable();
            $table->string('session_token');
            $table->string('tour_name');
            $table->double('price');
            $table->double('total_price')->nullable();
            $table->integer('discount')->nullable();
            $table->string('number_of_slots');
            $table->string('thumbnail')->nullable();
            $table->timestamp('date_of_book')->nullable();
            $table->timestamps();
//            $table->foreign('tour_id')->references('id')->on('tours');
//            $table->foreign('payment_id')->references('id')->on('payments');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('carts');
    }
}

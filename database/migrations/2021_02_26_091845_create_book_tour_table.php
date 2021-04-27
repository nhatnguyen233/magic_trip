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
            $table->unsignedInteger('payment_id')->nullable();
            $table->timestamp('date_of_book')->nullable();
            $table->integer('number_of_slots')->default(0);
            $table->integer('adults')->default(0);
            $table->integer('childrens')->default(0);
            $table->double('total_price')->nullable();
            $table->integer('status')->default(0);
            $table->integer('type')->default(0);
            $table->timestamps();
            $table->softDeletes();
//            $table->foreign('user_id')->references('id')->on('users');
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
        Schema::dropIfExists('book_tour');
    }
}

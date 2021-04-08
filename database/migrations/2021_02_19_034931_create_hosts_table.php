<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hosts', function (Blueprint $table) {
            $table->id();
            $table->string('host_name', 100);
            $table->string('host_mail', 50)->nullable();
            $table->string('hotline', 13)->nullable();
            $table->text('description')->nullable();
            $table->string('address',100)->nullable();
            $table->string('identification')->nullable();
            $table->date('date_of_establish')->nullable();
            $table->string('thumbnail')->nullable();
            $table->string('avatar')->nullable();
            $table->unsignedBigInteger('country_id')->nullable();
            $table->unsignedBigInteger('bank_id')->nullable();
            $table->unsignedBigInteger('user_id');
            $table->integer('status')->default(0);
            $table->timestamps();
//            $table->foreign('user_id')->references('id')->on('users');
//            $table->foreign('bank_id')->references('id')->on('banks');
//            $table->foreign('country_id')->references('id')->on('countries');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('hosts');
    }
}

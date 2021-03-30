<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->nullable();
            $table->string('phone')->nullable();
            $table->string('email')->unique();
            $table->string('password');
            $table->unsignedInteger('province_id')->nullable();
            $table->unsignedInteger('district_id')->nullable();
            $table->unsignedInteger('ward_id')->nullable();
            $table->unsignedInteger('country_id')->nullable();
            $table->integer('postal_code')->nullable();
            $table->string('address')->nullable();
            $table->unsignedInteger('role_id');
            $table->integer('bank_id')->nullable();
            $table->integer('payment_id')->nullable();
            $table->string('avatar')->nullable();
            $table->rememberToken();
            $table->timestamp('email_verified_at')->nullable();
            $table->timestamp('phone_verified_at')->nullable();
            $table->timestamps();
//            $table->foreign('role_id')->references('id')->on('roles');
//            $table->foreign('bank_id')->references('id')->on('banks');
//            $table->foreign('payment_id')->references('id')->on('payments');
//            $table->foreign('province_id')->references('id')->on('provinces');
//            $table->foreign('district_id')->references('id')->on('districts');
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
        Schema::dropIfExists('users');
    }
}

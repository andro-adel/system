<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Address extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('address', function (Blueprint $table) {
            $table->id();
            $table->string('address')->nullable();
            $table->string('region');
            $table->string('street');
            $table->integer('building_number');
            $table->integer('floor_number');
            $table->integer('apartment_number');
            $table->string('city');
            $table->string('country');
            $table->boolean('status')->default(1)->comment("1 -> Active 0 -> Inactive");
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('address');
    }
}

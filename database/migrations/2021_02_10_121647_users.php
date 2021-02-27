<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Users extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('phonenumber')->unique()->nullable();
            $table->smallInteger('type')->default(2)->comment("0 -> admin 1 -> user 2 -> student");
            $table->boolean("status")->default(1)->comment("1 -> Active 0 -> Inactive");
            $table->string('social_id')->nullable();
            $table->string('social_img')->nullable();
            $table->string('reset_key')->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}

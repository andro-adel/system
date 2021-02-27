<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Students extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('phonenumber')->unique()->nullable();
            $table->boolean("status")->default(1)->comment("1 -> Active 0 -> Inactive");
            $table->string('studentclass')->nullable();
            $table->string('marital_status')->nullable();
            $table->string('gender')->nullable();
            $table->string('nationality')->nullable();
            $table->datetime('dateofbirth')->nullable();
            $table->string('religion')->nullable();
            $table->string('nameofschool')->nullable();
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
        Schema::dropIfExists('students');
    }
}

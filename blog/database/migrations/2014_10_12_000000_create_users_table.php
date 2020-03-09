<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('usertable', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('DOB');
            $table->string('image');
            $table->string('Guardian');
            $table->string('Contact_no');
            $table->string('gender');
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
        Schema::dropIfExists('usertable');
    }
}

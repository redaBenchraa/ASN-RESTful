<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAccountPoll extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('account_poll', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('Account_id');
            $table->integer('Poll_id');
            $table->foreign('Account_id')->references('id')->on('Account')->onDelete('cascade');
            $table->foreign('Poll_id')->references('id')->on('Poll')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('account_poll');
    }
}

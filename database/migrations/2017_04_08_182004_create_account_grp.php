<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAccountGrp extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('account_grp', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('Account_id');
            $table->integer('Grp_id');
            $table->foreign('Account_id')->references('id')->on('Account')->onDelete('cascade');
            $table->foreign('Grp_id')->references('id')->on('Grp')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('account_grp');

    }
}

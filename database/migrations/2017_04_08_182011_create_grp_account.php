<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGrpAccount extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('grp_account', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('Account_id');
            $table->unsignedInteger('Grp_id');
            $table->boolean('Accepted');


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('grp_account');

    }
}

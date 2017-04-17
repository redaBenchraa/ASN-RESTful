<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAccountComment extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('account_comment', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('Account_id');
            $table->integer('Comment_id');
            $table->smallInteger('Type');
            $table->foreign('Account_id')->references('id')->on('Account')->onDelete('cascade');
            $table->foreign('Comment_id')->references('id')->on('Comment')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('account_comment');
    }
}

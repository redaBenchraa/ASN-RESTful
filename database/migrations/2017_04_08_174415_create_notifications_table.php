<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNotificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notifications', function (Blueprint $table) {
            $table->increments('id');
            $table->text('Content');
            $table->date('dateAndTime');
            $table->boolean('Seen');
            $table->timestamps();
            $table->integer('Account_id');
            $table->integer('Post_id');
            $table->foreign('Account_id')->references('id')->on('Account')->onDelete('cascade');
            $table->foreign('Post_id')->references('id')->on('Post')->onDelete('cascade');


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('notifications');
    }
}

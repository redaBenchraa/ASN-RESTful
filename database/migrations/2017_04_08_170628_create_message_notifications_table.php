<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMessageNotificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('message_notifications', function (Blueprint $table) {
            $table->increments('id');
            $table->text('Content');
            $table->boolean('Seen');
            $table->timestamps();
            $table->integer('Account_id');
            $table->integer('Message_id');
            $table->foreign('Message_id')->references('id')->on('Message')->onDelete('cascade');
            $table->foreign('Account_id')->references('id')->on('Account');


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('message_notifications');
    }
}

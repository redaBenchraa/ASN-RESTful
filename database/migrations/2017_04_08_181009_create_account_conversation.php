<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAccountConversation extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('account_conversation', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('Account_id');
            $table->integer('Conversation_id');
            $table->foreign('Account_id')->references('id')->on('Account')->onDelete('cascade');
            $table->foreign('Conversation_id')->references('id')->on('Conversation')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('account_conversation');
    }
}

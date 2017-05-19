<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TableProprieties extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('accounts', function($table){
        });
        Schema::table('grps', function($table){
            $table->foreign('Account_id')->references('id')->on('accounts');
            $table->foreign('Grp_id')->references('id')->on('grps')->onCascade('delete');
        });
        Schema::table('comments', function($table){
            $table->foreign('Account_id')->references('id')->on('accounts');
            $table->foreign('Post_id')->references('id')->on('posts')->onCascade('delete');
        });
        Schema::table('posts', function($table){
            $table->foreign('Account_id')->references('id')->on('accounts');
            $table->foreign('Grp_id')->references('id')->on('grps')->onCascade('delete');
        });
        Schema::table('polls', function($table){
            $table->foreign('Post_id')->references('id')->on('posts')->onDelete('cascade');
        });
        Schema::table('conversations', function($table){

        });
        Schema::table('messages', function($table){
            $table->foreign('Account_id')->references('id')->on('accounts');
            $table->foreign('Conversation_id')->references('id')->on('conversations');
        });
        Schema::table('message_notifications', function($table){
            $table->foreign('Message_id')->references('id')->on('messages')->onDelete('cascade');
            $table->foreign('Account_id')->references('id')->on('accounts');

        });
        Schema::table('notifications', function($table){
            $table->foreign('Account_id')->references('id')->on('accounts')->onDelete('cascade');
            $table->foreign('Post_id')->references('id')->on('posts')->onDelete('cascade');
        });
        Schema::table('account_comment', function($table){
            $table->foreign('Account_id')->references('id')->on('accounts')->onDelete('cascade');
            $table->foreign('Comment_id')->references('id')->on('comments')->onDelete('cascade');
        });
        Schema::table('account_post', function($table){
            $table->foreign('Account_id')->references('id')->on('accounts')->onDelete('cascade');
            $table->foreign('Post_id')->references('id')->on('posts')->onDelete('cascade');
        });
        Schema::table('account_poll', function($table){
            $table->foreign('Account_id')->references('id')->on('accounts')->onDelete('cascade');
            $table->foreign('Poll_id')->references('id')->on('polls')->onDelete('cascade');
        });
        Schema::table('account_conversation', function($table){
            $table->foreign('Account_id')->references('id')->on('accounts')->onDelete('cascade');
            $table->foreign('Conversation_id')->references('id')->on('conversations')->onDelete('cascade');
        });
        Schema::table('account_grp', function($table){
            $table->foreign('Account_id')->references('id')->on('accounts')->onDelete('cascade');
            $table->foreign('Grp_id')->references('id')->on('grps')->onDelete('cascade');
        });
        Schema::table('grp_account', function($table){
            $table->foreign('Account_id')->references('id')->on('accounts')->onDelete('cascade');
            $table->foreign('Grp_id')->references('id')->on('grps')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}

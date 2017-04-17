<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->increments('id');
            $table->string('Content');
            $table->binary('File')->nullable();
            $table->smallInteger('Type');
            $table->smallInteger('Popularity');
            $table->integer('Account_id');
            $table->integer('Post_id');
            $table->foreign('Account_id')->references('id')->on('Account');
            $table->foreign('Post_id')->references('id')->on('Post')->onCascade('delete');
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
        Schema::dropIfExists('comments');
    }
}

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->increments('id');
            $table->string('content');
            $table->binary('Image');
            $table->binary('File')->nullable();;
            $table->smallInteger('Type');
            $table->dateTime('postingDate');
            $table->smallInteger('popularity');
            $table->timestamps();
            $table->integer('Account_id');
            $table->integer('Group_id');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('posts');
    }
}

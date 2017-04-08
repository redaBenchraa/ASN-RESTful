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
            $table->increments('idPost');
            $table->string('content');
            $table->binary('Image');
            $table->binary('File');
            $table->smallInteger('Type');
            $table->dateTime('postingDate');
            $table->smallInteger('popularity');
            $table->timestamps();
            $table->integer('idAccount');
            $table->integer('idGroup');

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

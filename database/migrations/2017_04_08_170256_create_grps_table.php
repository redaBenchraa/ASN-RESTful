<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGrpsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('grps', function (Blueprint $table) {

            $table->increments('id');
            $table->string('Name');
            $table->date('creationDate');
            $table->binary('Image')->nullable();
            $table->text('About');
            $table->unsignedInteger('Account_id')->nullable();
            $table->unsignedInteger('Grp_id')->nullable();
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
        Schema::dropIfExists('grps');
    }
}

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('questions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id_from')->unsigned();
            $table->foreign('user_id_from')->references('id')->on('users')->onDelete('cascade');
            $table->integer('user_id_to')->unsigned()->nullable();
            $table->foreign('user_id_to')->references('id')->on('users')->onDelete('cascade');
            $table->text('questions')->nullable();
            $table->string('questions_code')->unique();
            $table->text('privacy')->nullable();
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
        Schema::dropIfExists('questions');
    }
}

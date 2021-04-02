<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDecksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('decks', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("teacher_id");
            $table->string("name");
            $table->text('description');
            $table->string('level');
            $table->unsignedBigInteger("lang_in_id");
            $table->unsignedBigInteger('lang_to_id');
            $table->string("cover_image");
            $table->foreign('teacher_id')->references('id')->on('teachers');
            $table->foreign('lang_in_id')->references('id')->on('languages');
            $table->foreign('lang_to_id')->references('id')->on('languages');
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
        Schema::dropIfExists('decks');
    }
}

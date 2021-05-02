<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDeckLessonsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('deck_lessons', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("deck_id");
            $table->foreign('deck_id')->references('id')->on('decks')->onDelete('cascade');
            $table->string("name");
            $table->string('translation');
            $table->string("audio");
            $table->string('cover');
            $table->softDeletes();
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
        Schema::dropIfExists('deck_lessons');
    }
}

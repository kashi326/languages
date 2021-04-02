<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommentsOnTeacherTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comments_on_teacher', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("teacher_id")->unsigned();
            $table->unsignedBigInteger("user_id")->unsigned();
            $table->tinyInteger('star');
            $table->string('comment');
            $table->foreign("teacher_id")->references('id')->on("teachers");
            $table->foreign("user_id")->references('id')->on("users");
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
        Schema::dropIfExists('comments_on_teacher');
    }
}

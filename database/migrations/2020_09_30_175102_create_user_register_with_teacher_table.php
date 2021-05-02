<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserRegisterWithTeacherTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
            Schema::create('lessons', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('user_id');
                $table->unsignedBigInteger('teacher_id');
                $table->unsignedBigInteger('timing_id');
                $table->string('scheduled_date');
                $table->float('stars')->default(0);
                $table->text('feedback')->nullable();
                $table->string('platform')->nullable();
                $table->string('link')->nullable();
                $table->tinyInteger('isAttended')->default(0);
                $table->softDeletes();
                $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
                $table->foreign('teacher_id')->references('id')->on('teachers')->onDelete('cascade');
                $table->foreign('timing_id')->references('id')->on('teacher_timings')->onDelete('cascade');
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
        Schema::dropIfExists('lessons');
    }
}

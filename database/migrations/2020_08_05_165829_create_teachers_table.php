<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTeachersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('teachers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("language_id");
            $table->unsignedBigInteger("user_id");
            $table->softDeletes();
            $table->foreign("language_id")->references('id')->on("languages")->onDelete('cascade');
            $table->foreign("user_id")->references('id')->on("users")->onDelete('cascade');
            $table->string("name");
            $table->string("lastname");
            $table->string('phone');
            $table->string("gender");
            $table->string('country');
            $table->tinyInteger('verified')->default(0);
            $table->float('price')->default(0);
            $table->tinyInteger('discount')->default(0);
            $table->string("intro_link")->nullable();
            $table->text("about");
            $table->tinyInteger('status')->default(0);
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
        Schema::dropIfExists('teachers');
    }
}

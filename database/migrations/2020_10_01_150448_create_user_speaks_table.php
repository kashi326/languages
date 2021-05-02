<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserSpeaksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_speaks', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('language_id');
            $table->foreign("user_id")->references('id')->on("users")->onDelete('cascade');
            $table->foreign("language_id")->references('id')->on("languages")->onDelete('cascade');
            $table->string('level');
            $table->string('motivation');
            $table->softDeletes();
            $table->tinyInteger('currently_learning')->default(1);
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
        Schema::dropIfExists('user_speaks');
    }
}

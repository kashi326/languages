<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDiscussionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('discussions', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('language_id');
            $table->string('heading');
            $table->text('body');
            $table->string('media_link')->nullable();
            $table->integer('upvote')->default(0);
            $table->integer('downvote')->default(0);
            $table->string('tags')->default('');
            $table->foreign("user_id")->references('id')->on("users");
            $table->foreign("language_id")->references('id')->on("languages");
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('discussion');
    }
}

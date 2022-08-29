<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateThreadsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('threads', function (Blueprint $table) {
            $table->id();
            $table->foreignId('post_id');
            $table->bigInteger('initiator_id');
            $table->bigInteger('post_author_id');
            $table->bigInteger('last_message_id')->nullable();
            $table->timestamps();

            $table->foreign('initiator_id')->references('id')->on('users')->cascadeOnDelete();
            $table->foreign('post_author_id')->references('id')->on('users')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('threads');
    }
};

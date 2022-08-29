<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('messages', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId('post_id')->constrained()->cascadeOnDelete();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('thread_id')->constrained()->cascadeOnDelete();
            $table->bigInteger('recipient_id');
            $table->text('message');
            $table->boolean('is_read')->default(false);

            $table->foreign('recipient_id')->references('id')->on('users')->cascadeOnDelete();
            $table->index('post_id');
            $table->index('thread_id');
            $table->index('user_id');
            $table->index('recipient_id');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('messages');
    }
}

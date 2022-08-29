<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('post_images', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId('post_id')->nullable()->constrained()->nullOnDelete();
            $table->string('full_size_path');
            $table->string('thumbnail_path');
            $table->boolean('is_main')->default(false);
            $table->string('width');
            $table->string('height');

            $table->index('post_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('post_images');
    }
}

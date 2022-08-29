<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->string('slug');
            $table->string('title');
            $table->decimal('price', 12, 2)->default(0);
            $table->text('description');
            $table->boolean('active')->default(true);
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('subcategory_id')->constrained()->cascadeOnDelete();
            $table->foreignId('city_id')->constrained()->cascadeOnDelete();
            $table->string('address')->nullable();
            $table->timestamps();

            $table->index('user_id');
            $table->index('subcategory_id');
            $table->index('city_id');
            $table->index('updated_at');
            $table->index('price');
        });

        DB::statement("ALTER TABLE posts ADD COLUMN title_tsvector TSVECTOR");
        DB::statement("UPDATE posts SET title_tsvector = to_tsvector('english', title)");
        DB::statement('CREATE INDEX posts_title_fts_idx ON posts USING GIN(title_tsvector)');
        DB::statement("CREATE TRIGGER posts_title_fts_update_trigger BEFORE INSERT OR UPDATE ON posts FOR EACH ROW EXECUTE PROCEDURE tsvector_update_trigger('title_tsvector', 'pg_catalog.english', 'title')");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement("DROP TRIGGER IF EXISTS posts_title_fts_update_trigger ON posts");
        DB::statement("DROP INDEX IF EXISTS posts_title_fts_idx");
        DB::statement("ALTER TABLE posts DROP COLUMN title_tsvector");
        Schema::dropIfExists('posts');
    }
}

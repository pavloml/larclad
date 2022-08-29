<?php

namespace App\Observers;

use App\Models\Post;
use App\Models\PostImage;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class PostObserver
{
    /**
     * Handle the Post "created" event.
     *
     * @param Post $post
     * @return void
     */
    public function created(Post $post)
    {
        //
    }

    /**
     * Handle the Post "saving" event.
     *
     * @param Post $post
     * @return void
     */
    public function saving(Post $post)
    {
        $this->updateSlug($post);
    }



    /**
     * Handle the Post "updated" event.
     *
     * @param Post $post
     * @return void
     */
    public function updated(Post $post)
    {
        //
    }


    /**
     * Handle the Post "deleting" event.
     *
     * @param Post $post
     * @return void
     */
    public function deleting(Post $post)
    {
        $post->deleteImages();
    }

    private function updateSlug($post): void
    {
        $post->slug = Str::slug($post->title);
    }
}

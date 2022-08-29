<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class PostImage extends Model
{
    /**
     * The attributes that aren't assignable.
     *
     * @var string[]
     */
    protected $guarded = ['id'];

    /**
     * The "booted" method of the model.
     *
     * @return void
     */
    protected static function booted()
    {
        static::deleted(function ($postImage) {
            if (Storage::disk('public')->exists($postImage->full_size_path)){
                Storage::disk('public')->delete($postImage->full_size_path);
            } else {
                Log::error('Trying to delete non-existing public file: ' . $postImage->full_size_path);
            }

            if (Storage::disk('public')->exists($postImage->thumbnail_path)){
                Storage::disk('public')->delete($postImage->thumbnail_path);
            } else {
                Log::error('Trying to delete non-existing public file: ' . $postImage->thumbnail_path);
            }
        });
    }


    public function post()
    {
        return $this->belongsTo(Post::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Complain extends Model
{

    /**
     * The attributes that aren't assignable.
     *
     * @var string[]
     */
    protected $guarded = ['id'];

    public function post()
    {
        $this->belongsTo(Post::class);
    }
}

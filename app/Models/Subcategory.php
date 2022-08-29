<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subcategory extends Model
{
    /**
     * The attributes that aren't assignable.
     *
     * @var string[]
     */
    protected $guarded = ['id'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}

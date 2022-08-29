<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    /**
     * The attributes that aren't assignable.
     *
     * @var string[]
     */
    protected $guarded = ['id'];

    public function scopeSearchByName($query, $name)
    {
        if (!$name) {
            return $query;
        }

        return $query->where('name', 'like', $name ."%");
    }

}

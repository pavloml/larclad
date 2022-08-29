<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MessageAttachment extends Model
{

    /**
     * The attributes that aren't assignable.
     *
     * @var string[]
     */
    protected $guarded = ['id'];

    public function message()
    {
        $this->belongsTo(Message::class);
    }
}

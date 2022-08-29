<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Thread extends Model
{
    /**
     * The attributes that aren't assignable.
     *
     * @var string[]
     */
    protected $guarded = ['id'];

    public function post()
    {
        return $this->belongsTo(Post::class, 'post_id');
    }

    public function messages()
    {
        return $this->hasMany(Message::class);
    }

    public function last_message()
    {
        return $this->belongsTo(Message::class, 'last_message_id');
    }

    public function initiator()
    {
        return $this->belongsTo(User::class, 'initiator_id');
    }

    public function post_author_id()
    {
        return $this->belongsTo(User::class, 'post_author_id');
    }

    public function scopeParticipant($query, $userId)
    {
        return $query->where('initiator_id', $userId)->orWhere('post_author_id', $userId);
    }

    public function scopeLastHour($query)
    {
        return $query->where('created_at', '>', now()->subHour()->toDateTimeString());
    }

}

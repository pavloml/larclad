<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{

    /**
     * The attributes that aren't assignable.
     *
     * @var string[]
     */
    protected $guarded = ['id'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function recipient()
    {
        return $this->belongsTo(User::class, 'recipient_id');
    }

    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    public function thread()
    {
        return $this->belongsTo(Thread::class);
    }

    public function scopeUnread($query)
    {
        return $query->where('is_read', false);
    }


    public function scopeAllUnreadForUser($query, $userId)
    {
        return $query->where('recipient_id', $userId)->where('is_read', false);
    }

    public function scopeRecipient($query, $userId)
    {
        return $query->where('recipient_id', $userId);
    }

    public function scopeThread($query, $threadId)
    {
        return $query->where('thread_id', $threadId);
    }

    public function attachements()
    {
        $this->hasMany(MessageAttachment::class);
    }
}

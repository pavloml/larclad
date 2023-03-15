<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;


class Ban extends Model
{
    use LogsActivity;

    /**
     * The attributes that aren't assignable.
     *
     * @var string[]
     */
    protected $guarded = ['id'];

    protected $casts = [
        'banned_until' => 'datetime',
    ];

    public function user()
    {
        $this->belongsTo(User::class);
    }

    public function scopeActive($query)
    {
        return $query->where('banned_until', '>', Carbon::now());
    }


    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->useLogName('moderation');
    }
}

<?php

namespace App\Models;

use App\Notifications\ResetPasswordNotification;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that aren't assignable.
     *
     * @var string[]
     */
    protected $guarded = ['id', 'role'];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function scopeCreatedDate($query, $date)
    {
        return $query->whereDate('created_at', $date);
    }

    public function scopeRole($query, $role)
    {
        return $query->where('role', $role);
    }

    public function scopeSearchByUsername($query, $username)
    {
        if (!$username) {
            return $query;
        }

        return $query->where('username', 'like', $username ."%");
    }

    public function scopeSearchByName($query, $name)
    {
        if (!$name) {
            return $query;
        }

        return $query->where('name', 'like', $name ."%");
    }

    public function setPasswordAttribute($password)
    {
        $this->attributes['password'] =  Hash::make($password);
    }


    public function setUsernameAttribute($username)
    {
        $this->attributes['username'] = Str::lower($username);
    }

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPasswordNotification($token, $this->email));
    }

    public function getPhoneNumberInNANP()
    {
        return preg_replace('/\+1(\d{3})(\d{3})(\d+)/', "($1) $2-$3", $this->phone);
    }

}

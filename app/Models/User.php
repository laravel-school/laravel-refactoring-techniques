<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\Usercity;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $guarded = [];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'featuredsince' => 'datetime'
    ];

    public function usercity()
    {
        return $this->hasOne(Usercity::class, 'userid');
    }

    public function tempphoto()
    {
        return $this->hasOne(Photo::class, 'userid');
    }

    public function profilePhoto()
    {
        return url('/') . "/images/users/photos/" . $this->tempphoto->isprivate == '1' ? 'private' : 'public' . "/cropped/{$this->tempphoto->photomainid}";
    }
}

<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function events() : HasMany {
        return $this->hasMany(Event::class);
    }

    public function galleries() : HasMany {
        return $this->hasMany(Gallery::class);
    }

    public function comments() : HasMany {
        return $this->hasMany(Comment::class);
    }

    public function likes() : HasMany {
        return $this->hasMany(Like::class);
    }

    public function attendings() : HasMany {
        return $this->hasMany(Attending::class);
    }

}

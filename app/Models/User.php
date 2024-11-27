<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    //set admin
    public function isAdmin(){
        return $this->user_role == 1;
    }

    //likes relation
    public function likes(){
        return $this->hasMany(Like::class, 'liked_by');
    }

    //contents relation
    public function contents()
    {
        return $this->belongsToMany(Content::class);
    }

    //sanction stuff
    public function isBanned()
    {
        return !is_null($this->banned_at);
    }

    public function ban()
    {
        $this->banned_at = now();
        $this->save();
    }

    public function unban()
    {
        $this->banned_at = null;
        $this->save();
    }

    public function addWarning()
    {
        $this->warnings_count += 1;
        $this->save();
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'profile_picture',
    ];

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
    ];
}

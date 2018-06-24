<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'role_id', 'is_active', 'photo_id', 'updated_at'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function photo()
    {
        return $this->belongsTo(Photo::class);
    }

    public function isAdmin()
    {
        return $this->role_id == 1 && $this->is_active == 1;
    }

    public function post()
    {
        return $this->hasMany(Post::class);
    }



}

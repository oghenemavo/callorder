<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'phone',
        'email',
        'password',
        'is_active',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getInitialsAttribute()
    {
        $split = explode(' ', $this->attributes['name']);
        return strtoupper($split[0][0]) . strtoupper($split[1][0]);
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    public function permissions()
    {
        return $this->belongsToMany(Permission::class);
    }
    
    public function hasRole($user_role)
    {
        foreach ($this->roles as $role) {
            if ($user_role == $role->slug) {
                return true;
            }
        }
        return false;
    }

    public function hasPrivilegeTo($privilege)
    {
        foreach ($this->permissions as $permission) {
            if ($privilege == $permission->slug) {
                return true;
            }
        }
        return false;
    }

    public function supermarket()
    {
        return $this->hasOne(Supermarket::class);
    }

}

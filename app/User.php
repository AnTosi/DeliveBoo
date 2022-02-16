<?php

namespace App;

use App\Models\Tag;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;


class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'image', 'name', 'slug', 'email', 'logo', 'password', 'address', 'vat',
    ];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function tags() {
        return $this->belongsToMany('App\Models\Tag');
    }

    public function dishes() {
        return $this->hasMany('App\Models\Dish');
    }

    public function orders() {
        return $this->hasMany('App\Models\Order');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    //

    protected $fillable = ['email', 'address', 'customer_name', 'dish_price', 'total_price', 'user_id'];

    public function dishes()
    {
        return $this->belongsToMany('App\Models\Dish')->withPivot('quantity')->withTimestamps();
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}

<?php

namespace App\Models;

use App\User;



use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    //

    public function users() {
        return $this->belongsToMany('App\User');
    }
}

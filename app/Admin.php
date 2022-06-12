<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    protected $table = 'admins';

    public function product(){
        return $this->hasMany('App\Product');
    }
}

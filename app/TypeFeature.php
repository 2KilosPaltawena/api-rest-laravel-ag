<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TypeFeature extends Model
{
    protected $table = 'typefeatures';

    public function feature(){
        return $this->hasMany('App\Feature');
    }

    public function cc(){
        return $this->hasMany('App\Cc');
    }
}

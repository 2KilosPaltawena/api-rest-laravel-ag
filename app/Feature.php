<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Feature extends Model
{
    protected $table = 'features';

    public function typeFeature(){
        return $this->belongsTo('App\TypeFeature','features_id');
    }

    public function cc(){
        return $this->hasMany('App\Cc');
    }
}

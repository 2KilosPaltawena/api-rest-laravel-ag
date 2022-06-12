<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cc extends Model
{
    protected $table = 'ccs';

    public function product(){
        return $this->belongsTo('App\Product','product_id');
    } 

    public function typeFeature(){
        return $this->belongsTo('App\TypeFeature','typeFeature_id');
    }

    public function feature(){
        return $this->belongsTo('App\Feature','feature_id');
    }

}

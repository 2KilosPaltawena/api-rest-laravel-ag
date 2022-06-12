<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table ='products';

//relacion pertenece a
public function category(){
    return $this->belongsTo('App\Category','category_id');
}

public function admin(){
    return $this->belongsTo('App\admin','admin_id');
}

public function stock(){
    return $this->hasMany('App\Stock');
}

public function cc(){
    return $this->hasMany('App\Cc');
}


}

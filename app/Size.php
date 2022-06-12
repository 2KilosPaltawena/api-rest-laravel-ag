<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Size extends Model
{
    protected $table = 'sizes';

    //nu talla tiene mucho stock
    public function stock(){
        return $this->belongsTo('App\Stock','size_id');
    }
}

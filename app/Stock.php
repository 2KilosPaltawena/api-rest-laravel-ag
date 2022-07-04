<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    protected $table = 'stocks';

    public function product(){
        return $this->belongsTo('App\Product','product_id');
    }

    public function size(){
        return $this->belongsTo('App\Size','size_id');
    }

    protected $fillable = [
        'product_id',
        'id_talla',
        'cantidad',
    ];
}

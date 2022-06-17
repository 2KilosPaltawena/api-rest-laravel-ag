<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cc;

class CcController extends Controller
{
    public function getProductByCc($id){
        $cc = Cc::where('product_id',$id)->get()->load('product','feature','typefeature');
        return response()->json(['cc'=>$cc]);

    }

    public function getProductByCcQyA($id,$ide){
        $cc = Cc::where('typeFeature_id',$id)->get()->load('product','feature','typefeature');
        $cc = Cc::where('feature_id',$ide)->get()->load('product','feature','typefeature');
        return response()->json(['cc'=>$cc]);
    }
}

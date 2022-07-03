<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cc;
use Product\Product;

class CcController extends Controller
{
    public function getProductByCc($id){
        $cc = Cc::where('product_id',$id)->get()->load('product','feature','typefeature');
        return response()->json(['cc'=>$cc]);

    }

    public function getProductByCcQyA($id,$ide){
        $cc = Cc::where('typeFeature_id',$id)->where('feature_id',$ide)->get()->load('product','feature','typefeature');
        return response()->json(['cc'=>$cc]);
    }
    


    public function getProductByCcQyAx2($idq1,$ida1,$idq2,$ida2){
        $cc = Cc::orwhere('typeFeature_id',$idq1)
        ->where('feature_id',$ida1)
        ->orwhere('typeFeature_id',$idq2)
        ->where('feature_id',$ida2)
        ->get()->load('product','feature','typefeature');

       $cc = $cc->unique("product_id");
        $largo = count($cc);
        //return $largo;
        $pp = $cc;



        return response()->json(['cc'=>$pp]);

    }
}

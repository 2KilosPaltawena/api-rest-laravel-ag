<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Stock;

class StockController extends Controller
{

    public function index(){
        $stock = Stock::all()->load('product','size');

        return response()->json([
            'code'=> 200,
            'status'=>'succes',
            'stock'=>$stock
        ]);
    } 
    
    public function show($id){
        $stock = Stock::find($id)->load('product','size');

        return response()->json([
            'code'=> 200,
            'status'=>'succes',
            'stock'=>$stock
        ]);
    }

    public function getProductByStock($id){
        $stock = Stock::where('product_id',$id)->get()->load('product','size');
        return response()->json(['stock'=>$stock]);

    }

    public function bystock(Request $request){

        //CREAR EL USUARIO

        $stock=Stock::where('product_id',$request->product_id)->where('size_id',$request->size_id)->get();

        return $stock;

}
}

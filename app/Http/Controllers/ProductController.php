<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Product;

class ProductController extends Controller
{

    public function getProductByCategory($id){
        $products = Product::where('category_id',$id)->get();
        return response()->json(['products'=>$products]);
    }

    public function index(){
        $products = Product::all()->load('category');

        return response()->json([
            'code'=> 200,
            'status'=>'succes',
            'products'=>$products
        ]);
    }

    public function show($id){
        $product = Product::find($id);

        if(is_object($product)){
            $data = [
                'code'=> 200,
                'status' => 'succes',
                'product' => $product
            ];

        }else{
            $data = [
                'code'=> 200,
                'status' => 'error',
                'message' => 'El producto no existe'
            ];
        }
        return response()->json($data, $data['code']);
    }

}

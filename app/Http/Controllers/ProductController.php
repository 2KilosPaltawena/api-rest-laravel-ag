<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Product;

class ProductController extends Controller
{
    //muestra todos los productos de una categoría en específico
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
        $product = Product::find($id)->load('category');

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

    public function getProductByRanking($rank){
        $product = Product::where('ranking',$rank)->get();
        return response()->json(['product'=>$product]);

    }

    public function productadd(Request $request){
        
//recoger los datos del producto por post
        $json = $request->input('json', null);
        $params = json_decode($json);
        $params_array = json_decode($json, true);

//validar datos ( no tan importante)
        $validate = \Validator::make($params_array, [
            'name' =>'required|alpha',
            'price'=>'required',
            'ranking'=>'required',
            'category_id'=>'required',
            'image'=>'required'
        ]);

        if(!empty($params) && !empty($params_array)){

        $params_array = array_map('trim' , $params_array);

        if($validate->fails()){
            $data = array(
                'status' => 'error',
                'code' => 404,
                'message'=>'El producto no ha sido validado correctamente',
                'errors' => $validate->errors()
            );
        }else{
            $data = array(
                'status' => 'succes',
                'code' => 200,
                'message'=>'El producto ha sido validado correctamente'
            );
        }

//comprobar si producto está duplicado

//crear el product
            $product= new Product();
            $product->name = $params_array['name'];
            $product->price = $params_array['price'];
            $product->ranking = $params_array['ranking'];
            $product->category_id = $params_array['category_id'];
            $product->image = $params_array['image'];

//guardar el usuario

        $product->save();

    }else{
        $data = array(
            'status' => 'error',
            'code' => 404,
            'message' => 'Los datos enviados no son correctos'
        );

    }


        return response ()->json($data, $data['code']);
    }



}

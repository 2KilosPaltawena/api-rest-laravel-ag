<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Category;

class CategoryController extends Controller
{
    public function __construct(){
       $this->middleware('api.auth', ['except' => ['index','show']]);
    }

    public function index(){
        $categories = Category::all();

        return response()->json([
            'code'=> 200,
            'status'=>'succes',
            'categories'=>$categories
        ]);
    }

    public function showC($id){
        $category = Category::find($id);

        if(is_object($category)){
            $data = [
                'code'=> 200,
                'status' => 'succes',
                'category' => $category
            ];

        }else{
            $data = [
                'code'=> 200,
                'status' => 'error',
                'message' => 'La categoria no existe'
            ];
        }
        return response()->json($data, $data['code']);
    }

    public function store(Request $request){
        //recoger los datos por product
        $json = $request->input('json', null);
        $params_array = json_decode($json, true);
        
        if(!empty($params_array)){
            //validar los datos
            $validate = \Validator::make($params_array,[
                'name'=> 'required'
            ]);

            //Guardar una categoría
            if($validate->fails()){
                $data = [
                    'code'=> 400,
                    'status'=> 'error',
                    'message'=> 'no se ha guardado la categoría'
                ];
            }else{
                $category = new Category();
                $category->name =$params_array['name'];
                $category->save(); 

                $data = [
                    'code'=> 200,
                    'status'=> 'success',
                    'category'=> $category
                ];
            }
        }else{
            $data = [
                'code'=> 400,
                'status'=> 'error',
                'message'=> 'no se ha enviado ninguna categoria'
            ];        
        }  
        return response()->json($data, $data['code']);  
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Product;
use App\Stock;
use App\Category;
use App\Cc;
use App\Admin;

class ControllerPruebas extends Controller
{
    public function index(){
            //$products = Product::all()->load('category');
            //$stocks = Stock::all()->load('product','size');
            $ccs = Cc::all();
    
            return response()->json([
                'code'=> 200,
                'status'=>'succes',
                //'products'=>$products
                //'stocks'=>$stocks
                'ccs' =>$ccs

            ]);
    }



    public function testorm(){

        $categories = Category::all();
        foreach($categories as $category){
            echo"<h1>{$category->name}</h1>";

            foreach($category->products as $product){
                echo"<h3>".$product->name."</h3>";
                echo "<h4>{$product->admin->name}</h4>";

            }
            echo '<hr>';
        }

        $stocks = Stock::all();
        foreach($stocks as $stock){
            echo "<h3>{$stock->product->name}</h3>";
            echo "<h2>{$stock->size->size}</h2>";
            echo "<span>{$stock->quantity}</span>";
        }
        echo '<hr>';
        $ccs = Cc::all();
        foreach($ccs as $cc){
            echo "<h1>{$cc->product->name}</h3>";
            echo "<h2>{$cc->typeFeature->name}</h2>";
            echo "<h3>{$cc->feature->name}</h3>";
        }


        die();
    }


}

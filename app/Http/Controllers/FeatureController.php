<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FeatureController extends Controller
{
    public function pruebas(Request $request){
        return "Accion de pruebas de FEATURE-CONTROLLER";
    }
}

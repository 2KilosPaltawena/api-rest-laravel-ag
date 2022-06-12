<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function pruebas(Request $request){
        return "Accion de pruebas de ADMIN-CONTROLLER";
    }

    public function login(Request $request){
        return "accion de login";
    }
}

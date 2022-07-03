<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Firebase\JWT\JWT;
use App\Helpers\JwtAuth;

class UserController extends Controller
{
    public function pruebas(Request $request){
        return "acción de pruebas de USER-CONTROLLER";
    }
    //----------------------------------------------------------------------------------------------
    public function register(Request $request){
        //RECOGER DATOS DE USUARIO

        $json = $request->input('json', null);
        $params = json_decode($json); //objeto
        $params_array = json_decode($json, true); //array

        if(!empty($params) && !empty($params_array)){

            //LIMPIAR DATOS
            $params_array = array_map('trim', $params_array);

            //VALIDAR DATOS
            $validate = \Validator::make($params_array, [
                'name' => 'required|alpha',
                'surname' => 'required|alpha',
                'email' => 'required|email|unique:users',//COMPROBAR SI EL USUARIO ESTÁ DUPLUCADO
                'password' => 'required',
            ]);

            if($validate->fails()){
                //La validación ha fallado
                $data = array(
                'status' => 'error',
                'code'=> 404,
                'message' => 'El usuario no se ha creado correctamente',
                'errors' => $validate->errors()
                );
                
            }else{
                //validacion pasada correctamente

                //CIFRAR CONTRASEÑA
                //$pwd = hash('sha256', $params->password);
                
                //CREAR EL USUARIO
                $user = new User();
                $user->name = $params_array['name'];
                $user->surname = $params_array['surname'];
                $user->email = $params_array['email'];
                //$user->password = $pwd;
                $user->password = $params_array['password'];

                //GUARDAR EL USUARIO
                $user->save();

                $data = array(
                    'status' => 'success',
                    'code'=> 200,
                    'message' => 'El usuario se ha creado correctamente',   
                    'user' => $user
                );
            }
        }else{
            $data = array(
                'status' => 'error',
                'code'=> 405,
                'message' => 'Los datos enviados no son correctos'
            );

        }
        return response()->json($data, $data['code']);
    }
//---------------------------------------------------------------------------------------------------------
    public function login(Request $request){

        $jwtAuth = new \JwtAuth();

        //RECIBIR DATOS POR POST
        $json = $request->input('json', null);
        $params = json_decode($json);
        $params_array = json_decode($json, true);

        //VALIDAR ESOS DATOS
        $validate = \Validator::make($params_array, [
            'email' => 'required|email',
            'password' => 'required'
        ]);
        
        if($validate->fails()){//la validacion ha fallado
            $signup = array(
                'status' => 'error',
                'code' =>404,
                'message' => 'El usuario no se ha podido identificar',
                'errors' => $validate->errors()
            );
        }else{
           $signup = $jwtAuth->signup($params->email, $params->password);
            if(!empty($params->getToken)){
                $signup = $jwtAuth->signup($params->email, $params->password, true);
            }
        }
        //CIFRAR LA PASSWORD
        //DEVOLVER TOKEN O DATOS
        //$pwd = hash('sha256', $params->password);   
        return response()->json($signup,200); //aqui retorna la clave sin cifrado, para lo otro activar $pwd
    } 

    public function update(Request $request){
        $token = $request->header('Authorization');
        $jwtAuth = new \JwtAuth;
        $checkToken = $jwtAuth->checkToken($token);

        if($checkToken){
            echo"<h1> Login Correcto </h1>";

        } else{
            echo"<h1> Login Incorrecto </h1>";
        }
        die();
    }
}

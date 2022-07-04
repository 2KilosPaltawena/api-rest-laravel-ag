<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Firebase\JWT\JWT;
use App\Helpers\JwtAuth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function pruebas(Request $request){
        return "acción de pruebas de USER-CONTROLLER";
    }
    //----------------------------------------------------------------------------------------------
    public function register22(Request $request){
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

    public function register(Request $request){

            //CREAR EL USUARIO
            $user = new User();
            $user->name = $request->input('name');
            $user->surname = $request->input('surname');
            $user->email = $request->input('email');
            //$user->password = $pwd;
            $user->password =Hash::make($request->input('password')) ;

            $pp=User::where('email', $request->input('email'))->exists();

            if ($pp == false){
                $user->save();
               return $user;  
            }else{
                return 1;
            }     

}

    public function login(Request $req){

        $user=User::where('email',$req->email)->first();
        if(!$user || !Hash::check($req->password,$user->password)){
            return 1;
        }
        return $user;

    }


//---------------------------------------------------------------------------------------------------------
    public function login22(Request $request){

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

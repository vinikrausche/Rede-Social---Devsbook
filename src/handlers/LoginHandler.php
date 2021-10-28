<?php
namespace src\handlers;

use \src\models;
use src\models\User;

class LoginHandler{

    //método estatico que irá verificar se o usuário existe no banco dedados
    public static function checkLogin(){
        
        //verificação da existência da sessão token
        if(!empty($_SESSION['token'])){
            $token = $_SESSION['token'];

            //verificando se o token existe no banco de dados
            $data = User::select()->where('token',$token)->one();
            

            //verificando se algo foi encontrado
            if(count($data) > 0){

                //setando os dados no banco de dados
                $loggedUser = new User();
                $loggedUser->setId($data['id']);
                $loggedUser->setName($data['name']);
                $loggedUser->setEmail($data['email']);
                return $loggedUser;  
            }
            
        }

        return false;
    }

    public static function verifyLogin($email,$pass){
        //verificando se o email e senha batem 
        $user = User::select()->where('email',$email)->one();

        if($user){
            //verificação de senha
            if(password_verify($pass,$user['password'])){
                $token = md5(time().rand(0,9999).time());

                User::update()
                ->set('token',$token)
                ->where('email',$email)
                ->execute();

                return $token;

            }
            
        }
        return false;
    }


    //verificador de email existente
    public static function emailExist($email){
        //verificando se o email já existe
        $dado = User::select()->where('email',$email)->one();
        return $dado ? true : false;
    }

    public static function addUser($name,$email,$password,$birthdate){

        //criando um hash para a senha
        $hash = password_hash($password,PASSWORD_DEFAULT);

        //criando o token
        $token = md5(time().rand(0,9999).time());

        //inserindo o usuário no banco de dados
        User::insert([
            'name' => $name,
            'email' => $email,
            'password' => $hash,
            'birthdate' => $birthdate,
            'token' => $token
        ])->execute();
        
        return $token;

    }
}
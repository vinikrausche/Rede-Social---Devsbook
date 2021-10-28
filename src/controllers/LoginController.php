<?php 

namespace src\controllers;

use \core\Controller;
use src\models\Usuario;
use src\handlers\LoginHandler;

class LoginController extends Controller {

    public function signin() {
        $flash = '';

        //verificação de mensagem de erro
        if(!empty($_SESSION['flash'])){
            $flash = $_SESSION['flash'];
            $_SESSION['flash'] = '';
        }
        $this->render('login',['flash' => $flash]);
}

public function signinAction(){
    
    //tratamento dos dados vindos das input de /login
    $email = filter_input(INPUT_POST,'email',FILTER_VALIDATE_EMAIL);
    $password = filter_input(INPUT_POST,'password',FILTER_SANITIZE_SPECIAL_CHARS);

    if(!empty($email) && !empty($password)){
        
        //usando o LoginHandler
        $token = LoginHandler::verifyLogin($email,$password);
        if($token){
            $_SESSION['token'] = $token;
            $this->redirect('/');
        } else{
            $_SESSION['flash'] = 'E-mail e/ou senha inválidos';
            $this->redirect('/login');
        }
    } 
}
public function signup(){
    $token = '';
    if(!empty($_SESSION['token'])){
        $_SESSION['token'] = $token;
        $_SESSION['token'] = '';
    }

    //mensagem de erro na página cadastro
    $flash = '';
    if(!empty($_SESSION['flash'])){
        $flash = $_SESSION['flash'];
        $_SESSION['flash'] = '';
    }

    $this->render('/cadastro',['flash' => $flash]);
}

public function signupAction(){

    //tratamento dos dados recebidos pela rota /cadastro
    $name = filter_input(INPUT_POST,'name',FILTER_SANITIZE_SPECIAL_CHARS);
    $email = filter_input(INPUT_POST,'email',FILTER_VALIDATE_EMAIL);
    $password = filter_input(INPUT_POST,'password',FILTER_SANITIZE_SPECIAL_CHARS);
    $date = filter_input(INPUT_POST,'date',FILTER_SANITIZE_SPECIAL_CHARS);

    if($name && $email && $password && $date){
    
        //transformando a data de nascimento no formato internacional
        $birthdate = explode('/',$date);
        //verificando se ela possui trÊs itens dia - mes - ano
        if(count($birthdate) != 3){
            $_SESSION['flash'] = 'Data inválida';
            $this->redirect('/cadastro');
        }

        //transformando a data de nascimento no padrão internacional
        $birthdate = $birthdate[2].'-'.$birthdate[1].'-'.$birthdate[0];

        if(strtotime($birthdate) === false){
            $_SESSION['flash'] = 'Data inválida';
            $this->redirect('/cadastro');
        }

        //inserindo no banco de dados
        if(LoginHandler::emailExist($email) === false){
            $token = LoginHandler::addUser($name,$email,$password,$birthdate);
            $_SESSION['token'] = $token;
            $this->redirect('/');
        }else{
            $_SESSION['flash'] = 'Erro ao inserir no banco de dados';
            $this->redirect('/cadastro');
        }

    }else{
        $_SESSION['flash'] = 'Preencha todos os campos corretamente';
        $this->redirect('/cadastro');
    }

}

}
<?php
namespace src\controllers;

use \core\Controller;
use src\handlers\LoginHandler;

class HomeController extends Controller {

    private $loggedUser;

    public function __construct()
    {
        $loggedUser = LoginHandler::checkLogin();
        if($loggedUser === false){
            return $this->redirect('/login');
        }

        
    }

    public function index() {
        $this->render('home',
        ['loggedUser' => $this->loggedUser]
    );
    }



}
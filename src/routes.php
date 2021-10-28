<?php
use core\Router;

$router = new Router();

$router->get('/', 'HomeController@index');

//Rota de Login
$router->get('/login','LoginController@signin');
$router->post('/login','LoginController@signinAction');

//Rota de cadastro
$router->get('/cadastro','LoginController@signup');
$router->post('/cadastro','LoginController@signupAction');


//Rota sair
$router->get('/sair','LoginController@exit');
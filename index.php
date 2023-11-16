<?php
/**
 * Este archivo sera el punto de entrada de la aplicacion.
 */

//Este archivo de php devuelve un objeto con la setencia return:
require 'Core/bootstrap.php';
require "Models/Task.php";

// Aqui comienza el ruoter
// Las rutas que se tendran 
$routes = require('routes.php');


$url = Request::url();

//La instancia de un Router
$router = new Router;
// En este metodo se registrarian las rutas que ya se definieron.
$router->register($routes);

// Este metodo es para determinar el controlador que sera invocado.
 require $router->handle($url);


<?php

require 'functions.php';
require 'database/Connection.php';
require 'database/QueryBuilder.php';
require 'Core/Router.php';
require 'Core/Request.php';
require 'Core/App.php';


App::set('config', require 'config.php');
$config = App::get('config');
//Clase para inicializar variables que seran utilizadas en toda la aplicacion:
// De la instancia de PDO se prepara la consulta que se hara a la base de datos:
$pdo = Connection::start($config['database']); // los "::" es para llamar a metodos estaticos de una clase.
//$connection = new Connection();
//$pdo = $connection->start(); //Una manera mas corta seria: $pdo = (new Connection)->start(); en el caso se instancie la clase.
App::set('database', new QueryBuilder($pdo));

App::get('database');

if ($config['error_handling']) {
//Las siguientes instrucciones le dicen a php que muestre los errores en el navegador:
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
}


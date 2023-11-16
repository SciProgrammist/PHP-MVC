<?php

class Connection {
    public static function start($config)
    {
         // ***Manera en la cual se manda a llamar de la base de datos con la clase PHP DATA OBJECTS:
       try {
        $pdo = new PDO("{$config['type']}:host={$config['host']}; dbname={$config['database']}",
                         $config['user'], $config['password']);

       } catch (PDOException $error) {
        die("Error: " . $error->getMessage());
       }

       return $pdo;
    }
}
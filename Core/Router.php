<?php

class Router
{
    // propiedad protegida
    protected $routes = [];

    // II- El proposito de este metodo register es asignar las rutas internamente en el router.
    public function register($routes)
    {
        $this->routes = $routes;
    }
    // III- Este metodo se encarga de determinar cual controlador debe ser utilizado
    public function handle($url)
    {
        // Para validar que la ruta se encuentra definida:
        if(array_key_exists($url, $this->routes)) {
            return $this->routes[$url];
        }
        
        die('La ruta no existe.');

    }
}
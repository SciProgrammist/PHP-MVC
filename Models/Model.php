<?php
/** NOTAS IMPORTATES:
 * I) Para darle una ruta absoluta se utiliza: __DIR__ - '/../asdasd.php';
 * 
 * II) Otra manera en la que podemos llamar atributos de nuestras clases es de la siguiente:
 *      $propertyName='title';
 *      $this->$propertyName; // se llama la propidad title
 *      $this->title;
 * III) El metodo var_export() lo que hace es exportar el nombre en forma de texto del atributo de la clase
 *      es por eso que se le debe pasar el valor y en el otro parametro permitirle hacerlo con true.
 **/
 class Model
 {
    protected $properties = [];
    protected $table;

    public function __construct($properties = [])
    {
        $this->properties = $properties;
    }

    public static function create($properties)
    {
        $model = new static($properties);
        $model->save();

        return $model;
    }

    public static function find($id)
    {
        $model = new static;
        App::get('database')
        ->find($model->getTable(), $id);
    }

    public function getTable()
    {
        return $this->table;
    }
    public function buildString()
    {
        
        $me = new ReflectionClass($this);
        $properties = $me->getProperties();
        //dd($properties);
        $string = "";
        foreach ($properties as $property) {
            //En esta parte estamos aislando el nombre de la propiedad:
            $propertyName = $property->name;
            //Aqui estamos aislando el valor de la propiedad:
            $propertyValue = $this->$propertyName;
            $string = $string . "{$propertyName}:" . (is_bool($propertyValue) ? var_export($propertyValue, true): $propertyValue) . "\n";
        }
        return $string;
    }
    // Este metodo es para demostrar el concepto de la herencia donde se quiere guardar en un archivo de texto la clase.
    public function save($name = null)
    {

        if(empty($this->table)) {
            throw new Exception("El nombre de la tabla no ha sido definido.");
        }

        $query = App::get('database'); //Este es una manera de inyectar dependencias en PHP
        $query->create($this->table, $this->properties);
        //Manera en la cual se guardaba en un archivo de texto
        if (is_null($name)) {
            $me = new ReflectionClass($this);
            $filename = $me->getName();
            $name = lcfirst($filename) . ".txt";
        }
        /**
         * Hay 3 funciones las cuales permiten crear, escribir y guardar un archivo y son 
         * las siguientes:
         **/
        
        $file = fopen($name, 'w'); // I) Permite crear y abrir un archivo, el nombre de archivo y modo de escritura 'w'.
        fwrite($file, $this->buildString());
        fclose($file);
    }

 }
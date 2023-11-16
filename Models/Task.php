<?php
require "Model.php";
class Task extends Model {

    public $id;
    public $color = 'black';
    public $title;
    public $completed;

    protected $table = 'tasks';

    // Constructor Property Promotion.
    /**
     * Una forma en la que PHP 8 maneja esto de los constructores es de una manera resumida donde tenemos
     * la declaracion en los parametros del mismo como publicas y asi se hacen referencia a ellas mismas como
     * propiedades, quedando de la siguiente manera:
     *
     * public function __construct(
     *  public $title,
     *  public $completed = false
     * )
     * {
     * }
     *
     **/
    // public function __construct( $topic = '', $completed = false) {
    //     $this->topic = $topic;
    //     $this->completed = $completed;
    // }

        // public function __construct(
        //     public $title,
        //     public $completed = false
        // )
        // {

        // }
    public function setComplete($bool) {
        $this->completed = $bool;
    }

    public function setColor($color) {
        $this->color = $color;
    }
    
}


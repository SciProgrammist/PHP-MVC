<?php
 //require "Model.php";
/**
 * Para la herencia en php debos de definir una clase superior la cual contenga los metodos a ser heredados,
 * es por eso que se hace dentro del bloque de codigo llamado model.
 */
class Exam extends Model
{
    public function __construct(
        public $topic,
        public $info = "",
        public $completed = false
    ) {}

    public function setCompleted($bool) {
        $this->completed = $bool;
    }
}
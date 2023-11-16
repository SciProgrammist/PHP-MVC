<?php

$greeting = "Gestionador de proyectos";
// $task = new Task("Estudiar PHP", false);
// $task->setComplete(true);

//dd($task);

echo "<br />";
/**
 * Algo muy importante a tomar en cuenta, esque no se debera definir la informacion como objetos, si no
 * esta representacion debe ser a manera de ilustrar la informacion que se recuperara de una base de datos,
 * en la cual se usaron en su debido las instancias como modelos para crear las mismas a su debido tiempo.
 * es por eso que se les conoce como modelos.
 *
 */

// $tasks = [
//     new Task(completed: false, topic: 'Estudiar PHP'), //Una nueva caracteristica para hacer referencia a los parametros de una clase.
//     // new Task('Estudiar PHP', true),
//     new Task('Ir al supermercado', false),
//     new Task('Hacer ejercicio', false),
// ];

// $tasks[0]->setColor(ColorsEnum::BLUE->value);
// $tasks[1]->setColor(ColorsEnum::GREEN->value);
// $tasks[2]->setColor(ColorsEnum::RED->value);
$query = App::get('database'); //Este es una manera de inyectar dependencias en PHP
$tasks = $query->selectAll('tasks', 'Task');
// dd($tasks);
// Accediendo a atributos de los elementos:
// $tasks[0]->setColor(ColorsEnum::RED->value);
/**
 * Funciones para filtrar en base en una funcion anonima y su evaluacion de un atributo el cual al cumplir como true 
 * la condicion pasa a ser asignado como arreglo o/u agregado.
 */
    $completedTasks =  array_filter($tasks, function($task) {
        return $task->completed;
    });

    $pendingTasks = array_filter($tasks, function($task) {
        return !$task->completed;
    });

require 'Views/index.view.php';
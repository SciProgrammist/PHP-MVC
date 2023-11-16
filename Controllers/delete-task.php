<?php
$query = App::get('database'); //Este es una manera de inyectar dependencias en PHP
$query->delete('tasks', $_POST['id']);

header('Location: /');
<?PHP
$query = App::get('database'); //Este es una manera de inyectar dependencias en PHP
// $query->update('tasks', $_POST['id'], [
//     'completed' => $_POST['completed'],
//     ]);

header('Location: /');
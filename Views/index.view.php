<?php require('partials/head.view.php'); ?>
    <!-- <nav>
        <a href="contact">Contacto</a>
        <a href="about">Nosotros</a>
        <a href="services">Servicios</a>
    </nav> -->
    <?php ?>
    <h1><?= $greeting; ?></h1> <!--Esta es la manera corta de escribir "echo $greeting" en php-->
    <h2>Proyectos completos</h2>
    <ul>
        <?php
            // foreach ($completedTasks as $task) {
            //     echo "<li>". $task->title . "</li>";
            // }
            foreach ($completedTasks as $task) :
        ?>
        <li style="color: <?=$task->color ?>;">
            <?= $task->title ?>
            <form style="display: inline;" action="tasks/toggle" method="POST">
                <input type="hidden" name="completed" value="0">
                <input type="hidden" name="id" value="<?= $task->id ?>">
                <button type="submit">➖</button>
            </form>
            <form   onsubmit="return confirm('¿Estas seguro de eliminar el registros?');
                                /**
                                 * Lo que hace es retornar un codigo javaScript cuando
                                 * se esta ejecutando el formulario, si en ese caso se retorna false,
                                 * entonces el envio del formulario se cancela.
                                 **/"
                    style="display: inline;"
                    action="tasks/delete"
                    method="POST">
                <input type="hidden" name="id" value="<?= $task->id ?>">
                <button type="submit">❌</button>
            </form>
        </li>
        <?php endforeach; ?>
    </ul>

    <h2>Proyectos pendientes</h2>
    <ul>
        <!-- Esta es una forma resumida y mas limpia de popular una lista-->
        <?php foreach ($pendingTasks as $task ) :?>
            <li style="color: <?= $task->color ?>;">
            <?= $task->title ?>
            <form style="display: inline;" action="tasks/toggle" method="POST">
               <input type="hidden" name="completed" value="1">
                <input type="hidden" name="id" value="<?= $task->id ?>">
                <button type="submit">✅</button>
            </form>
            <form   onsubmit="return confirm('¿Estas seguro de eliminar el registros?');"
                    style="display: inline;"
                    action="tasks/delete"
                    method="POST">
                <input type="hidden" name="id" value="<?= $task->id ?>">
                <button type="submit">❌</button>
            </form>
            
            </li> <!--Esta una forma mas facil de leer lo que se esta haciendo.-->
        <?php endforeach ?>
    </ul>
    <!--<h2>Ejemplo de metodo para guardar archivos. </h2>-->
    <?php
        // $tasks[0]->save('task-1.txt');
        // $tasks[1]->save('task-2.txt');
        // $tasks[2]->save();
        // $proyecto = new Exam("Proyecto Daylog", "Made by ReyesWorks",  true);
        // $proyecto->save();
    ?>
    <!--El action indica a que direccion o archivo se enviara la informacion del formulario-->
    <form action="tasks/create" method="POST"> <!-- Los metodos POST Y GET se usan para el manejo de informacion atraves del http. -->
            <input type="text" name="title"> <!--POST es para enviar informacion y GET es para solicitar. -->
            <input type="color" name="color">
            <button type="submit">Guardar</button>
    </form>
<?php require('partials/footer.view.php'); ?>
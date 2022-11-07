<?php include('database/conexion.php');
// Comprobamos si existe la sesión de apodo
session_start();
if (!isset($_SESSION['nickname'])) {
    // En caso contrario devolvemos a la página login.php
    header('Location: login.php');
    die();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css">

    <title>Mis Clases</title>
    <link rel="stylesheet" href="css/estilos.css">
</head>

<body>
    <?php include('cabecera.php'); ?>
    <main id="contenido-mislibros">

        <div class="mis-libros">
            <h2>Nire klaseak</h2>
        </div>
        <div class="todos-mis-libros">
            <p class='enlace-clase'><a href=''>Klase berria</a></p>
            <?php
            // Prepara SELECT
            $misClases = $miPDO->prepare('SELECT * FROM clase');
            $misClases->execute();
            $clases = $misClases->fetchAll();
            foreach ($clases as $posicion => $clase) {
                $clasesAlumnos = $miPDO->prepare('SELECT COUNT(id_nivel) AS num_alumnos FROM usuarios WHERE id_nivel=:id_nivel');
                $clasesAlumnos->execute(
                    [
                        'id_nivel' => $clase['id_nivel']
                    ]
                );
                $alumnos = $clasesAlumnos->fetch();
            ?>
                <div class='caja-clase'>

                    <!-- Contenedor valoracion -->
                    <div class='caja-info-clase'>
                        <!-- Nota media -->
                        <div class='caja-Nombre'>
                            <p class='nombre_clase'></i><span> <?php echo ($clase['nivel']) ?> </span></p>
                        </div>
                        <!-- Edad media -->
                        <div class='caja-alumnos'>
                            <p class='numero_alumnos'> <?php echo ($alumnos['num_alumnos']) ?> <span> ikasleak</span></p>
                        </div>
                    </div>


                </div>
            <?php
            }
            ?>


        </div>

    </main>

    <?php include('pie-pagina.php'); ?>
</body>

</html>
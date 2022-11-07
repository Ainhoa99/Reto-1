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

                echo "<div class='caja-clase'>";

                //Contenedor valoracion
                echo "<div class='caja-info-clase'>";
                //Nota media
                echo "<div class='caja-Nombre'>";
                echo "<p class='nombre_clase'></i><span>" . $clase['nivel'] . "</span></p>";
                echo "</div>";
                //Edad media
                echo "<div class='caja-alumnos'>";
                echo "<p class='numero_alumnos'>" . $alumnos['num_alumnos'] . "<span> ikasleak</span></p>";
                echo "</div>";

                echo "</div>";


                echo "</div>";
            }

            ?>
        </div>

    </main>

    <?php include('pie-pagina.php'); ?>
</body>

</html>
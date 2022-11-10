<?php
include_once "database/conexion.php";
?>

<?php
// Comprobamos si existe la sesión de apodo
session_start();
if (!isset($_SESSION['nickname'])) {
    // En caso contrario devolvemos a la página login.php
    header('Location: login.php');
    die();
}
$nivel = $miPDO->prepare('SELECT nivel FROM clase WHERE id_nivel = :id_nivel');
$nivel->execute(
    [
        'id_nivel' => $_GET['id_nivel']
    ]
);
$nivel = $nivel->fetch();

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <head>
        <meta charset="UTF-8">
        <title>Ikasleak</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- Font Awesome -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css">

        <!-- Custom Styles -->
        <link rel="stylesheet" href="css/estilos.css">

        <!-- jQuery -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

        <!-- Custom Scripts -->
        <script src="js/scripts.js"></script>
    </head>

<body>
    <?php include('cabecera.php'); ?>
    <main class="container" id="validacion">

        <h2><?php echo $nivel['nivel'] ?></h2>
        <h3>IKASLEAK</h3>
        <table class="tabla-validar" style="margin-left: 1rem;">
            <tr class="definicion-usuario">
                <th>Izena</th>
                <th>Abizenak</th>
                <th>Ezizena</th>
                <th>Emaila</th>
            </tr>
            <?php
            //Consulta
            $consulta = $miPDO->prepare('SELECT nombre, apellidos, nickname, correo FROM usuarios WHERE id_nivel = :id_nivel AND validado=1');
            $consulta->execute(
                [
                    'id_nivel' => $_GET['id_nivel']
                ]
            );
            $consulta = $consulta->fetchAll();
            foreach ($consulta as $posicion => $alumno) {
                echo "<tr>";
                echo "<td>" . $alumno['nombre'] . "</td>";
                echo "<td>" . $alumno['apellidos'] . "</td>";
                echo "<td>" . $alumno['nickname'] . "</td>";
                echo "<td class='correo-usu' name= 'correo'>" . $alumno['correo'] . "</td>";
                echo "</tr>";
            }

            ?>
        </table>

    </main>
    <?php include('pie-pagina.php'); ?>
</body>

</html>
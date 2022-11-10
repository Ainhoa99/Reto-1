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
?>
 
<!DOCTYPE html>
<html lang="en">
 
<head>
 
    <head>
        <meta charset="UTF-8">
        <title>Balioztatzeko</title>
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
        <form action="validacion.php" method="post">
 
            <h2>Balioztatzeko</h2>
            <h3>Ezizena</h3>
            <table class="tabla-validar">
                <tr class="definicion-usuario">
                    <th>Izena</th>
                    <th>Abizena</th>
                    <th>Ezizena</th>
                    <th>Emaila</th>
                    <th>Onartu?</th>
                </tr>
                <?php
                $validar = (int) isset($_REQUEST['validado']) ? $_REQUEST['validado'] : null;
                $correo = isset($_REQUEST['correo']) ? $_REQUEST['correo'] : null;
 
                if ($validar == 1) {
                    // Prepara UPDATE
                    $miUpdate = $miPDO->prepare('UPDATE usuarios SET VALIDADO  = 1 WHERE correo = :correo');
                    // Ejecuta UPDATE con los datos
                    $miUpdate->execute(
                        [
                            'correo' => $correo,
                        ]
                    );
                    // Prepara UPDATE
                    // Redireccionamos a Leer
                } else {
                    // Prepara UPDATE
                    $miDelete = $miPDO->prepare('DELETE FROM usuarios WHERE correo = :correo');
                    // Ejecuta UPDATE con los datos
                    $miDelete->execute(
                        [
                            'correo' => $correo,
                        ]
                    );
                }
                //Consulta
                $consulta = $miPDO->prepare("SELECT nombre, apellidos, nickname, correo FROM usuarios WHERE validado=0");
                $consulta->execute();
                $usuarios = $consulta->fetchAll();
                $miUpdate = '';
                foreach ($usuarios as $posicion => $usuario) {
                    $correo = $usuario['correo'];
                    echo "<tr>";
                    echo "<td>" . $usuario['nombre'] . "</td>";
                    echo "<td>" . $usuario['apellidos'] . "</td>";
                    echo "<td>" . $usuario['nickname'] . "</td>";
                    echo "<td class='correo-usu' name= 'correo'>" . $usuario['correo'] . "</td>";
                    echo "<td>";
                    echo "<a class='boton_validacion validar-si' name='check' href='validacion.php?validado=1&correo=" . $usuario['correo'] . "' ><i class='fas fa-check-circle'></i></a> ";
                    echo "<a class='boton_validacion validar-no' name='check' href='validacion.php?validado=0&correo=" . $usuario['correo'] . "' ><i class='fas fa-times-circle'></i></a> ";
                    echo "</td>";
                    echo "</tr>";
                }
                ?>
                <table class="tabla-validar">
                        <tr class="definicion-usuario">
                            <th>Ezizena</th>
                            <th>Iruzkina</th>
                            <th>Onartu?</th>
                        </tr>
                        <?php
                        $validar = (int) isset($_REQUEST['validado']) ? $_REQUEST['validado'] : null;
                        $nickname = isset($_REQUEST['nickname']) ? $_REQUEST['nickname'] : null;
 
                        if ($validar == 1) {
                            // Prepara UPDATE
                            $miUpdate = $miPDO->prepare('UPDATE opiniones SET VALIDADO  = 1 WHERE nickname = :nickname');
                            // Ejecuta UPDATE con los datos
                            $miUpdate->execute(
                                [
                                    'nickname' => $nickname,
                                ]
                            );
                            // Prepara UPDATE
                            // Redireccionamos a Leer
                        } else {
                            // Prepara UPDATE
                            $miDelete = $miPDO->prepare('DELETE FROM opiniones WHERE nickname = :nickname');
                            // Ejecuta UPDATE con los datos
                            $miDelete->execute(
                                [
                                    'nickname' => $nickname,
                                ]
                            );
                        }
                        //Consulta
                        $consulta = $miPDO->prepare("SELECT opinion, nickname FROM opiniones WHERE validado=0");
                        $consulta->execute();
                        $usuarios = $consulta->fetchAll();
                        $miUpdate = '';
                        foreach ($usuarios as $posicion => $usuario) {
                            $correo = $usuario['nickname'];
                            echo "<tr>";
                            echo "<td>" . $usuario['opinion'] . "</td>";
                            echo "<td class='correo-usu' name= 'correo'>" . $usuario['nickname'] . "</td>";
                            echo "<td>";
                            echo "<a class='boton_validacion validar-si' name='check' href='validacion.php?validado=1&nickname=" . $usuario['nickname'] . "' ><i class='fas fa-check-circle'></i></a> ";
                            echo "<a class='boton_validacion validar-no' name='check' href='validacion.php?validado=0&nickname=" . $usuario['nickname'] . "' ><i class='fas fa-times-circle'></i></a> ";
                            echo "</td>";
                            echo "</tr>";
                        }
                        ?>
                        <h3>Iruzkinak</h3>
                    </table>
                    <table class="tabla-validar">
                    <tr class="definicion-usuario">
                        <th>Azala</th>
                        <th>Izenburua</th>
                        <th>Idazlea</th>
                        <th>Sinopsia</th>
                        <th>ISBN</th>
                        <th>Onartu?</th>
                    </tr>
 
                    <?php
                    $isbn = isset($_REQUEST['isbn']) ? $_REQUEST['isbn'] : null;
                    $validar = (int) isset($_REQUEST['validado']) ? $_REQUEST['validado'] : null;
                    if ($validar == 1) {
                        // Prepara UPDATE
                        $miUpdate = $miPDO->prepare('UPDATE libros SET VALIDADO  = 1 WHERE isbn = :isbn');
                        // Ejecuta UPDATE con los datos
                        $miUpdate->execute(
                            [
                                'isbn' => $isbn,
                            ]
                        );
                        // Redireccionamos a Leer
                    } else {
                        $miDelete = $miPDO->prepare('DELETE FROM libros WHERE isbn = :isbn');
                        // Ejecuta UPDATE con los datos
                        $miDelete->execute(
                            [
                                'isbn' => $isbn,
                            ]
                        );
                        //Consulta
                    }
                    $consulta = $miPDO->prepare("SELECT foto, titulo_libro, autor, sinopsis, isbn FROM libros WHERE validado=0");
                    $consulta->execute();
                    $usuarios = $consulta->fetchAll();
                    $miUpdate = '';
                    foreach ($usuarios as $posicion => $usuario) {
                        $isbn = $usuario['isbn'];
                        echo "<tr>";
                        echo "<td> <figure class='img-libro-validado'><img src='src/" . $usuario['foto'] . "'></figure> </td>";
                        echo "<td>" . $usuario['titulo_libro'] . "</td>";
                        echo "<td>" . $usuario['autor'] . "</td>";
                        echo "<td>" . $usuario['sinopsis'] . "</td>";
                        echo "<td class='isbn-libro' name= 'isbn'>" . $usuario['isbn'] . "</td>";
                        echo "<td>";
                        echo "<a class='boton_validacion validar-si' name='check' href='validacion.php?validado=1&isbn=" . $usuario['isbn'] . "' ><i class='fas fa-check-circle'></i></a> ";
                        echo "<a class='boton_validacion validar-no' name='check' href='validacion.php?validado=0&isbn=" . $usuario['isbn'] . "' ><i class='fas fa-times-circle'></i></a> ";
                        echo "</td>";
                        echo "</tr>";
                    }
 
                    ?>
                    <h3>Liburuak</h3>
                    </table>
                    
 
        </form>
    </main>
    <?php include('pie-pagina.php'); ?>
</body>
 
</html>
 

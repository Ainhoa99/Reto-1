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
    <title>Pasahitza Berria</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css">
    <!-- Custom Styles -->
    <link rel="stylesheet" href="css/estilos.css">
    <!-- jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!-- Custom Scripts -->
    <script src="js/scripts.js"></script>
    <!-- <script src="js/scriptValidaciones.js" defer></script> -->
    
</head>

<body>
    <?php include('cabecera.php'); ?>
    <main class="container-nuevo">
        <?php
        // Comprobamos que nos llega los datos del formulario
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            // Variables del formulario
            $contActual = isset($_REQUEST['password']) ? $_REQUEST['password'] : null;
            $contNueva = isset($_REQUEST['password1']) ? $_REQUEST['password1'] : null;
            $contNuevaRepe = isset($_REQUEST['password2']) ? $_REQUEST['password2'] : null;

            // Base de datos.
            $consulta = $miPDO->prepare('SELECT password FROM usuarios WHERE nickname = :nickname');
            $consulta->execute(
                [
                    'nickname' => $_SESSION['nickname'],
                ]
            );
            $usuario = $consulta->fetch();
            if ($usuario['password'] === $contActual) {
                if ($contNueva === $contNuevaRepe) {
                    $consulta = $miPDO->prepare('UPDATE usuarios SET password = :password WHERE nickname = :nickname');
                    $consulta->execute(
                        [
                            'password' => $contNueva,
                            'nickname' => $_SESSION['nickname'],
                        ]
                    );
                    header('Location: perfilpersonal.php');
                    die();
                } else {
                    echo "Las contraseñas no coinciden";
                }
            } else {
                echo "Contraseña incorrecta";
            }
        }
        ?>
        <form class="form-n" id="cambio-contra" action="" method="post">

            <div class="formulario__grupo-input">
                <input type="text" class="formulario__input" name="password" autofocus placeholder="Zure pasahitza">

            </div>
            <div class="formulario__grupo-input">
                <input type="password" class="formulario__input" name="password1" autofocus placeholder="Pasahitza berria">
            </div>
            <div class="formulario__grupo-input">
                <input type="password" class="formulario__input" name="password2" autofocus placeholder="Errepikatu pasahitza">
            </div>
            <button class="form__button" type="submit">Pasahitza aldatu</button>

        </form>
    </main>
    <?php include('pie-pagina.php'); ?>
</body>

</html>
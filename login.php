<?php
include_once "database/conexion.php";
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="estilo/estiloGenerico.css">
    <title>LOGIN</title>
</head>

<body>
    <div class="container">
        <?php
        // Comprobamos que nos llega los datos del formulario
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            // Variables del formulario
            $form_nickname = isset($_REQUEST['nickname']) ? $_REQUEST['nickname'] : null;
            $form_password = isset($_REQUEST['password']) ? $_REQUEST['password'] : null;

            // Base de datos.
            $consulta = $miPDO->prepare('SELECT correo, nickname, password, validado FROM usuarios');
            $consulta->execute();
            $usuarios = $consulta->fetchAll();
            foreach ($usuarios as $posicion => $usuario) {
                $email = $usuario['correo'];
                $nickname = $usuario['nickname'];
                $password = $usuario['password'];
                $validado = $usuario['validado'];

                // Comprobamos si los datos son correctos
                if (($email == $form_nickname || $nickname == $form_nickname) && $form_password == $password && $validado == 1) {
                    // Si son correctos, creamos la sesión
                    session_start();
                    $_SESSION['nickname'] = $_REQUEST['nickname'];
                    $_SESSION['email'] = $_REQUEST['email'];
                    // Redireccionamos a la página segura
                    header('Location: index.php');
                    die();
                }
            }
            echo '<p style="color: red" class="form__text">El email o la contraseña es incorrecta.</p>';
        }
        ?>
        <form class="form" id="login" action="" method="post">
            <img id="logobueno" src="src/Logobueno.png" alt="Logo">

            <div class="formulario__grupo-input">
                <input type="text" class="formulario__input" name="nickname" autofocus placeholder="Email-a edo ezizena">

            </div>
            <div class="formulario__grupo-input">
                <input type="password" class="formulario__input" name="password" autofocus placeholder="Pasahitza">
            </div>
            <button class="form__button" type="submit">Saioa hasi</button>

            <p class="form__text">
                <a class="form__link" href="registro.php" id="linkCreateAccount">Oraindik ez duzu konturik? Sortu bat</a>
            </p>
        </form>
    </div>
</body>

</html>
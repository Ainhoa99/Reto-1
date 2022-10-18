<?php
    include_once "database/conexion.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="estilo/estilo_login_registro.css">
    <script src="script.js"></script>
    <title>REGISTER</title>
</head>
<body>
    <div class="container">
        <?php 
            // Comprobamos que nos llega los datos del formulario
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {

                // Variables del formulario
                $nombre = isset($_REQUEST['nombre']) ? $_REQUEST['nombre'] : null;
                $apellidos = isset($_REQUEST['apellidos']) ? $_REQUEST['apellidos'] : null;
                $correo = isset($_REQUEST['email']) ? $_REQUEST['email'] : null;
                $nickname = isset($_REQUEST['nickname']) ? $_REQUEST['nickname'] : null;

                // Base de datos.
                $consulta = $miPDO ->prepare('INSERT INTO usuarios (nombre, apellidos, correo, nickname) VALUES (:nombre, :apellidos, :correo, :nickname)');
                $consulta ->execute([
                    'nombre' => $nombre,
                    'apellidos' => $apellidos,
                    'correo' => $correo,
                    'nickname' => $nickname

                ]);

                header('Location: login.php');
                die();


            }
        ?>
        <form class="form" id="register" action="" method="post">
            <img id="logobueno" src="src/Logobueno.png" alt="Logo">
            <h1 class="form__title">Register</h1>
            <div id="main">
                <div id="columna1">
                    <div class="form__input-group">
                        <input type="text" class="form__input" name="nombre" id="nombre" size="40" autofocus placeholder="Nombre">
                    </div>
                    <div class="form__input-group">
                        <input type="text" class="form__input" name="apellidos" id="apellidos" size="40" autofocus placeholder="Apellidos">
                    </div>
                    <div class="form__input-group">
                        <input type="text" class="form__input" name="email" id="email" size="40" autofocus placeholder="Email">
                    </div>
                </div>
                <div>
                    <div class="form__input-group">
                        <input type="text" class="form__input" name="nickname" id="nickname" size="40" autofocus placeholder="Nickname">
                    </div>
                    <div class="form__input-group">
                        <input type="password" name="password" class="form__input" id="password" size="40" autofocus placeholder="Password">
                    </div>
                    <div class="form__input-group">
                        <input type="password" class="form__input" id="password2" size="40" autofocus placeholder="Repeat password">
                    </div>
                </div>

            </div>
            
            
            <button class="form__button" type="submit" id="btnRegistro">Sign up</button>
            <p class="form__text">
                <a class="form__link" href="login.php" id="linkCreateAccount">Alredy have an account? Sign in</a>
            </p>
        </form>
    </div>
</body>
</html>
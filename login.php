<?php
    include_once "database/conexion.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="estilo/estilo_general.css">
    <title>LOGIN</title>
</head>
<body>
    <div class="container">
        <?php 
            // Comprobamos que nos llega los datos del formulario
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {

                // Variables del formulario
                $usuarioFormulario = isset($_REQUEST['usuario']) ? $_REQUEST['usuario'] : null;
                $contrasenyaFormulario = isset($_REQUEST['cont']) ? $_REQUEST['cont'] : null;

                // Base de datos.
                $consulta = $miPDO ->prepare('SELECT correo, nickname, password, validado FROM usuarios');
                $consulta ->execute();
                $usuarios = $consulta ->fetchAll();
                foreach($usuarios as $posicion =>$usuario){
                    $correo = $usuario['correo'];
                    $nickname = $usuario['nickname'];
                    $password = $usuario['password'];
                    $validado = $usuario['validado'];

                    // Comprobamos si los datos son correctos
                    if (($correo == $usuarioFormulario || $nickname == $usuarioFormulario) && $contrasenyaFormulario == $password && $validado == 1) {
                        // Si son correctos, creamos la sesión
                        session_start();
                        $_SESSION['correo'] = $_REQUEST['correo'];
                        // Redireccionamos a la página segura
                        header('Location: validacion.php');
                        die();
                    } 
                }
                echo '<p style="color: red" class="form__text">El email o la contraseña es incorrecta.</p>';

            }
        ?>
        <form class="form" id="login" action="" method="post">
            <img id="logobueno" src="src/Logobueno.png" alt="Logo">
            
            <div class="form__input-group">
                <input type="text" class="form__input" name="usuario" autofocus placeholder="Email-a edo ezizena">

            </div>
            <div class="form__input-group">
                <input type="password" class="form__input" name="cont" autofocus placeholder="Pasahitza">
            </div>
            <button class="form__button" type="submit">Login</button>

            <p class="form__text">
                <a class="form__link" href="registro.php" id="linkCreateAccount">You Don't have an account? Create new account</a>
            </p>
        </form>
    </div>
</body>
</html>
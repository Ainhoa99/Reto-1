<?php
include_once "database/conexion.php";
$todo_ok = true;
$vacio = true;
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css">

    <link rel="stylesheet" href="css/estiloGenerico.css">
    <title>Login - IGKLUBA</title>
</head>

<body>
    <main class="container">
        <?php
        // Comprobamos que nos llega los datos del formulario
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            if (($_REQUEST['password'] != "") && ($_REQUEST['nickname'] != "")) {
                // Base de datos.
                $consulta = $miPDO->prepare('SELECT nickname, correo, password, validado, tipo FROM usuarios WHERE nickname = :usuario OR correo = :usuario');
                $consulta->execute(
                    [
                        'usuario' => $_REQUEST['nickname']
                    ]
                );
                $usuario = $consulta->fetch();
                if (!empty($usuario)) {
                    $correo = $usuario['correo'];
                    $nickname = $usuario['nickname'];
                    $validado = $usuario['validado'];

                    // Comprobamos si los datos son correctos
                    if (password_verify($_REQUEST['password'], $usuario['password']) && $validado == 1) {
                        // Si son correctos, creamos la sesión
                        session_start();
                        $_SESSION['nickname'] = $usuario['nickname'];
                        $_SESSION['email'] = $usuario['correo'];
                        $_SESSION['tipo'] = $usuario['tipo'];
                        // Redireccionamos a la página segura
                        header('Location: index.php');
                        die();
                    } else {
                        $todo_ok = false;
                    };
                } else {
                    $todo_ok = false;
                };
            } else {
                $vacio = false;
            }
        }
        ?>
        <form class="form" id="login" action="" method="post">
            <div class="form-caja-logo">
            </div>

            <div class="form-caja-campos">
                <figure class="login-caja-logo">
                    <img class="logobueno" src="src/LOGO.png" alt="Logo">
                </figure>
                <div class="formulario__grupo-input login-usuario">
                    <input type="text" class="formulario__input" name="nickname" autofocus placeholder="Email-a edo ezizena">
                    <i class="far fa-user"></i>
                </div>

                <div class="formulario__grupo-input login-contra">
                    <input type="password" class="formulario__input" name="password" autofocus placeholder="Pasahitza">
                    <i class="fas fa-unlock-alt"></i>
                </div>
                <?php
                if ($todo_ok == false) {
                    echo '<p style="color: red" class="form__text">Email-a edo pasahitza ez dira zuzenak.</p>';
                };
                if ($vacio == false) {
                    echo '<p style="color: red" class="form__text">Datu guztiak bete behar dituzu.</p>';
                }
                ?>

                <div class="formulario__grupo formulario__grupo-btn-enviar">
                    <button class="form__button" type="submit">Saioa hasi</button>
                </div>
                <p class="form__text">
                    <a class="form__link" href="registro.php" id="linkCreateAccount">Oraindik ez duzu konturik? <span>Sortu bat</span></a>
                </p>
            </div>
        </form>
    </main>
</body>

</html>
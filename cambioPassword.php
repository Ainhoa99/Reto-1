<!-- incluimos la conexion a la base de datos -->
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
            $contActual = $_REQUEST['password'];
            $contNueva = $_REQUEST['password1'];
            $contNuevaRepe = $_REQUEST['password2'];

            // Base de datos.
            $consulta = $miPDO->prepare('SELECT password FROM usuarios WHERE nickname = :nickname');
            $consulta->execute(
                [
                    'nickname' => $_SESSION['nickname'],
                ]
            );
            $usuario = $consulta->fetch();
            // Comprobamos que la contraseña sea correcta
            if (password_verify($_REQUEST['password'], $usuario['password'])) {
                if ($contNueva != "" && $contNuevaRepe != "") {
                    if ($contNueva === $contNuevaRepe) {
                        // Cambiamos la contraseña a la contraseña que ha escrito el usuario
                        $consulta = $miPDO->prepare('UPDATE usuarios SET password = :password WHERE nickname = :nickname');
                        $consulta->execute(
                            [
                                'password' => password_hash($_REQUEST['password1'], PASSWORD_DEFAULT),
                                'nickname' => $_SESSION['nickname'],
                            ]
                        );
                        // Si es correcta nos lleva a perfil persona
                        header('Location: perfilpersonal.php');
                        die();
                    } else {
                        // Si no coinciden da error
                        echo "<p style='color:red;margin-top:1rem;font-size:medium'>Pasahitzak berdinak izan behar dira</p>";
                    }
                } else {
                    echo "<p style='color:red;margin-top:1rem;font-size:medium'>Ez duzu ipini beste pasahitz bat</p>";
                }
            } else {
                // Si la contraseña no es correcta nos da error
                echo "<p style='color:red;margin-top:1rem;font-size:medium'>Pasahitz okerra</p>";
            }
        }
        ?>
        <!-- Formulario con los campos -->
        <form class="form-n" id="cambio-contra" action="" method="post">
            <!-- Campo de contraseña -->
            <div class="formulario__grupo-input">
                <input type="text" class="formulario__input" name="password" autofocus placeholder="Zure pasahitza">

            </div>
            <!-- Campo de nueva contraseña -->
            <div class="formulario__grupo-input">
                <input type="password" class="formulario__input" name="password1" autofocus placeholder="Pasahitza berria">
            </div>
            <!-- Campo de nueva contraseña 2-->
            <div class="formulario__grupo-input">
                <input type="password" class="formulario__input" name="password2" autofocus placeholder="Errepikatu pasahitza">
            </div>
            <!-- Boton de cambiar la contraseña -->
            <button class="form__button" type="submit">Pasahitza aldatu</button>

        </form>
    </main>
    <?php include('pie-pagina.php'); ?>
</body>

</html>
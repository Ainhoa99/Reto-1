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
            $nickname = isset($_REQUEST['nickname']) ? $_REQUEST['nickname'] : null;

            $comprobar = $miPDO->prepare('SELECT foto FROM usuarios WHERE nickname = :nickname');
            $comprobar->execute(['nickname' => $nickname]);
            $comprobar = $comprobar->fetch();

            if (empty($comprobar)) {
                $archivo = isset($_FILES['foto']) ? $_FILES['foto'] : null;
                $target_dir = "C:\\xampp\\htdocs\\2DW3\\src\\";
                $target_file = $target_dir . basename($archivo["name"]);
                $uploadOk = 1;
                $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

                //Comprobar si la imagen es una imagen o otro tipo de archivo
                if (isset($_POST["submit"])) {
                    $check = getimagesize($archivo["tmp_name"]);
                    if ($check !== false) {
                        echo "azala - " . $check["foto"] . " da.";
                        $uploadOk = 1;
                    } else {
                        echo "Barkatu, argazkiak bakarrik igo daitezke";
                        $uploadOk = 0;
                    }
                }

                // comprobar si el archivo ya existe en la carpeta
                if (file_exists($target_file)) {
                    echo "azala errepikatuta dago";
                    $uploadOk = 0;
                }

                // comprobar el tamaño de la imagen
                if ($archivo["size"] > 500000) {
                    echo "Barkatu, azalaren argazkia oso handia da.";
                    $uploadOk = 0;
                }

                // comproar que sea un formato valido
                if (
                    $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
                ) {
                    echo "Barkatu, bakarrik JPG, JPEG eta PNG irudiak.";
                    $uploadOk = 0;
                }

                // comprobar si da error o se puede subir
                if ($uploadOk == 0) {
                    echo "Barkatu, azala ezin izan da igo";
                    // al comprobar que todo esta bien se puede hacer la insercion
                } else {
                    if (move_uploaded_file($archivo["tmp_name"], $target_file)) {
                        echo htmlspecialchars(basename($archivo["foto"])) . "azala ondo igo da.";
                    } else {
                        echo "Barkatu, arazo bat egon da azala igotzerakoan.";
                    }
                }

                $foto = isset($_REQUEST['foto']) ? $_REQUEST['foto'] : null;
                // Cambiamos la contraseña a la contraseña que ha escrito el usuario
                $consulta = $miPDO->prepare('UPDATE usuarios SET foto = :foto WHERE nickname = :nickname');
                $consulta->execute(
                    [
                        'foto' => $foto,
                        'nickname' => $_SESSION['nickname'],
                    ]
                );
                // Si es correcta nos lleva a perfil persona
                //header('Location: perfilpersonal.php');
                die();
            }
        }

        ?>
        <!-- Formulario con los campos -->
        <form class="form-n" id="cambio-contra" action="" method="post">
            <!-- Campo de contraseña -->
            <div class="formulario__grupo-input">
                <input type="file" class="formulario__input" name="foto" id="foto" size="40" autofocus placeholder="Argazki pertzonala">
            </div>
            <!-- Boton de cambiar la contraseña -->
            <button class="form__button" type="submit">higo argazkia</button>

        </form>
    </main>
    <?php include('pie-pagina.php'); ?>
</body>

</html>
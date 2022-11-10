<!-- incluimos la conexion a la base de datos -->
<?php
include_once "database/conexion.php";

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
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css">
    <!-- Custom Styles -->
    <link rel="stylesheet" href="css/estilos.css">
    <!-- jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!-- Custom Scripts -->
    <script src="js/scripts.js"></script>
    <!-- <script src="js/scriptValidaciones.js" defer></script> -->
    <title>Liburu berria - IGKLUBA</title>
</head>

<body>
    <?php include('cabecera.php'); ?>
    <main class="container-nuevo">
        <h2>Liburu berria</h2>
        <?php
        // Comprobamos que nos llega los datos del formulario
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Variables del formulario
            $isbn = isset($_REQUEST['isbn']) ? $_REQUEST['isbn'] : null;
            $titulo_libro = isset($_REQUEST['titulo_libro']) ? $_REQUEST['titulo_libro'] : null;
            $autor = isset($_REQUEST['autor']) ? $_REQUEST['autor'] : null;
            $ano_de_libro = isset($_REQUEST['ano_de_libro']) ? $_REQUEST['ano_de_libro'] : null;
            $sinopsis = isset($_REQUEST['sinopsis']) ? $_REQUEST['sinopsis'] : null;
            $formato = isset($_REQUEST['formato']) ? $_REQUEST['formato'] : null;
            $idioma  = isset($_REQUEST['idioma']) ? $_REQUEST['idioma'] : null;
            $link_compra = isset($_REQUEST['link_compra']) ? $_REQUEST['link_compra'] : null;

            // Hacemos la consulta para comprobar si el libro ya esta en la base de datos
            $comprobar = $miPDO->prepare('SELECT id_libro FROM libros WHERE isbn = :isbn');
            $comprobar->execute(['isbn' => $isbn]);
            $comprobar = $comprobar->fetch();
            // Hacemos la comprobaciones para saver si la foto es valida y la podemos insertar 
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

                // Hacemos la insercion en la base de datos 
                $consulta = $miPDO->prepare('INSERT INTO libros (isbn, titulo_libro, foto, autor, ano_de_libro, sinopsis, formato, edadmedia, notamedia, num_lectores, validado, id_idioma)
                                            VALUES (:isbn, :titulo_libro, :foto, :autor, :ano_de_libro, :sinopsis, :formato, :edadmedia, :notamedia, :num_lectores, :validado, :id_idioma)');
                $consulta->execute([
                    'isbn' => $isbn,
                    'titulo_libro' => $titulo_libro,
                    'foto' => basename($archivo["name"]),
                    'autor' => $autor,
                    'ano_de_libro' => $ano_de_libro,
                    'sinopsis' => $sinopsis,
                    'formato' => $formato,
                    'edadmedia' => 0,
                    'notamedia' => 0,
                    'num_lectores' => 0,
                    'validado' => 0,
                    'id_idioma' => $idioma
                ]);

                header('Location: index.php');
                die();
            };
        }
        ?>
        <form class="form-n" id="añadir-libro" action="" method="post" enctype="multipart/form-data">
            <div>
                <div class="fila">
                    <!-- TITULO LIBRO -->
                    <div class="formulario__grupo" id="grupo__apellidos">
                        <div class="formulario__grupo-input">
                            <input type="text" class="formulario__input" name="titulo_libro" id="apellidos" size="40" autofocus placeholder="Liburuaren Izenburua">
                        </div>
                    </div>
                    <!-- ESCRITOR -->
                    <div class="formulario__grupo" id="grupo__nickname">
                        <div class="formulario__grupo-input">
                            <input type="text" class="formulario__input" name="autor" id="nickname" size="40" autofocus placeholder="Idazlea">
                        </div>
                    </div>

                </div>
                <div class="fila">
                    <!-- AÑO DEL LIBRO -->
                    <div class="formulario__grupo" id="grupo__password">
                        <div class="formulario__grupo-input">
                            <input type="year" name="ano_de_libro" class="formulario__input" id="password" size="40" autofocus placeholder="Liburuaren argitaratze data">
                        </div>
                    </div>

                    <!-- NICKNAME -->
                    <div class="formulario__grupo" id="grupo__password">
                        <div class="formulario__grupo-input">
                            <input type="text" name="formato" class="formulario__input" id="password" size="40" autofocus placeholder="Formatua">
                        </div>
                    </div>

                </div>
                <div class="fila">
                    <!-- CONTRASEÑA -->
                    <div class="formulario__grupo-input">
                        <select name="idioma" id="centro">
                            <?php
                            //Consulta
                            $consulta = $miPDO->prepare("SELECT * FROM idiomalibro");
                            $consulta->execute();
                            $idiomas = $consulta->fetchAll();
                            foreach ($idiomas as $posicion => $idioma) {
                                echo "<option value = '" . $idioma['id_idioma'] . "'>" . $idioma['idioma'] . "</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <!-- CONTRASEÑA 2 -->
                    <div class="formulario__grupo" id="grupo__nombre">
                        <div class="formulario__grupo-input">
                            <input type="text" class="formulario__input" name="isbn" id="nombre" size="40" autofocus placeholder="Isbn zembakia">
                        </div>
                    </div>
                </div>
                <div class="fila">

                    <!-- Sinopsis 2 -->
                    <div class="formulario__grupo" id="grupo__password2">
                        <div class="formulario__grupo-input">
                            <textarea type="text" name="sinopsis" class="formulario__input" id="password2" size="40" autofocus placeholder="Sinopsia/laburpena"></textarea>
                        </div>
                    </div>
                </div>
                <div class="fila">
                    <!-- Portada del libro -->
                    <div class="formulario__grupo" id="grupo__email">
                        <div class="formulario__grupo-input">
                            <input type="file" class="formulario__input" name="foto" id="foto" size="40" autofocus placeholder="Liburuaren azala">
                        </div>
                    </div>
                </div>
                <div class="formulario__mensaje" id="formulario__mensaje">
                    <p><i class="fas fa-exclamation-triangle"></i><b>Errorea:</b> Mesedez, bete formularioa behar bezala.</p>
                </div>

                <div class="formulario__grupo formulario__grupo-btn-enviar">
                    <button class="form__button" type="submit" id="btnRegistro">GeHitu Liburua</button>
                    <p class="formulario__mensaje-exito" id="formulario__mensaje-exito">Ondo bidalitako formularioa!</p>
                </div>


        </form>
    </main>
    <?php include('pie-pagina.php'); ?>
</body>

</html>
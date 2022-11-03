<?php
include('database/conexion.php');
// Comprobamos si existe la sesión de apodo
session_start();
if (!isset($_SESSION['nickname'])) {
    // En caso contrario devolvemos a la página login.php
    header('Location: login.php');
    die();
}

$libro = $_GET['liburua'];
// Prepara SELECT
$otraconsulta = $miPDO->prepare('SELECT * FROM libros WHERE id_libro = :id_libro;');

// Ejecuta consulta
$otraconsulta->execute(
    [
        'id_libro' => $libro
    ]
);
$libros = $otraconsulta->fetch();
<<<<<<< HEAD
=======

$id_idioma = $libros['id_idioma'];

$consulta2 = $miPDO->prepare('SELECT idioma FROM idiomalibro WHERE id_idioma = :id_idioma;');
// Ejecuta consulta
$consulta2->execute(
    [
        'id_idioma' => $id_idioma
    ]
);
$idioma = $consulta2->fetch();
>>>>>>> 0e86531d37cca3c66ad8691150afef4664ee1501

?>


<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Argitalpen-data</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Google Fonts -->

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

    <?php include("cabecera.php"); ?>

    <main id="contenido-fichalibro">

        <?php

        echo "<div id='caja-titulo-fichafibro'>";
        //Titulo
        echo "<h2 class='ficha-titulo'>" . $libros['titulo_libro'] . "</h2>";
        //Autor
        echo "<h3 class='ficha-autor'>" . $libros['autor'] . "</h3>";
        echo "</div>";

        echo "<div id='contenedor-todo'>";

        echo "<div id='caja-foto-info'>";
        //Imagen
        echo "<div id='caja-img'>";
        echo "<figure class='ficha-img'><img src='img/" . $libros['foto'] . "'></figure>";
        echo "</div>";

        //Contenedor nota media y edad media
        echo "<div class='caja-contenedor-valoracion'>";

        echo "<div id='contenedor-valoracion'>";
        //Valoración -nota media
        echo "<div class='caja-notamedia'>";
        echo "<p class='ficha-notamedia-text'><i class='fas fa-star'></i><span>" . $libros['notamedia'] . "</span></p>";
        //batez besteko nota
        echo "</div>";

        //Edad media
        echo "<div class='caja-ficha-edadmedia'>";
        echo "<p class='texto-edadmedia'><span>Batez</span> <span>besteko</span> <span>adina</span></p>";
        echo "<p class='ficha-edadmedia'>" . $libros['edadmedia'] . "</p>";
        echo "</div>";
        echo "</div>";
        echo "</div>";
        echo "</div>";

        echo "<div id='caja-info-fichafibro'>";
        echo "<dl id='datos-libro'>";
        //Sinopsis
        echo "<dt class='titulo-sinopsis'>Sinopsia</dt>";
        echo "<dd class='ficha-sinopsis'>" . $libros['sinopsis'] . "</dd>";
        echo "</dl>";

        echo "<div id='caja-fichatecnica'>";

        echo "<div id='btn-fichatecnica'>
                            <p>Fitxa teknikoa</p>";
        echo "</div>";

        //Contenedor ficha tecnica
        echo "<dl id='contenido-fichatecnica' class='ocultar'>";

        //ISBN
        echo "<div class='elemento-fichatecnica'>";
        echo "<dt class='titulo-isbn'>ISBN</dt>";
        echo "<dd class='ficha-isbn'>" . $libros['isbn'] . "</dd>";
        echo "</div>";

        //Año publicacion
        echo "<div class='elemento-fichatecnica'>";
        echo "<dt class='titulo-anyo'>Argitalpen-urtea</dt>";
        echo "<dd class='ficha-anyo'>" . $libros['ano_de_libro'] . "</dd>";
        echo "</div>";

        //Formato
        echo "<div class='elemento-fichatecnica'>";
        echo "<dt class='titulo-formato'>Formatua</dt>";
        echo "<dd class='ficha-formato'>" . $libros['formato'] . "</dd>";
        echo "</div>";

        //Idioma
        echo "<div class='elemento-fichatecnica'>";
        echo "<dt class='titulo-idioma'>Hizkuntza</dt>";
        echo "<dd class='ficha-idioma'>" . $libros['id_idioma'] . "</dd>";
        echo "</div>";

        echo "</dl>";
        echo "</div>";
        echo "</div>";
        echo "</div>";

        ?>


        <div id="btn-valorar">
            <p>Baloratu liburua</p>
        </div>

        <h3 id="titulo-opinion">Irakurleen iritzia</h3>
        <div id="comentarios" class="">
            <?php

            $otraconsulta = $miPDO->prepare('SELECT * FROM opiniones WHERE validado = 1 ORDER BY id_opinion DESC ');

            // Ejecuta consulta
            $otraconsulta->execute();
            $comentarios = $otraconsulta->fetchAll();
            $count = count($comentarios);


            if ($count > 0) {
            ?>
                <div id="comment-count">
                    <span id="count-number"><?php echo ('Liburu hau ' . $count . ' pertsonek iruzkindu dute'); ?></span>
                    <br>
                </div>
            <?php
            }
            foreach ($comentarios as $opinion) {

                //$titulo-libro = $libros['titulo_libro'];
                echo "<br>";
                echo "<div id='comentario'>";

                echo "<p class='opinion' method='get'>" . $opinion['nickname'] . "</p>";
                echo "<p class='opinion' method='get'>" . $opinion['opinion'] . "</p>";
                echo "</div>";
            }

            ?>
        </div>


        <form id="form-opinion" class="ocultar" action="" method="post">

            <div class="nombre-opinion">

            </div>
            <div class="fecha-opinion">
                <?php
                $fechaActual = date('d-m-Y');
                echo "<p class='texto-opinion'>" . $fechaActual . "</p>";
                ?>
            </div>

            <div class="form-input-opinion">

                <?php
                if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                    $opinion = isset($_REQUEST['opinion']) ? $_REQUEST['opinion'] : null;
<<<<<<< HEAD

                    $consulta = $miPDO->prepare('INSERT INTO opiniones ( nickname , opinion, validado, id_libro)
                VALUES ( :nickname, :opinion, :validado, :id_libro)');
                    $consulta->execute([
                        'nickname' => $_SESSION['nickname'],
                        'opinion' => $opinion,
                        'validado' => 0,
                        'id_libro' => $libros['id_libro']
                    ]);
                }
                ?>

                <div class="row">
                    <label> Ezizena: </label><?php echo $_SESSION['nickname']; ?>
                </div>
                <textarea class="form__input" name="opinion" id="opinion" size="40" autofocus placeholder="Iritzia"></textarea>
                <button>iruzkindu</button>
=======

                    $consulta = $miPDO->prepare('INSERT INTO opiniones (nickname , opinion, validado, id_libro)
                    VALUES (:nickname, :opinion, :validado, :id_libro)');
                    $consulta->execute(
                        [
                            'nickname' => $_SESSION['nickname'],
                            'opinion' => $opinion,
                            'validado' => 0,
                            'id_libro' => $libro
                        ]
                    );
                }

                ?>
                <div class="row">
                    <label> Ezizena: </label><?php echo $_SESSION['nickname']; ?>
                </div>
                <div class="row">
                    <label for="mesg"> Iritzia :</label>
                    <br>
                    <textarea class="form__input" name="opinion" id="opinion" size="40" autofocus placeholder="Iritzia"></textarea>
                    <button>iruzkindu</button>
                </div>



>>>>>>> 0e86531d37cca3c66ad8691150afef4664ee1501
            </div>

        </form>
        <div id="btn-opinion">
            <p>Eman zure iritzia</p>
        </div>

    </main>

    <?php include('pie-pagina.php'); ?>

</body>

</html>
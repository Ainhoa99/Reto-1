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
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>IGKLUBA</title>
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
    <?php include('funcionLibros.php'); ?>

    <style>
        * {
            box-sizing: border-box;
        }

        #foto {
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem;
        }

        /* Slideshow container */
        .slideshow-container {
            max-width: 100%;
            position: relative;
            margin: auto;
            background-color: #bbb;
        }

        /* Hide the images by default */
        .mySlides {
            display: flex;
            justify-content: center;
        }

        /* Next & previous buttons */
        .prev,
        .next {
            cursor: pointer;
            position: absolute;
            top: 50%;
            width: auto;
            margin-top: -22px;
            padding: 16px;
            color: orangered;
            font-weight: bold;
            font-size: 18px;
            transition: 0.6s ease;
            border-radius: 0 3px 3px 0;
            user-select: none;
            background-color: #717171;


        }

        /* Position the "next button" to the right */
        .next {
            right: 0;
            border-radius: 3px 0 0 3px;
        }

        /* On hover, add a black background color with a little bit see-through */
        .prev:hover,
        .next:hover {
            background-color: rgba(0, 0, 0, 0.8);
        }

        /* Caption text */
        .text {
            color: orange;
            font-size: 15px;
            position: absolute;
            bottom: 0px;
            width: 100%;
            text-align: center;
            background-color: #717171;
            display: flex;
            justify-content: center;
        }

        /* Number text (1/3 etc) */
        .numbertext {
            color: orangered;
            font-size: 2rem;
            padding: 3rem;
            background-color: #717171;
            padding: 8px 12px;
            position: absolute;
            top: 0;
            margin-right: 1420px;
        }

        /* The dots/bullets/indicators */
        .dot {
            cursor: pointer;
            height: 15px;
            width: 15px;
            margin: 0 2px;
            background-color: #bbb;
            border-radius: 50%;
            display: inline-block;
            transition: background-color 0.6s ease;
        }

        .active,
        .dot:hover {
            background-color: #717171;
        }

        /* Fading animation */
        .fade {
            animation-name: fade;
            animation-duration: 1.5s;
        }

        @keyframes fade {
            from {
                opacity: 0.4;
            }

            to {
                opacity: 1;
            }
        }
    </style>
    <!-- Slideshow container -->
    <div class="slideshow-container">
        <!-- Full-width images with number and caption text -->
        <div class="mySlides fade">
            <?php
            // Prepara SELECT
            $otraconsulta = $miPDO->prepare('SELECT foto, id_libro FROM libros ORDER BY notamedia DESC LIMIT 3');

            // Ejecuta consulta
            $otraconsulta->execute();
            $libros = $otraconsulta->fetchAll();
            ?>
            <div class="numbertext">1 / 3</div>
            <?php
            foreach ($libros as $libro) {
            ?>
                <a id='foto' href='fichalibro.php?liburua= <?php echo $libro['id_libro'] ?>'><img src='src/<?php echo $libro['foto'] ?>' style=" width: 50%"></a>
            <?php
            }
            ?>
            <div class="text">
                <p>VALORAZIO ONENA DUTEN LIBURUAK</p>
            </div>

        </div>

        <div class="mySlides fade">
            <?php
            // Prepara SELECT
            $otraconsulta = $miPDO->prepare('SELECT foto, id_libro FROM libros ORDER BY id_libro DESC LIMIT 3');

            // Ejecuta consulta
            $otraconsulta->execute();
            $libros = $otraconsulta->fetchAll();
            ?>
            <div class="numbertext">2 / 3</div>
            <?php
            foreach ($libros as $libro) {
            ?>

                <a id='foto' href='fichalibro.php?liburua= <?php echo $libro['id_libro'] ?>'><img src='src/<?php echo $libro['foto'] ?>' style=" width: 50%"></a> <?php
                                                                                                                                                                }
                                                                                                                                                                    ?>
            <div class="text">
                <p>LIBURU BERRIENAK</p>
            </div>

        </div>


        <div class="mySlides fade">
            <?php
            // Prepara SELECT
            $otraconsulta = $miPDO->prepare('SELECT foto, id_libro FROM libros ORDER BY num_lectores DESC LIMIT 3');

            // Ejecuta consulta
            $otraconsulta->execute();
            $libros = $otraconsulta->fetchAll();
            ?>
            <div class="numbertext">3 / 3</div>
            <?php
            foreach ($libros as $libro) {
            ?>
                <a id='foto' href='fichalibro.php?liburua= <?php echo $libro['id_libro'] ?>'><img src='src/<?php echo $libro['foto'] ?>' style=" width: 44%"></a>
            <?php
            }
            ?>
            <div class="text">
                <p>GEIEN IRAKURRI DirEN LIBURUAK</p>
            </div>

        </div>

        <!-- Next and previous buttons -->
        <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
        <a class="next" onclick="plusSlides(1)">&#10095;</a>
    </div>
    <br />


    <script>
        let slideIndex = 1;
        showSlides(slideIndex);

        // Next/previous controls
        function plusSlides(n) {
            showSlides((slideIndex += n));
        }

        // Thumbnail image controls
        function currentSlide(n) {
            showSlides((slideIndex = n));
        }

        function showSlides(n) {
            let i;
            let slides = document.getElementsByClassName("mySlides");
            let dots = document.getElementsByClassName("dot");
            if (n > slides.length) {
                slideIndex = 1;
            }
            if (n < 1) {
                slideIndex = slides.length;
            }
            for (i = 0; i < slides.length; i++) {
                slides[i].style.display = "none";
            }
            for (i = 0; i < dots.length; i++) {
                dots[i].className = dots[i].className.replace(" active", "");
            }
            slides[slideIndex - 1].style.display = "flex";
            dots[slideIndex - 1].className += " active";
        }
    </script>

    <main id="contenido">

        <?php
        $busqueda = '';
        $busqueda = isset($_REQUEST['busqueda']) ? $_REQUEST['busqueda'] : null;


        if ($busqueda === '' || $busqueda === null) {
            $consulta = $miPDO->prepare('SELECT * FROM libros;');

            // Ejecuta consulta
            $consulta->execute();

            $respuesta = $consulta->fetchAll();
            // funcion de cargar libros
            anadirlibros($respuesta);
        } else {
            // Variables del formulario
            $respuesta = $miPDO->prepare("SELECT * FROM libros WHERE autor LIKE '%$busqueda%' oR titulo_libro LIKE '%$busqueda%'");
            $respuesta->execute();
            $respuesta = $respuesta->fetchAll();

            //texto de informacion de la busqueda
            if ($respuesta) {
                $contador = count($respuesta);
                echo ("<div id='textobusqueda'>
                <p>(<strong>" . $contador . "</strong>) aurkipen daude (<strong>" . $busqueda . "</strong>) libururekin erlazionatuta. 
                </p></div>"
                );
                echo ('<div id = "contenedorLibros">' . anadirlibros($respuesta) . '</div>');
            } else {
                echo 'NO EXISTE NINGUN LIBRO CON ESTE AUTOR O TITULO';
            }
            // foreach($respuesta as $posicion =>$libros): 

        }

        ?>


    </main>

    <?php include('pie-pagina.php'); ?>

</body>

</html>
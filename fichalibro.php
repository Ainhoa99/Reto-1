<?php include('database/conexion.php');?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Ficha libro</title>
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

            //echo $titulo-libro;
        ?>
        
        
        
         <?php 
        
            // Prepara SELECT
            $otraconsulta = $miPDO->prepare('SELECT * FROM libros WHERE id_libro="9788420674209";');
    
            // Ejecuta consulta
            $otraconsulta->execute();

                $registro = $otraconsulta ->fetchAll();

                    foreach($registro as $posicion =>$libros){
                    
                        echo "<div id='caja-titulo-fichafibro'>";
                        //Titulo
                        echo "<h2 class='ficha-titulo'>" . $libros['titulo_libro'] . "</h2>";
                    
                        //Autor
                        echo "<h3 class='ficha-autor'>" . $libros['autor'] . "</h3>";
                         echo "</div>";
                        
                        
                        echo "<div id='caja-foto-info'>";
                        //Imagen
                        echo "<div id='caja-img'>";
                        echo "<figure class='ficha-img'><img src='img/" . $libros['foto'] . "'></figure>";
                        echo "</div>";
                        
                        
                         echo "<div id='caja-info-fichafibro'>";
                        echo "<dl id='datos-libro'>";
                        //Sinopsis
                        echo "<dt class='titulo-sinopsis'>Sinopsia</dt>";
                        echo "<dd class='ficha-sinopsis'>" . $libros['sinopsis'] . "</dd>";
                        echo "</dl>";
                    
                        echo "<div id='caja-fichatecnica'>";
                        
                        echo "<div id='btn-fichatecnica'>
                            <p>Fitxa teknikoa</p></div>";
                        
                        //Contenedor ficha tecnica
                        echo "<dl id='contenido-fichatecnica' class='ocultar'>";
                        
                        //ISBN
                        echo "<dt class='titulo-isbn'>ISBN</dt>";
                        echo "<dd class='ficha-isbn'>" . $libros['id_libro'] . "</dd>";
                        
                        
                        //Año publicacion
                        echo "<dt class='titulo-anyo'>Argitalpen-urtea</dt>";
                        echo "<dd class='ficha-anyo'>" . $libros['año_de_libro'] . "</dd>";
                        
                        
                        //Formato
                        echo "<dt class='titulo-formato'>Formatua</dt>";
                        echo "<dd class='ficha-formato'>" . $libros['formato'] . "</dd>";
                        
                        //Idioma
                        echo "<dt class='titulo-idioma'>Hizkuntza</dt>";
                        echo "<dd class='ficha-idioma'>" . $libros['idioma'] . "</dd>";
                        
                        //Valoración
                        echo "<div class='caja-notamedia'>";
                        echo "<p class='ficha-notamedia-text'>Batez besteko nota</p>";
                        echo "<p class='ficha-notamedia'>" . $libros['notamedia'] . "</p>";
                        echo "</div>";                        
                        //Edad media
                        echo "<p class='ficha-edadmedia'> Batez besteko adina: " . $libros['edadmedia'] . "</p>";
                    echo "</dl>";
                        echo "</div>";
                        echo "</div>";
                        echo "</div>";
                       
                }
                    
                  ?>

        
           <div id="btn-valorar">
               <p>Baloratu liburua</p>
           </div>
           
            <h3 id="titulo-opinion">Irakurleen iritzia</h3>
            <div id="comentarios" class="">
               <p>Ez dago iruzkinik, lehena izan zure iritzia ematen</p>
            </div>
            <div id="btn-opinion">
               <p>Eman zure iritzia</p>
            </div>
        
        
    </main>
    
     <?php include('pie-pagina.php'); ?>
    
</body>

</html>
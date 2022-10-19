<?php include('database/conexion.php');?>
    
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

    <main id="contenido">
        
            <?php 
        
            // Prepara SELECT
            $consulta = $miPDO->prepare('SELECT * FROM libros;');
    
            // Ejecuta consulta
            $consulta->execute();

                $respuesta = $consulta ->fetchAll();
               // foreach($respuesta as $posicion =>$libros):   
            ?>
              
                       <?php 
                    foreach($respuesta as $posicion =>$libros){
                    echo "<div id='libro'>";
                    
                        //Imagen
                        echo "<figure class='img-libro'><img src='img/" . $libros['foto'] . "'></figure>";
                    
                            
                        echo "<div class='caja-info-libro'>";
                        //Titulo
                        echo "<p class='libro-titulo'>" . $libros['titulo_libro'] . "</p>";
                    
                        //Autor
                        echo "<p class='libro-autor'>" . $libros['autor'] . "</p>";
                        
                        //Valoración
                        echo "<div class='caja-notamedia'>";
                        echo "<p class='libro-notamedia-text'> Nota media</p>";
                        echo "<p class='libro-notamedia'>" . $libros['notamedia'] . "</p>";
                        echo "</div>";                        
                        //Edad media
                        echo "<p class='libro-edad-media'> Edad media: " . $libros['edadmedia'] . "</p>";

                        //Enlace a la ficha
                        echo "<p class='enlace-ficha'><a href='fichalibro.php'>Ver ficha</a></p>";
                        echo "</div>";
                    echo "</div>";
                }
                    
                  ?>  

        
    </main>
    
    <?php include('pie-pagina.php'); ?>
   
</body>

</html>

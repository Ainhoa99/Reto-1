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
            
            include('database/conexion.php');
        
            // Prepara SELECT
            $consulta = $miPDO->prepare('SELECT * FROM libros;');
    
            // Ejecuta consulta
            $consulta->execute();

                $respuesta = $consulta ->fetchAll();
                foreach($respuesta as $posicion =>$libros):   
                
            ?>

            <div id="contenedor-libros">
                <div id="libro">
                    <figure class="img-libro"> 
                        <img src="<?= $libros['foto']; ?>" alt="">
                    </figure>
                    <p id="libro-titulo"><?= $libros['titulo_libro']; ?></p>
                    <p id="libro-autor"><?= $libros['autor']; ?></p>
                    <p class="enlace-ficha"><a href="fichalibro.php">Ver ficha del libro</a></p>
                </div>
            </div>
           
            <?php endforeach; ?>
        
    </main>
    
    <?php include('pie-pagina.php'); ?>
   
</body>

</html>

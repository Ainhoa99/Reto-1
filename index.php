<?php include('database/conexion.php'); ?>
<?php
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

    <main id="contenido">

    <?php
    $busqueda = isset($_REQUEST['busqueda']) ? $_REQUEST['busqueda'] : null;
    
    if($busqueda === '' || $busqueda === null){

        $consulta = $miPDO->prepare('SELECT * FROM libros;');

        // Ejecuta consulta
        $consulta->execute();

        $respuesta = $consulta->fetchAll();
        // foreach($respuesta as $posicion =>$libros): 
        anadirlibros($respuesta);
        
        }else{
       // Variables del formulario
        $respuesta = $miPDO->prepare("SELECT * FROM libros WHERE autor LIKE '%$busqueda%' OR titulo_libro LIKE  '%$busqueda%'");
        $respuesta->execute();
        $respuesta = $respuesta->fetchAll();
        // Prepara SELECT
        $consulta = $miPDO->prepare('SELECT * FROM libros;');

        // Ejecuta consulta
        $consulta->execute();

        $respuesta = $consulta->fetchAll();
        // foreach($respuesta as $posicion =>$libros): 
        anadirlibros($respuesta);

    }
 
    ?>


    </main>

    <?php include('pie-pagina.php'); ?>

</body>

</html>
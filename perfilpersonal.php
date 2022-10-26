<?php
include('database/conexion.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/estilos.css">
    <title>FichaAlumno</title>
</head>

<body>
    <?php include('cabecera.php'); ?>
    <main id="contenido">
        <?php
        session_start();

        $nickname = $_SESSION['nickname'];
        // Prepara SELECT
        $consulta = $miPDO->prepare('SELECT * FROM usuarios where nickname = :nickname');

        // Ejecuta consulta
        $consulta->execute([
            'nickname' => $nickname,
        ]);

        $respuesta = $consulta->fetch();
        // foreach($respuesta as $posicion =>$libros):  

        ?>
        <div id='container'>

            <div id="foto">
                <figure class='foto'><img src='img/<?php echo ($respuesta['foto']) ?>'></figure>
                <input type='file' id='foto' style='display: none'>
            </div>

            <div id='foto-nombre-apellido'>

                <div class='caja-info-usuario'>

                    <p class='nombre' method='get'><?php echo ($respuesta['nombre']) ?></p>
                    <input type='text' id='nombre' style='display: none'>

                    <p class='apellidos'><?php echo ($respuesta['apellidos']) ?></p>
                    <input type='text' id='apellidos' style='display: none'>

                    <p class='nickname'><?php echo ($respuesta['nickname']) ?></p>
                    <input type='text' id='nickname' style='display: none'>

                    <p class='correo'><?php echo ($respuesta['correo']) ?></p>
                    <input type='text' id='correo' style='display: none'>

                </div>
            </div>

            <div id='info'>

                <p></p>
                <span><?php echo ($respuesta['id_centro']) ?></span>


                <p class='fecha_nacimiento'><?php echo ($respuesta['fecha_nacimiento']) ?></p>
                <input type='date' id='fecha_nacimiento' style='display: none'>

                <p class='movil'><?php echo ($respuesta['movil']) ?></p>
                <input type='text' id='movil' style='display: none'>

                <p class='nivel'></p>
                <span><?php echo ($respuesta['nivel']) ?></span>


                <p class='enlace-ficha'><a href='fichalibro.php'>Fitxa ikusi</a></p>
                <link href="perfilpersonal.php" id="btneditar" class="datuak aldatu">
            </div>
        </div>

    </main>
    <?php
    include('pie-pagina.php');
    ?>
</body>

</html>
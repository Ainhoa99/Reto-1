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
        $centro = $respuesta['id_centro'];
        $consulta2 = $miPDO->prepare('SELECT nombre_centro FROM centro WHERE id_centro = :id_centro');
        $consulta2->execute(
            [
                'id_centro' => $centro,
            ]
        );
        $respuesta2 = $consulta2->fetch();
        ?>
        <div id='container'>
            <div class="container2">
                <div id="foto">
                    <figure class='foto'><img src='img/<?php echo ($respuesta['foto']) ?>'></figure>
                    <input type='file' id='foto' style='display: none'>
                </div>

                <div id='foto-nombre-apellido'>

                    <div class='caja-info-usuario'>

                        <h3>Izena</h3>
                        <p class='nombre' method='get'><?php echo ($respuesta['nombre']) ?></p>
                        <input type='text' id='nombre' style='display: none'>

                        <h3>Abizena</h3>
                        <p class='apellidos'><?php echo ($respuesta['apellidos']) ?></p>
                        <input type='text' id='apellidos' style='display: none'>

                        <h3>Ezizena</h3>
                        <p class='nickname'><?php echo ($respuesta['nickname']) ?></p>
                        <input type='text' id='nickname' style='display: none'>

                        <h3>Emaila</h3>
                        <p class='correo'><?php echo ($respuesta['correo']) ?></p>
                        <input type='text' id='correo' style='display: none'>

                    </div>
                </div>

                <div id='info'>

                    <h3>Eskola</h3>
                    <span><?php echo ($respuesta2['nombre_centro']) ?></span>

                    <h3>Jahiotze data</h3>
                    <p class='fecha_nacimiento'><?php echo ($respuesta['fecha_nacimiento']) ?></p>
                    <input type='date' id='fecha_nacimiento' style='display: none'>

                    <h3>Mugikorra</h3>
                    <p class='movil'><?php echo ($respuesta['movil']) ?></p>
                    <input type='text' id='movil' style='display: none'>

                    <h3>Maila</h3>
                    <p class='nivel'></p>
                    <span><?php echo ($respuesta['nivel']) ?></span>


                    <p class='enlace-ficha'><a href='fichalibro.php'>Fitxa ikusi</a></p>
                    <link href="perfilpersonal.php" id="btneditar" class="datuak aldatu">
                </div>
            </div>
            <button class="editar">Aldatu pasahitza</button>
        </div>

    </main>

    <?php
    include('pie-pagina.php');
    ?>
</body>

</html>
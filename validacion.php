<?php
include_once "database/conexion.php";
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="estilo/estiloGeneral.css">
    <title>Validaciones</title>
</head>

<body>
    <form action="validacion.php" method="post">
        <div class="container" id="validacion">
            <h1>VALIDACIONES</h1>
            <table>
                <tr>
                    <th>NOMBRE</th>
                    <th>APELLIDOS</th>
                    <th>NICKNAME</th>
                    <th>CORREO</th>
                    <th>¿ACEPTAR?</th>
                </tr>
                <?php
                $validar = (int) isset($_REQUEST['validado']) ? $_REQUEST['validado'] : null;
                $correo = isset($_REQUEST['correo']) ? $_REQUEST['correo'] : null;
                if ($validar == 1) {
                    // Prepara UPDATE
                    $miUpdate = $miPDO->prepare('UPDATE usuarios SET VALIDADO  = 1 WHERE correo = :correo');
                    // Ejecuta UPDATE con los datos
                    $miUpdate->execute(
                        [
                            'correo' => $correo,
                        ]
                    );
                    // Redireccionamos a Leer
                } else{
                    // Prepara UPDATE
                    $miDelete = $miPDO->prepare('DELETE FROM usuarios WHERE correo = :correo');
                    // Ejecuta UPDATE con los datos
                    $miDelete->execute(
                        [
                            'correo' => $correo,
                        ]
                    );
                }
                //Consulta
                $consulta = $miPDO->prepare("SELECT nombre, apellidos, nickname, correo FROM usuarios WHERE validado=0");
                $consulta->execute();
                $usuarios = $consulta->fetchAll();
                $miUpdate = '';
                foreach ($usuarios as $posicion => $usuario) {
                    $correo = $usuario['correo'];
                    echo "<tr>";
                    echo "<td>" . $usuario['nombre'] . "</td>";
                    echo "<td>" . $usuario['apellidos'] . "</td>";
                    echo "<td>" . $usuario['nickname'] . "</td>";
                    echo "<td name= 'correo'>" . $usuario['correo'] . "</td>";
                    echo "<td>";
                    echo "<a class='boton_validacion' name='check' href='validacion.php?validado=1&correo=" . $usuario['correo'] . "' >Si</a> ";
                    echo "<a class='boton_validacion' name='check' href='validacion.php?validado=0&correo=" . $usuario['correo'] . "' >No</a> ";
                    echo "</td>";
                    echo "</tr>";
                }

                ?>
                <tr>
                    <a href="index.php" class='boton_validacion'><i ></i>Volver a la pagina principal</a></li>
                </tr>
            </table>
        </div>
    
    </form>
    

</body>

</html>
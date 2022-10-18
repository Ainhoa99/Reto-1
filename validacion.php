<?php
    include_once "database/conexion.php";
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="estilo/estilo.css">
    <title>Validaciones</title>
</head>
<body>
    <header>
        <h1>VALIDACIONES</h1>
    </header>
    <form action="" method=""></form>
    <table>
        <tr>
            <th>NOMBRE</th>
            <th>APELLIDOS</th>
            <th>NICKNAME</th>
            <th>CORREOs</th>
            <th>¿VALIDAR?</th>
        </tr>
        <?php
            //Consulta
            $consulta = $miPDO ->prepare("SELECT nombre, apellidos, nickname, correo FROM usuarios WHERE VALIDADO=0");
            $consulta ->execute();
            $usuarios = $consulta ->fetchAll();
            $miUpdate = '';
            foreach($usuarios as $posicion =>$usuario){
                $correo=$usuario['correo'];
                echo "<tr>";
                    echo "<td>" . $usuario['nombre'] . "</td>";
                    echo "<td>" . $usuario['apellidos'] . "</td>";
                    echo "<td>" . $usuario['nickname'] . "</td>";
                    echo "<td name= 'correo'>" . $usuario['correo'] . "</td>";
                    echo "<td>";
                    echo "<input type='button' class='boton_validacion' id='" . $usuario['correo'] . "' name='check' value='Sí'> ";
                    echo "</td>";
                echo "</tr>";
                // Comprobamso si recibimos datos por POST
                if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                    // Prepara UPDATE
                    $miUpdate = $miPDO->prepare('UPDATE usuarios SET VALIDADO  = 1 WHERE correo = :correo');
                    // Ejecuta UPDATE con los datos
                    $miUpdate->execute(
                        [
                            'correo' => $correo,
                        ]
                    );
                    // Redireccionamos a Leer
                    header('Location: login.php');
                } 

                            
                            
            }
            
        ?>


        
    </table>
    
</body>
</html>
<?php
include_once('database/conexion.php');
?>
 
<!DOCTYPE html>
<html lang="en">
 
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="estilo/estiloGeneral.css">
    <title>Añadir nuevo profesor</title>
</head>
 
<body>
    <div class="container">
    <?php 
            // Comprobamos que nos llega los datos del formulario
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                // Variables del formulario
                $nombre = isset($_REQUEST['nombre']) ? $_REQUEST['nombre'] : null;
                $apellidos = isset($_REQUEST['apellidos']) ? $_REQUEST['apellidos'] : null;
                $correo = isset($_REQUEST['email']) ? $_REQUEST['email'] : null;
                $nickname = isset($_REQUEST['nickname']) ? $_REQUEST['nickname'] : null;
                $password = isset($_REQUEST['password']) ? $_REQUEST['password'] : null;
                $centro = isset($_REQUEST['centro']) ? $_REQUEST['centro'] : null;
                $fecha = isset($_REQUEST['fecha']) ? $_REQUEST['fecha'] : null;
                

                // Base de datos.
                $consulta = $miPDO ->prepare('INSERT INTO usuarios (nombre, apellidos, correo, nickname, id_centro, fecha_nacimiento, tipo, validado, password, curso)
                                            VALUES (:nombre, :apellidos, :correo, :nickname, :id_centro, :fecha_nacimiento, :tipo, :validado, :password, :curso)');
                $consulta ->execute([
                    'nombre' => $nombre,
                    'apellidos' => $apellidos,
                    'correo' => $correo,
                    'nickname' => $nickname,
                    'id_centro' => $centro,
                    'fecha_nacimiento' => $fecha,
                    'tipo' => 'Profesor',
                    'validado' => 1,
                    'password' => $password,
                    'curso' => '2022-2023'

                ]);

                header('Location: login.php');
                die();


            }
        ?>
        <form class="form" id="register" action="" method="post">
            <img id="logobueno" src="src/Logobueno.png" alt="Logo">
            <div id="main">
                <div id="columna1">
                    <div class="form__input-group">
                        <input type="text" class="form__input" name="nombre" id="nombre" size="40" autofocus placeholder="Nombre">
                    </div>
                    <div class="form__input-group">
                        <input type="text" class="form__input" name="apellidos" id="apellidos" size="40" autofocus placeholder="Apellidos">
                    </div>
                    <div class="form__input-group">
                        <input type="text" class="form__input" name="email" id="email" size="40" autofocus placeholder="Email">
                    </div>
                    <div class="form__input-group">
                        <input type="text" name="fecha" class="form__input" id="fecha" size="40" autofocus placeholder="Fecha de nacimiento" onfocus="(this.type='date')">
                    </div>
                </div>
                <div>
                    <div class="form__input-group">
                        <input type="text" class="form__input" name="nickname" id="nickname" size="40" autofocus placeholder="Nickname">
                    </div>
                    <div class="form__input-group">
                        <input type="password" name="password" class="form__input" id="password" size="40" autofocus placeholder="Password">
                    </div>
                    <div class="form__input-group">
                        <input type="password" class="form__input" id="password2" size="40" autofocus placeholder="Repeat password">
                    </div>
                    <div class="form__input-group">
                        <select name="centro" id="centro">
                            <?php
                                //Consulta
                                $consulta = $miPDO ->prepare("SELECT * FROM centro");
                                $consulta ->execute();
                                $centros = $consulta ->fetchAll();
                                foreach($centros as $posicion =>$centro){
                                    echo "<option value = '" . $centro['id_centro'] . "'>" . $centro['nombre_centro'] . "</option>";
                                }
                            ?>
                        </select>
                    </div>
                </div>

            </div>
            
            
            <button class="form__button" type="submit" id="btnRegistro">Crear profesor</button>
           
        </form>
    </div>
</body>
 
</html>

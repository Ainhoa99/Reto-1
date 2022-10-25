<?php
    include_once "database/conexion.php";
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="estilo/estiloGenerico.css">
    <script src="js/scriptValidaciones.js" defer></script>
    <title>REGISTER</title>
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
                $password2 = isset($_REQUEST['password2']) ? $_REQUEST['password2'] : null;
                $centro = isset($_REQUEST['centro']) ? $_REQUEST['centro'] : null;
                $fecha = isset($_REQUEST['fecha']) ? $_REQUEST['fecha'] : null;
                $nivel = isset($_REQUEST['nivel']) ? $_REQUEST['nivel'] : null;
    
                $comprobar = $miPDO->prepare('SELECT nickname FROM usuarios WHERE nickname = :nickname');
                $comprobar->execute(['nickname' => $nickname]);
                $comprobar = $comprobar->fetch();
    
                if (empty($comprobar)) {
                   // Base de datos.
                    $consulta = $miPDO->prepare('INSERT INTO usuarios (nombre, apellidos, correo, nickname, id_centro, fecha_nacimiento, tipo, validado, password, nivel, curso)
                                            VALUES (:nombre, :apellidos, :correo, :nickname, :id_centro, :fecha_nacimiento, :tipo, :validado, :password, :nivel, :curso)');
                    $consulta->execute([
                        'nombre' => $nombre,
                        'apellidos' => $apellidos,
                        'correo' => $correo,
                        'nickname' => $nickname,
                        'id_centro' => $centro,
                        'fecha_nacimiento' => $fecha,
                        'tipo' => 'Alumno',
                        'validado' => 0,
                        'password' => $password,
                        'nivel' => $nivel,
                        'curso' => '2022-2023'

                    ]);

                    header('Location: login.php');
                    die();
                    
                } else {
                    echo '<div><p style="color: red" class="form__text">Badago erabiltzaile bat ezizen honekin</p></div>';
                };
            }
        ?>
        <form class="form" id="register" action="" method="post">
            <img id="logobueno" src="src/Logobueno.png" alt="Logo">
            <div id="main">
                <div class="fila">
                    <!-- NOMRBRE -->
                    <div class="formulario__grupo" id="grupo__nombre">
                        <div class="formulario__grupo-input">
                            <input type="text" class="formulario__input" name="nombre" id="nombre" size="40" autofocus placeholder="Nombre">
                        </div>
                        <p class="formulario__input-error">El nombre tiene que ser de 3 a 16 dígitos y solo puede contener letras, empezando siempre por mayúscula.</p>
                    </div>   
                    <!-- APELLIDOS -->
                    <div class="formulario__grupo" id="grupo__apellidos">
                        <div class="formulario__grupo-input">
                            <input type="text" class="formulario__input" name="apellidos" id="apellidos" size="40" autofocus placeholder="Apellidos">
                        </div>
                            <p class="formulario__input-error">El apellido tiene que ser de 3 a 16 dígitos y solo puede contener letras, empezando siempre por mayúscula.</p>
                    </div>   
                </div>
                <div class="fila">
                    <!-- CORREO -->
                    <div class="formulario__grupo" id="grupo__email">
                        <div class="formulario__grupo-input">
                            <input type="text" class="formulario__input" name="email" id="email" size="40" autofocus placeholder="Email">
                        </div>
                        <p class="formulario__input-error">El correo solo puede contener letras, numeros, puntos, guiones y guion bajo.</p>
                    </div>
                    <!-- NICKNAME -->
                    <div class="formulario__grupo" id="grupo__nickname">
                        <div class="formulario__grupo-input">
                            <input type="text" class="formulario__input" name="nickname" id="nickname" size="40" autofocus placeholder="Nickname">
                        </div>
                        <p class="formulario__input-error">El usuario tiene que ser de 4 a 16 dígitos y solo puede contener numeros, letras y guion bajo.</p>
                    </div>
                </div>
                <div class="fila">
                    <!-- CONTRASEÑA -->
                    <div class="formulario__grupo" id="grupo__password">
                        <div class="formulario__grupo-input">
                            <input type="password" name="password" class="formulario__input" id="password" size="40" autofocus placeholder="Password">
                        </div>
                        <p class="formulario__input-error">La contraseña tiene que ser de 4 a 12 dígitos.</p>
                    </div>
                    <!-- CONTRASEÑA 2 -->
                    <div class="formulario__grupo" id="grupo__password2">
                        <div class="formulario__grupo-input">
                            <input type="password" class="formulario__input" id="password2" size="40" autofocus placeholder="Repeat password">
                        </div>
                        <p class="formulario__input-error">Ambas contraseñas deben ser iguales.</p>
                    </div>
                </div> 
                
                <div class="formulario__grupo" id="grupo__fecha">
                    <!-- FECHA_NACIMIENTO -->
                    <div class="formulario__grupo-input">
                        <input type="text" name="fecha" class="formulario__input" id="fecha" size="40" autofocus placeholder="Fecha de nacimiento" onfocus="(this.type='date')">
                    </div>
                </div>

                
                <div class="fila">
                    <div class="formulario__grupo-input">
                    <span>Curso:</span>
                    <select name="nivel" id="nivel">
                        <option value="DBH1">DBH 1</option>
                        <option value="DBH2">DBH 2</option>
                        <option value="DBH3">DBH 3</option>
                        <option value="DBH4">DBH 4</option>
                    </select>
                </div>
                <div class="formulario__grupo-input">
                    <span>Centro:</span>
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
            <div class="formulario__mensaje" id="formulario__mensaje">
				<p><i class="fas fa-exclamation-triangle"></i><b>Error:</b> Por favor rellena el formulario correctamente.</p>
			</div>

            <div class="formulario__grupo formulario__grupo-btn-enviar">
                <button class="form__button" type="submit" id="btnRegistro">Sign up</button>
				<p class="formulario__mensaje-exito" id="formulario__mensaje-exito">Formulario enviado exitosamente!</p>
			</div>

            <p class="form__text">
                <a class="form__link" href="login.php" id="linkCreateAccount">Alredy have an account? Sign in</a>
            </p>
            
        </form>
    </div>
</body>
</html>
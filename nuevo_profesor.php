<?php
include_once "database/conexion.php";
?>

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
    <title>Nuevo profesor</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css">

    <!-- Custom Styles -->
    <link rel="stylesheet" href="css/estilos.css">

    <!-- jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <!-- Custom Scripts -->
    <script src="js/scriptValidaciones.js" defer></script>
    <script src="js/scripts.js"></script>
</head>



</head>

<body>
    <?php include('cabecera.php'); ?>
    <main class="container-nuevo">
        <h2>Gehitu irakaslea</h2>
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
            $movil = isset($_REQUEST['movil']) ? $_REQUEST['movil'] : null;
            $fecha = isset($_REQUEST['fecha']) ? $_REQUEST['fecha'] : null;
            $nivel = isset($_REQUEST['nivel']) ? $_REQUEST['nivel'] : null;

            $comprobar = $miPDO->prepare('SELECT nickname FROM usuarios WHERE nickname = :nickname');
            $comprobar->execute(['nickname' => $nickname]);
            $comprobar = $comprobar->fetch();

            if (empty($comprobar)) {
                // Base de datos.
                $consulta = $miPDO->prepare('INSERT INTO usuarios (nombre, apellidos, correo, nickname, id_centro, fecha_nacimiento, tipo, validado, movil, password, curso)
                                            VALUES (:nombre, :apellidos, :correo, :nickname, :id_centro, :fecha_nacimiento, :tipo, :validado, :movil, :password, :curso)');
                $consulta->execute([
                    'nombre' => $nombre,
                    'apellidos' => $apellidos,
                    'correo' => $correo,
                    'nickname' => $nickname,
                    'id_centro' => $centro,
                    'fecha_nacimiento' => $fecha,
                    'tipo' => 'Profesor',
                    'validado' => 1,
                    'movil' => $movil,
                    'password' => password_hash($password, PASSWORD_DEFAULT),
                    'curso' => '2022-2023'

                ]);

                header('Location: login.php');
                die();
            } else {
                echo '<div><p style="color: red" class="form__text">Badago erabiltzaile bat ezizen honekin</p></div>';
            };
        }
        ?>
        <form class="form-n" id="register" action="" method="post">

            <div>
                <div class="fila">
                    <!-- NOMRBRE -->
                    <div class="formulario__grupo" id="grupo__nombre">
                        <div class="formulario__grupo-input">
                            <input type="text" class="formulario__input" name="nombre" id="nombre" size="40" autofocus placeholder="Izena">
                        </div>
                        <p class="formulario__input-error">Izenak 3 eta 16 digitu artekoa izan behar du, eta letrak bakarrik eduki ditzake, beti letra larriz hasita.</p>
                    </div>
                    <!-- APELLIDOS -->
                    <div class="formulario__grupo" id="grupo__apellidos">
                        <div class="formulario__grupo-input">
                            <input type="text" class="formulario__input" name="apellidos" id="apellidos" size="40" autofocus placeholder="Abizenak">
                        </div>
                        <p class="formulario__input-error">Abizenak 3 eta 16 digitu artekoa izan behar du, eta letrak bakarrik eduki ditzake, beti letra larriz hasita.</p>
                    </div>
                </div>

                <div class="fila">
                    <!-- CORREO -->
                    <div class="formulario__grupo" id="grupo__email">
                        <div class="formulario__grupo-input">
                            <input type="text" class="formulario__input" name="email" id="email" size="40" autofocus placeholder="Email-a">
                        </div>
                        <p class="formulario__input-error">Email-a letrak, zenbakiak, puntuak, gidoiak eta gidoi baxua baino ezin ditu izan.</p>
                    </div>
                    <!-- NICKNAME -->
                    <div class="formulario__grupo" id="grupo__nickname">
                        <div class="formulario__grupo-input">
                            <input type="text" class="formulario__input" name="nickname" id="nickname" size="40" autofocus placeholder="Ezizena">
                        </div>
                        <p class="formulario__input-error">Ezizena 4-16 digitu izan behar ditu, eta zenbakiak, letrak eta gidoi baxua baino ezin ditu izan.</p>
                    </div>
                </div>

                <div class="fila">
                    <!-- CONTRASEÑA -->
                    <div class="formulario__grupo" id="grupo__password">
                        <div class="formulario__grupo-input">
                            <input type="password" name="password" class="formulario__input" id="password" size="40" autofocus placeholder="Pasahitza">
                        </div>
                        <p class="formulario__input-error">Pasahitzak 4 eta 12 digitu artekoa izan behar du.</p>
                    </div>
                    <!-- CONTRASEÑA 2 -->
                    <div class="formulario__grupo" id="grupo__password2">
                        <div class="formulario__grupo-input">
                            <input type="password" class="formulario__input" id="password2" size="40" autofocus placeholder="Errepikatu pasahitza">
                        </div>
                        <p class="formulario__input-error">Pasahitzak berdinak izan behar dira.</p>
                    </div>
                </div>

                <div class="formulario__grupo" id="grupo__fecha">
                    <!-- FECHA_NACIMIENTO -->
                    <div class="formulario__grupo-input">
                        <input type="text" name="fecha" class="formulario__input" id="fecha" size="40" autofocus placeholder="Jaiotze-data" onfocus="(this.type='date')">
                    </div>
                    <!-- NUMERO TELEFONO -->
                    <div class="formulario__grupo-input">
                        <input type="text" name="movil" class="formulario__input" id="movil" size="40" autofocus placeholder="Mugikor zembakia">
                    </div>
                </div>

                <div class="formulario__grupo-input">
                    <span>Ikastetxea:</span>
                    <select name="centro" id="centro">
                        <?php
                        //Consulta
                        $consulta = $miPDO->prepare("SELECT * FROM centro");
                        $consulta->execute();
                        $centros = $consulta->fetchAll();
                        foreach ($centros as $posicion => $centro) {
                            echo "<option value = '" . $centro['id_centro'] . "'>" . $centro['nombre_centro'] . "</option>";
                        }
                        ?>
                    </select>
                </div>

            </div>
            <div class="formulario__mensaje" id="formulario__mensaje">
                <p><i class="fas fa-exclamation-triangle"></i> <b>Errorea:</b> Mesedez, bete formularioa behar bezala.</p>
            </div>

            <div class="formulario__grupo formulario__grupo-btn-enviar">
                <button class="form__button" type="submit" id="btnRegistro">Irakaslea sortu</button>
                <p class="formulario__mensaje-exito" id="formulario__mensaje-exito">Ondo bidalitako formularioa!</p>
            </div>


        </form>
    </main>
    <?php include('pie-pagina.php'); ?>
</body>

</html>
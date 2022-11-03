<?php
include_once "database/conexion.php";
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/estiloGenerico.css">
    <!-- <script src="js/scriptValidaciones.js" defer></script> -->
    <title>AÑADIRLIBRO</title>
</head>

<body>
    <div class="container">
        <?php
        // Comprobamos que nos llega los datos del formulario
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Variables del formulario
            $isbn = isset($_REQUEST['isbn']) ? $_REQUEST['isbn'] : null;
            $titulo_libro = isset($_REQUEST['titulo_libro']) ? $_REQUEST['titulo_libro'] : null;
            $foto = isset($_FILES['foto']) ? $_FILES['foto'] : null;
            $autor = isset($_REQUEST['autor']) ? $_REQUEST['autor'] : null;
            $ano_de_libro = isset($_REQUEST['ano_de_libro']) ? $_REQUEST['ano_de_libro'] : null;
            $sinopsis = isset($_REQUEST['sinopsis']) ? $_REQUEST['sinopsis'] : null;
            $formato = isset($_REQUEST['formato']) ? $_REQUEST['formato'] : null;
            $idioma  = isset($_REQUEST['idioma']) ? $_REQUEST['idioma'] : null;
            $link_compra = isset($_REQUEST['link_compra']) ? $_REQUEST['link_compra'] : null;

            $comprobar = $miPDO->prepare('SELECT id_libro FROM libros WHERE isbn = :isbn');
            $comprobar->execute(['isbn' => $isbn]);
            $comprobar = $comprobar->fetch();

            if (empty($comprobar)) {
                // Base de datos.
                $consulta = $miPDO->prepare('INSERT INTO libros (isbn, titulo_libro, foto, autor, ano_de_libro, sinopsis, formato, edadmedia, notamedia, num_lectores, id_idioma, link_compra)
                                            VALUES (:isbn, :titulo_libro, :foto, :autor, :ano_de_libro, :sinopsis, :formato, :edadmedia, :notamedia, :num_lectores, :id_idioma, :link_compra)');
                $consulta->execute([
                    'isbn' => $isbn,
                    'titulo_libro' => $titulo_libro,
                    'foto' => 'default.jpg',
                    'autor' => $autor,
                    'ano_de_libro' => $ano_de_libro,
                    'sinopsis' => $sinopsis,
                    'formato' => $formato,
                    'edadmedia' => 0,
                    'notamedia' => 0,
                    'num_lectores' => 0,
                    'id_idioma' => $idioma,
                    'link_compra' => $link_compra

                ]);

                header('Location: index.php');
                die();
            } else {
                echo '<div><p style="color: red" class="form__text">Liburu hau web orrian dago jada.</p></div>';
            };
        }
        ?>
        <form class="form" id="register" action="" method="post">
            <img id="logobueno" src="src/Logobueno.png" alt="Logo">
            <div id="main">
                <div class="fila">
                    <!-- NOMRBRE -->
                    <div class="formulario__grupo" id="grupo__apellidos">
                        <div class="formulario__grupo-input">
                            <input type="text" class="formulario__input" name="titulo_libro" id="apellidos" size="40" autofocus placeholder="Liburuaren Izenburua">
                        </div>
                        <p class="formulario__input-error">Abizenak 3 eta 16 digitu artekoa izan behar du, eta letrak bakarrik eduki ditzake, beti letra larriz hasita.</p>
                    </div>
                    <!-- APELLIDOS -->
                    <div class="formulario__grupo" id="grupo__nickname">
                        <div class="formulario__grupo-input">
                            <input type="text" class="formulario__input" name="autor" id="nickname" size="40" autofocus placeholder="Idazlea">
                        </div>
                        <p class="formulario__input-error">Ezizena 4-16 digitu izan behar ditu, eta zenbakiak, letrak eta gidoi baxua baino ezin ditu izan.</p>
                    </div>

                </div>
                <div class="fila">
                    <!-- CORREO -->
                    <div class="formulario__grupo" id="grupo__password">
                        <div class="formulario__grupo-input">
                            <input type="text" name="ano_de_libro" class="formulario__input" id="password" size="40" autofocus placeholder="Liburuaren argitaratze data">
                        </div>
                        <p class="formulario__input-error">Pasahitzak 4 eta 12 digitu artekoa izan behar du.</p>
                    </div>

                    <!-- NICKNAME -->
                    <div class="formulario__grupo" id="grupo__password">
                        <div class="formulario__grupo-input">
                            <input type="text" name="formato" class="formulario__input" id="password" size="40" autofocus placeholder="Formatua">
                        </div>
                        <p class="formulario__input-error">Pasahitzak 4 eta 12 digitu artekoa izan behar du.</p>
                    </div>

                </div>
                <div class="fila">
                    <!-- CONTRASEÑA -->
                    <div class="formulario__grupo-input">
                        <span>Hizkuntza:</span>
                        <select name="idioma" id="centro">
                            <?php
                            //Consulta
                            $consulta = $miPDO->prepare("SELECT * FROM idiomalibro");
                            $consulta->execute();
                            $idiomas = $consulta->fetchAll();
                            foreach ($idiomas as $posicion => $idioma) {
                                echo "<option value = '" . $idioma['id_idioma'] . "'>" . $idioma['idioma'] . "</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <!-- CONTRASEÑA 2 -->
                    <div class="formulario__grupo" id="grupo__nombre">
                        <div class="formulario__grupo-input">
                            <input type="text" class="formulario__input" name="isbn" id="nombre" size="40" autofocus placeholder="Isbn zembakia">
                        </div>
                        <p class="formulario__input-error">Izenak 3 eta 16 digitu artekoa izan behar du, eta letrak bakarrik eduki ditzake, beti letra larriz hasita.</p>
                    </div>
                </div>
                <div class="fila">
                    <!-- CONTRASEÑA -->

                    <!-- CONTRASEÑA 2 -->
                    <div class="formulario__grupo" id="grupo__password2">
                        <div class="formulario__grupo-input">
                            <textarea type="text" name="sinopsis" class="formulario__input" id="password2" size="40" autofocus placeholder="sinopsia/laburpena"></textarea>
                        </div>
                        <p class="formulario__input-error">Pasahitzak berdinak izan behar dira.</p>
                    </div>
                </div>
                <div class="fila">
                    <!-- CONTRASEÑA -->
                    <div class="formulario__grupo" id="grupo__password2">
                        <div class="formulario__grupo-input">
                            <input type="text" name="link_compra" class="formulario__input" id="password2" size="40" autofocus placeholder="Erosteko linka">
                        </div>
                        <p class="formulario__input-error">Pasahitzak berdinak izan behar dira.</p>
                    </div>
                    <!-- CONTRASEÑA 2 -->
                    <!-- <div class="formulario__grupo" id="grupo__email">
                        <div class="formulario__grupo-input">
                            <input type="file" class="formulario__input" name="foto" id="foto" size="40" autofocus placeholder="Liburuaren azala">
                        </div>
                        <p class="formulario__input-error">Email-a letrak, zenbakiak, puntuak, gidoiak eta gidoi baxua baino ezin ditu izan.</p>
                    </div> -->
                </div>
                <div class="formulario__mensaje" id="formulario__mensaje">
                    <p><i class="fas fa-exclamation-triangle"></i><b>Errorea:</b> Mesedez, bete formularioa behar bezala.</p>
                </div>

                <div class="formulario__grupo formulario__grupo-btn-enviar">
                    <button class="form__button" type="submit" id="btnRegistro">Erregistratu</button>
                    <p class="formulario__mensaje-exito" id="formulario__mensaje-exito">Ondo bidalitako formularioa!</p>
                </div>

                <p class="form__text">
                    <a class="form__link" href="login.php" id="linkCreateAccount">Baduzu kontu bat? Saioa hasi</a>
                </p>

        </form>
    </div>
</body>

</html>
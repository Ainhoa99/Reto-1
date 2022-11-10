<?php
// Incluimos la conexion con la base de datos
include('database/conexion.php');
// habrimos la sesion para para poder conseguir los datos de nota y edad
session_start();
// comprobamos si los campos estan bacios, si no lo estan hacemos la consulta
if ($_GET['nota'] != "" && $_GET['idioma'] != "" && $_GET['edad'] != "") {
    $consulta = $miPDO->prepare('INSERT INTO valoraciones (nota , edad, nickname, id_libro, id_idioma)
                    VALUES (:nota, :edad, :nickname, :id_libro, :id_idioma)');
    $consulta->execute(
        [
            'nota' => $_GET['nota'],
            'edad' => $_GET['edad'],
            'nickname' => $_SESSION['nickname'],
            'id_libro' => $_GET['libro'],
            'id_idioma' => $_GET['idioma']
        ]
    );
    // Hacemos la consulta para conseguir la edad media, la nota media y contamos los lectors 
    $consulta2 = $miPDO->prepare('SELECT AVG(edad) AS "edad", AVG(nota) AS "nota", COUNT(id_valoracion) AS "lectores" FROM valoraciones WHERE id_libro = :id_libro');
    $consulta2->execute(
        [
            'id_libro' => $_GET['libro']
        ]
    );
    // hacemos el update con los datos de los libros con las medias y la cantidad de lectores
    $consulta2 = $consulta2->fetch();
    $actualizar = $miPDO->prepare('UPDATE libros SET edadmedia = :edad, notamedia = :nota, num_lectores = :lectores WHERE id_libro = :id_libro');
    $actualizar->execute(
        [
            'id_libro' => $_GET['libro'],
            'edad' => $consulta2['edad'],
            'nota' => $consulta2['nota'],
            'lectores' => $consulta2['lectores'],
        ]
    );
}
//llevamos al usuario a el apartado de ficha de libor opinada
header('Location: fichalibro.php?liburua=' . $_GET['libro']);

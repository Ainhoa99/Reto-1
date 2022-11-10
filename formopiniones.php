<?php
// Incluimos la conexion con la base de datos
include('database/conexion.php');
session_start();

// Cuando el nombre no esta vacio hacemos el insert de opiniones
if ($_GET['opinion'] != "") {
    $consulta = $miPDO->prepare('INSERT INTO opiniones (nickname , opinion, validado, id_libro)
                    VALUES (:nickname, :opinion, :validado, :id_libro)');
    if ($_SESSION['tipo'] == 'Alumno') {
        $consulta->execute(
            [
                'nickname' => $_SESSION['nickname'],
                'opinion' => $_GET['opinion'],
                'validado' => 0,
                'id_libro' => $_GET['libro']
            ]
        );
    } else {
        // Cuando el nombre esta vacio hacemos el insert de todas las opiniones
        $consulta->execute(
            [
                'nickname' => $_SESSION['nickname'],
                'opinion' => $_GET['opinion'],
                'validado' => 1,
                'id_libro' => $_GET['libro']
            ]
        );
    }
}
//llevamos al usuario a el apartado de ficha de libor opinada
header('Location: fichalibro.php?liburua=' . $_GET['libro']);

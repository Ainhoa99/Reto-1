<?php
// Incluimos la conexion con la base de datos
include('database/conexion.php');
session_start();

// Cuando el nombre no esta vacio hacemos el insert de clase
if ($_GET['nombre'] != "") {
    $consulta = $miPDO->prepare('INSERT INTO clase (fecha_limite, nivel)
                    VALUES (:fecha_limite, :nivel)');
    $consulta->execute(
        [
            'fecha_limite' => $_GET['fecha'],
            'nivel' => $_GET['nombre']
        ]
    );
}
//llevamos al usuario a el apartado de mis clases
header('Location: mis_clases.php');

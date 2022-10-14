<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AñadirProfesor</title>
    <style>
        body {
            background-color: wheat;

        }
    </style>
</head>

<body>
    <form>
        <h3>Idatzi irakaslearen datuak</h3>
        <p>Izena</p>
        <input type="text" id="nombre" name="campo">
        <p>Abizena</p>
        <input type="text" id="Abizena" name="campo">
        <p>Ezizena</p>
        <input type="text" id="Ezizena" name="campo">
        <p>Irudia</p>
        <input type="text" id="Irudia" name="campo">
        <p>Pasahitza</p>
        <input type="text" id="Pasahitza" name="campo">
        <p>Escola</p>
        <input type="text" id="Escola" name="campo">
        <p>Gmaila</p>
        <input type="email" id="Gmaila" name="campo">
        <p>Maila</p>
        <select name="curso" id="curso">
            <option value="DBH1">DBH1</option>
            <option value="DBH2">DBH2</option>
            <option value="DBH3">DBH3</option>
            <option value="DBH4">DBH4</option>
        </select>
        <p>mugikorra</p>
        <input type="numbre" maxlength="9" id="mugikorra" name="campo">
        <button type="submit" id="boton" name="enviar">
    </form>

    <?php
    //conexion a bbdd
    $hostDB = "localhost";
    $nombreDb = "IGKLUBA";
    $usuarioDB = "root";
    $contrasenaDB = "";

    $hostPDO = "mysql:host=$hostDB;dbname=$nombreDb;";
    $miPDO = new PDO($hostDB, $usuarioDB, $contrasenaDB);
    ?>

    <?php
    // Comprobamso si recibimos datos por POST
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Recogemos variables
        $nombre = isset($_REQUEST['Nombre']) ? $_REQUEST['Nombre'] : null;
        $apellidos = isset($_REQUEST['Apellidos']) ? $_REQUEST['Apellidos'] : null;
        $correo = isset($_REQUEST['Correo']) ? $_REQUEST['Correo'] : null;
        $foto = isset($_REQUEST['Foto ']) ? $_REQUEST['Foto '] : null;
        $centro = isset($_REQUEST['Centro']) ? $_REQUEST['Centro'] : null;
        $telefono = isset($_REQUEST['movil']) ? $_REQUEST['movil'] : null;
        $contraseña = isset($_REQUEST['Contraseña']) ? $_REQUEST['Contraseña'] : null;
        $nivel = isset($_REQUEST['NIVEL']) ? $_REQUEST['NIVEL'] : null;
        $tipo = isset('Profesor') ? 'Profesor' : null;

        // Variables
        $hostDB = '127.0.0.1';
        $nombreDB = 'IGKLUBA';
        $usuarioDB = 'root';
        $contrasenyaDB = '';
        // Conecta con base de datos
        $hostPDO = "mysql:host=$hostDB;dbname=$nombreDB;";
        $miPDO = new PDO($hostPDO, $usuarioDB, $contrasenyaDB);
        // Prepara INSERT
        $miInsert = $miPDO->prepare('INSERT INTO IGKLUBA (Nombre, Apellidos, Correo, Foto, Centro, movil, Contraseña, NIVEL,Tipo) 
                                     VALUES (:nombre, :apellidos, :correo, :foto, :centro, :telefono, :contraseña, :nivel, :tipo )');
        // Ejecuta INSERT con los datos
        $miInsert->execute(
            array(
                'Nombre' => $nombre,
                'Apellidos' => $apellidos,
                'Correo' => $correo,
                'Foto' => $foto,
                'Centro' => $centro,
                'movil' => $telefono,
                'Contraseña' => $contraseña,
                'NIVEL' => $nivel,
                'Tipo' => $tipo
            )
        );
        // Redireccionamos a Leer
        header('Location: leer.php');
    }
    ?>

</body>

</html>
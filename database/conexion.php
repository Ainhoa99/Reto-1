<?php
//Variables
$hostDB = 'localhost';
$nombreDB = 'igkluba';
$usuarioDB = 'root';
$contrasenyaDB = 'admin';

//Conecta con base de datos
$hostPDO = "mysql:host=$hostDB;dbname=$nombreDB;";
$miPDO = new PDO($hostPDO, $usuarioDB, $contrasenyaDB);

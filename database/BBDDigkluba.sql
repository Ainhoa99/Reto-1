drop database if exists igkluba;
create database igkluba default character set utf8 default collate utf8_general_ci;
use igkluba;
    CREATE TABLE centro (
    id_centro Varchar(20) NOT NULL PRIMARY KEY,
    nombre_centro Varchar(30)
);
    CREATE TABLE usuarios (
    nombre Varchar(20) NOT NULL,
    apellidos Varchar(30) NOT NULL,
    correo Varchar(30) NOT NULL ,
    nickname Varchar(30) NOT NULL PRIMARY KEY,
    foto varchar(15),
    centro Varchar(20),
    fecha_nacimiento DATE,
    tipo ENUM('Alumno','Profesor', 'Administrador') NOT NULL,
    validado BOOLEAN NOT NULL,
    movil char(9), 
    contraseña Varchar(25) NOT NULL,
    nivel ENUM('DBH1','DBH2', 'DBH3', 'DBH4') NOT NULL,
    curso INT(8),
    FOREIGN KEY  (`centro`) references `centro`(`id_centro`)
);  
CREATE TABLE idiomalibro (
    idioma Varchar(15) NOT NULL PRIMARY Key
);
CREATE TABLE libros (
    id_libro  Varchar(20) NOT NULL ,
    titulo_libro  Varchar(20) NOT NULL PRIMARY KEY,
    foto varchar(15) NOT NULL,
    autor varchar(100) NOT NULL,
    año_de_libro  Varchar(20) NOT NULL,  
    sinopsis Varchar(2300) NOT NULL,
    formato varchar(15) NOT NULL,
    edadmedia INT(2) NOT NULL,
    notamedia INT(2) NOT NULL,
    num_lectores INT(4) NOT NULL,
    idioma Varchar(15) NOT NULL,
    link_compra varchar(100),
    FOREIGN KEY  (`idioma`) references `idiomalibro`(`idioma`)
); 
CREATE TABLE valoraciones (
    id_valoracion Varchar(20) NOT NULL PRIMARY KEY,
    nota Varchar(30) NOT NULL,
    edad int(2),
    nickname Varchar(30) NOT NULL,
    titulo_libro  Varchar(20) NOT NULL,
    idioma Varchar(15) NOT NULL,
    FOREIGN KEY  (`nickname`) references `usuarios`(`nickname`),
    FOREIGN KEY  (`titulo_libro`) references `libros`(`titulo_libro`),
    FOREIGN KEY  (`idioma`) references `idiomalibro`(`idioma`)
);
CREATE TABLE opiniones (
    id_opinion Varchar(20) NOT NULL PRIMARY KEY, 
    nickname Varchar(30) NOT NULL,
    edad int(2),
    FOREIGN KEY  (`nickname`) references `usuarios`(`nickname`)
);

CREATE TABLE peticiondelibro (
    titulo_libro  Varchar(20) NOT NULL,
    estado ENUM('Aceptada','Espera', 'Denegada'),
    nickname Varchar(30) NOT NULL,
    edad int(2),
    id_peticion Varchar(20) NOT NULL PRIMARY KEY,
    FOREIGN KEY  (`titulo_libro`) references `libros`(`titulo_libro`),
    FOREIGN KEY  (`nickname`) references `usuarios`(`nickname`)
);
CREATE TABLE clase (
    fecha_limite Date NOT NULL,
    nickname Varchar(30) NOT NULL,
    codigo INT(4) NOT NULL AUTO_INCREMENT PRIMARY KEY, 
    FOREIGN KEY  (`nickname`) references `usuarios`(`nickname`)
);
CREATE TABLE listadeclases (
    codigo INT(4) NOT NULL AUTO_INCREMENT,
    nickname Varchar(30) NOT NULL, 
    FOREIGN KEY  (`codigo`) references `Clase`(`codigo`),
    FOREIGN KEY (`nickname`) references `Usuarios`(`nickname`)
);

Create Database IGKLUBA;
    use IGKLUBA;
    CREATE TABLE Usuarios (
    Nombre Varchar(20) NOT NULL,
    Apellidos Varchar(30) NOT NULL,
    Correo Varchar(30) NOT NULL PRIMARY KEY,
    Nickname Varchar(30) NOT NULL,
    Foto varchar(15),
    Centro varchar(20) NOT NULL,
    Fecha_Nacimiento DATE,
    TIPO ENUM('Alumno','Profesor', 'Administrador') NOT NULL,
    VALIDADO BOOLEAN NOT NULL,
    movil char(9), 
    Contraseña Varchar(30) NOT NULL,

);
  CREATE TABLE Valoraciones (
    ID_Valoracion Varchar(20) NOT NULL PRIMARY KEY,
    Nota Varchar(30) NOT NULL,
    Edad INT(4) NOT NULL,
    Idioma Varchar(15) NOT NULL
);
CREATE TABLE Opiniones (
    ID_Opinion Varchar(20) NOT NULL PRIMARY KEY, 
    Nombre Varchar(30) NOT NULL,
    Edad INT(4) NOT NULL
);
CREATE TABLE Libros (
    ID_Libro  Varchar(20) NOT NULL PRIMARY KEY,
    Nombre  Varchar(20) NOT NULL,
    Foto varchar(15) NOT NULL,
    Autor varchar(100) NOT NULL,
    AñoDeLibro  Varchar(20) NOT NULL,  
    Sinopsis Varchar(30) NOT NULL,
    Formato varchar(15) NOT NULL,
    EdadMedia INT(2) NOT NULL,
    NotaMedia INT(2) NOT NULL,
    Num_Lectores INT(4) NOT NULL,
    Idioma ENUM('Gaztelania','Euskara', 'Ingelesa')
); 
CREATE TABLE ListaDeClases (
    ID_Clase Varchar(20) NOT NULL PRIMARY KEY, 
    Nombre Varchar(30) NOT NULL
);
CREATE TABLE Clase (
    ID_Clase Varchar(20) NOT NULL PRIMARY KEY,
    FechaLimite Date NOT NULL,
    Codigo INT(4) NOT NULL, 
    Nombre Varchar(30) NOT NULL
);
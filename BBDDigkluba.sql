Create Database IGKLUBA;
    use IGKLUBA;
    CREATE TABLE Usuarios (
    Nombre Varchar(20) NOT NULL,
    Apellidos Varchar(30) NOT NULL,
    Correo Varchar(30) NOT NULL PRIMARY KEY,
    Nickname Varchar(30) NOT NULL,
    TIPO ENUM('Alumno','Profesor', 'Administrador'),
    VALIDADO BOOLEAN,
    Contraseña Varchar(30) NOT NULL
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
    AñoDeLibro  Varchar(20) NOT NULL,  
    Sinopsis Varchar(30) NOT NULL,
    EdadMedia INT(2) NOT NULL,
    NotaMedia INT(2) NOT NULL,
    Idioma Varchar(15) NOT NULL
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
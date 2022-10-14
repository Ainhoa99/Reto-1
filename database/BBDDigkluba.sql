Create Database IGKLUBA;
    use IGKLUBA;
    CREATE TABLE Centro (
    ID_Centro Varchar(20) NOT NULL PRIMARY KEY,
    NombreCentro Varchar(30)
);
    CREATE TABLE Usuarios (
    Nombre Varchar(20) NOT NULL,
    Apellidos Varchar(30) NOT NULL,
    Correo Varchar(30) NOT NULL PRIMARY KEY,
    Nickname Varchar(30) NOT NULL,
    Foto varchar(15),
    Centro Varchar(20),
    FOREIGN KEY  (Centro) references Centro(ID_Centro),
    Fecha_Nacimiento DATE,
    Tipo ENUM('Alumno','Profesor', 'Administrador') NOT NULL,
    Validado BOOLEAN NOT NULL,
    Movil char(9), 
    Contraseña Varchar(25) NOT NULL,
    Nivel ENUM('DBH1','DBH2', 'DBH3', 'DBH4') NOT NULL,
    Curso YEAR
);  
CREATE TABLE IdiomaLibro (
    Idioma Varchar(15) NOT NULL PRIMARY Key
);
CREATE TABLE Libros (
    ID_Libro  Varchar(20) NOT NULL PRIMARY KEY,
    Titulo_libro  Varchar(20) NOT NULL,
    Foto varchar(15) NOT NULL,
    Autor varchar(100) NOT NULL,
    AñoDeLibro  Varchar(20) NOT NULL,  
    Sinopsis Varchar(2300) NOT NULL,
    Formato varchar(15) NOT NULL,
    EdadMedia INT(2) NOT NULL,
    NotaMedia INT(2) NOT NULL,
    Num_Lectores INT(4) NOT NULL,
    Idioma Varchar(15) NOT NULL,
     FOREIGN KEY  (Idioma) references IdiomaLibro(Idioma)
); 
CREATE TABLE Valoraciones (
    ID_Valoracion Varchar(20) NOT NULL PRIMARY KEY,
    Nota Varchar(30) NOT NULL,
    Edad INT(4) NOT NULL,
    Nickname Varchar(30) NOT NULL,
     FOREIGN KEY  (Nickname) references Usuarios(Nickname),
    Titulo_libro  Varchar(20) NOT NULL,
     FOREIGN KEY  (Titulo_libro) references Libros(Titulo_libro),
    Idioma Varchar(15) NOT NULL,
     FOREIGN KEY  (Idioma) references IdiomaLibro(Idioma)
);
CREATE TABLE Opiniones (
    ID_Opinion Varchar(20) NOT NULL PRIMARY KEY, 
    Nombre Varchar(30) NOT NULL,
     FOREIGN KEY  (Nombre) references Usuarios(Nombre),
    Fecha_Nacimiento DATE,
     FOREIGN KEY  (Fecha_Nacimiento) references Usuarios(Fecha_Nacimiento)
);

CREATE TABLE PeticionDeLibro (
    Titulo_libro  Varchar(20) NOT NULL,
     FOREIGN KEY  (Titulo_libro) references Libros(Titulo_libro),
    ID_Peticion Varchar(20) NOT NULL PRIMARY KEY,
    Fecha_Nacimiento DATE,
     FOREIGN KEY  (Fecha_Nacimiento) references Usuarios(Fecha_Nacimiento),
    Estado ENUM('Aceptada','EnEspera', 'Denegada'),
    Nickname Varchar(30) NOT NULL,
    FOREIGN KEY  (Nickname) references Usuarios(Nickname)
);
CREATE TABLE Clase (
    ID_Clase Varchar(20) NOT NULL PRIMARY KEY,
    FechaLimite Date NOT NULL,
    Codigo INT(4) NOT NULL, 
    Correo Varchar(30) NOT NULL,
     FOREIGN KEY  (Correo) references Usuarios(Correo)
);
CREATE TABLE ListaDeClases (
    ID_Clase Varchar(20) NOT NULL PRIMARY KEY, 
    FOREIGN KEY  (ID_Clase) references Clase(ID_Clase),
    Nombre Varchar(30) NOT NULL,
    FOREIGN KEY (Nombre) references Usuarios(Nombre)
);

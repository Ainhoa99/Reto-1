Create Database IGKLUBA;
    use IGKLUBA;
    CREATE TABLE Centro (
    id_centro Varchar(20) NOT NULL PRIMARY KEY,
    nombre_centro Varchar(30)
);
    CREATE TABLE Usuarios (
    nombre Varchar(20) NOT NULL,
    apellidos Varchar(30) NOT NULL,
    correo Varchar(30) NOT NULL PRIMARY KEY,
    nickname Varchar(30) NOT NULL,
    foto varchar(15),
    centro Varchar(20),
    fecha_nacimiento DATE,
    tipo ENUM('Alumno','Profesor', 'Administrador') NOT NULL,
    validado BOOLEAN NOT NULL,
    movil char(9), 
    contraseña Varchar(25) NOT NULL,
    nivel ENUM('DBH1','DBH2', 'DBH3', 'DBH4') NOT NULL,
    curso YEAR,
    FOREIGN KEY  (centro) references Centro(id_centro)
);  
CREATE TABLE IdiomaLibro (
    idioma Varchar(15) NOT NULL PRIMARY Key
);
CREATE TABLE Libros (
    id_libro  Varchar(20) NOT NULL PRIMARY KEY,
    titulo_libro  Varchar(20) NOT NULL,
    foto varchar(15) NOT NULL,
    autor varchar(100) NOT NULL,
    año_de_libro  Varchar(20) NOT NULL,  
    sinopsis Varchar(2300) NOT NULL,
    formato varchar(15) NOT NULL,
    edadmedia INT(2) NOT NULL,
    notamedia INT(2) NOT NULL,
    num_lectores INT(4) NOT NULL,
    idioma Varchar(15) NOT NULL,
    FOREIGN KEY  (idioma) references IdiomaLibro(idioma)
); 
CREATE TABLE Valoraciones (
    id_valoracion Varchar(20) NOT NULL PRIMARY KEY,
    nota Varchar(30) NOT NULL,
    fecha_nacimiento DATE,
    nickname Varchar(30) NOT NULL,
    titulo_libro  Varchar(20) NOT NULL,
    idioma Varchar(15) NOT NULL,
    FOREIGN KEY  (fecha_nacimiento) references Usuarios(fecha_nacimiento),
    FOREIGN KEY  (nickname) references Usuarios(nickname),
    FOREIGN KEY  (titulo_libro) references Libros(titulo_libro),
    FOREIGN KEY  (idioma) references IdiomaLibro(idioma)
);
CREATE TABLE Opiniones (
    id_opinion Varchar(20) NOT NULL PRIMARY KEY, 
    nombre Varchar(30) NOT NULL,
    fecha_nacimiento DATE,
    FOREIGN KEY  (nombre) references Usuarios(nombre),
    FOREIGN KEY  (fecha_nacimiento) references Usuarios(fecha_nacimiento)
);

CREATE TABLE PeticionDeLibro (
    titulo_libro  Varchar(20) NOT NULL,
    estado ENUM('Aceptada','EnEspera', 'Denegada'),
    nickname Varchar(30) NOT NULL,
    fecha_nacimiento DATE,
    id_peticion Varchar(20) NOT NULL PRIMARY KEY,
    FOREIGN KEY  (titulo_libro) references Libros(titulo_libro),
    FOREIGN KEY  (fecha_nacimiento) references Usuarios(fecha_nacimiento),
    FOREIGN KEY  (nickname) references Usuarios(nickname)
);
CREATE TABLE Clase (
    fecha_limite Date NOT NULL,
    correo Varchar(30) NOT NULL,
    codigo INT(4) NOT NULL AUTO_INCREMENT PRIMARY KEY, 
    FOREIGN KEY  (correo) references Usuarios(correo)
);
CREATE TABLE ListaDeClases (
    id_clase Varchar(20) NOT NULL PRIMARY KEY,
    nombre Varchar(30) NOT NULL, 
    FOREIGN KEY  (id_clase) references Clase(id_clase),
    FOREIGN KEY (nombre) references Usuarios(nombre)
);

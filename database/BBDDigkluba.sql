-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 28-10-2022 a las 09:37:03
-- Versión del servidor: 10.4.24-MariaDB
-- Versión de PHP: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: igkluba
--
drop database if exists igkluba;
create database igkluba default character set utf8 default collate utf8_general_ci;
use igkluba;
-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla centro
--

CREATE TABLE centro (
  id_centro int(11) NOT NULL AUTO_INCREMENT,
  nombre_centro varchar(30) DEFAULT NULL,
  PRIMARY KEY (id_centro)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla centro
--

INSERT INTO centro (nombre_centro) VALUES
('Txurdinaga'),
('Jesuitas');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla clase
--

CREATE TABLE clase (
  fecha_limite date NOT NULL,
  nickname varchar(30) NOT NULL,
  codigo int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla idiomalibro
--

CREATE TABLE idiomalibro (
  idioma varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla idiomalibro
--

INSERT INTO idiomalibro (idioma) VALUES
('Castellano'),
('Euskera'),
('Inglés');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla libros
--

CREATE TABLE libros (
  id_libro int(11) NOT NULL AUTO_INCREMENT,
  isbn varchar(20) NOT NULL,
  titulo_libro varchar(160) NOT NULL,
  foto varchar(80) NOT NULL,
  autor varchar(100) NOT NULL,
  ano_de_libro varchar(20) NOT NULL,
  sinopsis varchar(2300) NOT NULL,
  formato varchar(15) NOT NULL,
  edadmedia int(2) NOT NULL,
  notamedia int(2) NOT NULL,
  num_lectores int(4) NOT NULL,
  idioma varchar(50) NOT NULL,
  link_compra varchar(100) DEFAULT NULL,
  PRIMARY KEY (id_libro)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla libros
--

INSERT INTO libros (isbn, titulo_libro, foto, autor, ano_de_libro, sinopsis, formato, edadmedia, notamedia, num_lectores, idioma, link_compra) VALUES
('9788420674209', 'El guardián entre el centeno', 'elguardianentrelcenteno.jpg', 'J.D. Salinger', 1951, 'Por expreso deseo del autor, no está permitido que la editorial aporte en su material promocional ningún tipo de texto adicional, información biográfica, cita o reseña relacionados con esta obra. El lector interesado podrá, no obstante, encontrar abundante información al respecto en internet.', 'Novela', 16, 7, 4, 'Castellano', '' ),
('9788478887194', 'El principito', 'elprincipito.jpg', 'Antoine de Saint-Exupéry', 1943, 'Fábula mítica y relato filosófico que interroga acerca de la relación del ser humano con su prójimo y con el mundo, El Principito concentra, con maravillosa simplicidad, la constante reflexión de Saint-Exupery sobre la amistad, el amor, la responsabilidad y el sentido de la vida.', 'Novela', 16, 7, 4, 'Castellano', '' ),
('9788466794992', 'La isla del tesoro', 'laisladeltesoro.jpg', 'Robert Louis Stevenson', 1883, 'El protagonista de este magnífico libro es un niño, Jim Hawkins. Su emocionante aventura comienza el día en que un viejo marinero con la cara marcada por un sablazo llega a la posada de su padre. El cofre que transporta el desconocido contiene un extraño mapa, que Jim descubrirá por casualidad. A partir de este momento, nuestro joven protagonista emprenderá un arriesgado viaje en busca del tesoro del temido capitán Flint.', 'Novela', 14, 8, 4, 'Castellano',''  ),
('9783140464066', 'Los juegos del hambre', 'losjuegosdelhambre.jpg', 'Suzanne Collins', 2008, 'En una oscura versión del futuro próximo, doce chicos y doce chicas se ven obligados a participar en un reality show llamado Los Juegos del Hambre. Solo hay una regla: matar o morir.Cuando Katniss Everdeen, una joven de dieciseis años se presenta voluntaria para ocupar el lugar de su hermana en los juegos, lo entiende como una condena a muerte. Sin embargo, Katniss ya ha visto la muerte de cerca y la supervivencia forma parte de su naturaleza.', 'Novela', 16, 7, 4, 'Castellano',''  ),
('9788467502695', 'Memorias de Idhún. La Resistencia', 'memoriasdeidhun.jpg', 'Laura Gallego', 2004, 'El día en que se produjo en Idhún la conjunción astral de los tres soles y las tres lunas, Ashran el Nigromante se hizo con el poder en aquel planeta. En nuestro mundo, un guerrero y un mago exiliados de Idhún han formado la Resistencia, a la que pertenecen también Jack y Victoria, dos adolescentes nacidos en la Tierra. El objetivo del grupo es acabar con el reinado de las serpientes aladas, pero Kirtash, un joven y despiadado asesino, enviado por Ashran a la Tierra, no se lo va a permitir.', 'Novela', 16, 9, 3, 'Castellano','' ),
('9788420482767', 'Momo', 'momo.jpg',' Michael Ende', 1973, 'Momo es una niña con un don muy especial: sólo con escuchar consigue que los que están tristes se sientan mejor, los que están enfadados solucionen sus problemas o que a los que están aburridos se les ocurran cosas divertidas. De repente, la llegada de los hombres grises va a cambiar su vida. Porque prometen que ahorrar tiempo es lo mejor que se puede hacer, y pronto nadie va a tener tiempo para nada. Ni siquiera para jugar con los niños. Momo es la unica que no cae en la trampa, y con la ayuda de la tortuga Casiopea y del maestro Hora, llevará al lector a una aventura fantástica llena de enseñanzas sobre la amistad, la bondad y el valor de las cosas sencillas. En definitiva, sobre lo que de verdad nos hace felices.', 'Novela', 13, 8, 3, 'Castellano','' );

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla listadeclases
--

CREATE TABLE listadeclases (
  codigo int(4) NOT NULL,
  nickname varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla opiniones
--

CREATE TABLE opiniones (
  id_opinion int(11) NOT NULL AUTO_INCREMENT,
  nickname varchar(30) NOT NULL,
  edad int(2) NOT NULL,
  PRIMARY KEY (id_opinion)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla peticiondelibro
--

CREATE TABLE peticiondelibro (
  id_peticion int(11) NOT NULL AUTO_INCREMENT,
  titulo_libro varchar(20) NOT NULL,
  estado enum('Aceptada','Espera','Denegada') DEFAULT NULL,
  nickname varchar(30) NOT NULL,
  edad int(2) NOT NULL,
  PRIMARY KEY (id_peticion)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla usuarios
--

CREATE TABLE usuarios (
  nombre varchar(20) NOT NULL,
  apellidos varchar(30) NOT NULL,
  correo varchar(30) NOT NULL,
  nickname varchar(30) NOT NULL,
  foto varchar(15) DEFAULT NULL,
  id_centro int(11) NOT NULL,
  fecha_nacimiento date DEFAULT NULL,
  tipo enum('Alumno','Profesor','Administrador') NOT NULL,
  validado tinyint(1) NOT NULL,
  movil char(9) DEFAULT NULL,
  password varchar(25) NOT NULL,
  nivel enum('DBH1','DBH2','DBH3','DBH4') DEFAULT NULL,
  curso char(9) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla usuarios
--

INSERT INTO usuarios (nombre, apellidos, correo, nickname, foto, id_centro, fecha_nacimiento, tipo, validado, movil, password, nivel, curso) VALUES
('Ainhoa', 'Lopez Castro', 'ainhoalopez99.al@gmail.com', 'ainhoa', NULL, 2, 1999-09-28, 'Alumno', 1, NULL, 'cont_ainhoa', 'DBH3', '2022-2023'),
('Augusto', 'dlc', 'augusto@gmail.com', 'augusto', NULL, 1, 2003-06-06, 'Alumno', 1, NULL, 'cont_augusto', 'DBH3', '2022-2023'),
('Clara', 'Gutierrez', 'Clara@gmail.com', 'claragutc', NULL, 2, 1993-03-21, 'Alumno', 1, NULL, 'clara_cont', 'DBH4', '2022-2023'),
('Endika', 'Avellaneda', 'endika@gmail.com', 'endika_profe', NULL, 1, 1990-01-01, 'Profesor', 1, NULL, 'cont_endika', NULL, '2022-2023'),
('Iker', 'Gonzalez', 'iker@gmail.com', 'iker', NULL, 2, 2022-10-19, 'Alumno', 0, NULL, 'cont_iker', 'DBH2', '2022-2023'),
('Luka', 'Carmona', 'lukacarmona115@gmail.com', 'lukita_', NULL, 2, 5555-05-05, 'Alumno', 1, NULL, 1234, 'DBH3', '2022-2023'),
('Unai', 'Cabo', 'unai@gmail.com', 'unai', NULL, 1, 2000-07-15, 'Alumno', 1, NULL, 'unai_cont', 'DBH3', '2022-2023');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla valoraciones
--

CREATE TABLE valoraciones (
  id_valoracion int(11) NOT NULL AUTO_INCREMENT,
  nota varchar(30) NOT NULL,
  edad int(2) NOT NULL,
  nickname varchar(30) NOT NULL,
  titulo_libro varchar(160) NOT NULL,
  idioma varchar(15) NOT NULL,
  PRIMARY KEY (id_valoracion)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla valoraciones
--

INSERT INTO valoraciones (nota, edad, nickname, titulo_libro, idioma) VALUES
(8, 15, 'ainhoa', 'El guardián entre el centeno', 'Euskera'),
(6, 16, 'claragutc', 'Momo', 'Inglés'),
(9, 16, 'ainhoa', 'El principito', 'Euskera'),
(6, 16, 'ainhoa', 'La isla del tesoro', 'Castellano');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla centro
--

--
-- Indices de la tabla clase
--
ALTER TABLE clase
  ADD PRIMARY KEY (codigo),
  ADD KEY nickname (nickname);

--
-- Indices de la tabla idiomalibro
--
ALTER TABLE idiomalibro
  ADD PRIMARY KEY (idioma);

--
-- Indices de la tabla libros
--
ALTER TABLE libros
  ADD KEY idioma (idioma);

--
-- Indices de la tabla listadeclases
--
ALTER TABLE listadeclases
  ADD KEY codigo (codigo),
  ADD KEY nickname (nickname);

--
-- Indices de la tabla opiniones
--
ALTER TABLE opiniones
  ADD KEY nickname (nickname);

--
-- Indices de la tabla peticiondelibro
--
ALTER TABLE peticiondelibro
  ADD KEY titulo_libro (titulo_libro),
  ADD KEY nickname (nickname);

--
-- Indices de la tabla usuarios
--
ALTER TABLE usuarios
  ADD PRIMARY KEY (correo),
  ADD UNIQUE KEY nickname (nickname),
  ADD KEY centro (id_centro);

--
-- Indices de la tabla valoraciones
--
ALTER TABLE valoraciones
  ADD KEY nickname (nickname),
  ADD KEY titulo_libro (titulo_libro),
  ADD KEY idioma (idioma);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla clase
--


--
-- AUTO_INCREMENT de la tabla listadeclases
--
ALTER TABLE listadeclases
  MODIFY codigo int(4) NOT NULL AUTO_INCREMENT;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla clase
--
ALTER TABLE clase
  ADD CONSTRAINT clase_ibfk_1 FOREIGN KEY (nickname) REFERENCES usuarios (nickname);

--
-- Filtros para la tabla libros
--
ALTER TABLE libros
  ADD CONSTRAINT libros_ibfk_1 FOREIGN KEY (idioma) REFERENCES idiomalibro (idioma);

--
-- Filtros para la tabla listadeclases
--
ALTER TABLE listadeclases
  ADD CONSTRAINT listadeclases_ibfk_1 FOREIGN KEY (codigo) REFERENCES clase (codigo),
  ADD CONSTRAINT listadeclases_ibfk_2 FOREIGN KEY (nickname) REFERENCES usuarios (nickname);

--
-- Filtros para la tabla opiniones
--
ALTER TABLE opiniones
  ADD CONSTRAINT opiniones_ibfk_1 FOREIGN KEY (nickname) REFERENCES usuarios (nickname);

--
-- Filtros para la tabla peticiondelibro
--
ALTER TABLE peticiondelibro
  ADD CONSTRAINT peticiondelibro_ibfk_2 FOREIGN KEY (nickname) REFERENCES usuarios (nickname);

--
-- Filtros para la tabla usuarios
--
ALTER TABLE usuarios
  ADD CONSTRAINT usuarios_ibfk_1 FOREIGN KEY (id_centro) REFERENCES centro (id_centro);

--
-- Filtros para la tabla valoraciones
--
ALTER TABLE valoraciones
  ADD CONSTRAINT valoraciones_ibfk_1 FOREIGN KEY (nickname) REFERENCES usuarios (nickname),
  ADD CONSTRAINT valoraciones_ibfk_3 FOREIGN KEY (idioma) REFERENCES idiomalibro (idioma);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

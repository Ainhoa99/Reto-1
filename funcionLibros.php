<?php
function anadirlibros($respuesta)
{
    foreach ($respuesta as $posicion => $libros) {

        //$titulo-libro = $libros['titulo_libro'];

        echo "<div id='libro'>";

        //Imagen
        echo "<figure class='img-libro'><img src='img/" . $libros['foto'] . "'></figure>";


        echo "<div class='caja-info-libro'>";
        //Titulo
        echo "<p class='libro-titulo' method='get'>" . $libros['titulo_libro'] . "</p>";


        //Autor
        echo "<p class='libro-autor'>" . $libros['autor'] . "</p>";

        //Valoración
        echo "<div class='caja-notamedia'>";
        echo "<p class='libro-notamedia-text'>Batez besteko nota</p>";
        echo "<p class='libro-notamedia'>" . $libros['notamedia'] . "</p>";
        echo "</div>";
        //Edad media
        echo "<p class='libro-edad-media'>Batez besteko adina: " . $libros['edadmedia'] . "</p>";

        //Enlace a la ficha
        echo "<p class='enlace-ficha'><a href='fichalibro.php?liburua=" . $libros['id_libro'] . "'>Fitxa ikusi</a></p>";
        echo "</div>";
        echo "</div>";
    }
}

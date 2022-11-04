<header id="cabecera">

    <div id="caja-logo-titulo">
        <figure id="logo">
            <a href="index.php"><img src="src/logoSinLetra.png" alt="logo"></a>
        </figure>
        
        <h1><a href="index.php">Igkluba</a></h1>

    </div>

    <div id="caja-botones">

        <div id="btn-buscador" class="btn">
            <i class="fas fa-search"></i>
        </div>
        <form METHOD=POST ACTION="index.php">
            <div id="buscador" class="ocultar">
                <input type="text" id="busqueda" name='busqueda' placeholder="Bilatu" size="20">
                <i class="fas fa-search"></i>
            </div>
        </form>

        <div id="btn-nav" class="btn">
            <span class="linea"></span>
            <span class="linea"></span>
            <span class="linea"></span>
        </div>
    </div>
    <nav id="menu-nav" class="ocultar">
        <ul>
            <?php
            if (($_SESSION['tipo'] == 'Profesor') || ($_SESSION['tipo'] == 'Administrador')) {
                echo " <li><a href=''><i class='fas fa-chalkboard-teacher'></i>Nire klaseak</a></li>";
            }
            ?>

            <li><a href="mis_libros.php"><i class="fa fa-book-open"></i>Nire liburuak</a></li>
            <li><a href="añadirlibro.php"><i class="fas fa-book-medical"></i>Liburu berria</a></li>
            <li><a href="perfilpersonal.php"><i class="fas fa-user"></i>Nire datuak</a></li>
            <?php
            if ($_SESSION['tipo'] == 'Administrador') {
                echo " <li><a href='nuevo_profesor.php'><i class='far fa-id-badge'></i>Irakasle berria</a></li>";
            }
            ?>
            <?php
            if (($_SESSION['tipo'] == 'Profesor') || ($_SESSION['tipo'] == 'Administrador')) {
                echo " <li><a href='validacion.php'><i class='fas fa-check'></i>Balioztatzeko</a></li>";
            }
            ?>
            <li><a href="logout.php"><i class="fas fa-times"></i>Saioa itxi</a></li>
        </ul>
    </nav>

</header>
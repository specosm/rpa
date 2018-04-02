<!--Navbar-->
<nav class="navbar navbar-expand-lg navbar-dark   navColor  fixed-top  scrolling-navbar  ">

    <!-- Navbar brand -->
    <a class="navbar-brand" target="_blank" href="https://www.axpe.com/">
        <img src="imagenes/logo.jpg" height="50" alt="">
     </a>

     <!-- Collapse button -->
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
            aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>

    <!-- Collapsible content -->
    <div class="collapse navbar-collapse" id="navbarSupportedContent">

        <!-- Links -->
        <ul class="navbar-nav mr-auto" id="link">
            <li class="nav-item">
                <a id="grafo" class="nav-link" href="#">Rpa Procesos Estadísticas<i class="fa fa-bar-chart-o" aria-hidden="true"></i></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="estadistica" href="#">Rpa Procesos</a>
            </li>
            <li class="nav-item">
                <a id="process" class="nav-link" href="#">Rpa Procesos Tracking</a>
            </li>
            <li class="nav-item">
                <a id="informes" class="nav-link" href="#">Rpa Procesos Informes<i class="fa fa-file-excel-o" aria-hidden="true"></i></a>
            </li>

        </ul>
        <ul id="link2" class="nav navbar-nav navbar-right">

            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-child fa-2x" aria-hidden="true"></i><?php echo $_SESSION["user"]." ".$_SESSION["apellidos"];?></a>
                <div class="dropdown-menu">
                    <?php if($_SESSION['admin'] == "S") { ?>
                    <a class="dropdown-item" id="crear" href="#">Administrador de bot´s</a>
                    <a class="dropdown-item" id="admin" href="#">Administrador de Procesos</a>
                    <div class="dropdown-divider"></div>
                    <?php } ?>
                    <a class="dropdown-item" id="perfil" href="#">Perfil bot´s</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item"  href="comunes/salir.php">Salir</a>
                </div>
            </li>
        </ul>


        <!-- Links -->
    </div>
    <!-- Collapsible content -->

</nav>
<!--/.Navbar-->



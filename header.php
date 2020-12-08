<?php
if($acceso == "maestro")
{
echo <<<_head
<nav class="navbar" role="navigation" aria-label="main navigation">
    <div class="navbar-brand">
        <a role="button" class="navbar-burger" data-target="navMenu" aria-label="menu" aria-expanded="true">
            <span aria-hidden="true"></span>
            <span aria-hidden="true"></span>
            <span aria-hidden="true"></span>
        </a>
    </div>
    <div class="navbar-menu" id="navMenu">
        <div class="navbar-start">
            <a href="index.php" class="navbar-item">
                Añadir
            </a>

            <a href="cambiar.php" class="navbar-item">
                Cambiar
            </a>

            <a href="eliminar.php" class="navbar-item">
                Borrar
            </a>

            <a href="logout.php" class="navbar-item">
                Cerrar sesión
            </a>

        </div>
    </div>
</nav>
_head;
}
else{
echo <<<_head
    <nav class="navbar" role="navigation" aria-label="main navigation">
        <div class="navbar-brand">
            <a role="button" class="navbar-burger" data-target="navMenu" aria-label="menu" aria-expanded="true">
                <span aria-hidden="true"></span>
                <span aria-hidden="true"></span>
                <span aria-hidden="true"></span>
            </a>
        </div>

        <div class="navbar-menu" id="navMenu">
            <div class="navbar-start">

                <a href="logout.php" class="navbar-item">
                    Cerrar sesión
                </a>

            </div>
        </div>
    </nav>
_head;
}
?>

<?php
    require_once 'functions.php';

    echo'

    <body>';
    if (isset($_SESSION['user']))
    {
        destroySession();
    }

    echo'

    <h1 class="centrar is-size-4 mt-6">Usted ha cerrado sesión <a href="login.php">click aquí</a> para regresar al inicio de sesión</h1>

    </body>

    </html>
    ';

?>

<?php
require_once 'functions.php';
use Illuminate\Database\Capsule\Manager as DB;

echo'
<body>
    <div class="container">
';

if(isset($_POST['usuario']))
{
    $usuario = sanitizeString($_POST['usuario']);
    $contraseña = sanitizeString($_POST['contraseña']);

    if($usuario == "" || $contraseña == "")
    {
        echo'
        <p class="is-size-3 centrar mt-2">No pueden haber campos sin llenar</p>
        ';
    }
    else
    {
        $cuenta = DB::table('cuentas')->select(['usuario', 'contraseña'])->where('usuario', $usuario)->where('contraseña', $contraseña)->first();

        if (!$cuenta)
        {
            echo'
            <p class="is-size-3 centrar mt-2">Cuenta o contraeña incorrectas</p>
            ';
        }
        else
        {
            $_SESSION['user'] = $usuario;
            $_SESSION['pass'] = $contraseña;

            die("
            <div class='check is-size-4'>
                <p class='is-size-4 centrar mt-6'>Usted ha iniciado sesión <a href='index.php'>click aquí</a> para ir al inicio</p>
            </div>
            </div></body></html>");
        }
    }
}

if(!$loggedin){

    echo'
        <div class="box mt-6">
            <div class="title is-large">
                Ingresa tus datos para iniciar sesión
            </div>
            <div class="form">
                <form method="post" action="login.php">
                    <div class="field">
                        <label class="label mt-4">Usuario</label>
                        <div class="control">
                            <input class="input is-rounded" type="text" maxlength="45" name="usuario" placeholder="Usuario">
                        </div>
                    </div>
                    <div class="field">
                        <label class="label">Contraseña</label>
                        <div class="control">
                            <input class="input is-rounded" type="password" maxlength="45" name="contraseña" placeholder="Contraseña">
                        </div>
                    </div>
                    <button type="submit" class="button is-rounded is-link mt-3">Iniciar sesión</button>
                </form>
            </div>
        </div>
    </div>
    ';
}
else{

    die('<p class="is-size-4 is-center mt-6">Usted ya tiene una sesión <a href="index.php">click aquí</a> para regresar</p>
        </div></body></html>');

}

echo'
    </body>
</html>
';
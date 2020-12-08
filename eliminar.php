<?php
require_once 'functions.php';
use Illuminate\Database\Capsule\Manager as DB;

$aviso = $esp = $mate = $hist = "";

echo'
<body>
';


if($loggedin)
{
    require_once 'header.php';

    if(isset($_POST['id']))
    {
        $id_cuenta = $_POST['id'];

        $eliminar = DB::table('materias')->where('cuentas_id_cuenta', $id_cuenta)->delete();

        if($eliminar)
        {
            echo'<p class="is-size-3 centrar mt-2">Calificaciones del alumno eliminadas</p>';
        }
        else {
            echo'<p class="is-size-3 centrar mt-2">Ese alumno no tiene calificaciones</p>';
        }
    }

    if($acceso == "maestro")
    {
        $usuarios = DB::table('cuentas')
        ->where('id_cuenta', '<>', $id)
        ->orderBy('apellido')
        ->get();

        echo'
        <div class="container">
            <div class="box mt-6">
                <div class="title is-large">
                    Selecione a un alumno para eliminar su calificación
                </div>
                <div class="form">
                    <form method="post" action="eliminar.php">
                        <div class="field">
                            <label class="label">Alumno</label>
                            <div class="control">
                                <div class="select">
                                    <select name="id">';
                                    $num = 1;
                                    foreach($usuarios as $u)
                                    {
                                        echo'<option value="'.$u->id_cuenta.'">'.$num.".- " . $u->nombre . " " . $u->apellido .'</option>';
                                        $num+=1;
                                    }
                                echo'
                                    </select>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="button is-link mt-5">Eliminar</button>
                    </form>
                </div>
            </div>
        </div>
        ';
    }
    else
    {
        echo"<p class='is-size-4 centrar mt-6'>No tienes permisos para estar aquí <a href='index.php'>click aquí para regresar al inicio</a></p>";
    }
}
else{
    echo"<p class='is-size-4 centrar mt-6'>Necesitas una cuenta para usar este sistema <a href='login.php'>click aquí para regresar al login</a></p>";
}

echo'
    </body>
</html>
';
?>
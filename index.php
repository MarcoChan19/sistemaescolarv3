<?php
require_once 'functions.php';
use Illuminate\Database\Capsule\Manager as DB;

echo'
<body>
';

if($loggedin){
    require_once 'header.php';

    if(!empty($_POST['nombre']))
    {
        $nombre = sanitizeString($_POST['nombre']);
        $nombre2 = sanitizeString($_POST['nombre2']);
        $apellido = sanitizeString($_POST['apellido']);
        $apellido2 = sanitizeString($_POST['apellido2']);

        $usuario = "escuela_".$nombre.$apellido;

        $existe = DB::table('cuentas')->where('usuario', $usuario)->first();

        $nombres = $nombre . " " . $nombre2;

        $apellidos = $apellido . " " . $apellido2;

        if(!$existe)
        {
            $calificaciones = DB::table('cuentas')->insertGetId(
                ['usuario' => $usuario, 'contraseña' => $usuario, 'nombre' => $nombres, 'apellido' => $apellidos, 'acceso' => 'alumno']
            );
            echo'<p class="is-size-3 centrar mt-2">Alumno agregado</p>';
        }
        else{
            echo'<p class="is-size-3 centrar mt-2">Ese alumno ya ha sido agregado</p>';
        }
    }

    echo'
    <div class="container">
    ';

    if($acceso == "maestro")
    {
        echo'
        <div class="box mt-6">
            <div class="title is-large">
                Ingresa los datos del alumno para registrarlo
            </div>
            <div class="info centrar">
                Los usuarios y contraseñas serán "escuela" + " _" + "primer nombre" + "primer apellido"
                <br>
                ejemplo: escuela_MarcoChan
            </div>
            <div class="form">
                <form method="post" action="index.php">
                    <div class="field">
                        <label class="label mt-4">Nombre</label>
                        <div class="control">
                            <input class="input is-rounded" type="text" name="nombre" placeholder="Nombre">
                        </div>
                        <label class="label mt-4">Segundo nombre</label>
                        <div class="control">
                            <input class="input is-rounded" type="text" name="nombre2" placeholder="Segundo nombre">
                        </div>
                        <label class="label mt-4">Apellido Paterno</label>
                        <div class="control">
                            <input class="input is-rounded" type="text" name="apellido" placeholder="Apellido Paterno">
                        </div>
                        <label class="label mt-4">Apellido Materno</label>
                        <div class="control">
                            <input class="input is-rounded" type="text" name="apellido2" placeholder="Apellido Materno">
                        </div>
                    </div>
                    <button type="submit" class="button is-rounded is-link mt-3">Registrar!</button>
                </form>
            </div>
        </div>
    </div>
    ';
    }
    else
    {
        $calificaciones = DB::table('materias')->where('cuentas_id_cuenta', $id)->first();

        if($calificaciones)
        {
            $mate = $calificaciones->mate;
            $ingles = $calificaciones->ingles;
            $fisica = $calificaciones->fisica;

            $promedio = ($mate + $ingles + $fisica)/3;
        }
        else {
            $mate = "";
            $ingles = "";
            $fisica = "";
            $promedio = "";

            echo'<p class="is-size-3 centrar mt-2">No tienes calificaciones aún</p>';
        }


        echo'
        <div class="box mt-6">
            <div class="title is-large">
                Calificaciones y promedio general de: '.$usuario->nombre . " " . $usuario->apellido.'
            </div>
                <div class="form">
                    <form>
                    <div class="field">
                        <label class="label mt-4">Matemáticas</label>
                        <div class="control">
                            <input class="input" type="number" value="'.$mate.'" readonly>
                        </div>
                        <label class="label mt-4">Inglés</label>
                        <div class="control">
                            <input class="input" type="number" value="'.$ingles.'" readonly>
                        </div>
                        <label class="label mt-4">Física</label>
                        <div class="control">
                            <input class="input" type="number" value="'.$fisica.'" readonly>
                        </div>
                        <label class="label mt-6">Promedio General</label>
                        <div class="control">
                            <input class="input" type="number" value="'.$promedio.'" readonly>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    ';
    }
}
else{
    echo"<p class='is-size-4 is-center mt-6'>Necesitas una cuenta para usar este sistema <a href='login.php'>click aquí para regresar al login</a></p>";
}

echo'
    </body>
</html>
';
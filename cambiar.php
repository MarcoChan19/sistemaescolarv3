<?php
require_once 'functions.php';
use Illuminate\Database\Capsule\Manager as DB;

echo'
<body>
';


if($loggedin)
{
    require_once 'header.php';
    if($acceso == "maestro")
    {
        echo'
        <div class="container">';

        if(isset($_POST['id']))
        {
            $id_cuenta = $_POST['id'];
            $mate = $_POST['mate'];
            $ing = $_POST['ing'];
            $fis = $_POST['fis'];

            $existe = DB::table('materias')
            ->where('cuentas_id_cuenta', $id_cuenta)
            ->first();

            if($existe)
            {
                DB::table('materias')
                ->where('cuentas_id_cuenta', $id_cuenta)
                ->update([
                    'mate' => $mate, 'ingles' => $ing, 'fisica' => $fis
                ]);
                echo'<p class="is-size-3 centrar mt-2">Calificaciones del alumno modificadas</p>';
            }
            else {
                DB::table('materias')
                ->insert([
                    'cuentas_id_cuenta' => $id_cuenta, 'mate' => $mate, 'ingles' => $ing, 'fisica' => $fis
                ]);
                echo'<p class="is-size-3 centrar mt-2">Calificaciones del alumno añadidas</p>';
            }

        }

        $usuarios = DB::table('cuentas')
        ->where('id_cuenta', '<>', $id)
        ->orderBy('apellido')
        ->get();

        echo'
        <div class="box mt-6">
            <div class="title is-large">
                Selecione a un alumno para cambiar su calificación
            </div>
            <div class="form">
                <form method="post" action="cambiar.php">
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
                    <label class="label mt-4">Matemáticas</label>
                    <div class="control">
                        <input class="input" type="number" max="10" name="mate" placeholder="Matemáticas">
                    </div>
                    <label class="label mt-4">Inglés</label>
                    <div class="control">
                        <input class="input" type="number" max="10" name="ing" placeholder="Inglés">
                    </div>
                    <label class="label mt-4">Física</label>
                    <div class="control">
                        <input class="input" type="number" max="10" name="fis" placeholder="Física">
                    </div>
                    <button type="submit" class="button is-link mt-5">cambiar</button>
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
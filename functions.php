<?php
@ob_start();
session_start();

use Illuminate\Database\Capsule\Manager as DB;

require 'vendor/autoload.php';
require 'config/database.php';

if (isset($_SESSION['user'])) {
    $user     = $_SESSION['user'];
    $loggedin = TRUE;

    $usuario = DB::table('cuentas')->where('usuario', $user)->first();

    $acceso = $usuario->acceso;
    $id = $usuario->id_cuenta;
} else $loggedin = FALSE;

function destroySession()
{
    $_SESSION=array();

    if (session_id() != "" || isset($_COOKIE[session_name()]))
        setcookie(session_name(), '', time()-2592000, '/');

    session_destroy();
}

function sanitizeString($var)
{
    $var = strip_tags($var);
    $var = htmlentities($var);
    return $var;
}
echo '
<!DOCTYPE html>
    <html lang="es" class="fondo">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta http-equiv="x-ua-compatible" content="ie=edge">

        <title>Sistema escolar</title>

        <link rel="stylesheet" href="node_modules/bulma/css/bulma.min.css">

        <link rel="stylesheet" href="css/styles.css">
    </head>
';
?>
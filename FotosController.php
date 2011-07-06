<?php
include_once('FotosFachada.php');
/**
 * Controlador para manejar la visualización de los albumes
 * 
 * version 1.0
 */
session_name('usuario');
session_start();
// Por ahora supongamos que solo existe perfil
$_SESSION['usuario']= 'simon';
$_SESSION['fotos']= array();
if(!array_key_exists("tipo",$_GET))
        echo "Error al llamar al controlador debes especificar la variable tipo";

    switch ($_GET['tipo']) {
    case 'perfil':
        echo "hola!!!!!!!!!!!!!!!!!!!";
        $F=FotosFachada::getInstance();
        $_SESSION['fotos']=$F->getNombresAlbumPerfil($_SESSION['usuario']);
        $_SESSION['hola']="hola";
        echo "hola!!!!!!!!!!!!!!!!!!!";
        break;
    case 'grupo':
        break;
    case 'noticia':
        break;
    case 'evento':
        break;
    
    default:
        break;
}  

echo "<meta http-equiv='refresh' content='4; URL=./index.php'>";
?>

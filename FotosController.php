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
$SESSION['usuario']= 'simon';
if(!array_key_exists("tipo",$_GET))
        echo "Error al llamar al controlador debes especificar la variable tipo";

    switch ($_GET['tipo']) {
    case 'perfil':
        $F=FotosFachada::getInstance();
        $SESSION['fotos']=$F->getNombresAlbumPerfil($SESSION['usuario']);
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
 
echo "<meta http-equiv='refresh' content='0; URL=./index.php'>";
?>

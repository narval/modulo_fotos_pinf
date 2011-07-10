<?php
include_once('FotosFachada.php');
/**
 * Controlador para manejar la visualizacion de los albumes
 * 
 * version 1.0
 */
session_start();
// Por ahora supongamos que solo existe perfil

$_SESSION['k_username']= 'yo';

if(array_key_exists("opt", $_GET) && $_GET["opt"]="fotos"){
    $F=FotosFachada::getInstance();
    $listaF=$F->getNombresFotos($_GET["id"]);
    $_SESSION["nombreAlbum"]= $_GET["nombre"];
    $_SESSION["idAlbum"]= $_GET["id"];
    $_SESSION["listaFotos"]= $listaF;
    echo "<meta http-equiv='refresh' content='0; URL=./album.php'>";
}

        
//$_GET["tipo"]= "perfil";

 //if(!array_key_exists("tipo",$_GET))
   //     echo "Error al llamar al controlador debes especificar la variable tipo";

    switch ("perfil") {
    case 'perfil':
        $F=FotosFachada::getInstance();
        $_SESSION['fotos']=$F->getNombresAlbumPerfil($_SESSION['k_username']);
        echo "<meta http-equiv='refresh' content='10; URL=./albumes.php'>";
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
     
 
?>

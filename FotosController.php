<?php

/**
 * Controlador para manejar la visualización de los albumes
 * 
 * version 1.0
 */
session_name('usuario');
session_start();
// Por ahora supongamos que solo existe perfil
$SESSION['usuario']= 'yo';
$F=FotosFachada::getInstance();
$lista=$F->getNombresAlbumPerfil($SESSION['usuario']);
echo "<meta http-equiv='refresh' content='0; URL=./index.php?lista=".$lista."'>";
?>

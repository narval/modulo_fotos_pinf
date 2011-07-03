<?php
require_once("ClassAlbum.php");
/*
 * Fachada logica para el modulo Gestion de Fotos
 * Version 1.0
 */
class FotosFachada {

    private static $instance;

    private function __construct() {
        
    }
    
    public static function getInstance() { //metodo Singleton
        if (!isset(self::$instance)) {
            $c = __CLASS__;
            self::$instance = new $c;
        }
        return self::$instance;
    }
    
public function crearAlbumPerfil($nombre,$lugar,$usuario){
    $perfil= new Perfil($usuario);
    $ok=$perfil.crearAlbum($nombre,$lugar);
    if (!ok)
        RETURN FALSE;
    RETURN TRUE;
    
} 
 
}
?>

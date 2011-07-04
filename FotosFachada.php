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
    /**
     * Función que devuelve un array asociativo con los id's y nombres 
     * de los albumes dado el $user de un Perfil.
     * Si existe algún error devuelve NULL.
     * @param string $user
     * @return array() 
     */
    public function getNombresAlbumPerfil($user){
        if($lista=Album_Perfil::getListaAlbums($user))
                RETURN $lista;
        RETURN NULL;
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

<?php
require_once("Clases/ClassAlbum.php");
require_once("Clases/ClassFoto.php");

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
     * de los albumes dado el tipo de entidad y su clave.
     * Si existe algún error devuelve NULL.
     * @param string $tipo_ente
     * @param string $clave
     * @return array() 
     */
    public function getNombresAlbum($tipo_ente,$clave){
        if($lista=  ClassAlbum::getListaAlbums($tipo_ente, $clave))
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


public function getNombresFotos($id_album){
    $Album= new ClassAlbum($id_album);
    $Album->cargarFotos();
    if($lista=$Album->getFotos())
            RETURN $lista;
        RETURN NULL;
    }
    

 
}
?>

<?php
 require_once '../FachadasBD/AlbumMapper.php';
/**
 * Description of ClassAlbum
 *
 * 
 */
 class ClassAlbum {
    private $id;
    private $nombre;
    private $lugar;
    private $fotos = Array(); // Arreglo de fotos
    
    public function __construct() {
     if (func_num_args() == 1) {
     $this->id= func_get_arg(0);
     $this->fotos= array();
   }

    if (func_num_args() == 2) {
      $this->nombre= $func_get_arg(0);
      $this->lugar= $func_get_arg(1);
      $this->fotos= array();
    }
    }
    
    public function cargarFotos(){
        $this->fotos= ClassFoto::getListaFoto($this->id);
    }
    
    public function getFotos(){
        RETURN $this->fotos;
    }
    
    public function agregarFoto($nombreFoto, $imagen){
        $foto= new ClassFoto($nombre, $imagen);
        $foto->guardarFoto($this->id);  
    }
    
     /** 
     * Devuelve un arreglo asociativo con el id y el nombre de cada album
     * dado el ente propietario de los albumes y su ID.
     * Devuelve NULL si existio algun error.
     * @param string $clave 
     * @return array() $idsNombres
     */
    public static function getListaAlbums($tipo_ente,$clave){
        $A=AlbumMapper::getInstance();
        $idsNombres=NULL;
        // Obtener la lista de id's de los albumes cuyo dueno es $tipo_ente
        if($listaIds= $A->getIdsAlbum($tipo_ente,$clave)){
            $idsNombres=array();
            for($i=0; $i<count($listaIds);$i++){
                $id= $listaIds[$i];
                $idsNombres[$id]=
                            $A->getNombreAlbum($id);
                if(!($idsNombres[$id]))
                    RETURN NULL;
            }
        }
        RETURN $idsNombres;
    }
}

?>

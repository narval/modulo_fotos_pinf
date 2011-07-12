<?php
require_once('../FachadasBD/FotoMapper.php');

/**
 * Description of ClassFoto
 *
 * @author jennifer DOSREIS
 */
class ClassFoto {
    private $nombre;
    private $imagen;
    private $id;
    
    public function __construct($nombre,$imagen) {
        $this->nombre=$nombre;
        $this->imagen= $imagen;
    }
    
   // public function __construct($nombre) {
   //     $this->nombre=$nombre;
   // }
    
    public function setImagen($imagen) {
        $this->imagen = $imagen;
    }

    public function getNombre() {
        return $this->nombre;
    }

    public function getImagen() {
        return $this->imagen;
    }

    public static function getListaFoto($ID_album){
        $A=FotoMapper::getInstance();
        $idsNombres=NULL;
        // Obtener la lista de id's y nombres de las
        // fotos pertenecientes al album $ID_album
        if($listaIds= $A->getIdsFotoAlbum($ID_album)){
            $idsNombres=array();
            for($i=0; $i<count($listaIds);$i++){
                $id= $listaIds[$i];
                $idsNombres[$id]=
                            $A->getNombreImagenFoto($id);
                if(!($idsNombres[$id]))
                    RETURN NULL;
            }
        }
        RETURN $idsNombres;
    }

   
    public function guardarFoto($idAlbum){
        $A=FotoMapper::getInstance();
        $ok=0;
        // Si la persona ya tiene una foto con el nombre dado, concatenarle "(1)"
        while(($ok=($A::existeFotoAlbum($idAlbum))) && $ok!=-1){
            $this->nombre= $this->nombre."(1)";
        }
        if ($ok==-1)
            RETURN FALSE;
        // Guardar la foto en la base de datos
        $this->id= $A::saveFoto($idAlbum, $this->nombre, $this->imagen);
        if($this->id==-1)
                RETURN FALSE;
        RETURN TRUE;
    }   

    
    
}

?>

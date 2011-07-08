<?php
require_once('AlbumMapper.php');
require_once('ClassAlbum.php');
/**
 * Description of Album_Perfil
 *
 * version 1.2
 */
class Album_Perfil extends ClassAlbum {
    
    
    public function __construct(){
   if (func_num_args() == 1) {
     $this->nombre= $func_get_arg(0);
     $this->fotos= array();
   }

    if (func_num_args() == 2) {
      $this->nombre= $func_get_arg(0);
      $this->lugar= $func_get_arg(1);
      $this->fotos= array();
    }
    }
   
    /** Bueno en cada Album_entidad hay que colocar la funcion asi, se puede llamar igual solo que adentro ella 
     * llama a la funcion de la BD q le corresponda ok
     * Devuelve un arreglo asociativo con el id y el nombre de cada album
     * dado el nombre de un usuario.
     * Devuelve NULL si existi� algun error.
     * @param string $user 
     * @return array() $idsNombres
     */
    public static function getListaAlbums($user){
        $A=AlbumMapper::getInstance();
        $idsNombres=NULL;
        // Obtener la lista de id's de los albumes cuyo due�o es $user
        if($listaIds= $A->getIdsAlbumPerfil($user)){
            $idsNombres=array();
            for($i=0; $i<count($listaIds);$i++){
                $id= $listaIds[$i];
                $idsNombres[$id]=
                            $A->getNombreAlbumPerfil($id);
                if(!($idsNombres[$id]))
                    RETURN NULL;
            }
        }
        RETURN $idsNombres;
    }

    /**
     * Funci�n que crea un Album asociado a un Perfil
     * devuelve TRUE si el Album ha sido creado.
     * @param string $user
     * @return boolean 
     */    
    public function crearAlbum($user){
        $A=AlbumMapper::getInstance();
        $ok=0;
        // Si la persona ya tiene un Album con el nombre dado, concatenarle "(1)"
        while(($ok=($A::existeAlbumPerfil(this.nombre,$user))) && $ok!=-1){
            $this->nombre= $this->nombre."(1)";
        }
        if ($ok==-1)
            RETURN FALSE;
        // Guardar el Album en la base de datos
        $this->id= $A::saveAlbumPerfil($this->nombre,$this->lugar,$user);
        if($this->id==-1)
                RETURN FALSE;
        RETURN TRUE;
    }   
}

?>

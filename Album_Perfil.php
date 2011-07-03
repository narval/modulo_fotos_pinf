<?php

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
    
    public static function getListaAlbums($user){
       /**
        * Esta funcion deberia devolver la lista de albumes 
        * para ello usa los metodos de la fachadaBD
        * primero obtiene la lista getIdsAlbumPerfil()
        * y con cada id devuelto pide el nombre del album
        */
    }

    /**
     * Función que crea un Album asociado a un Perfil
     * devuelve TRUE si el Album ha sido creado.
     * @param string $user
     * @return boolean 
     */    
    public function crearAlbum($user){
        $A=AlbumMapper::getinstance();
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

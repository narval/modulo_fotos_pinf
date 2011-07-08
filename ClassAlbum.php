<?php

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
    
}

?>

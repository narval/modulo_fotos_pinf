<?php

/**
 * Description of ClassFoto
 *
 * @author jennifer DOSREIS
 */
class ClassFoto {
    private $nombre;
    private $imagen;
    
    public function __construct($nombre,$imagen) {
        $this->nombre=$nombre;
        $this->imagen= imagen;
    }
    
    public function __construct($nombre) {
        $this->nombre=$nombre;
    }
    
    public function setImagen($imagen) {
        $this->imagen = $imagen;
    }

    public function getNombre() {
        return $this->nombre;
    }

    public function getImagen() {
        return $this->imagen;
    }


    
    
}

?>

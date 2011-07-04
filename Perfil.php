<?php

class Perfil {

    private $username;
    private $password;
    private $nombre;
    private $apellido;
    private $correo;
    private $fecha_nac;
    private $listaFotos= array();
    private $foto_act;

    public function __construct($username) {
        $this->username = $username;
        $this->foto_act = 0;
    }

    public function existe() {
        $P = PerfilMapper::getinstance();
        if ($P->existePerfil($username))
            return TRUE;
        return FALSE;
    }

    public function setDatosPerfil($password, $nombre, $apellido, $correo, $fecha_nac) {
        $this->password = $password;
        $this->nombre = $nombre;
        $this->apellido = $apellido;
        $this->correo = $correo;
        $this->fecha_nac = $fecha_nac;
    }

    public function save() {
        $P = PerfilMapper::getinstance();
        if ($P->salvarPerfil($this))
            return TRUE;
        return FALSE;
    }

    /*public function crearAlbum($nombre, $lugar)  {
       listaFotos[foto_act] = Albm_Perfil($nombre, $lugar);    
    }*/

    public function getUsername() {
        return $this->username;
    }

    public function getPassword() {
        return $this->password;
    }

    public function getNombre() {
        return $this->nombre;
    }

    public function getApellido() {
        return $this->apellido;
    }

    public function getCorreo() {
        return $this->correo;
    }

    public function getFecha_nac() {
        return $this->fecha_nac;
    }

    public function setUsername($username) {
        $this->username = $username;
    }

    public function setPassword($password) {
        $this->password = $password;
    }

    public function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    public function setApellido($apellido) {
        $this->apellido = $apellido;
    }

    public function setCorreo($correo) {
        $this->correo = $correo;
    }

    public function setFecha_nac($fecha_nac) {
        $this->fecha_nac = $fecha_nac;
    }

}

?>

<?php

/**
 * Clase FotoMapper (Singleton)
 * Gestiona el acceso a la Base de Datos
 * del modulo de Fotos.
 * version 1.2
 */
require_once('../DataBase.php');
// Falta hacer los updates
class FotoMapper {

    private static $instance;
    
     /**
     * Para evitar que instancien esta clase, se crea un constructor privado
     * (Tomado del manual de php:
     *             http://php.net/manual/en/language.oop5.patterns.php)
     */
    private function __construct() {

    }

    /**
     * Evita que los usuarios clonen el objeto
     * (Tomado del manual de php:
     *             http://php.net/manual/en/language.oop5.patterns.php)
     */
    public function __clone() {
        trigger_error('No se permite la clonación de este objeto.', E_USER_ERROR);
    }
    
    /**
     * Método que garantiza que sólo habrá una instancia de esta clase, con los
     * dos métodos anteriores junto con este, se crea un "Singleton Pattern"
     * con lo cual emulamos lo que sería una clase estática (lo que en java
     * hacemos con "public static class blah {}").
     * (Tomado del manual de php:
     *             http://php.net/manual/en/language.oop5.patterns.php)
     */
    public static function getInstance() { 
        if (!isset(self::$instance)) {
            $c = __CLASS__;
            self::$instance = new $c;
        }
        return self::$instance;
    }
    
    /**
     * Función que guarda una Foto en la BD
     * devuelve el id de la foto, o -1 si existe algun error. 
     * @param string $album
     * @param string $nombre
     * @param string $imagen
     * @return int idalbum
     */
    public function saveFotoPerfil($album, $nombre, $imagen) {
        DataBase::getInstance();
        $idalbum = 0;
        // Agregar Album en la tabla Album de la BD
        $sqlQuery = "INSERT INTO pinf.foto(album, nombre, imagen) VALUES" .
                "('$album','$nombre','$imagen')";
        $queryResult = mysql_query($sqlQuery);
        // Si falló la operacion retornar -1
        // sino, guardar el ultimo id generado para Album
        if ($queryResult == FALSE) {
            return -1;
        } else {
            $idalbum = mysql_insert_id();
        }
        RETURN $idalbum;
    }
    /**
     * Función que determina si existe un Album cuyo ID es $album
     * y posee una Foto con nombre $nombre.
     * Devuelve TRUE si existe el Album, FALSE si no existe
     * y -1 si existió algun error. 
     * @param string $nombre
     * @param string $album
     * @return int 
     */
    public function existeFotoAlbum($nombre_foto,$id_album){
        DataBase::getInstance();
        $sqlQuery="SELECT A.ID
                   FROM A pinf.foto
                   WHERE '$id_album'=A.Album AND '$nombre_foto'=A.nombre";
        $queryResult = mysql_query($sqlQuery);
        if (!queryResult) {
            RETURN -1;
        }
        $row = mysql_fetch_assoc($queryResult);
        if (!($row)) {
            return FALSE;
        } else {
            return TRUE;
        } 
    }
    /** 
     * Función que devuelve un array que contiene los ID de los albumes
     * de un Perfil cuyo $user (nombre de usuario) es dado.
     * Devuelve NULL si existió algun error.
     * @param string $user
     * @return array() 
     */
    public function getIdsFotoAlbum($ID_album){
        DataBase::getInstance();
        $sqlQuery= "SELECT ID FROM pinf.foto
                    WHERE album='$ID_album'";
        $queryResult = mysql_query($sqlQuery);
         if (!$queryResult) {
            RETURN NULL;
        }
        $idsAlbum= array();
        while ($row = mysql_fetch_array($queryResult, MYSQL_ASSOC)) {
            $idsAlbum[]=$row["ID"];
        }
        RETURN $idsAlbum;
    }
    
    /** 
     * Función que recibe un id $id_foto de foto y devuelve un arreglo 
     * con el nombre y la imagen asociados con ese $id_foto.
     * Devuelve NULL si existio algun error o no existe el $id.
     * @param int $id_foto
     * @return string 
     */
    public function getNombreImagenFoto($id_foto){
        DataBase::getInstance();
        $sqlQuery= "SELECT nombre, imagen FROM pinf.Foto
                    WHERE ID='$id_foto'";
        $queryResult = mysql_query($sqlQuery);
         if (!$queryResult) {
            RETURN NULL;
        } 
        if(!($row=mysql_fetch_array($queryResult))){
            RETURN NULL;
        }
        RETURN $row;
    }
    
     public function getImagenFoto($id_foto){
        DataBase::getInstance();
        $sqlQuery= "SELECT imagen FROM pinf.Foto
                    WHERE ID='$id_foto'";
        $queryResult = mysql_query($sqlQuery);
         if (!$queryResult) {
            RETURN NULL;
        } 
        if(!($row=mysql_fetch_row($queryResult))){
            RETURN NULL;
        }
        RETURN $row[0];
    }
    
    
   
}

?>

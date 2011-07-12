<?php

/**
 * Clase FotoMapper (Singleton)
 * Gestiona el acceso a la Base de Datos
 * del modulo de Fotos.
 * version 3
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
     * @param string $idalbum
     * @param string $nombreFoto
     * @param string $imagen
     * @return int $idFoto
     */
    public function saveFoto($idalbum, $nombreFoto, $imagen) {
        DataBase::getInstance();
        $idfoto = 0;
        // Agregar Album en la tabla Album de la BD
        $sqlQuery = "INSERT INTO pinf.foto(album, nombre, imagen) VALUES" .
                "('$idalbum','$nombreFoto','$imagen')";
        
        $queryResult = mysql_query($sqlQuery);
        // Si falló la operacion retornar -1
        // sino, guardar el ultimo id generado para la foto
        if ($queryResult == FALSE) {
            return -1;
        } else {
            $idFoto = mysql_insert_id();
        }
        RETURN $idFoto;
    }
    /**
     * Función que determina si existe una Foto cuyo nombre es $nombre_foto
     * dentro de un Album cuyo ID es $id_album.
     * Devuelve TRUE si existe el Album, FALSE si no existe
     * y -1 si existió algun error. 
     * @param string $nombre_foto
     * @param string $id_album
     * @return boolean 
     */
    public function existeFotoAlbum($nombre_foto,$id_album){
        DataBase::getInstance();
        $sqlQuery="SELECT *
                   FROM pinf.Foto
                   WHERE album='$id_album' AND nombre='$nombre_foto'";
        $queryResult = mysql_query($sqlQuery);
        echo "hola";
        echo $queryResult;
        if (!($queryResult)) {
            RETURN 3;
        }
        echo $nombre_foto;
        $row = mysql_fetch_assoc($queryResult);
        
        if (!($row)) {
            return 2;
        } else {
            return 1;
        } 
    }
    /** 
     * Función que devuelve un array que contiene los ID de las fotos
     * de un Album cuyo ID es $ID_album.
     * Devuelve NULL si existió algun error.
     * @param int $ID_album
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
        $idsFotos= array();
        while ($row = mysql_fetch_array($queryResult, MYSQL_ASSOC)) {
            $idsFotos[]=$row["ID"];
        }
        RETURN $idsFotos;
    }
    
    /** 
     * Función que recibe un id $id_foto de foto y devuelve un arreglo 
     * con el nombre y la imagen asociados con ese $id_foto.
     * Devuelve NULL si existio algun error o no existe el $id.
     * @param int $id_foto
     * @return array() 
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

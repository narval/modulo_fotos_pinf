<?php

/**
 * Clase AlbumMapper (Singleton)
 * Gestiona el acceso a la Base de Datos
 * del modulo de Fotos.
 * version 1.2
 */
require_once('DataBase.php');
// Falta hacer los updates
class AlbumMapper {

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
     * Función que guarda los datos basicos del album en la BD
     * devuelve el id del album, o -1 si existe algun error. 
     * @param string $nombre
     * @param string $lugar
     * @param string $clave_dueno
     * @return int idalbum
     */
    public function saveAlbum($tipo,$nombre,$lugar,$clave_dueno){
        DataBase::getInstance();
        $idalbum = 0;
        
         // Agregar Album en la tabla Album de la BD
        $sqlQuery = "INSERT INTO pinf.Album(nombre,lugar) VALUES" .
                "('$nombre','$lugar')";
        $queryResult = mysql_query($sqlQuery);
        
        /* Si falló la operacion retornar -1
         * sino, guardar el ultimo id generado para Album */
        if ($queryResult == FALSE) {
            return -1;
        } else {
            $idalbum = mysql_insert_id();
        }
        
        $ok=FALSE;
        // Dependiendo del tipo de propietario del album asignarlo 
        switch ($tipo) {
            case 'perfil':
                $ok= saveAlbumPerfil($idalbum,$clave_dueno);
                break;

            default:
                break;
        }
        
         if ($ok) {
            return $idalbum;
        } else {
            return -1;
        }
        
    }
  
    public function saveAlbumPerfil($nombre,$usuario) {
        // Asignar el Album al Perfil dueño del mismo    
        $sqlQuerry = "INSERT INTO pinf.albumesdeperfil VALUES" .
                "('$idalbum','$usuario')";
        $queryResult = mysql_query($sqlQuery);

        if ($queryResult) {
            return TRUE;
        } else {
            return FALSE;
        }
    }
    
    public function existeAlbum($tipo,$nombre,$clave_dueno){
        DataBase::getInstance();
        $ok=FALSE;
        switch ($tipo) {
            case 'perfil':
                $ok= existeAlbumPerfil()
                break;

            default:
                break;
        }
     
    }
    /**
     * Función que determina si existe un Perfil cuyo ID es $usuario
     * y posee un Album con nombre $nombre.
     * Devuelve TRUE si existe el Album, FALSE si no existe
     * y -1 si existió algun error. 
     * @param string $nombre
     * @param string $usuario
     * @return int 
     */
    public function existeAlbumPerfil($nombre,$usuario){
        $sqlQuery="SELECT A.ID_Album 
                   FROM A pinf.Album, AP pinf.albumesdeperfil
                   WHERE A.ID=A.ID_Album AND '$user'=AP.ID_Perfil
                            AND A.nombre='$nombre'";
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
    public function getIdsAlbumPerfil($user){
        DataBase::getInstance();
        $sqlQuery= "SELECT ID_Album FROM pinf.albumesdeperfil
                    WHERE ID_Perfil='$user'";
        $queryResult = mysql_query($sqlQuery);
         if (!$queryResult) {
            RETURN NULL;
        }
        $idsAlbum= array();
        while ($row = mysql_fetch_array($queryResult, MYSQL_ASSOC)) {
            $idsAlbum[]=$row["ID_Album"];
        }
        RETURN $idsAlbum;
    }
    
    /** 
     * Función que recibe un $id de album y devuelve el nombre del album 
     * asociado con ese $id.
     * Devuelve NULL si existio algun error o no existe el $id.
     * @param int $id
     * @return string 
     */
    public function getNombreAlbumPerfil($id){
        DataBase::getInstance();
        $sqlQuery= "SELECT nombre FROM pinf.album
                    WHERE ID='$id'";
        $queryResult = mysql_query($sqlQuery);
         if (!$queryResult) {
            RETURN NULL;
        } 
        if(!($row=mysql_fetch_row($queryResult))){
            RETURN NULL;
        }
        RETURN $row[0];
    }
    
    
    public function saveAlbumGrupo($nombre, $lugar, $idgrupo) {
        DataBase::getInstance();
// Agregar Album en la tabla Album de la BD
        $sqlQuery = "INSERT INTO pinf.Album(nombre,lugar) VALUES" .
                "('$nombre','$lugar')";
        $queryResult = mysql_query($sqlQuery);
// Si falló la operacion retornar -1
// sino, guardar el ultimo id generado para Album
        $idalbum = 0;
        if ($queryResult == FALSE) {
            return -1;
        } else {
            $idalbum = mysql_insert_id();
        }

// Asignar el nuevo Album al Grupo dueño del mismo    
        $sqlQuerry = "INSERT INTO pinf.grupo_album VALUES" .
                "('$idgrupo',LAST_INSERT_ID())";
        $queryResult = mysql_query($sqlQuery);

        if ($queryResult == FALSE) {
            return -1;
        } else {
            return $idalbum;
        }
    }

    public function saveAlbumEvento($nombre, $lugar, $idevento) {
        DataBase::getInstance();
// Agregar Album en la tabla Album de la BD
        $sqlQuery = "INSERT INTO pinf.Album(nombre,lugar) VALUES" .
                "('$nombre','$lugar')";
        $queryResult = mysql_query($sqlQuery);
// Si falló la operacion retornar -1
// sino, guardar el ultimo id generado para Album
        $idalbum = 0;
        if ($queryResult == FALSE) {
            return -1;
        } else {
            $idalbum = mysql_insert_id();
        }

// Asignar el nuevo Album al Evento dueño del mismo    
        $sqlQuerry = "INSERT INTO pinf.evento_album VALUES" .
                "('$idevento', LAST_INSERT_ID())";
        $queryResult = mysql_query($sqlQuery);

        if ($queryResult == FALSE) {
            return -1;
        } else {
            return $idalbum;
        }
    }

    public function saveAlbumNoticia($nombre, $lugar, $idnoticia) {
        DataBase::getInstance();
// Agregar Album en la tabla Album de la BD
        $sqlQuery = "INSERT INTO pinf.Album(nombre,lugar) VALUES" .
                "('$nombre','$lugar')";
        $queryResult = mysql_query($sqlQuery);
// Si falló la operacion retornar -1
// sino, guardar el ultimo id generado para Album
        $idalbum = 0;
        if ($queryResult == FALSE) {
            return -1;
        } else {
            $idalbum = mysql_insert_id();
        }

// Asignar el nuevo Album a la Noticia dueña del mismo    
        $sqlQuerry = "INSERT INTO pinf.noticia_album VALUES" .
                "('$idnoticia',LAST_INSERT_ID())";
        $queryResult = mysql_query($sqlQuery);

        if ($queryResult == FALSE) {
            return -1;
        } else {
            return $idalbum;
        }
    }

    public function saveFotoMuro($idalbum, $nombre, $imagen, $idmuro) {
        DataBase::getInstance();
// Agregar la Foto en la tabla Foto de la BD 
        $sqlQuery = "INSERT INTO pinf.foto(album,nombre,imagen) VALUES" .
                "('$idalbum','$nombre','$imagen')";
        $queryResult = mysql_query($sqlQuery);
        $idfoto = 0;
        if ($queryResult == FALSE) {
            return -1;
        } else {
            $idfoto = mysql_insert_id();
        }

// Asignar la nueva foto al Muro dueño de ella
        $sqlQuery = "INSERT INTO pinf.murotienefoto VALUES" .
                "('$idmuro',LAST_INSERT_ID())";
        $queryResult = mysql_query($sqlQuery);

       if ($queryResult == FALSE) {
            return -1;
        } else {
            return $idfoto;
        }
    }

}

?>

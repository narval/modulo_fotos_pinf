<?php

/**
 * Clase AlbumMapper (Singleton)
 * Gestiona el acceso a la Base de Datos
 * del modulo de Fotos.
 * version 1.2
 */
require_once('../DataBase.php');
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
            case 'grupo':
                $ok= saveAlbumGrupo($idalbum,$clave_dueno);
                break;
            case 'evento':
                $ok= saveAlbumEvento($idalbum,$clave_dueno);
                break;
            case 'noticia':
                $ok= saveAlbumNoticia($idalbum,$clave_dueno);
                break;
            default:
                echo "No existe ese tipo de entidad para la funcion saveAlbum";
                break;
        }
        
        if ($ok) {
            return $idalbum;
        } else {
            return -1;
        }
        
    }
  
    public function saveAlbumPerfil($idalbum,$usuario) {
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
        public function saveAlbumGrupo($idalbum,$idgrupo) {
        // Asignar el nuevo Album al Grupo dueño del mismo    
        $sqlQuerry = "INSERT INTO pinf.grupo_album VALUES" .
                "('$idgrupo','$idalbum')";
        $queryResult = mysql_query($sqlQuery);

         if ($queryResult) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function saveAlbumEvento($idalbum, $idevento) {
        // Asignar el nuevo Album al Evento dueño del mismo    
        $sqlQuerry = "INSERT INTO pinf.evento_album VALUES" .
                "('$idevento', '$idalbum')";
        $queryResult = mysql_query($sqlQuery);

         if ($queryResult) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function saveAlbumNoticia($idalbum, $idnoticia) {
        // Asignar el nuevo Album a la Noticia dueña del mismo    
        $sqlQuerry = "INSERT INTO pinf.noticia_album VALUES" .
                "('$idnoticia','$idalbum')";
        $queryResult = mysql_query($sqlQuery);

       if ($queryResult) {
            return TRUE;
        } else {
            return FALSE;
        }
    }
    
    /**
     * Función que determina si existe un ente cuyo ID es $uclave_dueno
     * y posee un Album con nombre $nombre.
     * Devuelve TRUE si existe el Album, FALSE si no existe
     * y -1 si existió algun error. 
     * @param string $tipo es "perfil" "grupo" "evento" "noticia"...
     * @param string $nombre
     * @param string $usuario
     * @return int 
     */
    public function existeAlbum($tipo,$nombre,$clave_dueno){
        DataBase::getInstance();
        $ok=FALSE;
        switch ($tipo) {
            case 'perfil':
                $ok= existeAlbumPerfil($nombre,$clave_dueno);
                break;

            default:
                break;
        }
     RETURN $ok;
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
     * de una entidad cuyo ID o clave es dado.
     * Devuelve NULL si existió algun error.
     * @param string $user
     * @return array() 
     */
    public function getIdsAlbum($tipo,$clave){
        DataBase::getInstance();
        $tabla= "";
        $tipo_clave= "";
        switch ($tipo) {
            case "perfil":
                $tabla= "pinf.albumesdeperfil";
                $tipo_clave="ID_Perfil";
                break;
            case 'grupo':
                $tabla= "pinf.grupo_album";
                $tipo_clave="ID_Grupo";
                break;
            case 'evento':
                $tabla= "pinf.evento_album";
                $tipo_clave="ID_Evento";
                break;
            case 'noticia':
                $tabla= "pinf.noticia_album";
                $tipo_clave="ID_Noticia";
                break;
            default:
                echo "No existe ese tipo de entidad para la funcion getIds";
                break;
        }
        $sqlQuery= "SELECT ID_Album FROM ".$tabla."
                    WHERE ".$tipo_clave."='$clave'";
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
    public function getNombreAlbum($id){
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

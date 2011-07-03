<?php

/**
 * Clase AlbumMapper (Singleton)
 * Gestiona el acceso a la Base de Datos
 * del modulo de Fotos.
 * version 1.0
 */
// Falta hacer los updates
class AlbumMapper {

    private static $instance;

    private function __construct() {
        
    }
    /**
     * 
     */
    public static function getInstance() { //metodo Singleton
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
     * @param string $usuario
     * @return int idalbum
     */
    public function saveAlbumPerfil($nombre, $lugar, $usuario) {
        DataBase::singleton();
        $idalbum = 0;
        // Agregar Album en la tabla Album de la BD
        $sqlQuery = "INSERT INTO pinf.Album(nombre,lugar) VALUES" .
                "('$nombre','$lugar')";
        $queryResult = mysql_query($sqlQuery);
        // Si falló la operacion retornar -1
        // sino, guardar el ultimo id generado para Album
        if ($queryResult == FALSE) {
            return -1;
        } else {
            $idalbum = mysql_insert_id();
        }

        // Asignar el nuevo Album al Perfil dueño del mismo    
        $sqlQuerry = "INSERT INTO pinf.albumesdeperfil VALUES" .
                "('$idalbum','$usuario')";
        $queryResult = mysql_query($sqlQuery);

        if ($queryResult == FALSE) {
            return -1;
        } else {
            return $idalbum;
        }
    }
    /**
     * Función que determina si existe un Perfil cuyo ID es $usuario
     * y posee un Album con nombre $nombre
     * si 
     * @param string $nombre
     * @param string $usuario
     * @return int 
     */
    public function existeAlbumPerfil($nombre,$usuario){
        DataBase::singleton();
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
    
    public function saveAlbumGrupo($nombre, $lugar, $idgrupo) {
        DataBase::singleton();
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
        DataBase::singleton();
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
        DataBase::singleton();
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
        DataBase::singleton();
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

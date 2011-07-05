<?php
/**
 * Clase Singleton usada para la coneccion a la Base de datos
 * con solo configurar los atributos segun el servidor mysql que
 * cada quien este usando y cada vez que se quiera hacer uso de 
 * la base de datos, sólo es necesario escribir: DataBase::getInstance() 
 */

class DataBase {

    private static $instance; // Representa la unica instancia de esta clase
    private $db = "Pinf";         // Estos valores deben ser cambiados manual-
    private $usr = "root";        // mente por los correspondientes al servidor
    private $passwd = ""; // mysql que cada quien esté usando. Estos
    private $host = "127.0.0.1"; // son los valores por default.
    private $link;               // Almacena el identificador de la conexión

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
            $inst = new $c;
            $inst->link = $inst->connect();
            self::$instance = $inst;
        }
        return self::$instance;
    }

    public function __destruct() {
        mysql_close($this->link);
    }

    /**
     * Se encarga de crear la conexión a la base de datos. No recibe ningún
     * parámetro.
     */
    private function connect() {
        $this->link = @mysql_connect($this->host, $this->usr, $this->passwd) or
                die("Problemas al conectarse a la base de datos");
        @mysql_select_db($this->db, $this->link) or
                die("Problemas al seleccionar la base de datos");
        return $this->link;
    }

    /**
     * Devuelve el recurso identificador de la conexión a la base de datos.
     */
    public function getId() {
        return $this->link;
  }
}

?>

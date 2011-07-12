<html>
    Hola!
<?php
include("../Clases/classAlbum");

if (isset($_POST["upload"])) {
    $nombreFoto = $_FILES['userfile']['name'];
    $tmpName = $_FILES['userfile']['tmp_name'];
    $fp = fopen($tmpName, 'r');
    $content = fread($fp, filesize($tmpName));
    $content = addslashes($content);
    fclose($fp);

    if (!get_magic_quotes_gpc()) {
        $nombreFoto = addslashes($nombreFoto);
    }
    $album= new ClassAlbum($_POST["id_album"]);
    
}
?>

</html>

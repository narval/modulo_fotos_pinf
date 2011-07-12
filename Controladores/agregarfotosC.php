<html>
    
<?php
include("../Clases/classAlbum.php");

if (isset($_POST["upload"])) {
    $nombreFoto = $_FILES['foto']['name'];
    $tmpName = $_FILES['foto']['tmp_name'];
    $fp = fopen($tmpName, 'r');
    $content = fread($fp, filesize($tmpName));
    $content = addslashes($content);
    fclose($fp);

    if (!get_magic_quotes_gpc()) {
        $nombreFoto = addslashes($nombreFoto);
    }
    $album= new ClassAlbum($_POST["id_album"]);
    $album->agregarFoto($nombreFoto, $content);
    
}
?>

</html>

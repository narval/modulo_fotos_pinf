<html>
<?php
include('../formatoPagina/encabezado.php');
?>
    <form enctype="multipart/form-data" action="uploader.php" method="POST">
    <input type="hidden" name="MAX_FILE_SIZE" value="300000" />
    <?php
    //echo "<input type=hidden name=ID_Album value='$_GET["id"]' />";
    ?>
    Choose a file to upload: <input name="uploadedfile" type="file" /><br />
    <input type="submit" value="Upload File" />
    </form>
  

</html>


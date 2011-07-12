<html>
    <?php
    include('../formatoPagina/encabezado.php');
    ?>
    <form enctype="multipart/form-data" action="../Controladores/agregarfotosC.php" method="POST">
        <input type="hidden" name="MAX_FILE_SIZE" value="300000000" />
        <?php
        echo "<input type=hidden name=id_album value=" . $_GET['id'] . " />";
        ?>
        Choose a file to upload: <input name="foto" type="file" /><br />
        <input type="submit" name="upload" value="Upload File" />
    </form>


</html>


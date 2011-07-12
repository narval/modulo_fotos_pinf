<html>
<?php
echo
    "<form enctype=multipart/form-data action="uploader.php" method="POST">
    <input type="hidden" name="MAX_FILE_SIZE" value="300000" />
    <input type="hidden" name="ID_Album" value="300000" />
    Choose a file to upload: <input name="uploadedfile" type="file" /><br />
    <input type="submit" value="Upload File" />
    </form>";
 ?>   

</html>


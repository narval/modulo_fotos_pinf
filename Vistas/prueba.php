<?php
session_name("Fotos");
session_start();
header("Content-type: image/jpg");
print $_SESSION["var".$_GET["id"].""]; 
?>

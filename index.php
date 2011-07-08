<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

        <title></title>
    </head>
    <body>
        <?php
        session_name('usuario');
        session_start();
  //      echo $_SESSION['usuario'];
        $lista=$_SESSION['fotos'];
  //      echo $_SESSION['hola'];
        if(!isset($lista)) echo "no seteada";
        //echo "<html><head><meta http-equiv='refresh' content='0; URL=./FotosController.php?id=3'></head></html>";
   //     echo $lista[1];
        
        ?>
    </body>
</html>

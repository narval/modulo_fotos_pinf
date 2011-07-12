<!-- 
  En este documento se encuentra el esqueleto de las paginas para la red social PINF.
  Lo unico que deben tener presente es que las rutas de los include deben ser relativas,
  por ende, para cada archivo que generen, deben cambiar la ruta para hacer que lleguen
  al archivo correspondiente ubicado en localhost/rspinf.usb/formatoPagina/
-->

<?php include('encabezado.php') ?>
<!-- Incluir aqui todos los JavaScript que utiicen en la pagina -->
<?php include('menu.php') ?>
<!-- Incluir todas las validaciones de usuarios necesarias -->
<?php include('inicioBL.php') ?>
<!-- Aqui deben incluir el codigo que deseen que aparezca en la barra lateral-->
<?php include('finBL.php') ?>
<?php include('inicioContenido.php') ?>
<!-- Aqui va el contenido del panel principal-->
<?php include('finContenido.php') ?>

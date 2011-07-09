<html>
  <head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <title>Cacatua por Manghoo</title>
    <link href="style.css" rel="stylesheet" type="text/css" media="screen" />
  </head>
  <body>
    <div id="wrapper">
      <div id="encab">
	<div id="logo">
	  <h1><a href="#">Pinf </a></h1>
	  <p>por Roraima</p>
	</div>
	<div id="busq">
	  <form method="get" action="">
	    <fieldset>
	      <input type="text" name="s" id="busq-texto" size="15" value="Buscar álbum" />
	      <input type="submit" id="busq-enviar" value="GO" />
	    </fieldset>
	  </form>
	</div>
      </div>
      <!-- fin #encab -->
      <div id="pag">
	<div id="pag-bgarriba">
	  <div id="pag-bgabajo">
	    <div id="menu">
	      <ul>
		<li><a href="http://localhost:8080/web/home.html">Inicio</a></li>
		<li><a href="http://localhost:8080/web/perfil.html">Perfil</a></li>
		<li><a href="http://localhost:8080/web/enConstruccion.html">Amigos</a></li>
		<li><a href="http://localhost:8080/web/enConstruccion.html">Fotos</a></li>
		<li class="current_page_item"><a href="#">Eventos</a></li>
		<li><a href="http://localhost:8080/web/buscar.html">Buscar</a></li>
	      </ul>
	    </div>
	    <!-- fin #menu -->
            <div id="contenido">
                <h2 class="title"><a href="a">Albumes </a></h2>
               <div class="post">
            <?php
            session_start();
            $lista= $_SESSION["fotos"];
                //require_once('FotosController.php');             
                $tam = count($lista);
                
                if($tam == 0){
                    echo "albumes vacios";
                } else{
                      
                    
                    
                    echo "<table>";
                    $j = 1;                    
                    foreach($lista as $id => $nombre){                                               
                        if ($j == 1) echo "<tr>"; // fila general{
                        echo "<td>"; // columna elemento
                        echo "<table>";
                        echo "<tr>"; // fila imagen
                                echo "<td>"; // columna imagen
                                    echo "<a  href=FotosController.php?opt=fotos&id=";
                                    echo $id;
                                    echo "&nombre=";
                                    echo $nombre;
                                    echo ">";
                                    echo "<img src=images/folder.png width=80 height=80 alt= />";
                                    echo "</a>";                                    
                                echo "</td>";
                            echo "</tr>";
                            echo "<tr>"; //fila de nombre
                                echo "<td>"; //columna nombre
                                    echo "<a  href=FotosController.php?opt=fotos&id=";
                                    echo $id;
                                    echo "&nombre=";
                                    echo $nombre;
                                    echo ">";
                                    echo "<p style=\"text-align: center\";>";
                                    echo $nombre;
                                    echo "</p>";
                                    echo "</a>"; 
                                echo "</td>";
                            echo "</tr>";
                            
                        echo "</td>";
                        echo "</table>";
                        $j++; 
                        if ($j == 7){
                            echo "</tr>";
                            $j = 1;
                        }                            
                    }
                    if (count($lista) % 7 != 0) echo "</tr>";
                    echo "</table>";
                            
                }
            ?> 
               </div>
            
            
	    </div>
	    <!-- fin #content -->
	    <div id="barlateral">
                <ul>
                    <li>
                        <h2>Opciones</h2>
                        <ul>
                            <li><a href="http://localhost:8080/web/enConstruccion.html">Agregar Album</a></li>
                         </ul>
                    </li>
                </ul>
	    </div>
	    <!-- fin #barlateral -->
	    <div style="clear: both;">&nbsp;</div>
	  </div>
	</div>
      </div>
      <!-- fin #pag -->
    </div>
    <div id="pie-wrapper">
      <div id="pie">
	<p><a href="http://localhost:8080/web/home.html">Inicio&nbsp;&nbsp;&nbsp;</a>
		<a href="http://www.usb.ve/">USB&nbsp;&nbsp;&nbsp;</a>
		<a href="http://www.dace.usb.ve/">DACE&nbsp;&nbsp;&nbsp;</a>
		<a href="http://www.generales.usb.ve/">Estudios Generales&nbsp;&nbsp;&nbsp;</a>
		<a href="http://asignaturas.usb.ve/">Aula Virtual</a>
		<a href="http://localhost:8080/web/enConstruccion.html">Salir</a><br><br>
		Diseñado por Manghoo!</p>
      </div>
    </div>
    <!-- fin #pie -->
  </body>
</html>

<html>
  <head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <title>Pinf</title>
    <link href="style.css" rel="stylesheet" type="text/css" media="screen" />
  </head>
  <body>
    <div id="wrapper">
      <div id="encab">
	<div id="logo">
	  <h1><a href="#">Pinf </a></h1>
	  
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
              <?php  
                session_start();
                /*
                $listaF= $_SESSION["listaFotos"];
                $nombre= $_SESSION["nombreAlbum"];
                $id= $_SESSION["idAlbum"];
                */
                $numero = count($_GET); 
                $tags = array_keys($_GET);// obtiene los nombres de las varibles
                $valores = array_values($_GET);// obtiene los valores de las varibles

                // crea las variables y les asigna el valor
                for($i=0;$i<$numero;$i++){
                $$tags[$i]=$valores[$i];
                }
                
              echo "<h2 class=title>";
              echo $nombre;
              echo "</h2>";
              
              echo "<div class=\"post\">";
            
                require_once("../Fachadas/FotosFachada.php");
                $F=FotosFachada::getInstance();
                $listaF=$F->getNombresFotos($id);
                
                $tam = count($listaF);
                if($tam == 0){
                    echo "albumes vacios";
                } else{
                    echo $listaF[3]["nombre"];
                    
                    
                    echo "<table>";
                    $j = 1;                    
                    foreach($listaF as $id => $nombre){
                    //    $nombre[1] = $nombre[1].".jpg\"";
                        
                    //    $image = mysql_fetch_assoc($nombre[1]);
                    //    header("Content-type: $nombre[1]");
                    //     echo $nombre[1];
                        if ($j == 1) echo "<tr>"; // fila general{
                        echo "<td>"; // columna elemento
                        echo "<table>";
                        echo "<tr>"; // fila imagen
                                echo "<td>"; // columna imagen
                                    echo "<a  href=fotos.php?id=$id&nombre=$nombre[0]>";
                                    echo "<img src=fotos/$id.jpg width=80 height=80 alt= />";
                                    echo "</a>";                                    
                                echo "</td>";
                            echo "</tr>";
                            echo "<tr>"; //fila de nombre
                                echo "<td>"; //columna nombre
                                    echo "<a  href=fotos.php?id=$id&nombre=$nombre>";
                                    echo "<p style=\"text-align: center\";>";
                                    echo $nombre[0];
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
                    if (count($listaF) % 7 != 0) echo "</tr>";
                    echo "</table>";
                            
                }
            ?> 
               </div>
            
            
	    </div>
            
            <!--
	    
	      
	      
		<h3 class="title"><a href="http://localhost:8080/web/album.html">"Nombre del �?lbum" </a></h3>
		<p class="meta">�?lbum: <a href="http://localhost:8080/web/enConstruccion.html">"Nuemro de fotos"</a> 
		  &nbsp;&bull;&nbsp; <a href="#" class="comments">Fecha de creacion: 04/04/04</a></p>
		
		
		  <td> <img src="images/chavo.jpg" width="80" height="80" alt="" /></td>
		  <td> <img src="images/fotito1.jpg" width="80" height="80" alt="" /></td>
		  <td> <img src="images/fotito2.jpg" width="80" height="80" alt="" /></td>
		  <td> <img src="images/fotito3.jpg" width="80" height="80" alt="" /></td>
		  <td> <img src="images/fotito4.jpg" width="80" height="80" alt="" /></td>
		  <td> <img src="images/fotito.jpg" width="80" height="80" alt="" /></td>
		  <td> <img src="images/fotito2.jpg" width="80" height="80" alt="" /></td>
		</tr>
		<tr>
		  <td> <img src="images/fotito1.jpg" width="80" height="80" alt="" /></td>
		  <td> <img src="images/fotito2.jpg" width="80" height="80" alt="" /></td>
		  <td> <img src="images/fotito3.jpg" width="80" height="80" alt="" /></td>
		  <td> <img src="images/fotito4.jpg" width="80" height="80" alt="" /></td>
		  <td> <img src="images/fotito.jpg" width="80" height="80" alt="" /></td>
		  <td> <img src="images/fotito1.jpg" width="80" height="80" alt="" /></td>
		  <td> <img src="images/fotito2.jpg" width="80" height="80" alt="" /></td>
		</tr>
		<tr>
		  <td> <img src="images/fotito2.jpg" width="80" height="80" alt="" /></td>
		  <td> <img src="images/fotito3.jpg" width="80" height="80" alt="" /></td>
		  <td> <img src="images/fotito4.jpg" width="80" height="80" alt="" /></td>
		  <td> <img src="images/fotito.jpg" width="80" height="80" alt="" /></td>
		  <td> <img src="images/Krishnamurti.jpg" width="80" height="80" alt="" /></td>
		  <td> <img src="images/fotito2.jpg" width="80" height="80" alt="" /></td>
		  <td> <img src="images/fotito3.jpg" width="80" height="80" alt="" /></td>
		</tr>
		<tr>
		  <td> <img src="images/fotito4.jpg" width="80" height="80" alt="" /></td>
		  <td> <img src="images/fotito.jpg" width="80" height="80" alt="" /></td>
		  <td> <img src="images/fotito1.jpg" width="80" height="80" alt="" /></td>
		  <td> <img src="images/fotito2.jpg" width="80" height="80" alt="" /></td>
		  <td> <img src="images/fotito3.jpg" width="80" height="80" alt="" /></td>
		  <td> <img src="images/fotito4.jpg" width="80" height="80" alt="" /></td>
		  <td> <img src="images/fotito2.jpg" width="80" height="80" alt="" /></td>
		</tr>
	      </table>
			<p> Anteriores&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Siguientes </p>
		  <h4 class="title"> �?lbunes: </h4>
			<table>
				<tr>
				<td><img src="images/folder1.png" width="100" height="100" alt=""/></td>
				<td><img src="images/folder1.png" width="100" height="100" alt=""/></td>
				<td><img src="images/folder1.png" width="100" height="100" alt=""/></td>
				<td><img src="images/folder1.png" width="100" height="100" alt=""/></td>
				<td><img src="images/folder1.png" width="100" height="100" alt="algo"/></td>
				<td> Más �?lbunes </td>
				</tr>
			</table>
		<div class="entry">
		  
		  
		</div>
	      </div>
	      
	      <div style="clear: both;">&nbsp;</div>
            -->
	    </div>
	    <!-- fin #content -->
	    <div id="barlateral">
	      <ul>
		<li>
		  <h2>Opciones</h2>
                </li>
              </ul>
		  <ul>
		    <li><a href="http://localhost:8080/web/enConstruccion.html">Editar datos del Album</a></li>
                    <li><a href="http://localhost:8080/web/enConstruccion.html">Agregar fotos</a></li>
		    <li><a href="http://localhost:8080/web/enConstruccion.html">Borrar foto</a></li>
		    <li><a href="http://localhost:8080/web/enConstruccion.html">Descargar Album </a></li>
		  </ul>
		
                <h2>Personas en este Album</h2> 
			<div>
				<ul>
				 <li><a href="http://localhost:8080/web/enConstruccion.html">María Antonieta De Las Nieves</a></li>
				 <li><a href="http://localhost:8080/web/enConstruccion.html">Jiddu Krishnamurti</a></li>
				 <li><a href="http://localhost:8080/web/enConstruccion.html">Roberto Gómez Bolaños</a></li>
				 <li><a href="http://localhost:8080/web/enConstruccion.html">Carlos Villagran</a></li>
				 <li><a href="http://localhost:8080/web/enConstruccion.html">Ver más personas</a></li>
				</ul>
			</div>
	    </div>
	    <!-- fin #barlateral -->
	    <div style="clear: both;">&nbsp;</div>
	  </div>
	</div>
      <!-- fin #pag -->
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

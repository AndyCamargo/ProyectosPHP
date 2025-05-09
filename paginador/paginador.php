<html>

	<head>
		<title>Paginador</title>
	</head>

	<body>
		<?php
		    //primero obtenemos el parametro que nos dice en que pagina estamos
		    $page = 1; //inicializamos la variable $page a 1 por default
		    if(array_key_exists('pg', $_GET)){
		        $page = $_GET['pg']; //si el valor pg existe en nuestra url, significa que estamos en una pagina en especifico.
		    }
		    //ahora que tenemos en que pagina estamos obtengamos los resultados:
		    // a) el numero de registros en la tabla
			
		    $mysqli = new mysqli("localhost","root","","sg_modulo_vivienda");
		    if ($mysqli->connect_errno) {
				printf("Connect failed: %s\n", $mysqli->connect_error);
				exit();
			}


		    $conteo_query =  $mysqli->query("SELECT  COUNT(*) AS conteo FROM seguridad a,sg_mv_rol b WHERE a.id_rol=b.id_rol ORDER BY a.fecha;");
		    $conteo = "";
		    if($conteo_query){
		    	while($obj = $conteo_query->fetch_object()){ 
		    	 	$conteo =$obj->conteo; 
		    	}
		    }
		    $conteo_query->close(); 
		    unset($obj); 
    		
		    //ahora dividimos el conteo por el numero de registros que queremos por pagina.
		    $max_num_paginas = intval($conteo/10); //en esto caso 10
			
		    // ahora obtenemos el segmento paginado que corresponde a esta pagina
			
			
			
		    $segmento = $mysqli->query(" SELECT a.fecha,a.cedula,a.nombre_usuario,a.apellido,a.puesto,b.rol,a.tabla,a.antes,a.ahora,a.accion
 FROM seguridad a,sg_mv_rol b WHERE a.id_rol=b.id_rol ORDER BY a.fecha LIMIT ".(($page-1)*10).", 10 ");

		    //ya tenemos el segmento, ahora le damos output.
		    if($segmento){
			    echo '<table>';
				echo "<table border='1' align='center'>";
					      echo "<tr bgcolor='#CCCCCC'>";
					      echo"<td><b>fecha Modificacion</b></td>";
					      echo"<td><b>Cedula</b></td>";
					      echo"<td><b>Nombre</b></td>";
					      echo"<td><b>Apellido</b></td>";
					      echo"<td><b>Puesto</b></td>";
					      echo"<td><b>Rol</b></td>";
					      echo"<td><b>Tabla BD</b></td>";
					      echo"<td><b>Antes</b></td>";
					      echo"<td><b>Ahora</b></td>";
					      echo"<td><b>Accion</b></td>";
					     
			    while($obj2 = $segmento->fetch_object())
			    {
			       echo '<tr>
			                   <td>'.$obj2->fecha.'</td>
			                   <td>'.$obj2->cedula.'</td>
			                   <td>'.$obj2->nombre_usuario.'</td>
							   <td>'.$obj2->apellido.'</td>
			                   <td>'.$obj2->puesto.'</td>
			                   <td>'.$obj2->rol.'</td>
							   <td>'.$obj2->tabla.'</td>
							   <td>'.$obj2->antes.'</td>
			                   <td>'.$obj2->ahora.'</td>
			                   <td>'.$obj2->accion.'</td>
			             </tr>'; 
			    }
			    echo '</table><br/><br/>';
			}
	
		    //ahora viene la parte importante, que es el paginado
		    //recordemos que $max_num_paginas fue previamente calculado.
		    for($i=0; $i<$max_num_paginas;$i++){
		       echo '<a href="paginador.php?pg='.($i+1).'">'.($i+1).'</a> | ';
		    }      
		?>

	</body>

</html>
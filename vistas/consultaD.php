<?php 

include_once '../includes/user.php';
include_once '../includes/user_session.php';


$userSession = new UserSession();
$user = new User();
/////// CONEXIÓN A LA BASE DE DATOS /////////
function conn(){
	$host = 'localhost';
	$basededatos = 'ahn_db';
	$usuario = 'root';
	$contraseña = '';
	
	$conexion = new mysqli($host, $usuario,$contraseña, $basededatos);
	if ($conexion -> connect_errno)
	{
		die("Fallo la conexion:(".$conexion -> mysqli_connect_errno().")".$conexion-> mysqli_connect_error());
	}
	return $conexion;
}

$sql2 = "SELECT user_cedula  FROM usuarios";
$result2 = mysqli_query(conn(), $sql2);
$arregloUsuarios=array();
while($row2 = mysqli_fetch_array($result2, MYSQLI_ASSOC)){
	array_push($arregloUsuarios,$row2["user_cedula"]);
}


//////////////// VALORES INICIALES ///////////////////////
$tabla="";
$query="SELECT * FROM documento ORDER BY doc_id LIMIT 10";
$rol= $_SESSION['Rol'];
$ceduser=$_SESSION['User'];

$sucursal="";




///////// LO QUE OCURRE AL TECLEAR SOBRE EL INPUT DE BUSQUEDA ////////////
if(isset($_POST['equipo']))
{
	$q=conn()->real_escape_string($_POST['equipo']);
	$query="SELECT * FROM documento WHERE 
		doc_id LIKE '%".$q."%' OR
		doc_est LIKE '%".$q."%' OR
		doc_estanteria LIKE '%".$q."%' OR
		doc_columna LIKE '%".$q."%' OR
		doc_nivel LIKE '%".$q."%' OR
		doc_fondo LIKE '%".$q."%' OR
		doc_seccion LIKE '%".$q."%' OR
		doc_serie LIKE '%".$q."%' OR
		doc_cajas LIKE '%".$q."%' OR
		doc_volumen LIKE '%".$q."%' OR
		doc_fecha LIKE '%".$q."%' OR
		doc_estado LIKE '%".$q."%' OR
		doc_cedula_pk LIKE '%".$q."%' OR
		doc_nota LIKE '%".$q."%' ";
	}

$buscarAlumnos=conn()->query($query);
if ($buscarAlumnos->num_rows > 0)
{
	$tabla.= 
	'	<div class="table-responsive">
	<table class="table table-hover"  >
		<tr>';
		
		$tabla.= 
	'
		<th>Repositorio</th>
		<th>Estanteria</th>
		<th>Columna</th>
		<th>Nivel</th>
		<th>Fondo</th>
		<th>Seccion</th>
		<th>Serie</th>
		<th>Caja</th>
		<th>Volumen</th>
		<th>Fecha Inicio</th>
		<th>Fecha Fin</th>
		<th>Estado</th>';
		
	
		if($rol==1){
			$tabla .= '	
		<th>Usuario</th>';
	}
	$tabla .= '
		<th>Nota</th>';
		if($rol==1){
			$tabla .= '	
				
				<th colspan="3">Acciones</th>';
				}else{
					$tabla .= '	
				
				<th colspan="3">Detalles</th>';
				}
	
		
				$tabla .= '</tr> ';

	while($row= $buscarAlumnos->fetch_assoc())
	{
		$d_del = "del/" . $row['doc_id'];
			$d_del_final = base64_encode($d_del);
			$d_act = "act/" . $row['doc_id'];
			$d_act_final = base64_encode($d_act);
			$d_det = "det/" . $row['doc_id'];
			$d_det_final = base64_encode($d_det);		
			
			
			

				$tabla .= '	<tr>
					<td>' . $row['doc_id'] . '</td>
					<td>' . $row['doc_estanteria'] . '</td>
					<td>' . $row['doc_columna'] . '</td>
					<td>' . $row['doc_nivel'] . '</td>
                    <td>' . $row['doc_fondo'] . '</td>
					<td>' . $row['doc_seccion'] . '</td>
					<td>' . $row['doc_serie'] . '</td>
					<td>' . $row['doc_cajas'] . '</td>
					<td>' . $row['doc_volumen'] . '</td>
					<td>' . $row['doc_fecha'] . '</td>
					<td>' . $row['doc_fechafin'] . '</td>
					<td>' . $row['doc_estado'] . '</td>
										';
		
				
		if($rol==1){
			$tabla .= '	
			
					<td>
					' . $row['doc_cedula_pk'] . '</td>';
					/*<select class="form-control" id="controlBuscador" name="Usuario"    onchange="actualizacion2(this.value,' .$row["doc_id"] . ')">
						<option value="NULL">Disponible</option>
						<option value="M">Conservación</option>';
					/*	foreach ($arregloUsuarios as $i => $value) {

							if ($arregloUsuarios[$i] == $row['doc_cedula_pk']) {
								$tabla .= '<option value="' . $arregloUsuarios[$i] . '" selected >' . $arregloUsuarios[$i] . ' </option>';
							} else {
								$tabla .= '<option value="' . $arregloUsuarios[$i] . '">' . $arregloUsuarios[$i] . '</option>';
							}
						}

					$tabla .= '		</select>
						</td>';*/
					}
					$tabla .= '
					<td>' . $row['doc_nota'] . '</td>';
                   
					if($row['doc_estado']=="Disponible" AND $rol==3 ){
						
						$tabla .= '	
							<td><a href="index.php?op=1&d=' . $d_det_final . '">
								Solicitar
							</a>
						
							</td>
							
							
							';
						
				}elseif($row['doc_estado']=="Ocupado" AND $rol==3 AND $row['doc_cedula_pk']==$ceduser){
						
					$tabla .= '	
						<td><a href="index.php?op=1&d=' . $d_det_final . '">
							Devolver
						</a>
					
						</td>
						
						
						';
					
				}else{
						$tabla .= '
					
						<td><a href="index.php?op=1&d=' . $d_det_final . '">
						<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-journal-text" viewBox="0 0 16 16">
						<path d="M5 10.5a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 0 1h-2a.5.5 0 0 1-.5-.5zm0-2a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5zm0-2a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5zm0-2a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5z"/>
						<path d="M3 0h10a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2v-1h1v1a1 1 0 0 0 1 1h10a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H3a1 1 0 0 0-1 1v1H1V2a2 2 0 0 1 2-2z"/>
						<path d="M1 5v-.5a.5.5 0 0 1 1 0V5h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1H1zm0 3v-.5a.5.5 0 0 1 1 0V8h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1H1zm0 3v-.5a.5.5 0 0 1 1 0v.5h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1H1z"/>
						</svg>
						</a></td>
						';
					}
					
					if($rol==1){
				$tabla .= '	
					<td><a href="index.php?op=1&d=' . $d_act_final . '">
					<svg xmlns="http://www.w3.org/2000/svg"  width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
					<path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
					<path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
					</svg>
					</a></td>
					<td><a href="index.php?op=1&d=' . $d_del_final . '" onclick="return Confirmar()">
					<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="red" class="bi bi-trash" viewBox="0 0 16 16">
					<path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
					<path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
					</svg>
					</a></td>
					
					';
				}	
					
					
			
				if($row['doc_estado']=="Ocupado" AND $rol==2 OR $rol==1){
					$tabla .= '	

				
						<td>
					
					   <a href="index.php?op=1&d=' . $d_det_final . '">
						Despachar
						</a></td>
						';
					}
				if($row['doc_estado']=="Ocupado" AND  $rol==1){
					$tabla .= '	
					
						<td>
						
						<a href="index.php?op=1&d=' . $d_det_final . '">
						Entregar
						</a></td>
						';
					}
				if($rol==1){
					$tabla .= '	
						<td><a href="index.php?op=1&d=' . $d_det_final . '">
						Recibir
						</a></td>
						';
						}
						$tabla.='</tr>';
	}

	$tabla.='</table>';
} else
	{
		
		$tabla='<center><img src="./imagen/resultados.png" width="80"><br> 
		No se encontraron coincidencias con sus criterios de búsqueda.</center>';
	}


echo $tabla;
?>

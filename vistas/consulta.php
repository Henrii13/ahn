<?php 

include_once '../includes/user.php';
include_once '../includes/user_session.php';


$userSession = new UserSession();
$user = new User();
/////// CONEXIÓN A LA BASE DE DATOS /////////
$host = 'localhost';
$basededatos = 'ahn_db';
$usuario = 'root';
$contraseña = '';

$conexion = new mysqli($host, $usuario,$contraseña, $basededatos);
if ($conexion -> connect_errno)
{
	die("Fallo la conexion:(".$conexion -> mysqli_connect_errno().")".$conexion-> mysqli_connect_error());
}

//////////////// VALORES INICIALES ///////////////////////
$tabla="";
$query="SELECT * FROM usuarios ";
$rol= $_SESSION['Rol'];

///////// LO QUE OCURRE AL TECLEAR SOBRE EL INPUT DE BUSQUEDA ////////////
if(isset($_POST['equipo']))
{
	$q=$conexion->real_escape_string($_POST['equipo']);
	$query="SELECT * FROM usuarios WHERE 
		user_cedula LIKE '%".$q."%' OR
		user_usuario LIKE '%".$q."%' OR
		user_nombre LIKE '%".$q."%' OR
		user_apellido LIKE '%".$q."%' ;";


$buscarAlumnos=$conexion->query($query);
if ($buscarAlumnos->num_rows > 0)
{
	$tabla.= 
	'	<div class="table-responsive">
	<table class="table table-hover"  >
	<tr>
		<th>ID</th>
		<th>Cédula</th>
		<th>Nombre</th>
		<th>Apellido</th>
		<th>Correo</th>
		<th>Nacionalidad</th>
		<th>Estado</th>
		';
		
		if($rol==1){
			$tabla .= '	
				
				<th colspan="3">Acciones</th>';
				}else{
					$tabla .= '	
				
				<th colspan="1">Acciones</th>';
				}
				$tabla .= '</tr>';

	while($row= $buscarAlumnos->fetch_assoc())
	{
		$d_del = "del/" . $row['user_id'];
			$d_del_final = base64_encode($d_del);
			$d_act = "act/" . $row['user_id'];
			$d_act_final = base64_encode($d_act);
			$d_det = "det/" . $row['user_id'];
			$d_det_final = base64_encode($d_det);		
			$estados = ["Temporal",
					 "Fijo",
					 "Proveedor",
					 "Baja",
					 "Donación"

					 ];
			$tabla .= '
				<tr>
					<td>' . $row['user_id'] . '</td>
					<td>' . $row['user_cedula'] . '</td>
					<td>' . $row['user_nombre'] . '</td>
					<td>' . $row['user_apellido'] . '</td>
					<td>' . $row['user_correo'] . '</td>
                    <td>' . $row['user_nacionalidad'] . '</td>
					<td>' . $row['user_status'] . '</td>
                   
					
						
					<td><a href="index.php?op=4&d=' . $d_det_final . '">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-journal-text" viewBox="0 0 16 16">
                    <path d="M5 10.5a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 0 1h-2a.5.5 0 0 1-.5-.5zm0-2a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5zm0-2a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5zm0-2a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5z"/>
                    <path d="M3 0h10a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2v-1h1v1a1 1 0 0 0 1 1h10a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H3a1 1 0 0 0-1 1v1H1V2a2 2 0 0 1 2-2z"/>
                    <path d="M1 5v-.5a.5.5 0 0 1 1 0V5h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1H1zm0 3v-.5a.5.5 0 0 1 1 0V8h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1H1zm0 3v-.5a.5.5 0 0 1 1 0v.5h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1H1z"/>
                    </svg>
                    </a></td>
					';
					if($rol==1){
				$tabla .= '
					<td><a href="index.php?op=4&d=' . $d_act_final . '">
                    <svg xmlns="http://www.w3.org/2000/svg"  width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                    <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                    <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                    </svg>
                    </a></td>
					<td><a href="index.php?op=4&d=' . $d_del_final . '" onclick="return Confirmar()">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="red" class="bi bi-trash" viewBox="0 0 16 16">
                    <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                    <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                    </svg>
                    </a></td>
					
					';
					}
				$tabla .= '
				</tr>';
	}

	$tabla.='</table>';
} else
	{
		
		$tabla='<br> <br> <center><img src="./imagen/resultados.png" width="90"><br> <br> <br> <br> 
		No se encontraron coincidencias con sus criterios de búsqueda.</center>';
	}

}
echo $tabla;
?>

<?php 
class usuario{
    private $id;
	private $cabid;
	private $cedula;
	private $usuario;
	private $correo;
	private $contrasenia;
	private $rol_pk;
	private $nombre;
	private $apellido;
	private $nombre2;
	private $apellido2;
	private $telefono;
	private $telefono_fijo;
	private $genero;
	private $status;
	private $nacionalidad;
	private $numero_pasaporte;
	private $profesion;
	private $direccion_permanente;
	private $direccion_local;

    function __construct($cn){
        $this->con = $cn;
    }
//*********************** 3.1 METODO update_bodega() **************************************************	
	
public function update_user(){
	$this->id = $_POST['id'];
	$this->cabid =  $_POST['id'];
		$this->cedula = $_POST['cedula'];
		$this->usuario = $_POST['cedula'];
		$this->correo = $_POST['correo'];
		$this->contrasenia = $_POST['contraseña'];
		$this->rol_pk = $_POST['rol1'];
		$this->nombre = $_POST['nombre'];
		$this->apellido = $_POST['apellido'];
		$this->nombre2 = $_POST['nombre2'];
		$this->apellido2 = $_POST['apellido2'];
		$this->telefono =  $_POST['telefono'];
		$this->telefono_fijo = $_POST['telefono_fijo'];
		$this->genero = $_POST['genero'];
		$this->status = $_POST['estado'];
		$this->nacionalidad = $_POST['nacionalidad'];
		$this->numero_pasaporte = $_POST['pasaporte'];
		$this->profesion = $_POST['profesion'];
		$this->direccion_permanente = $_POST['direccion_permanente'];
		$this->direccion_local = $_POST['direccion_local'];
	
	
	
	$sql = "UPDATE usuarios SET user_cabid='$this->cabid',
								user_cedula='$this->cedula',
								user_usuario='$this->usuario',
								user_correo='$this->correo',
								user_contrasenia='$this->contrasenia',
								user_rol_pk ='$this->rol_pk',
								user_nombre ='$this->nombre',
								user_apellido='$this->apellido',
								user_telefono='$this->telefono',
								user_telefono_fijo='$this->telefono_fijo',
								user_genero='$this->genero',
								user_status='$this->status',
								user_nacionalidad='$this->nacionalidad',
								user_numero_pasaporte='$this->numero_pasaporte',
								user_profesion='$this->profesion',
								user_direccion_permanente='$this->direccion_permanente',
								user_direccion_local='$this->direccion_local',
								user_nombre2 ='$this->nombre2',
								user_apellido2='$this->apellido2'
								WHERE 	user_id =$this->id;";
	//echo $sql;
	//exit;
	if($this->con->query($sql)){
		echo $this->_message_ok("modifico");
	}else{
		echo $this->_message_error("al modificar");
	}								
									
}


//*********************** 3.2 METODO save_bodega() **************************************************	

public function save_user(){

		
		$this->cabid =  $_POST['cabid'];
		$this->cedula = $_POST['cedula'];
		$this->usuario = $_POST['cedula'];
		$this->correo = $_POST['correo'];
		$this->contrasenia = $_POST['contraseña'];
		 if(isset($_POST['rol1'])){
			$this->rol_pk =$_POST['rol1'];
		}else{
			$this->rol_pk= NULL;
		}
		$this->nombre = $_POST['nombre'];
		$this->apellido = $_POST['apellido'];
		$this->nombre2 = $_POST['nombre2'];
		$this->apellido2 = $_POST['apellido2'];
		$this->telefono =  $_POST['telefono'];
		$this->telefono_fijo = $_POST['telefono_fijo'];
		$this->genero = $_POST['genero'];
		$this->status = $_POST['estado'];
		$this->nacionalidad = $_POST['nacionalidad'];
		$this->contrasenia = $_POST['contraseña'];
		 if(isset($_POST['pasaporte'])){
			$this->numero_pasaporte = $_POST['pasaporte'];
		}else{
			$this->numero_pasaporte= NULL;
		}
		
		$this->profesion = $_POST['profesion'];
		if(isset($_POST['direccion_permanente'])){
			$this->direccion_permanente = $_POST['direccion_permanente'];
		}else{
			$this->direccion_permanente = NULL;
		}
		
		$this->direccion_local = $_POST['direccion_local'];


	$sql = "INSERT INTO usuarios VALUES(NULL,
										'$this->cabid',
										'$this->cedula',
										'$this->usuario',
										'$this->correo',
										'$this->contrasenia',";
										 if(isset($_POST['rol1'])){
											$sql .= "'$this->rol_pk',";
										}else{
											$sql .= "NULL,";
										}
									
										$sql .= "	
										'$this->nombre',
										'$this->apellido',
										'$this->telefono',
										'$this->telefono_fijo',
										'$this->genero',
										'$this->status',
										'$this->nacionalidad',
										'$this->numero_pasaporte',
										'$this->profesion',
										'$this->direccion_permanente',
										'$this->direccion_local',
										'$this->nombre2',
										'$this->apellido2');";
	
	
	echo $sql;
	//exit;
	if($this->con->query($sql)){
		echo $this->_message_ok("guardó");
	}else{
		echo $this->_message_error("guardar");
	}								
									
}



 /*Aquí se agregó el parámetro:  $defecto*/
 private function _get_combo_db($tabla,$valor,$etiqueta,$nombre,$defecto){
	$html = '<select  class=" selectpicker show-menu-arrow " 
	data-style="form-control" 
	data-live-search="true" 
	
	title="-- Selecciona la Localidad  --"
	single
		id="' . $nombre . '"	name="' . $nombre . '" required>';
	$sql = "SELECT $valor,$etiqueta FROM $tabla;";
	$res = $this->con->query($sql);
	
		while($row = $res->fetch_assoc()){
			//ImpResultQuery($row);
		
			$html .= ($defecto == $row[$valor])?'<option value="' . $row[$valor] . '" selected>' . $row[$etiqueta] . '</option>' . "\n" : '<option value="' . $row[$valor] . '">' . $row[$etiqueta] . '</option>' . "\n";
		}
		$html .= '</select>';
	
	
	return $html;
}

/*Aquí se agregó el parámetro:  $defecto*/
private function _get_radio($arreglo,$nombre,$defecto){
		
	$html = '
	';
	
	//CODIGO NECESARIO EN CASO QUE EL USUARIO NO SE ESCOJA UNA OPCION
	
	foreach($arreglo as $etiqueta){
		$html .= '
		
			
			';
			
			if($defecto == NULL){
				// OPCION PARA GRABAR UN NUEVO VEHICULO (id=0)
				$html .= '<input type="radio" class="btn-check" id="' . $etiqueta . '" autocomplete="off" value="' . $etiqueta . '" name="' . $nombre . '" required checked/>
				<label class="btn btn-outline-primary" for="' . $etiqueta . '">' . $etiqueta . '</label>
				';
			
			}else{
				// OPCION PARA MODIFICAR UN VEHICULO EXISTENTE
				$html .= ($defecto == $etiqueta)? '<input type="radio" class="btn-check" id="' . $etiqueta . '" autocomplete="off" value="' . $etiqueta . '" name="' . $nombre . '" required checked/>
				<label class="btn btn-outline-primary" for="' . $etiqueta . '">' . $etiqueta . '</label>' : '<input type="radio" class="btn-check" id="' . $etiqueta . '" autocomplete="off" value="' . $etiqueta . '" name="' . $nombre . '" required />
				<label class="btn btn-outline-primary" for="' . $etiqueta . '">' . $etiqueta . '</label>';
			}
		
		$html .= '';
	}
	$html .= '
	';
	return $html;
}

//******************************************************
public function get_form($id=NULL){
		
	if($id == NULL){

		$this->id = NULL;
		$this->cabid = NULL;
		$this->cedula = NULL;
		$this->usuario = NULL;
		$this->correo = NULL;
		$this->contrasenia = NULL;
		$this->rol_pk = NULL;
		$this->nombre = NULL;
		$this->apellido = NULL;
		$this->telefono  = NULL;
		$this->telefono_fijo = NULL;
		$this->genero = NULL;
		$this->status = NULL;
		$this->nacionalidad = NULL;
		$this->numero_pasaporte = NULL;
		$this->profesion = NULL;
		$this->direccion_permanente = NULL;
		$this->direccion_local = NULL;

	
		
		$flag = NULL;
		$op = "new";
	}else{

		$sql = "SELECT * FROM usuarios WHERE  user_id =$id;";
		$res = $this->con->query($sql);
		$row = $res->fetch_assoc();
		
		$num = $res->num_rows;
		if($num==0){
			$mensaje = "tratar de actualizar el vehiculo con id= ".$id;
			echo $this->_message_error($mensaje);
		}else{   
		
			
			/*echo "<br>TUPLA <br>";
			echo "<pre>";
				print_r($row);
			echo "</pre>";
		*/
		$this->id= $row['user_id'];
		$this->cabid = $row['user_cabid'];
		$this->cedula = $row['user_cedula'];
		$this->usuario = $row['user_usuario'];
		$this->correo = $row['user_correo'];
		$this->contrasenia = $row['user_contrasenia'];
		$this->rol_pk = $row['user_rol_pk'];
		$this->nombre = $row['user_nombre'];
		$this->apellido = $row['user_apellido'];
		$this->telefono = $row['user_telefono'];
		$this->telefono_fijo = $row['user_telefono_fijo'];
		$this->genero = $row['user_genero'];
		$this->status = $row['user_status'];
		$this->nacionalidad = $row['user_nacionalidad'];
		$this->numero_pasaporte = $row['user_numero_pasaporte'];
		$this->profesion = $row['user_profesion'];
		$this->direccion_permanente = $row['user_direccion_permanente'];
		$this->direccion_local = $row['user_direccion_local'];
		$this->nombre2 = $row['user_nombre2'];
		$this->apellido2 = $row['user_apellido2'];
		
		
		$flag = "disabled";
		$op = "update";
		}
	}
	
	
	$estados = ["Temporal",
					 "Fijo",
					 "Proveedor",
					 "Baja",
					 "Donación"

					 ];
				
	$html = '
	
		<div class="container">
			<div class="row g-5">
				<div class="col-md-7 col-lg-8">
					<h4 class="mb-3">Usuario: </h4>';
					if(!isset($_GET['res']) ){
						$html .= '<form class="needs-validation" name="bodega" method="POST" action="index.php?op=4" enctype="multipart/form-data novalidate">';
					}
					if(isset($_GET['res']) && $_GET['res']=='1'){
						echo $_GET['res'];
						$html .= '<form class="needs-validation" name="bodega" method="POST" action="usuario.php?op=4&res=1" enctype="multipart/form-data novalidate">';
					}
					$html .= '	
						<input type="hidden" name="id" value="' . $id  . '">
						<input type="hidden" name="op" value="' . $op  . '">
						<input type="hidden" name="cabid" value="">
						<div class="row g-3">
					
						<div class="col-sm-4">
						<label for="marca" class="form-label">Cédula</label>
						<input type="text" class="form-control" oninput="actualizarValor()" id="cedula" placeholder="" name="cedula" value="' . $this->cedula . '" required>
						<div id="salida" class="invalid-feedback">
							Cédula Incorrecta.
						</div>
					</div>
					<div id="ecua" class="col-sm-4">
						<label for="marca" class="form-label">Pasaporte</label>
						<input type="text" class="form-control" id="pasaporte" placeholder="" name="pasaporte" value="' . $this->numero_pasaporte . '" >
						<div class="invalid-feedback">
							Valid first name is required.
						</div>
					</div>
					
					<div class="col-sm-4">
						<label for="marca" class="form-label">Nacionalidad</label>
						
						<select  class=" selectpicker show-menu-arrow " 
						data-style="form-control" 
						data-live-search="true" 
						onchange="campos_Ecuador()"
						title="-- Selecciona la Localidad  --"
						single
						
							id="nacionalidad"	name="nacionalidad" required>';
						$sql = "SELECT pais_id,pais_nombre FROM paises;";
						$res = $this->con->query($sql);
						
							while($row = $res->fetch_assoc()){
								//ImpResultQuery($row);
							
								$html .= ($this->nacionalidad == $row['pais_nombre'])?'<option value="' . $row['pais_nombre'] . '" selected>' . $row['pais_nombre'] . '</option>' . "\n" : '<option value="' . $row['pais_nombre'] . '">' . $row['pais_nombre'] . '</option>' . "\n";
							}
							$html .= '</select>


					
						<!--<input type="text" class="form-control" id="pasaporte" placeholder="" name="pasaporte" value="' . $this->numero_pasaporte . '" required>
						--><div class="invalid-feedback">
							Valid first name is required.
						</div>
					</div>
					
			
					<div id="ecua2" class="col-sm-4">
					
					</div>
					
					<div class="col-sm-4">
						<label for="Name" class="form-label">Primer Nombre</label>
						<input type="text" class="form-control" id="nombre" placeholder="" name="nombre" value="' . $this->nombre . '" required>
						<div class="invalid-feedback">
							Valid first name is required.
						</div>
					</div>
					<div class="col-sm-4">
						<label for="Name" class="form-label">Segundo Nombre</label>
						<input type="text" class="form-control" id="nombre2" placeholder="" name="nombre2" value="' . $this->nombre2 . '" required>
						<div class="invalid-feedback">
							Valid first name is required.
						</div>
					</div>
					<div class="col-sm-4">
					
					</div>
					<div class="col-sm-4">
						<label for="Name" class="form-label">Apellido Paterno</label>
						<input type="text" class="form-control" id="apellido" placeholder="" name="apellido" value="' . $this->apellido . '" required>
						<div class="invalid-feedback">
							Valid first name is required.
						</div>
					</div>
					<div class="col-sm-4">
						<label for="Name" class="form-label">Apellido Materno</label>
						<input type="text" class="form-control" id="apellido2" placeholder="" name="apellido2" value="' . $this->apellido2 . '" required>
						<div class="invalid-feedback">
							Valid first name is required.
						</div>
					</div>
					<div class="col-sm-4">
					
					</div>
					<div class="col-sm-4">
						<label for="Name" class="form-label">Usuario</label>
						<input type="text" class="form-control" id="usuario" placeholder="" name="usuario" value="' . $this->usuario . '" disabled required>
						<div class="invalid-feedback">
							Valid first name is required.
						</div>
					</div>
					<div class="col-sm-4">
						<label for="Name" class="form-label">Contraseña</label>
						<input type="password" class="form-control" id="contraseña" placeholder="" name="contraseña" value="' . $this->contrasenia . '" required>
						<div class="invalid-feedback">
							Valid first name is required.
						</div>
					</div>
					';
					if(!isset($_GET['res']) ){
					//if($user->getrol()==1){
					$html .='
					<div class="col-sm-4">
					<label for="Name" class="form-label">Rol</label>
					' . $this->_get_combo_db("rol","rol_id","rol_name","rol1",$this->rol_pk) . '
						<!--<input type="text" class="form-control" id="rol" placeholder="" name="rol" value="' . $this->rol_pk . '" required>
						--><div class="invalid-feedback">
							Valid first name is required.
						</div>
					</div>
					';
						}
						if(isset($_GET['res']) ){
							//if($user->getrol()==1){
							$html .='
							<div class="col-sm-4">
						
							</div>
							';
								}
							$html .='
					<div class="col-sm-4">
						<label for="Name" class="form-label">Genero</label>
					
						<select  class=" selectpicker show-menu-arrow " 
						data-style="form-control" 
						data-live-search="true" 
						title="-- Selecciona la Localidad  --"
						single name="genero" required>
							<option value="Maculino">Masculino</option>
							<option value="Femenino">Femenino</option>
						</select>
						<!--<input type="text" class="form-control" id="cabid" placeholder="" name="cabid" value="' . $this->genero . '" required>-->
						<div class="invalid-feedback">
							Valid first name is required.
						</div>
					</div>
					<div class="col-sm-4">
						<label for="Name" class="form-label">Estado</label>
					
						<select  class=" selectpicker show-menu-arrow " 
						data-style="form-control" 
						data-live-search="true" 
						title="-- Selecciona la Localidad  --"
						single name="estado" required>
							<option value="Activo">Activo</option>
							<option value="Inactivo">Inactivo</option>
						</select>
						<!--<input type="text" class="form-control" id="genero" placeholder="" name="genero" value="' . $this->status . '" required>-->
						<div class="invalid-feedback">
							Valid first name is required.
						</div>
					</div>
					<div class="col-sm-4">
						
					</div>
					<div class="col-sm-4">
						<label for="Name" class="form-label">Correo</label>
						<input type="email" class="form-control" id="correo" placeholder="" name="correo" value="' . $this->correo . '" required>
						<div class="invalid-feedback">
							Valid first name is required.
						</div>
					</div>
					<div class="col-sm-4">
						<label for="Name" class="form-label">Teléfono</label>
						<input type="text" class="form-control" id="telefono" placeholder="" name="telefono" value="' . $this->telefono . '" required>
						<div class="invalid-feedback">
							Valid first name is required.
						</div>
					</div>
					<div class="col-sm-4">
						<label for="Name" class="form-label">Teléfono Fijo</label>
						<input type="text" class="form-control" id="telefono_fijo" placeholder="" name="telefono_fijo" value="' . $this->telefono_fijo . '" required>
						<div class="invalid-feedback">
							Valid first name is required.
						</div>
					</div>
					<div class="col-sm-4">
						<label for="Name" class="form-label">Profesión</label>
						<input type="text" class="form-control" id="profesion" placeholder="" name="profesion" value="' . $this->profesion . '" required>
						<div class="invalid-feedback">
							Valid first name is required.
						</div>
					</div>
					<div id="ecua1" class="col-sm-4">
						<label for="modelo" class="form-label">Dirección Permanente</label>
						<input type="text" class="form-control" id="direccion_permanente" placeholder="" name="direccion_permanente" value="' . $this->direccion_permanente. '" >
						<div class="invalid-feedback">
							Valid first name is required.
						</div>
					</div>
					<div class="col-sm-4">
						<label for="modelo" class="form-label">Dirección Local</label>
						<input type="text" class="form-control" id="direccion_local" placeholder="" name="direccion_local" value="' . $this->direccion_local. '" required>
						<div class="invalid-feedback">
							Valid first name is required.
						</div>
					</div>
					
					
				
				
				</div>
				<hr class="my-4">
				<div class="col-sm-3">
					<button class="w-100 btn btn-primary btn-lg" type="submit" name="Guardar">Guardar</button>
				</div>
				<div class="col-sm-2">';
				if(!isset($_GET['res']) ){
					$html .= '
				
				<a href="index.php?op=4" class="text-center btn btn-danger btn-lg" >Cancelar</a>';
				}
				if(isset($_GET['res']) && $_GET['res']=='1'){
					$html .= '
				
				<a href="../index.php" class="text-center btn btn-danger btn-lg" >Cancelar</a>';
				}
				$html .= '</div>
         
		 
					</form>
				</div>
			</div>
		</div>

	
	';
	return $html;
}


	public function get_list($rol){
		


		$d_new = "new/0";
		$d_new_final = base64_encode($d_new);

		
		$html = '
		<div class="container">
			<div class="row g-2">
				<div class="col-md-8 col-lg-8">
					<h4 class="mb-3">Usuarios</h4>
					
				</div>
				
				<div class="col-sm-7">
				<section>
						<input  name="busqueda" id="busqueda" class="form-control" placeholder="Buscar">
				</section>
				</div>
			
				<div class="col-sm-1 " >
					<a  class="btn btn-primary nav-link  " href="index.php?op=4&d=' . $d_new_final . '">Nuevo</a></div>
				</div>
		</div>
			<br>
			
			<section id="tabla_resultado">
		<!-- AQUI SE DESPLEGARA NUESTRA TABLA DE CONSULTA -->
		</section>';
			
		

		$html .= '	<div class="table-responsive">
	
		<script >
	function Confirmar(){
	
		if (confirm("Esta seguro que desea eliminar el registro!") == true) {
			return true;
		} else {
			return false;
		}
	}

	
	
	</script>
		</div>
		';
		
		return $html;
		
	}
	
	public function get_detail_usuario($id){
		$sql = "SELECT *
				FROM usuarios 
				WHERE user_id=$id ;";
		$res = $this->con->query($sql);
		$row = $res->fetch_assoc();
		
		$num = $res->num_rows;

        //Si es que no existiese ningun registro debe desplegar un mensaje 
        //$mensaje = "tratar de eliminar el vehiculo con id= ".$id;
        //echo $this->_message_error($mensaje);
        //y no debe desplegarse la tablas
		
		$_SESSION['Busqueda'] = $row['user_cedula'] ;
        if($num==0){
            $mensaje = "tratar de editar el vehiculo con id= ".$id;
            echo $this->_message_error($mensaje);
        }else{ 
				$html = '
				
				<h3 class="pb-2 border-bottom">DETALLES</h3>
				<div class="container">
				<div class="row g-5">
					<div class="col-md-7 col-lg-8">
						
						
							<div class="row g-3">
								<div class="col-sm-4">
									<a href="#" class="list-group-item list-group-item-action d-flex gap-3 py-3" aria-current="true">
									<svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" class="bi bi-postcard" viewBox="0 0 16 16">
										<path fill-rule="evenodd" d="M2 2a2 2 0 0 0-2 2v8a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V4a2 2 0 0 0-2-2H2ZM1 4a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1v8a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V4Zm7.5.5a.5.5 0 0 0-1 0v7a.5.5 0 0 0 1 0v-7ZM2 5.5a.5.5 0 0 1 .5-.5H6a.5.5 0 0 1 0 1H2.5a.5.5 0 0 1-.5-.5Zm0 2a.5.5 0 0 1 .5-.5H6a.5.5 0 0 1 0 1H2.5a.5.5 0 0 1-.5-.5Zm0 2a.5.5 0 0 1 .5-.5H6a.5.5 0 0 1 0 1H2.5a.5.5 0 0 1-.5-.5ZM10.5 5a.5.5 0 0 0-.5.5v3a.5.5 0 0 0 .5.5h3a.5.5 0 0 0 .5-.5v-3a.5.5 0 0 0-.5-.5h-3ZM13 8h-2V6h2v2Z"/>
									</svg>
									<div class="d-flex gap-2 w-100 justify-content-between">
									<div>
										<h5 class="mb-0">'. $row['user_cedula'] .'</h5>
										<p class="mb-0 opacity-75">Cedula.</p>
									</div>
									<small class="opacity-50 text-nowrap">Dni</small>
									</div>
									</a>
								</div>
								<div class="col-sm-4">
									<a href="#" class="list-group-item list-group-item-action d-flex gap-3 py-3" aria-current="true">
									<svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" class="bi bi-journal-text" viewBox="0 0 16 16">
										<path d="M5 10.5a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 0 1h-2a.5.5 0 0 1-.5-.5zm0-2a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5zm0-2a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5zm0-2a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5z"/>
										<path d="M3 0h10a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2v-1h1v1a1 1 0 0 0 1 1h10a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H3a1 1 0 0 0-1 1v1H1V2a2 2 0 0 1 2-2z"/>
										<path d="M1 5v-.5a.5.5 0 0 1 1 0V5h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1H1zm0 3v-.5a.5.5 0 0 1 1 0V8h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1H1zm0 3v-.5a.5.5 0 0 1 1 0v.5h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1H1z"/>
									</svg>
									
									<div class="d-flex gap-2 w-100 justify-content-between">
									<div>
										<h5 class="mb-0">'. $row['user_numero_pasaporte'] .'</h5>
										<p class="mb-0 opacity-75">Pasaporte.</p>
									</div>
									<small class="opacity-50 text-nowrap">Dni</small>
									</div>
									</a>
								</div>
								<div class="col-sm-4">
									
								</div>
							
								<div class="col-sm-4">
									<a href="#" class="list-group-item list-group-item-action d-flex gap-3 py-3" aria-current="true">
									<svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" class="bi bi-person-badge" viewBox="0 0 16 16">
										<path d="M6.5 2a.5.5 0 0 0 0 1h3a.5.5 0 0 0 0-1h-3zM11 8a3 3 0 1 1-6 0 3 3 0 0 1 6 0z"/>
										<path d="M4.5 0A2.5 2.5 0 0 0 2 2.5V14a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V2.5A2.5 2.5 0 0 0 11.5 0h-7zM3 2.5A1.5 1.5 0 0 1 4.5 1h7A1.5 1.5 0 0 1 13 2.5v10.795a4.2 4.2 0 0 0-.776-.492C11.392 12.387 10.063 12 8 12s-3.392.387-4.224.803a4.2 4.2 0 0 0-.776.492V2.5z"/>
									</svg>
									<div class="d-flex gap-2 w-100 justify-content-between">
									<div>
										<h5 class="mb-0">'. $row['user_usuario'] .'</h5>
										<p class="mb-0 opacity-75">Usuario.</p>
									</div>
									<small class="opacity-50 text-nowrap">Cod</small>
									</div>
									</a>
								</div>
								<div class="col-sm-4">
									<a href="#" class="list-group-item list-group-item-action d-flex gap-3 py-3" aria-current="true">
									<svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" class="bi bi-person-badge" viewBox="0 0 16 16">
										<path d="M6.5 2a.5.5 0 0 0 0 1h3a.5.5 0 0 0 0-1h-3zM11 8a3 3 0 1 1-6 0 3 3 0 0 1 6 0z"/>
										<path d="M4.5 0A2.5 2.5 0 0 0 2 2.5V14a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V2.5A2.5 2.5 0 0 0 11.5 0h-7zM3 2.5A1.5 1.5 0 0 1 4.5 1h7A1.5 1.5 0 0 1 13 2.5v10.795a4.2 4.2 0 0 0-.776-.492C11.392 12.387 10.063 12 8 12s-3.392.387-4.224.803a4.2 4.2 0 0 0-.776.492V2.5z"/>
									</svg>
									<div class="d-flex gap-2 w-100 justify-content-between">
									<div>
										<h5 class="mb-0">'. $row['user_rol_pk'] .'</h5>
										<p class="mb-0 opacity-75">Rol.</p>
									</div>
									<small class="opacity-50 text-nowrap">Cod</small>
									</div>
									</a>
								</div>
								<div class="col-sm-4">
									
								</div>
								<div class="col-sm-4">
									<a href="#" class="list-group-item list-group-item-action d-flex gap-3 py-3" aria-current="true">
									<svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" class="bi bi-person-circle" viewBox="0 0 16 16">
										<path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z"/>
										<path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z"/>
									</svg>
									<div class="d-flex gap-2 w-100 justify-content-between">
									<div>
										<h5 class="mb-0">'. $row['user_nombre'] .'</h5>
										<p class="mb-0 opacity-75">Nombre.</p>
									</div>
									<small class="opacity-50 text-nowrap">Name</small>
									</div>
									</a>
								</div>
								<div class="col-sm-4">
									<a href="#" class="list-group-item list-group-item-action d-flex gap-3 py-3" aria-current="true">
									<svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" class="bi bi-person-circle" viewBox="0 0 16 16">
										<path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z"/>
										<path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z"/>
									</svg>
									<div class="d-flex gap-2 w-100 justify-content-between">
									<div>
										<h5 class="mb-0">'. $row['user_apellido'] .'</h5>
										<p class="mb-0 opacity-75">Apellido.</p>
									</div>
									<small class="opacity-50 text-nowrap">Second</small>
									</div>
									</a>
								</div>

								<div class="col-sm-4">
									<a href="#" class="list-group-item list-group-item-action d-flex gap-3 py-3" aria-current="true">
									<svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" class="bi bi-envelope" viewBox="0 0 16 16">
										<path d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V4Zm2-1a1 1 0 0 0-1 1v.217l7 4.2 7-4.2V4a1 1 0 0 0-1-1H2Zm13 2.383-4.708 2.825L15 11.105V5.383Zm-.034 6.876-5.64-3.471L8 9.583l-1.326-.795-5.64 3.47A1 1 0 0 0 2 13h12a1 1 0 0 0 .966-.741ZM1 11.105l4.708-2.897L1 5.383v5.722Z"/>
									</svg>
									<div class="d-flex gap-2 w-100 justify-content-between">
									<div>
										<h5 class="mb-0">'. $row['user_correo'] .'</h5>
										<p class="mb-0 opacity-75">Correo.</p>
									</div>
									<small class="opacity-50 text-nowrap">Mail</small>
									</div>
									</a>	
								</div>
								<div class="col-sm-4">
									<a href="#" class="list-group-item list-group-item-action d-flex gap-3 py-3" aria-current="true">
									<svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" class="bi bi-telephone" viewBox="0 0 16 16">
										<path d="M3.654 1.328a.678.678 0 0 0-1.015-.063L1.605 2.3c-.483.484-.661 1.169-.45 1.77a17.568 17.568 0 0 0 4.168 6.608 17.569 17.569 0 0 0 6.608 4.168c.601.211 1.286.033 1.77-.45l1.034-1.034a.678.678 0 0 0-.063-1.015l-2.307-1.794a.678.678 0 0 0-.58-.122l-2.19.547a1.745 1.745 0 0 1-1.657-.459L5.482 8.062a1.745 1.745 0 0 1-.46-1.657l.548-2.19a.678.678 0 0 0-.122-.58L3.654 1.328zM1.884.511a1.745 1.745 0 0 1 2.612.163L6.29 2.98c.329.423.445.974.315 1.494l-.547 2.19a.678.678 0 0 0 .178.643l2.457 2.457a.678.678 0 0 0 .644.178l2.189-.547a1.745 1.745 0 0 1 1.494.315l2.306 1.794c.829.645.905 1.87.163 2.611l-1.034 1.034c-.74.74-1.846 1.065-2.877.702a18.634 18.634 0 0 1-7.01-4.42 18.634 18.634 0 0 1-4.42-7.009c-.362-1.03-.037-2.137.703-2.877L1.885.511z"/>
									</svg>
									<div class="d-flex gap-2 w-100 justify-content-between">
									<div>
										<h5 class="mb-0">'. $row['user_telefono'] .'</h5>
										<p class="mb-0 opacity-75">Telefono.</p>
									</div>
									<small class="opacity-50 text-nowrap">Phone</small>
									</div>
									</a>	
								</div>
								<div class="col-sm-4">
									<a href="#" class="list-group-item list-group-item-action d-flex gap-3 py-3" aria-current="true">
									<svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" class="bi bi-telephone" viewBox="0 0 16 16">
										<path d="M3.654 1.328a.678.678 0 0 0-1.015-.063L1.605 2.3c-.483.484-.661 1.169-.45 1.77a17.568 17.568 0 0 0 4.168 6.608 17.569 17.569 0 0 0 6.608 4.168c.601.211 1.286.033 1.77-.45l1.034-1.034a.678.678 0 0 0-.063-1.015l-2.307-1.794a.678.678 0 0 0-.58-.122l-2.19.547a1.745 1.745 0 0 1-1.657-.459L5.482 8.062a1.745 1.745 0 0 1-.46-1.657l.548-2.19a.678.678 0 0 0-.122-.58L3.654 1.328zM1.884.511a1.745 1.745 0 0 1 2.612.163L6.29 2.98c.329.423.445.974.315 1.494l-.547 2.19a.678.678 0 0 0 .178.643l2.457 2.457a.678.678 0 0 0 .644.178l2.189-.547a1.745 1.745 0 0 1 1.494.315l2.306 1.794c.829.645.905 1.87.163 2.611l-1.034 1.034c-.74.74-1.846 1.065-2.877.702a18.634 18.634 0 0 1-7.01-4.42 18.634 18.634 0 0 1-4.42-7.009c-.362-1.03-.037-2.137.703-2.877L1.885.511z"/>
									</svg>
									<div class="d-flex gap-2 w-100 justify-content-between">
									<div>
										<h5 class="mb-0">'. $row['user_telefono_fijo'] .'</h5>
										<p class="mb-0 opacity-75">Telefono Fijo.</p>
									</div>
									<small class="opacity-50 text-nowrap">Phone</small>
									</div>
									</a>
								</div>

								<div class="col-sm-4">
									<a href="#" class="list-group-item list-group-item-action d-flex gap-3 py-3" aria-current="true">
									<svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" class="bi bi-globe2" viewBox="0 0 16 16">
										<path d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm7.5-6.923c-.67.204-1.335.82-1.887 1.855-.143.268-.276.56-.395.872.705.157 1.472.257 2.282.287V1.077zM4.249 3.539c.142-.384.304-.744.481-1.078a6.7 6.7 0 0 1 .597-.933A7.01 7.01 0 0 0 3.051 3.05c.362.184.763.349 1.198.49zM3.509 7.5c.036-1.07.188-2.087.436-3.008a9.124 9.124 0 0 1-1.565-.667A6.964 6.964 0 0 0 1.018 7.5h2.49zm1.4-2.741a12.344 12.344 0 0 0-.4 2.741H7.5V5.091c-.91-.03-1.783-.145-2.591-.332zM8.5 5.09V7.5h2.99a12.342 12.342 0 0 0-.399-2.741c-.808.187-1.681.301-2.591.332zM4.51 8.5c.035.987.176 1.914.399 2.741A13.612 13.612 0 0 1 7.5 10.91V8.5H4.51zm3.99 0v2.409c.91.03 1.783.145 2.591.332.223-.827.364-1.754.4-2.741H8.5zm-3.282 3.696c.12.312.252.604.395.872.552 1.035 1.218 1.65 1.887 1.855V11.91c-.81.03-1.577.13-2.282.287zm.11 2.276a6.696 6.696 0 0 1-.598-.933 8.853 8.853 0 0 1-.481-1.079 8.38 8.38 0 0 0-1.198.49 7.01 7.01 0 0 0 2.276 1.522zm-1.383-2.964A13.36 13.36 0 0 1 3.508 8.5h-2.49a6.963 6.963 0 0 0 1.362 3.675c.47-.258.995-.482 1.565-.667zm6.728 2.964a7.009 7.009 0 0 0 2.275-1.521 8.376 8.376 0 0 0-1.197-.49 8.853 8.853 0 0 1-.481 1.078 6.688 6.688 0 0 1-.597.933zM8.5 11.909v3.014c.67-.204 1.335-.82 1.887-1.855.143-.268.276-.56.395-.872A12.63 12.63 0 0 0 8.5 11.91zm3.555-.401c.57.185 1.095.409 1.565.667A6.963 6.963 0 0 0 14.982 8.5h-2.49a13.36 13.36 0 0 1-.437 3.008zM14.982 7.5a6.963 6.963 0 0 0-1.362-3.675c-.47.258-.995.482-1.565.667.248.92.4 1.938.437 3.008h2.49zM11.27 2.461c.177.334.339.694.482 1.078a8.368 8.368 0 0 0 1.196-.49 7.01 7.01 0 0 0-2.275-1.52c.218.283.418.597.597.932zm-.488 1.343a7.765 7.765 0 0 0-.395-.872C9.835 1.897 9.17 1.282 8.5 1.077V4.09c.81-.03 1.577-.13 2.282-.287z"/>
									</svg>
									<div class="d-flex gap-2 w-100 justify-content-between">
									<div>
										<h5 class="mb-0">'. $row['user_nacionalidad'] .'</h5>
										<p class="mb-0 opacity-75">Nacionalidad.</p>
									</div>
									<small class="opacity-50 text-nowrap">Nationality</small>
									</div>
									</a>
								</div>
								<div class="col-sm-4">
									<a href="#" class="list-group-item list-group-item-action d-flex gap-3 py-3" aria-current="true">
									<svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" class="bi bi-mortarboard" viewBox="0 0 16 16">
										<path d="M8.211 2.047a.5.5 0 0 0-.422 0l-7.5 3.5a.5.5 0 0 0 .025.917l7.5 3a.5.5 0 0 0 .372 0L14 7.14V13a1 1 0 0 0-1 1v2h3v-2a1 1 0 0 0-1-1V6.739l.686-.275a.5.5 0 0 0 .025-.917l-7.5-3.5ZM8 8.46 1.758 5.965 8 3.052l6.242 2.913L8 8.46Z"/>
										<path d="M4.176 9.032a.5.5 0 0 0-.656.327l-.5 1.7a.5.5 0 0 0 .294.605l4.5 1.8a.5.5 0 0 0 .372 0l4.5-1.8a.5.5 0 0 0 .294-.605l-.5-1.7a.5.5 0 0 0-.656-.327L8 10.466 4.176 9.032Zm-.068 1.873.22-.748 3.496 1.311a.5.5 0 0 0 .352 0l3.496-1.311.22.748L8 12.46l-3.892-1.556Z"/>
									</svg>
									<div class="d-flex gap-2 w-100 justify-content-between">
									<div>
										<h5 class="mb-0">'. $row['user_profesion'] .'</h5>
										<p class="mb-0 opacity-75">Profesion.</p>
									</div>
									<small class="opacity-50 text-nowrap">Cod</small>
									</div>
									</a>
								</div>
								<div class="col-sm-4">
									<a href="#" class="list-group-item list-group-item-action d-flex gap-3 py-3" aria-current="true">
									<svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" class="bi bi-pin-map-fill" viewBox="0 0 16 16">
										<path fill-rule="evenodd" d="M3.1 11.2a.5.5 0 0 1 .4-.2H6a.5.5 0 0 1 0 1H3.75L1.5 15h13l-2.25-3H10a.5.5 0 0 1 0-1h2.5a.5.5 0 0 1 .4.2l3 4a.5.5 0 0 1-.4.8H.5a.5.5 0 0 1-.4-.8l3-4z"/>
										<path fill-rule="evenodd" d="M4 4a4 4 0 1 1 4.5 3.969V13.5a.5.5 0 0 1-1 0V7.97A4 4 0 0 1 4 3.999z"/>
									</svg>
									<div class="d-flex gap-2 w-100 justify-content-between">
									<div>
										<h5 class="mb-0">'. $row['user_direccion_permanente'] .'</h5>
										<p class="mb-0 opacity-75">Dirección.</p>
									</div>
									<small class="opacity-50 text-nowrap">Cod</small>
									</div>
									</a>
								</div>
								<div class="col-sm-4">
									<a href="#" class="list-group-item list-group-item-action d-flex gap-3 py-3" aria-current="true">
									<svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" class="bi bi-pin-map" viewBox="0 0 16 16">
										<path fill-rule="evenodd" d="M3.1 11.2a.5.5 0 0 1 .4-.2H6a.5.5 0 0 1 0 1H3.75L1.5 15h13l-2.25-3H10a.5.5 0 0 1 0-1h2.5a.5.5 0 0 1 .4.2l3 4a.5.5 0 0 1-.4.8H.5a.5.5 0 0 1-.4-.8l3-4z"/>
										<path fill-rule="evenodd" d="M8 1a3 3 0 1 0 0 6 3 3 0 0 0 0-6zM4 4a4 4 0 1 1 4.5 3.969V13.5a.5.5 0 0 1-1 0V7.97A4 4 0 0 1 4 3.999z"/>
									</svg>
									<div class="d-flex gap-2 w-100 justify-content-between">
									<div>
										<h5 class="mb-0">'. $row['user_direccion_local'] .'</h5>
										<p class="mb-0 opacity-75">Dirección Local.</p>
									</div>
									<small class="opacity-50 text-nowrap">Cod</small>
									</div>
									</a>
								</div>

								<div class="col-sm-4">
									
								</div>

								
								<div class="col-sm-9">
									
								</div>
							</div>
							
							
			 
			 
						
					</div>
				</div>
			</div>
			<h3 class="pb-2 border-bottom">DOCUMENTOS</h3>	
				
			<div class="container">
			<div class="row g-5">
				<div class="col-md-7 col-lg-8">
						<div class="row g-4">';
						$sql2 = "SELECT *
						FROM documento;";
						
					$res2 = $this->con->query($sql2);
					$i=0;
					while($row2 = $res2->fetch_assoc()){
							if($row2['doc_cedula_pk']==$row['user_cedula']){
								
						
						
					$html .= '
					
							<div class="col-sm-3">
							
								<a   onclick="myFunction('. $row2['doc_id'] .')"  class=" list-group-item list-group-item-action list-group-item-secondary active d-flex gap-3 py-3" aria-current="true">
								<svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" class="bi bi-file-earmark-text" viewBox="0 0 16 16">
									<path d="M5.5 7a.5.5 0 0 0 0 1h5a.5.5 0 0 0 0-1h-5zM5 9.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5zm0 2a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 0 1h-2a.5.5 0 0 1-.5-.5z"/>
									<path d="M9.5 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V4.5L9.5 0zm0 1v2A1.5 1.5 0 0 0 11 4.5h2V14a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h5.5z"/>
								</svg>
								<div class="d-flex gap-2 w-100 justify-content-between">
								<div>
									<h5 class="mb-0">'. $row2['doc_id'] .'</h5>
									<p class="mb-0 opacity-75">Documento.</p>
								</div>
								<small class="opacity-50 text-nowrap">TXT</small>
								</div>
								</a>
								
							</div>
							<div class="hidden" id="'. $row2['doc_id'] .'">
							<div class="container " >
								<div class="row g-5">
									<div class="col-md-7 col-lg-8">
										
										
											<div class="row g-3">
												<div class="col-sm-4">
													<a href="#" class="list-group-item list-group-item-action d-flex gap-3 py-3" aria-current="true">
													<svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" class="bi bi-postcard" viewBox="0 0 16 16">
														<path fill-rule="evenodd" d="M2 2a2 2 0 0 0-2 2v8a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V4a2 2 0 0 0-2-2H2ZM1 4a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1v8a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V4Zm7.5.5a.5.5 0 0 0-1 0v7a.5.5 0 0 0 1 0v-7ZM2 5.5a.5.5 0 0 1 .5-.5H6a.5.5 0 0 1 0 1H2.5a.5.5 0 0 1-.5-.5Zm0 2a.5.5 0 0 1 .5-.5H6a.5.5 0 0 1 0 1H2.5a.5.5 0 0 1-.5-.5Zm0 2a.5.5 0 0 1 .5-.5H6a.5.5 0 0 1 0 1H2.5a.5.5 0 0 1-.5-.5ZM10.5 5a.5.5 0 0 0-.5.5v3a.5.5 0 0 0 .5.5h3a.5.5 0 0 0 .5-.5v-3a.5.5 0 0 0-.5-.5h-3ZM13 8h-2V6h2v2Z"/>
													</svg>
													<div class="d-flex gap-2 w-100 justify-content-between">
													<div>
														<h5 class="mb-0">'. $row2['doc_id'] .'</h5>
														<p class="mb-0 opacity-75">Codigo.</p>
													</div>
													<small class="opacity-50 text-nowrap">Dni</small>
													</div>
													</a>
												</div>	
													<div class="col-sm-4">
														<a href="#" class="list-group-item list-group-item-action d-flex gap-3 py-3" aria-current="true">
														<svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" class="bi bi-journal-text" viewBox="0 0 16 16">
															<path d="M5 10.5a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 0 1h-2a.5.5 0 0 1-.5-.5zm0-2a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5zm0-2a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5zm0-2a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5z"/>
															<path d="M3 0h10a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2v-1h1v1a1 1 0 0 0 1 1h10a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H3a1 1 0 0 0-1 1v1H1V2a2 2 0 0 1 2-2z"/>
															<path d="M1 5v-.5a.5.5 0 0 1 1 0V5h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1H1zm0 3v-.5a.5.5 0 0 1 1 0V8h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1H1zm0 3v-.5a.5.5 0 0 1 1 0v.5h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1H1z"/>
														</svg>
														
														<div class="d-flex gap-2 w-100 justify-content-between">
														<div>
															<h5 class="mb-0">'. $row2['doc_est'] .'</h5>
															<p class="mb-0 opacity-75">Estanteria .</p>
														</div>
														<small class="opacity-50 text-nowrap">Dni</small>
														</div>
														</a>
													</div>
													<div class="col-sm-4">
														
													</div>
												
													<div class="col-sm-4">
														<a href="#" class="list-group-item list-group-item-action d-flex gap-3 py-3" aria-current="true">
														<svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" class="bi bi-columns-gap" viewBox="0 0 16 16">
														<path d="M6 1v3H1V1h5zM1 0a1 1 0 0 0-1 1v3a1 1 0 0 0 1 1h5a1 1 0 0 0 1-1V1a1 1 0 0 0-1-1H1zm14 12v3h-5v-3h5zm-5-1a1 1 0 0 0-1 1v3a1 1 0 0 0 1 1h5a1 1 0 0 0 1-1v-3a1 1 0 0 0-1-1h-5zM6 8v7H1V8h5zM1 7a1 1 0 0 0-1 1v7a1 1 0 0 0 1 1h5a1 1 0 0 0 1-1V8a1 1 0 0 0-1-1H1zm14-6v7h-5V1h5zm-5-1a1 1 0 0 0-1 1v7a1 1 0 0 0 1 1h5a1 1 0 0 0 1-1V1a1 1 0 0 0-1-1h-5z"/>
														</svg>
														<div class="d-flex gap-2 w-100 justify-content-between">
														<div>
															<h5 class="mb-0">'. $row2['doc_columna'] .'</h5>
															<p class="mb-0 opacity-75">Columna.</p>
														</div>
														<small class="opacity-50 text-nowrap">Cod</small>
														</div>
														</a>
													</div>
													<div class="col-sm-4">
														<a href="#" class="list-group-item list-group-item-action d-flex gap-3 py-3" aria-current="true">
														<svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" class="bi bi-layout-three-columns" viewBox="0 0 16 16">
														<path d="M0 1.5A1.5 1.5 0 0 1 1.5 0h13A1.5 1.5 0 0 1 16 1.5v13a1.5 1.5 0 0 1-1.5 1.5h-13A1.5 1.5 0 0 1 0 14.5v-13zM1.5 1a.5.5 0 0 0-.5.5v13a.5.5 0 0 0 .5.5H5V1H1.5zM10 15V1H6v14h4zm1 0h3.5a.5.5 0 0 0 .5-.5v-13a.5.5 0 0 0-.5-.5H11v14z"/>
														</svg>
														<div class="d-flex gap-2 w-100 justify-content-between">
														<div>
															<h5 class="mb-0">'. $row2['doc_nivel'] .'</h5>
															<p class="mb-0 opacity-75">Nivel.</p>
														</div>
														<small class="opacity-50 text-nowrap">Cod</small>
														</div>
														</a>
													</div>
													<div class="col-sm-4">
														
													</div>
													<div class="col-sm-4">
														<a href="#" class="list-group-item list-group-item-action d-flex gap-3 py-3" aria-current="true">
														<svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" class="bi bi-back" viewBox="0 0 16 16">
														<path d="M0 2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v2h2a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2v-2H2a2 2 0 0 1-2-2V2zm2-1a1 1 0 0 0-1 1v8a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H2z"/>
														</svg>
														<div class="d-flex gap-2 w-100 justify-content-between">
														<div>
															<h5 class="mb-0">'. $row2['doc_fondo'] .'</h5>
															<p class="mb-0 opacity-75">Fondo.</p>
														</div>
														<small class="opacity-50 text-nowrap">Name</small>
														</div>
														</a>
													</div>
													<div class="col-sm-4">
														<a href="#" class="list-group-item list-group-item-action d-flex gap-3 py-3" aria-current="true">
														<svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" class="bi bi-bounding-box" viewBox="0 0 16 16">
														<path d="M5 2V0H0v5h2v6H0v5h5v-2h6v2h5v-5h-2V5h2V0h-5v2H5zm6 1v2h2v6h-2v2H5v-2H3V5h2V3h6zm1-2h3v3h-3V1zm3 11v3h-3v-3h3zM4 15H1v-3h3v3zM1 4V1h3v3H1z"/>
														</svg>
														<div class="d-flex gap-2 w-100 justify-content-between">
														<div>
															<h5 class="mb-0">'. $row2['doc_seccion'] .'</h5>
															<p class="mb-0 opacity-75">Seccón.</p>
														</div>
														<small class="opacity-50 text-nowrap">Second</small>
														</div>
														</a>
													</div>

													<div class="col-sm-4">
														<a href="#" class="list-group-item list-group-item-action d-flex gap-3 py-3" aria-current="true">
														<svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" class="bi bi-upc" viewBox="0 0 16 16">
															<path d="M3 4.5a.5.5 0 0 1 1 0v7a.5.5 0 0 1-1 0v-7zm2 0a.5.5 0 0 1 1 0v7a.5.5 0 0 1-1 0v-7zm2 0a.5.5 0 0 1 1 0v7a.5.5 0 0 1-1 0v-7zm2 0a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-7zm3 0a.5.5 0 0 1 1 0v7a.5.5 0 0 1-1 0v-7z"/>
															</svg>
														<div class="d-flex gap-2 w-100 justify-content-between">
														<div>
															<h5 class="mb-0">'. $row2['doc_serie'] .'</h5>
															<p class="mb-0 opacity-75">Serie.</p>
														</div>
														<small class="opacity-50 text-nowrap">Cod</small>
														</div>
														</a>	
													</div>
													<div class="col-sm-4">
														<a href="#" class="list-group-item list-group-item-action d-flex gap-3 py-3" aria-current="true">
														<svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" class="bi bi-box" viewBox="0 0 16 16">
														<path d="M8.186 1.113a.5.5 0 0 0-.372 0L1.846 3.5 8 5.961 14.154 3.5 8.186 1.113zM15 4.239l-6.5 2.6v7.922l6.5-2.6V4.24zM7.5 14.762V6.838L1 4.239v7.923l6.5 2.6zM7.443.184a1.5 1.5 0 0 1 1.114 0l7.129 2.852A.5.5 0 0 1 16 3.5v8.662a1 1 0 0 1-.629.928l-7.185 2.874a.5.5 0 0 1-.372 0L.63 13.09a1 1 0 0 1-.63-.928V3.5a.5.5 0 0 1 .314-.464L7.443.184z"/>
														</svg>
														<div class="d-flex gap-2 w-100 justify-content-between">
														<div>
															<h5 class="mb-0">'. $row2['doc_cajas'] .'</h5>
															<p class="mb-0 opacity-75">Cajas.</p>
														</div>
														<small class="opacity-50 text-nowrap">Cod</small>
														</div>
														</a>	
													</div>
													<div class="col-sm-4">
														<a href="#" class="list-group-item list-group-item-action d-flex gap-3 py-3" aria-current="true">
														<svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" class="bi bi-badge-vo" viewBox="0 0 16 16">
														<path d="M4.508 11h1.429l1.99-5.999H6.61L5.277 9.708H5.22L3.875 5.001H2.5L4.508 11zM13.5 8.39v-.77c0-1.696-.962-2.733-2.566-2.733-1.604 0-2.571 1.029-2.571 2.734v.769c0 1.691.967 2.724 2.57 2.724 1.605 0 2.567-1.033 2.567-2.724zm-1.204-.778v.782c0 1.156-.571 1.732-1.362 1.732-.796 0-1.363-.576-1.363-1.732v-.782c0-1.156.567-1.736 1.363-1.736.79 0 1.362.58 1.362 1.736z"/>
														<path d="M14 3a1 1 0 0 1 1 1v8a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V4a1 1 0 0 1 1-1h12zM2 2a2 2 0 0 0-2 2v8a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V4a2 2 0 0 0-2-2H2z"/>
														</svg>
														<div class="d-flex gap-2 w-100 justify-content-between">
														<div>
															<h5 class="mb-0">'. $row2['doc_volumen'] .'</h5>
															<p class="mb-0 opacity-75">Volumen</p>
														</div>
														<small class="opacity-50 text-nowrap">Cod</small>
														</div>
														</a>
													</div>

													<div class="col-sm-4">
														<a href="#" class="list-group-item list-group-item-action d-flex gap-3 py-3" aria-current="true">
														<svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" class="bi bi-calendar-event" viewBox="0 0 16 16">
														<path d="M11 6.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1z"/>
														<path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5zM1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4H1z"/>
														</svg>
														<div class="d-flex gap-2 w-100 justify-content-between">
														<div>
															<h5 class="mb-0">'. $row2['doc_fecha'] .'</h5>
															<p class="mb-0 opacity-75">Fecha.</p>
														</div>
														<small class="opacity-50 text-nowrap">Cod</small>
														</div>
														</a>
													</div>
													<div class="col-sm-4">
														<a href="#" class="list-group-item list-group-item-action d-flex gap-3 py-3" aria-current="true">
														<svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" class="bi bi-bookmark-check" viewBox="0 0 16 16">
														<path fill-rule="evenodd" d="M10.854 5.146a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 1 1 .708-.708L7.5 7.793l2.646-2.647a.5.5 0 0 1 .708 0z"/>
														<path d="M2 2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v13.5a.5.5 0 0 1-.777.416L8 13.101l-5.223 2.815A.5.5 0 0 1 2 15.5V2zm2-1a1 1 0 0 0-1 1v12.566l4.723-2.482a.5.5 0 0 1 .554 0L13 14.566V2a1 1 0 0 0-1-1H4z"/>
														</svg>
														<div class="d-flex gap-2 w-100 justify-content-between">
														<div>
															<h5 class="mb-0">'. $row2['doc_estado'] .'</h5>
															<p class="mb-0 opacity-75">Estado.</p>
														</div>
														<small class="opacity-50 text-nowrap">Cod</small>
														</div>
														</a>
													</div>
													<div class="col-sm-4">
														<a href="#" class="list-group-item list-group-item-action d-flex gap-3 py-3" aria-current="true">
														<svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" class="bi bi-card-text" viewBox="0 0 16 16">
														<path d="M14.5 3a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-13a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h13zm-13-1A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-13z"/>
														<path d="M3 5.5a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5zM3 8a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9A.5.5 0 0 1 3 8zm0 2.5a.5.5 0 0 1 .5-.5h6a.5.5 0 0 1 0 1h-6a.5.5 0 0 1-.5-.5z"/>
														</svg>
														<div class="d-flex gap-2 w-100 justify-content-between">
														<div>
															<h5 class="mb-0">'. $row2['doc_nota'] .'</h5>
															<p class="mb-0 opacity-75">Nota.</p>
														</div>
														<small class="opacity-50 text-nowrap">Cod</small>
														</div>
														</a>
													</div>											
											</div>
									</div>
								</div>
							</div>
							</div>
							';
						}
						
					}
							$html .= '	
								
						</div>
				</div>
			</div>
		
		</div>
				
		<br>		
			
<div class="text-center">
	<a href="vistas/reporte_user.php" class="text-center btn btn-secondary btn-lg" >Reporte</a>
	<a href="index.php?op=4" class="text-center btn btn-primary btn-lg" >Regresar</a>
</div>';
				
				return $html;
		}
	}

//*********************** ELIMINAR ********************************************************* */
	public function delete_bodega($id){

		
			$sql = "DELETE FROM usuarios WHERE 	user_id =$id;";
			if($this->con->query($sql)){
			echo $this->_message_ok("eliminar");
			}else{
			echo $this->_message_error("eliminar");
		
		}
		
			
	}
//******************************************************************************** */
private function _message_error($tipo){
	$html = '
	<table border="0" align="center">
		<tr>
			<th>Error al ' . $tipo . '. Favor contactar a .................... </th>
		</tr>
		<tr>
			<th><a href="index.php?op=4">Regresar</a></th>
		</tr>
	</table>';
	return $html;
}


	private function _message_ok($tipo){
	
		echo '<script language="javascript">
		alert("El registro se  ' . $tipo . ' correctamente");';
		if(!isset($_GET['res']) ){
		echo 'window.location="index.php?op=4"
		</script>';
		}
		if(isset($_GET['res']) && $_GET['res']=='1'){
			echo 'window.location="../index.php"
		</script>';
		}
		
	}

}



?>
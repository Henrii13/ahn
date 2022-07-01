<?php 
class solicitud{
    private $id;
	private $user_cedula;
	private $doc_id;
	private $estado;
	private $status_cliente;
	private $status_admin;
	private $status_custodio;
	private $fecha_cliente;
	private $fecha_admin;
	private $fecha_custodio;
	private $status_entrega;
	private $fecha_entrega;


    function __construct($cn){
        $this->con = $cn;
    }
//*********************** 3.1 METODO update_bodega() **************************************************	
	
public function update_user(){
	$this->id = $_POST['id'];
	$this->user_cedula =  $_POST['user_cedula'];
	$this->doc_id = $_POST['doc_id'];
	$this->estado = $_POST['estado'];
	$this->status_cliente= $_POST['status_cliente'];
	$this->status_admin = $_POST['status_admin'];
	$this->status_custodio= $_POST['status_custodio'];
	$this->fecha_cliente = $_POST['fecha_cliente'];
	$this->fecha_admin = $_POST['fecha_admin'];
	$this->fecha_custodio = $_POST['fecha_custodio'];
	$this->status_entrega = $_POST['status_entrega'];
	$this->fecha_entrega=  $_POST['fecha_entrega'];

	$sql = "UPDATE solicitud SET soli_user_cedula='$this->user_cedula',
								soli_doc_id='$this->doc_id',
								soli_estado='$this->estado',
								soli_status_cliente='$this->status_cliente',
								soli_status_admin='$this->status_admin',
								soli_status_custodio ='$this->status_custodio',
								soli_fecha_cliente ='$this->fecha_cliente',
								soli_fecha_admin='$this->fecha_admin',
								soli_fecha_custodio='$this->fecha_custodio',
                                soli_status_entrega='$this->status_entrega',
								soli_fecha_entrega='$this->fecha_entrega'
								WHERE 	soli_id =$this->id;";
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

		
    $this->user_cedula =  $_POST['user_cedula'];
	$this->doc_id = $_POST['doc_id'];
	$this->estado = $_POST['estado'];
	$this->status_cliente= $_POST['status_cliente'];
	$this->status_admin = $_POST['status_admin'];
	$this->status_custodio= $_POST['status_custodio'];
	$this->fecha_cliente = $_POST['fecha_cliente'];
	$this->fecha_admin = $_POST['fecha_admin'];
	$this->fecha_custodio = $_POST['fecha_custodio'];
	$this->status_entrega = $_POST['status_entrega'];
	$this->fecha_entrega=  $_POST['fecha_entrega'];


	$sql = "INSERT INTO solicitud VALUES(NULL,
										'$this->user_cedula ',
										'$this->doc_id ',
										'$this->estado',
										'$this->status_cliente',
										'$this->status_admin',
										'$this->status_custodio',
										'$this->fecha_cliente',
										'$this->fecha_admin',
										'$this->fecha_custodio',
										'$this->status_entrega',
										'$this->fecha_entrega'
										);";
	
	
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

				
	$html = '
	
		<div class="container">
			<div class="row g-5">
				<div class="col-md-7 col-lg-8">
					<h4 class="mb-3">Usuario: </h4>';
				
						$html .= '<form class="needs-validation" name="bodega" method="POST" action="index.php?op=4" enctype="multipart/form-data novalidate">';
					
					
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
						<input type="text" class="form-control" id="pasaporte" placeholder="" name="pasaporte" value="' . $this->numero_pasaporte . '" required>
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
						<input type="text" class="form-control" id="direccion_permanente" placeholder="" name="direccion_permanente" value="' . $this->direccion_permanente. '" required>
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
					<h4 class="mb-3">Solicitudes</h4>
					
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
	
	public function get_detail_solicitud($id){
		$sql = "SELECT *
				FROM solicitud 
				WHERE soli_id=$id ;";
		$res = $this->con->query($sql);
		$row = $res->fetch_assoc();
        $cedula=$row['soli_user_cedula'];
        $doc=$row['soli_doc_id'];
        $sql2 = "SELECT *
				FROM  usuarios
				WHERE user_cedula = $cedula";
		$res2 = $this->con->query($sql2);
		$row2 = $res2->fetch_assoc();

        $sql3 = "SELECT *
				FROM documento
				WHERE 	doc_id =$doc ;";
		$res3 = $this->con->query($sql3);
		$row3 = $res3->fetch_assoc();
		
		$num = $res->num_rows;

        //Si es que no existiese ningun registro debe desplegar un mensaje 
        //$mensaje = "tratar de eliminar el vehiculo con id= ".$id;
        //echo $this->_message_error($mensaje);
        //y no debe desplegarse la tablas
		
		
        if($num==0){
            $mensaje = "tratar de editar el vehiculo con id= ".$id;
            echo $this->_message_error($mensaje);
        }else{ 
				$html = '
                <h3 class="pb-2 border-bottom">Detalle Solicitud</h3>
				<div class="container">
                    <main>
                    <div class="row g-5">
                        <div class="col-md-5 col-lg-4 order-md-last">
                            <h4 class="d-flex justify-content-between align-items-center mb-3">
                            <span class="text-secondary">Solicitante</span>
                            
                            </h4>
                            <ul class="list-group mb-3">
                            <li class="list-group-item d-flex justify-content-between bg-light">
                                <div class="text-success">
                                <h5 class="my-0">'. $row2['user_cedula'] .'</h5>
                                <small>Cedula</small>
                                </div>
                                <span class="text-success"></span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between lh-sm">
                                <div>
                                <h6 class="my-0">'. $row2['user_usuario'] .' '. $row2['user_usuario'] .' '. $row2['user_usuario'] .' '. $row2['user_usuario'] .'</h6>
                                <small class="text-muted">Nombre</small>
                                </div>
                                <span class="text-muted">$8</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between lh-sm">
                                <div>
                                <h6 class="my-0">'. $row2['user_nacionalidad'] .'</h6>
                                <small class="text-muted">Nacionalidad</small>
                                </div>
                                <span class="text-muted">$8</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between lh-sm">
                                <div>
                                <h6 class="my-0">'. $row2['user_telefono'] .'</h6>
                                <small class="text-muted">Télefono</small>
                                </div>
                                <span class="text-muted">$8</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between lh-sm">
                                <div>
                                <h6 class="my-0">'. $row2['user_correo'] .'</h6>
                                <small class="text-muted">Correo</small>
                                </div>
                                <span class="text-muted">$8</span>
                            </li>
                           
                            </ul>

                          
                        </div>


                        <div class="col-md-7 col-lg-8">
                            <h4 class="mb-3 text-secondary">Documento</h4>
                            <form class="needs-validation" novalidate>
                            <div class="row g-3">
                                
                            <div class="col-sm-4">
                                <a href="#" class="list-group-item list-group-item-action d-flex gap-3 py-3" aria-current="true">
                                <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" class="bi bi-postcard" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd" d="M2 2a2 2 0 0 0-2 2v8a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V4a2 2 0 0 0-2-2H2ZM1 4a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1v8a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V4Zm7.5.5a.5.5 0 0 0-1 0v7a.5.5 0 0 0 1 0v-7ZM2 5.5a.5.5 0 0 1 .5-.5H6a.5.5 0 0 1 0 1H2.5a.5.5 0 0 1-.5-.5Zm0 2a.5.5 0 0 1 .5-.5H6a.5.5 0 0 1 0 1H2.5a.5.5 0 0 1-.5-.5Zm0 2a.5.5 0 0 1 .5-.5H6a.5.5 0 0 1 0 1H2.5a.5.5 0 0 1-.5-.5ZM10.5 5a.5.5 0 0 0-.5.5v3a.5.5 0 0 0 .5.5h3a.5.5 0 0 0 .5-.5v-3a.5.5 0 0 0-.5-.5h-3ZM13 8h-2V6h2v2Z"/>
                                </svg>
                                <div class="d-flex gap-2 w-100 justify-content-between">
                                <div>
                                    <h5 class="mb-0">'. $row3['doc_id'] .'</h5>
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
                                    <h5 class="mb-0">'. $row3['doc_est'] .'</h5>
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
                                    <h5 class="mb-0">'. $row3['doc_columna'] .'</h5>
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
                                    <h5 class="mb-0">'. $row3['doc_nivel'] .'</h5>
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
                                    <h5 class="mb-0">'. $row3['doc_fondo'] .'</h5>
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
                                    <h5 class="mb-0">'. $row3['doc_seccion'] .'</h5>
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
                                    <h5 class="mb-0">'. $row3['doc_serie'] .'</h5>
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
                                    <h5 class="mb-0">'. $row3['doc_cajas'] .'</h5>
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
                                    <h5 class="mb-0">'. $row3['doc_volumen'] .'</h5>
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
                                    <h5 class="mb-0">'. $row3['doc_fecha'] .'</h5>
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
                                    <h5 class="mb-0">'. $row3['doc_estado'] .'</h5>
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
                                    <h5 class="mb-0">'. $row3['doc_nota'] .'</h5>
                                    <p class="mb-0 opacity-75">Nota.</p>
                                </div>
                                <small class="opacity-50 text-nowrap">Cod</small>
                                </div>
                                </a>
                            </div>
                            <div class="col-sm-4">
                                <a href="#" class="list-group-item list-group-item-action d-flex gap-3 py-3" aria-current="true">
                                <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" class="bi bi-postcard-fill" viewBox="0 0 16 16">
                                <path d="M11 8h2V6h-2v2Z"/>
                                <path d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V4Zm8.5.5a.5.5 0 0 0-1 0v7a.5.5 0 0 0 1 0v-7ZM2 5.5a.5.5 0 0 0 .5.5H6a.5.5 0 0 0 0-1H2.5a.5.5 0 0 0-.5.5ZM2.5 7a.5.5 0 0 0 0 1H6a.5.5 0 0 0 0-1H2.5ZM2 9.5a.5.5 0 0 0 .5.5H6a.5.5 0 0 0 0-1H2.5a.5.5 0 0 0-.5.5Zm8-4v3a.5.5 0 0 0 .5.5h3a.5.5 0 0 0 .5-.5v-3a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5Z"/>
                                </svg>
                                <div class="d-flex gap-2 w-100 justify-content-between">
                                <div>
                                    <h5 class="mb-0">'. $row3['doc_cedula_pk'] .'</h5>
                                    <p class="mb-0 opacity-75">Cedula.</p>
                                </div>
                                <small class="opacity-50 text-nowrap">Cod</small>
                                </div>
                                </a>
                            </div>

                              

                           
                        </div>
                    </div>
                    </main>



                </div>
				
				
			</div>
		
				
			
				
		<br>		
			
<div class="text-center">
	<a href="vistas/reporte_user.php" class="text-center btn btn-secondary btn-lg" >Reporte</a>
	<a href="index.php?op=4" class="text-center btn btn-primary btn-lg" >Regresar</a>
</div>
<br>	<br><br>	
';
				
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
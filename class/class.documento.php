<?php 	

class documento{
    private $id;
	private $est_id;
	private $estatenria;
	private $columna;
	private $nivel;
	private $fondo;
	private $seccion;
	private $serie;
	private $cajas;
    private $volumen;
    private $fecha;
    private $estado;
    private $cedula;
    private $nota;
	
	
    function __construct($cn){
        $this->con = $cn;
    }
//*********************** 3.1 METODO update_bodega() **************************************************	
	
public function update_bodega(){
	$this->id = $_POST['id'];
	$this->est_id= $_POST['id'];
		$this->estatenria= $_POST['estatenria'];
		$this->columna= $_POST['columna'];
		$this->nivel= $_POST['nivel'];
		$this->fondo= $_POST['fondo'];
		$this->seccion= $_POST['seccion'];
		$this->serie= $_POST['serie'];
		$this->cajas= $_POST['cajas'];
		$this->volumen= $_POST['volumen'];
		$this->fecha= $_POST['fecha'];
		$this->estado= $_POST['estado'];
		$this->cedula= $_POST['cedula'];
		$this->nota= $_POST['nota'];
	
	echo $this->cedula;
	
	$sql = "UPDATE documento SET doc_est='$this->est_id',
								doc_estanteria='$this->estatenria',
								doc_columna='$this->columna',
								doc_nivel='$this->nivel',
								doc_fondo='$this->fondo',
								doc_seccion='$this->seccion',
								doc_serie='$this->serie',
								doc_cajas='$this->cajas',
								doc_volumen='$this->volumen',
								doc_fecha='$this->fecha',
								doc_estado='$this->estado',
								doc_cedula_pk='$this->cedula',
								doc_nota='$this->nota'
								WHERE doc_id =$this->id;";
	echo $sql;
	//exit;
	if($this->con->query($sql)){
		echo $this->_message_ok("modifico");
	}else{
		echo $this->_message_error("al modificar");
	}								
									
}


//*********************** 3.2 METODO save_bodega() **************************************************	

public function save_bodega(){
	
	$this->id = $_POST['id'];
	$this->est_id= $_POST['id'];
		$this->estatenria= $_POST['estatenria'];
		$this->columna= $_POST['columna'];
		$this->nivel= $_POST['nivel'];
		$this->fondo= $_POST['fondo'];
		$this->seccion= $_POST['seccion'];
		$this->serie= $_POST['serie'];
		$this->cajas= $_POST['cajas'];
		$this->volumen= $_POST['volumen'];
		$this->fecha= $_POST['fecha'];
		$this->estado= $_POST['estado'];
		
		$this->nota= $_POST['nota'];
	date_default_timezone_set('America/Guayaquil');
	$DateAndTime = date('Y-m-d'); 
	$sql = "INSERT INTO documento VALUES(NULL,
										'$this->est_id',
										'$this->estatenria',
										'$this->columna',
										'$this->nivel',
										'$this->fondo',
										'$this->seccion',
										'$this->serie',
										'$this->cajas',
										'$this->volumen',
										'$DateAndTime',
										'$this->estado',
										'$this->nota',
										NULL
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
 private function _get_combo($tabla,$valor,$etiqueta,$nombre,$defecto){
	$html = '<select  class=" selectpicker show-menu-arrow " 
	data-style="form-control" 
	data-live-search="true" 
	title="-- Selecciona la Localidad  --"
	single
			name="' . $nombre . '" required>';
	$sql = "SELECT $valor,$etiqueta FROM $tabla;";
	$res = $this->con->query($sql);
	while($row = $res->fetch_assoc()){
		//ImpResultQuery($row);
		$html .= ($defecto == $row[$etiqueta])?'<option value="' . $row[$etiqueta] . '" selected>' . $row[$etiqueta] . '</option>' . "\n" : '<option value="' . $row[$etiqueta] . '">' . $row[$etiqueta] . '</option>' . "\n";
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
				// OPCION PARA GRABAR UN NUEV VEHICULO (id=0)
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
	
		$this->est_id= NULL;
		$this->estatenria= NULL;
		$this->columna= NULL;
		$this->nivel= NULL;
		$this->fondo= NULL;
		$this->seccion= NULL;
		$this->serie= NULL;
		$this->cajas= NULL;
		$this->volumen= NULL;
		$this->fecha= NULL;
		$this->estado= NULL;
		$this->cedula= NULL;
		$this->nota= NULL;
		$flag = NULL;
		$op = "new";
	}else{

		$sql = "SELECT * FROM documento WHERE doc_id=$id;";
		$res = $this->con->query($sql);
		$row = $res->fetch_assoc();
		
		$num = $res->num_rows;
		if($num==0){
			$mensaje = "tratar de actualizar el vehiculo con id= ".$id;
			echo $this->_message_error($mensaje);
		}else{   
		
			/* -- //
			echo "<br>TUPLA <br>";
			echo "<pre>";
				print_r($row);
			echo "</pre>";
		*/
	
		$this->est_id= $row['doc_est'];
		$this->estatenria= $row['doc_estanteria'];
		$this->columna= $row['doc_columna'];
		$this->nivel= $row['doc_nivel'];
		$this->fondo= $row['doc_fondo'];
		$this->seccion= $row['doc_seccion'];
		$this->serie= $row['doc_serie'];
		$this->cajas= $row['doc_cajas'];
		$this->volumen= $row['doc_volumen'];
		$this->fecha= $row['doc_fecha'];
		$this->estado= $row['doc_estado'];
		$this->cedula= $row['doc_cedula_pk'];
		$this->nota= $row['doc_nota'];
		
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
					<h4 class="mb-3">Ingreso de Documetos</h4>
					<form class="needs-validation" name="bodega" method="POST" action="index.php?op=1" enctype="multipart/form-data novalidate">
						<input type="hidden" name="id" value="' . $id  . '">
						<input type="hidden" name="op" value="' . $op  . '">
						<input type="hidden" class="form-control" id="cedula"  name="cedula" value="' . $this->cedula . '" >
						<div class="row g-3">
							<!--<div class="col-sm-3">
								<label for="codigo" class="form-label">Est_id</label>
								<input type="text" class="form-control" id="est_id" placeholder="" name="est_id" value="' . $this->est_id . '" required>
								<div class="invalid-feedback">
									Valid first name is required.
								</div>
							</div>-->
							<div class="col-sm-9">
								
							</div>
							<div class="col-sm-4">
								<label for="Name" class="form-label">Estanteria</label>
								<input type="text" class="form-control" id="estatenria" placeholder="" name="estatenria" value="' . $this->estatenria . '" required>
								<div class="invalid-feedback">
									Valid first name is required.
								</div>
							</div>
							<div class="col-sm-4">
								<label for="marca" class="form-label">Columna</label>
								<input type="text" class="form-control" id="columna" placeholder="" name="columna" value="' . $this->columna . '" required>
								<div class="invalid-feedback">
									Valid first name is required.
								</div>
							</div>
							<div class="col-sm-4">
								<label for="modelo" class="form-label">Nivel</label>
								<input type="text" class="form-control" id="nivel" placeholder="" name="nivel" value="' . $this->nivel . '" required>
								<div class="invalid-feedback">
									Valid first name is required.
								</div>
							</div>
							<div class="col-sm-4">
								<label for="custodio" class="form-label">Fondo</label>
								<input type="text" class="form-control" id="fondo" placeholder="" name="fondo" value="' . $this->fondo . '" required>
								<div class="invalid-feedback">
									Valid first name is required.
								</div>
							</div>
		
							<div class="col-sm-4">
								
							</div>
							<div class="col-sm-4">
								<label for="custodio" class="form-label">Seccion</label>
								<input type="text" class="form-control" id="seccion" placeholder="" name="seccion" value="' . $this->seccion . '" required>
								<div class="invalid-feedback">
									Valid first name is required.
								</div>
							</div>
							<div class="col-sm-4">
								<label for="custodio" class="form-label">Serie</label>
								<input type="text" class="form-control" id="serie" placeholder="" name="serie" value="' . $this->serie . '" required>
								<div class="invalid-feedback">
									Valid first name is required.
								</div>
							</div>
							<div class="col-sm-4">
								<label for="custodio" class="form-label">Cajas</label>
								<input type="text" class="form-control" id="cajas" placeholder="" name="cajas" value="' . $this->cajas . '" required>
								<div class="invalid-feedback">
									Valid first name is required.
								</div>
							</div>
							<div class="col-sm-4">
								<label for="custodio" class="form-label">Volumen</label>
								<input type="text" class="form-control" id="volumen" placeholder="" name="volumen" value="' . $this->volumen . '" required>
								<div class="invalid-feedback">
									Valid first name is required.
								</div>
							</div>
							<div class="col-sm-4">
								<label for="receptor" class="form-label">Fecha</label>
								<input type="date" class="form-control" id="fecha" placeholder="" name="fecha" value="' . $this->fecha . '" required>
								<div class="invalid-feedback">
									Valid first name is required.
								</div>
							</div>
							<div class="col-sm-4">
								<label for="receptor" class="form-label">Estado</label>
								<select id="estado" name="estado" class="form-control form-select">
									<option value="Disponible" >Disponible</option>
									<option value="Mantenimiento">Mantenimiento</option>
									<option value="Ocupado">Ocupado</option>
					 			 </select>
								
							
								<div class="invalid-feedback">
									Valid first name is required.
								</div>
							</div>
							<!--<div class="col-sm-4">
								<label for="receptor" class="form-label">Cedula del Usuario</label>
									' . $this->_get_combo("usuarios","user_id ","user_cedula","cedula",$this->cedula) . '
								<input type="hidden" class="form-control" id="cedula"  name="cedula" value="Disponible" >
								<div class="invalid-feedback">
									Valid first name is required.
								</div>
							</div>-->
							<div class="col-sm-9">
								<label for="receptor" class="form-label">Nota</label>
								<input type="text" class="form-control" id="nota" placeholder="" name="nota" value="' . $this->nota . '" required>
								<div class="invalid-feedback">
									Valid first name is required.
								</div>
							</div>
							<div class="col-sm-9">
								
							</div>
							
							<div class="col-sm-9">
								
							</div>
						</div>
						<hr class="my-4">
						<div class="col-sm-3">
						<button class="w-100 btn btn-primary btn-lg" type="submit" name="Guardar">Guardar</button>
					</div>
					<div class="col-sm-2">
					<a href="index.php?op=1" class="text-center btn btn-danger btn-lg" >Cancelar</a>
					</div>
         
		 
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
					<h4 class="mb-3">Consulta de Documentos</h4>
					
				</div>
				
				<div class="col-sm-7">
				<section>
						<input  name="busqueda" id="busqueda" class="form-control" placeholder="Buscar">
				</section>
				</div>
			
				<div class="col-sm-1 " >
				
					<a  class="btn btn-primary nav-link  " href="index.php?op=1&d=' . $d_new_final . '">Nuevo</a></div>
					<div class="col-sm-1 " >
				<a   onclick="myFunction(1)" class="btn btn-primary nav-link  ">Reporte</a>
					</div>
				</div>
				<br>
				
				<div class="hidden" id="1">
				<form action="vistas/reporte_doc.php" method="post" class="w3-container">
				<div class="w3-row w3-container">
				
				<div class="col-sm-5">
                <label>DESDE: </label>
                <input  class="form-control" type="Date" name="Consulta" class="box" id="myInput"  />
				</div>
				
				<div class="col-sm-5">
                <label>HASTA: </label>
					<input  class="form-control" type="Date" name="Consultas" class="box" id="myInput2"  />   
				</div>
			</div>
			<div class="col-sm-2">
            <p style="text-align: left;">
            &nbsp&nbsp
				<button   class="text-center btn btn-danger "> PDF</button>
			
			</p>
			</div>
			</form>
			</div>
		</div>


			<br>
			
			<section id="tabla_resultado">
		<!-- AQUI SE DESPLEGARA NUESTRA TABLA DE CONSULTA -->
		</section>';
			
      
       
       
		$html .= '  
		
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
	
	public function get_detail_bodega($id,$ceduser,$rol){
		$sql = "SELECT *
				FROM documento
				WHERE doc_id=$id ;";
		$res = $this->con->query($sql);
		$row = $res->fetch_assoc();
		$doc=$row['doc_id'];
		$num = $res->num_rows;

		$sql2 = "SELECT *
		FROM solicitud 
		WHERE soli_doc_id=$doc ORDER BY soli_id  DESC LIMIT 1;";
	
		
		$res2 = $this->con->query($sql2);
		$row2 = $res2->fetch_assoc();
		if(!empty($row2['soli_estado'])){
			$estadosoli=$row2['soli_estado'];
		}
		
		echo $sql2,$row2['soli_estado']; ;
        //Si es que no existiese ningun registro debe desplegar un mensaje 
        //$mensaje = "tratar de eliminar el vehiculo con id= ".$id;
        //echo $this->_message_error($mensaje);
        //y no debe desplegarse la tablas
        
        if($num==0){
            $mensaje = "tratar de editar el el documento con id= ".$id;
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
										<h5 class="mb-0">'. $row['doc_id'] .'</h5>
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
										<h5 class="mb-0">'. $row['doc_est'] .'</h5>
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
										<h5 class="mb-0">'. $row['doc_columna'] .'</h5>
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
										<h5 class="mb-0">'. $row['doc_nivel'] .'</h5>
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
										<h5 class="mb-0">'. $row['doc_fondo'] .'</h5>
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
										<h5 class="mb-0">'. $row['doc_seccion'] .'</h5>
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
										<h5 class="mb-0">'. $row['doc_serie'] .'</h5>
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
										<h5 class="mb-0">'. $row['doc_cajas'] .'</h5>
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
										<h5 class="mb-0">'. $row['doc_volumen'] .'</h5>
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
										<h5 class="mb-0">'. $row['doc_fecha'] .'</h5>
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
										<h5 class="mb-0">'. $row['doc_estado'] .'</h5>
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
										<h5 class="mb-0">'. $row['doc_nota'] .'</h5>
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
										<h5 class="mb-0">'. $row['doc_cedula_pk'] .'</h5>
										<p class="mb-0 opacity-75">Cedula.</p>
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
			<div class="row g-3">
			<div class="col-sm-4">
			</div>
			<div class="col-sm-2	">
									
							
			';
			
      
       
       
			
			if($row['doc_estado']=="Disponible" AND $rol==3 ){
			
			$html .= '
			<form method="post" id="comment_form">
						<input type="hidden" id="ceduser" name="ceduser" value="' . $ceduser  . '">
						<input type="hidden" id="doc_id" name="doc_id" value="' . $row['doc_id']  . '">
						<input type="hidden" name="campo" value="aniadir">
						<input type="hidden" name="estado" value="Solicita">
						
						
						 <input type="submit"  name="post" id="post" class="btn btn-lg btn-info" value="Solicitar" />
						
					   </form>		
					   ';
			
					}
			if($row['doc_estado']=="Ocupado" AND $estadosoli == "Entregado" AND $rol==3 AND $row['doc_cedula_pk']==$ceduser){
						
				$html .= '	
				<form method="post" id="comment_form">
					
					<input type="hidden" id="doc_id" name="doc_id" value="' . $row['doc_id']  . '">
					
					<input type="hidden" name="estado" value="Disponible">
					<input type="hidden" name="estado2" value="Devolver">
					
					
					<input type="submit"  name="post" id="post" class="btn btn-lg btn-info" value="Devolver" />
				
			   </form>	
							
							
							';
						
					}
				
			if($row['doc_estado']=="Ocupado" AND $estadosoli == "Solicita" AND $rol==2){
			
			$html .= '
			<form method="post" id="comment_form">
				<input type="hidden" id="doc_id" name="doc_id" value="' . $row['doc_id']  . '">
				<input type="hidden" name="estado" value="Despacho">
				
				
				<input type="submit"  name="post" id="post" class="btn btn-lg btn-info" value="Despachar" />
			
		   </form>
					   ';
			
					}

			if($row['doc_estado']=="Ocupado" AND $estadosoli == "Despacho" AND $rol==1){
			
			$html .= '
			<form method="post" id="comment_form">
						<input type="hidden" id="doc_id" name="doc_id" value="' . $row['doc_id']  . '">
						<input type="hidden" name="estado" value="Entregado">
						
						
						 <input type="submit"  name="post" id="post" class="btn btn-lg btn-info" value="Entregar" />
						
					   </form>
					   ';
			
					}
			if($row['doc_estado']=="Disponible" AND $estadosoli == "Devolver" AND $rol==1){
			
			$html .= '
			<form method="post" id="comment_form">
							<input type="hidden" id="doc_id" name="doc_id" value="' . $row['doc_id']  . '">
							<input type="hidden" name="estado" value="Recibido">
				   		    <input type="submit"  name="post" id="post" class="btn btn-lg btn-info" value="Recibir" />
									
								   </form>
								   ';
						
								}
					
			
		
			
					   $html .= '	
			
					   </div> 
					   <div class="col-sm-4">
					   <a href="index.php?op=1" class="text-center btn btn-primary btn-lg" >Regresar</a></td>
					   </div> 
					   </div>';
			

				
				return $html;
				
		}
	}

//*********************** ELIMINAR ********************************************************* */
	public function delete_bodega($id){

		
			$sql = "DELETE FROM documento WHERE doc_id =$id;";
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
			<th><a href="index.php?op=1">Regresar</a></th>
		</tr>
	</table>';
	return $html;
}


	private function _message_ok($tipo){
	
		echo '<script language="javascript">
		alert("El registro se  ' . $tipo . ' correctamente");
		window.location="index.php?op=1"
		</script>';
		
	}

}



?>
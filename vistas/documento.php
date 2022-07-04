<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>
	<title>Documentos | AHN</title>
	<meta http-equiv="content-type" content="text/html;charset=utf-8" />
	<!-- CSS only -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
<link rel="icon" href="./imagen/Arch.jpg">
	<link rel="canonical" href="https://getbootstrap.com/docs/5.0/examples/sidebars/">
	<link rel='stylesheet prefetch' href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css'>
	<link rel="stylesheet" type="text/css" href="assets/select2/select2.min.css">
	<script
  src="https://code.jquery.com/jquery-3.3.1.js"
  integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60="
  crossorigin="anonymous"></script>



	
		<!-- SCRIPTS JS-->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
		
</head>
<body>
<?php include_once 'header.php'; ?>

<div class="container-fluid pb-3">
    
      <div class="bg-light border rounded-3">

		<div class="container">

			<div class="row ">
		
			<div class="col-lg-12 m-3 pb-3"  >
			<?php
		require_once("includes/constantes.php");
		
		include_once("class/class.documento.php");
		$cn = conectar();
		
		$c = new documento($cn);
		if(isset($_GET['d'])){
			$dato = base64_decode($_GET['d']);
		//	echo $dato;exit;
			$tmp = explode("/", $dato);
			$dato = $_GET['d'];
			$op = $tmp[0];
			$id = $tmp[1];
			
			if($op == "del"){
				echo $c->delete_bodega($id);
			}elseif($op == "det"){
				echo $c->get_detail_bodega($id,$user->getNombre(),$user->getrol());
			}elseif($op == "new"){
				echo $c->get_form();
			}elseif($op == "act"){
				echo $c->get_form($id);
			}
			
       // PARTE III	
		}else{
			    /*echo "<br>PETICION POST <br>";
				echo "<pre>";
					print_r($_POST);
				echo "</pre>";
		*/
			if(isset($_POST['Guardar']) && $_POST['op']=="new"){
				$c->save_bodega();
			}elseif(isset($_POST['Guardar']) && $_POST['op']=="update"){
				
				$c->update_bodega();
			}else{
				if (isset($_GET["w3"]) && isset($_GET["w4"])) {

					$w3 = $_GET["w3"];
					$w4 = $_GET["w4"];
				
				
					if($w3=="NULL"){
						$sql = "UPDATE documento SET doc_cedula_pk=NULL, doc_estado='Disponible', doc_fechafin=NOW() where 	doc_id  = '$w4'";
						$sql2 = "INSERT INTO historial( user_cedula	, doc_id, doc_fecha) VALUES ('Disponible','$w4',NOW())";
						
					}
					else if($w3=="M"){
						$sql = "UPDATE documento SET doc_cedula_pk=NULL, doc_estado='Mantenimiento' , doc_fechafin=NOW() where 	doc_id  = '$w4'";
						$sql2 = "INSERT INTO historial( user_cedula	, doc_id, doc_fecha) VALUES ('Consevación','$w4',NOW())";
						
					}
					else if($w3!="NULL"){
						$sql = "UPDATE documento SET doc_cedula_pk='$w3', doc_estado='Ocupado', doc_fechafin=NOW() where 	doc_id  = '$w4'";
						$sql2 = "INSERT INTO historial( user_cedula	, doc_id, doc_fecha) VALUES ('$w3','$w4',NOW())";
					
					}
					mysqli_query($cn, $sql2);
					mysqli_query($cn, $sql);
					
				}
				echo $c->get_list( $user->getrol());
			}	
		}
		
	//*******************************************************
		function conectar(){
			//echo "<br> CONEXION A LA BASE DE DATOS<br>";
			$c = new mysqli(SERVER,USER,PASS,BD);
			
			if($c->connect_errno) {
				die("Error de conexión: " . $c->mysqli_connect_errno() . ", " . $c->connect_error());
			}else{
				//echo "La conexión tuvo éxito .......<br><br>";
			}
			
			$c->set_charset("utf8");
			return $c;
		}
	//**********************************************************	

		
	?>
			</div>
			
			</div>
		</div> 

		
	  <script>

				$(obtener_registros());

				function obtener_registros(equipo)
				{
					$.ajax({
						url : 'vistas/consultaD.php',
						type : 'POST',
						dataType : 'html',
						data : { equipo: equipo },
						})

					.done(function(resultado){
						$("#tabla_resultado").html(resultado);
					})
				}

				$(document).on('keyup', '#busqueda', function()
				{
					
					var valorBusqueda=$(this).val();
					
					if (valorBusqueda!="")
					{
						obtener_registros(valorBusqueda);
					}
					else
						{
							obtener_registros();
						}
				});

						function actualizacion2(opSelect, otraVar) {
							//alert( window.location.href + "?w3=" + opSelect + "&w4=" + otraVar);
							window.location.href = window.location.href + "&w3=" + opSelect + "&w4=" + otraVar;
						}
						
				
						$('.selectpicker').selectpicker();
		function myFunction(id) {
  var x = document.getElementById(id);
  if (x.className.indexOf("a") == -1) {
    x.className = x.className.replace("hidden", "a");
  } else { 
    x.className = x.className.replace("a", "hidden");
  }
}
$(document).ready(function(){
		$('#controlBuscador').select2();
	});
			
	  </script>
	 
	
        
      </div>
    </div>
  </div>

  <?php include_once 'footers.php'; ?>

  
  

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.6.3/js/bootstrap-select.min.js"></script>

	<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script> <script src="sidebars.js"></script>
	
	
	 
</body>
</html>

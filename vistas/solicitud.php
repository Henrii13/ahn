<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>
	<title>Solicitud | AHN</title>
	<meta http-equiv="content-type" content="text/html;charset=utf-8" />
	<!-- CSS only -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
<link rel="icon" href="https://scontent.fuio1-2.fna.fbcdn.net/v/t39.30808-6/239124507_541377193955747_5668063991736172393_n.jpg?_nc_cat=107&ccb=1-7&_nc_sid=730e14&_nc_eui2=AeGXuCvzd-y4ZOlWK9erplTD5Zpd-lSHYMTlml36VIdgxNPi7mfeJPsVd1bu-d-R9SxOImg7AzqXuaqundCncBA9&_nc_ohc=yOv7XLXMnSYAX-RuEb4&_nc_ht=scontent.fuio1-2.fna&oh=00_AT8q1nTY02VJeFvnRrVI-A1PPF9sE_mytSnXia_iq3me8A&oe=6298985F">
	<link rel="canonical" href="https://getbootstrap.com/docs/5.0/examples/sidebars/">
	<link rel='stylesheet prefetch' href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css'>
	<link rel='stylesheet prefetch' href='https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.11.2/css/bootstrap-select.min.css'>
	<script src="https://code.jquery.com/jquery-3.5.0.js"></script>
		<!-- SCRIPTS JS-->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
		

</head>
<body>
	<style>
		#ecua{
			display: block;
		}
		#ecua2{
			display: none;
		}
	</style>
<?php
	include_once 'header.php';
 ?>


<div class="container-fluid pb-3">
    
      <div class="bg-light border rounded-3">

		<div class="container">

			<div class="row ">
		
			<div class="col-lg-12 m-3 pb-3"  >
			<?php
			if(!isset($_GET['res'])){
					require_once("includes/constantes.php");
					include_once("class/class.solicitud.php");
				}
			if(isset($_GET['res']) && $_GET['res']=='1'){
					require_once("../includes/constantes.php");
					include_once("../class/class.solicitud.php");
				}	
        
		$cn = conectar();
		
		$c = new solicitud($cn);
		
		if(isset($_GET['d'])){
			$dato = base64_decode($_GET['d']);
		//	echo $dato;exit;
		
			$tmp = explode("/", $dato);
			$dato = $_GET['d'];
			$op = $tmp[0];
			$id = $tmp[1];
		
		
			
			
			if($op == "del"){
				echo $c->delete_usuario($id);
			}elseif($op == "det"){
				echo $c->get_detail_solicitud($id);
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
			if(isset($_POST['Guardar']) && $_POST['op']=="new" && !isset($_GET['res'])){
				$c->save_user();
			}elseif(isset($_POST['Guardar']) && $_POST['op']=="update" ){
				
				$c->update_user();
			}else{
				
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
		url : 'vistas/consultaS.php',
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

	  </script>
		

	
        
      </div>
    </div>
  </div>
 
  <?php include_once 'footers.php'; ?>

  
  

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.6.3/js/bootstrap-select.min.js"></script>

	<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script> 
	
	
	 
</body>
</html>

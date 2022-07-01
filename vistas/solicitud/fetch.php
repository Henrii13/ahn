<?php
include_once '../../includes/user.php';
include_once '../../includes/user_session.php';
$userSession = new UserSession();
$user = new User();
$con = mysqli_connect("localhost", "root", "", "ahn_db");

if(isset($_POST['view'])){
  $rol= $_SESSION['Rol'];
  $estado = "";
  $soli_status="";
  if($rol==1){
    $soli_status="soli_status_admin";
    $estado = "Despacho";
  }
  if($rol==2){
    $soli_status="soli_status_custodio";
    $estado = "Solicita";
  }
  if($rol==3){
    $soli_status="soli_status_cliente";
    $estado = "Entregado";
  }

// $con = mysqli_connect("localhost", "root", "", "notif");

if($_POST["view"] != '')
{
    $update_query = "UPDATE solicitud SET " .$soli_status . " = 1 WHERE " .$soli_status . " = 0";
     
    mysqli_query($con, $update_query);
}
$query = "SELECT * FROM solicitud  WHERE soli_estado='$estado' ORDER BY soli_id DESC LIMIT 5";
$result = mysqli_query($con, $query);
$output = '';
if(mysqli_num_rows($result) > 0)
{
 while($row = mysqli_fetch_array($result))
 {
   $output .= '
   <li>
   <a href="#">
   <strong>'.$row["soli_doc_id"].'</strong><br />
   <small><em>'.$row["soli_user_cedula"].'</em></small>
   <small><em>'.$row["soli_estado"].'</em></small>
   <small><em>'.$rol .'</em></small>
   </a>
   </li>
   ';

 }
}
else{
     $output .= '
     <li><a href="#" class="text-bold text-italic">No hay notificaciones</a></li>';
}



$status_query = "SELECT * FROM solicitud WHERE " .$soli_status . " = 0 AND soli_estado='$estado'";
$result_query = mysqli_query($con, $status_query);
$count = mysqli_num_rows($result_query);
$data = array(
    'notification' => $output,
    'unseen_notification'  => $count
);

echo json_encode($data);

}

?>
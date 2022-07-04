<?php
include_once '../../includes/user.php';
include_once '../../includes/user_session.php';
$userSession = new UserSession();
$user = new User();
$rol= $_SESSION['Rol'];
//insert.php
$con = mysqli_connect("localhost", "root", "", "ahn_db");


if($rol==3){
    if(isset($_POST["ceduser"]))
    {
        $ceducli = mysqli_real_escape_string($con, $_POST["ceduser"]);
        $docid = mysqli_real_escape_string($con, $_POST["doc_id"]);
        $estado = mysqli_real_escape_string($con, $_POST["estado"]);
    
        $query = "
        INSERT INTO solicitud(soli_user_cedula, soli_doc_id, soli_estado)
        VALUES ('$ceducli', '$docid', '$estado')
        ";
        $sql = "UPDATE documento SET doc_cedula_pk='$ceducli', doc_estado='Ocupado', doc_fechafin=NOW() where 	doc_id  = '$docid'";
        mysqli_query($con, $query);
        mysqli_query($con, $sql);
    }
    if(isset($_POST["doc_id"]) AND $_POST["estado2"]=="Devolver")
    {
       
        $docid = mysqli_real_escape_string($con, $_POST["doc_id"]);
        $estado = mysqli_real_escape_string($con, $_POST["estado"]);
        $estado2 = mysqli_real_escape_string($con, $_POST["estado2"]);
    
     /*   $query = "
        INSERT INTO solicitud(soli_user_cedula, soli_doc_id, soli_estado)
        VALUES ('$ceducli', '$docid', '$estado')

        ";*/
        $sql2 = "UPDATE solicitud SET soli_estado ='$estado2' where soli_doc_id  = '$docid'";
        mysqli_query($con, $sql2);
        $sql = "UPDATE documento SET doc_cedula_pk=NULL, doc_estado='Disponible', doc_fechafin=NOW() where 	doc_id  = '$docid'";
     
       // mysqli_query($con, $query);
        mysqli_query($con, $sql);
    }
    if(isset($_POST["doc_id"]) AND $_POST["estado"]=="Recibido")
    {
       
        $docid = mysqli_real_escape_string($con, $_POST["doc_id"]);
        $estado = mysqli_real_escape_string($con, $_POST["estado"]);
        
    
     /*   $query = "
        INSERT INTO solicitud(soli_user_cedula, soli_doc_id, soli_estado)
        VALUES ('$ceducli', '$docid', '$estado')

        ";*/
        $sql2 = "UPDATE solicitud SET soli_estado ='$estado' where soli_doc_id  = '$docid'";
        mysqli_query($con, $sql2);
        $sql = "UPDATE documento SET doc_cedula_pk=NULL, doc_estado='Disponible', doc_fechafin=NOW() where 	doc_id  = '$docid'";
     
       // mysqli_query($con, $query);
        mysqli_query($con, $sql);
    }

}
if($rol==2){
    if(isset($_POST["doc_id"]))
    {
        $docid = mysqli_real_escape_string($con, $_POST["doc_id"]);
        $estado = mysqli_real_escape_string($con, $_POST["estado"]);
        $sql = "UPDATE solicitud SET soli_estado ='$estado' where soli_doc_id  = '$docid'";
        mysqli_query($con, $sql);
     
    }

}
if($rol==1){
    if(isset($_POST["doc_id"]))
    {
        $docid = mysqli_real_escape_string($con, $_POST["doc_id"]);
        $estado = mysqli_real_escape_string($con, $_POST["estado"]);
        $sql = "UPDATE solicitud SET soli_estado ='$estado' where soli_doc_id  = '$docid'";
        mysqli_query($con, $sql);
       
    }

}
    
    


?>
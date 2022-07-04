<?php
include_once 'includes/user.php';
include_once 'includes/user_session.php';


$userSession = new UserSession();
$user = new User();

if(isset($_SESSION['user'])){
    clearstatcache();
    //echo "hay sesion";
   
    $user->setUser($userSession->getCurrentUser());
    
   
    if($user->getRol()!=null ){
        if($user->getEstado()=="Activo"){
            if(isset($_GET["op"])){
                //bodega
                if($_GET["op"]=='1'){
                    include_once 'vistas/documento.php';
                }elseif($_GET["op"]=='1' && isset($_GET["d"])){
                    include_once 'vistas/documento.php?op=1&d=' . $_GET["d"] . '';
                }
                if($_GET["op"]=='4'){
                    include_once 'vistas/usuario.php';
                }elseif($_GET["op"]=='4' && isset($_GET["d"])){
                    include_once 'vistas/usuario.php?op=4&d=' . $_GET["d"] . '';
                }
                if($_GET["op"]=='2'){
                    include_once 'vistas/solicitud.php';
                }elseif($_GET["op"]=='2' && isset($_GET["d"])){
                    include_once 'vistas/solicitud.php?op=2&d=' . $_GET["d"] . '';
                }
               
            }else{
                include_once 'vistas/home.php';
            }
        }else{
       
            include_once 'vistas/error.php';
        }
        
    }else{
       
        include_once 'vistas/error.php';
    }
    
    
  

}else if(isset($_POST['username']) && isset($_POST['password'])){
    
    $userForm = $_POST['username'];
    $passForm = $_POST['password'];

    $user = new User();
    if($user->userExists($userForm, $passForm)){
   
        $userSession->setCurrentUser($userForm);
        
        $user->setUser($userForm);
     
        if($user->getRol()!=null && $user->getEstado()=="Activo"){
      
        include_once 'vistas/home.php';
    }else{
     
        include_once 'vistas/error.php';
    }
    
        
    }else{
        //echo "No existe el usuario";
        $errorLogin = "Nombre de usuario y/o password incorrecto";
        include_once 'vistas/login.php';
    }
}else{
    //echo "login";
     include_once 'vistas/login.php';
   
}



?>
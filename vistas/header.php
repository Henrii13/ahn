<?php




?>
<div class="container">
  <header class="d-flex flex-wrap align-items-center justify-content-center justify-content-md-between py-3 mb-4 border-bottom">
      <a href="index.php" class="d-flex align-items-center col-md-3 mb-2 mb-md-0 text-dark text-decoration-none">
      
      <?php if(isset($_GET['res']) && $_GET['res']=='1'){?>
        <img src="../imagen/Arch.jpg"
        width="60"></a>
      <?php }
        if(!isset($_GET['res'])){
        ?>
      <img src="./imagen/Arch.jpg"
        width="60"></a>
        <div class="col-md-1 text-end">
     
      </div>
        <ul class="nav col-12 col-md-auto mb-2 justify-content-center mb-md-0">
        <li><a href="index.php" class="nav-link px-2 link-secondary">Home</a></li>
        <?php 
        if($user->getrol()!==3){
        ?>
        <li><a href="index.php?op=4" class="nav-link px-2 link-dark">Usuarios</a></li>
        <?php }?>
        <li><a href="index.php?op=1" class="nav-link px-2 link-dark">Documentos</a></li>
        <li><a href="index.php?op=2" class="nav-link px-2 link-dark">Solicitud</a></li>
        </ul>
         <div class="col-md-2 text-end">
     
      </div>
        <div class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" id="dropdownNavLink" data-bs-toggle="dropdown" >
          <span class="label label-pill label-danger count" style="border-radius:10px;"></span> 
          <span class="glyphicon glyphicon-bell" style="font-size:18px;"></span>
        </a>
          <ul class="dropdown-menu soli text-small shadow" aria-labelledby="dropdownNavLink">
            </ul>
      </div>

      <div class="d-flex align-items-center">
       <div class="flex-shrink-0 dropdown">
          <a href="#" class="d-block link-dark text-decoration-none dropdown-toggle" id="dropdownUser2" data-bs-toggle="dropdown" aria-expanded="false">
          <?php echo $user->getNombre();  ?>&nbsp;&nbsp;
          <img src="https://w7.pngwing.com/pngs/831/88/png-transparent-user-profile-computer-icons-user-interface-mystique-miscellaneous-user-interface-design-smile.png" alt="mdo" width="32" height="32" class="rounded-circle">
          </a>
          <ul class="dropdown-menu text-small shadow" aria-labelledby="dropdownUser2">
            <!--<li><a class="dropdown-item" href="vistas/error.php">Configuración</a></li>
            <li><a class="dropdown-item" href="index.php?op=4&d=ZGV0LzE=">Perfil</a></li>
            <li><hr class="dropdown-divider"></li>-->
            <li><a class="dropdown-item" href="includes/logout.php">Cerrar sesión</a></li>
          </ul>
        </div>
      </div>

        <?php }?>
  </header>


</div>




  <script>  
        	$(document).ready(function(){
        
        function load_unseen_notification(view = '')
        {
        $.ajax({
        url:"vistas/solicitud/fetch.php",
        method:"POST",
        data:{view:view},
        dataType:"json",
        success:function(data)
        {
          $('.soli').html(data.notification);
         
          if(data.unseen_notification > 0)
          {
          $('.count').html(data.unseen_notification);
          
          }
        }
        });
        }
        
        load_unseen_notification();
        
        $('#comment_form').on('submit', function(event){
        event.preventDefault();
        
        if($('#ceduser').val() != '' && $('#doc_id').val() != '')
        {
        var form_data = $(this).serialize();
        $.ajax({
          url:"vistas/solicitud/insert.php",
          method:"POST",
          data:form_data,
          success:function(data)
          {
          $('#comment_form')[0].reset();
          notificar();
        
          load_unseen_notification();
          }
        });
        }
        else
        {
        alert("Both Fields are Required");
        }
        });
        
        $(document).on('click', '.dropdown-toggle', function(){
        $('.count').html('');
        load_unseen_notification('yes');
        });
        
        setInterval(function(){ 
        load_unseen_notification();; 
        }, 5000);
        
        });		

       
          document.addEventListener("DOMContentLoaded", function(){ 
            if(!Notification){
              alert("Las notificaciones no se soportan en tu navegador, bajate uno mas nuevo.");

          return;

          }

          if(Notification.permission !== "granted"){
            Notification.requestPermission();
          }
         

          });
       
          function notificar(){
            if(Notification.permission !== "granted"){ 
              Notification.requestPermission();

            }else{
              var notification = new Notification("Pretición Realizada",
              {
                icon: "./imagen/Arch.jpg",
                body: "Esperar confirmacion!!!"

              }
              );
              notificacion.onclick = function(){
                window.open("#");
              }
          }
        }
        
        

 //------------------------------------------------------------------------------
</script>
    <!--<div id="menu">
        <ul>
            <li>Home</li>
            <li class="cerrar-sesion"><a href="includes/logout.php">Cerrar sesión</a></li>
        </ul>
    </div>
-->
<!-- Modal -->

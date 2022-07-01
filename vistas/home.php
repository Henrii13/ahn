<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" href="imagen/Arch.jpg">
	<title>Home</title>
    <link rel="stylesheet" href="main.css">
    <link rel="canonical" href="https://getbootstrap.com/docs/5.1/examples/product/">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="css/product.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  
	<link rel='stylesheet prefetch' href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css'>
	<link rel='stylesheet prefetch' href='https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.11.2/css/bootstrap-select.min.css'>

  </head>
  <style>
   .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }


  </style>

  <?php include_once 'vistas/header.php'; ?>
    <!--<div id="menu">
        <ul>
            <li>Home</li>
            <li class="cerrar-sesion"><a href="includes/logout.php">Cerrar sesión</a></li>
        </ul>
    </div>
-->
    <section>
      <!--  <h1>Bienvenido <?php echo $user->getNombre();  echo $user->getrol(); ?></h1>-->

    </section>
    <?php 
  $_SESSION['Rol']=$user->getrol();
  
  $_SESSION['User']=$user->getNombre();
 
  ?>
   
   <div class="container">
  <header>
  <div class="pricing-header p-3 pb-md-4 mx-auto text-center">
      <h1 class="display-4 fw-normal">ARCHIVO HISTORICO NACIONAL</h1>
      <p class="fs-5 text-muted">Bienvenido al Sistema de Consultas <?php echo $user->getNombre();  ?></p>
   
  
      </div>
  </header>
  <main class="container">
  <div class="row mb-2">
    <div class="col-md-6">
      <div class="row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
        <div class="col p-4 d-flex flex-column position-static">
          <strong class="d-inline-block mb-2 text-primary">Listo</strong>
          <h3 class="mb-0">USUARIOS</h3>
          <div class="mb-1 text-muted">2022</div>
          <p class="card-text mb-auto">Lista de usuarios ingresados.</p>
          <a href="index.php?op=4" class="stretched-link"></a>
        </div>
        <div class="col-auto d-none d-lg-block">
          <img width="200" height="200" src="https://lapiedradesisifo.com/wp-content/uploads/2016/01/1.-El-bloqueo-de-lector.jpg">
        </div>
      </div>
    </div>
    <div class="col-md-6">
      <div class="row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
        <div class="col p-4 d-flex flex-column position-static">
        <strong class="d-inline-block mb-2 text-primary">Listo</strong>
          <h3 class="mb-0">DOCUMENTO</h3>
          <div class="mb-1 text-muted">2022</div>
          <p class="mb-auto">Lista de Documentos ingresados.</p>
          <a href="index.php?op=1" class="stretched-link"></a>
        </div>
        <div class="col-auto d-none d-lg-block">
          <img width="200" height="200" src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQvnTVNkH2mF0qQ1CWeMr5bSYKPAE5mpYM6Uw&usqp=CAU">
      
        </div>
      </div>
    </div>  
  </main>
</div>
  <?php include_once 'vistas/footers.php'; ?>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>

</html>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Iniciar Sesión</title>
    <link rel="icon" href="imagen/Arch.jpg">
    <link rel="canonical" href="https://getbootstrap.com/docs/5.1/examples/sign-in/">
    <link href="assets/dist/css/bootstrap.min.css" rel="stylesheet">
   
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
      html,
        body {
        height: 100%;
        }

        body {
        display: flex;
        align-items: center;
        padding-top: 40px;
        padding-bottom: 40px;
        background-color: #f5f5f5;
        }

        .form-signin {
        width: 100%;
        max-width: 330px;
        padding: 15px;
        margin: auto;
        }

        .form-signin .checkbox {
        font-weight: 400;
        }

        .form-signin .form-floating:focus-within {
        z-index: 2;
        }

        .form-signin input[type="email"] {
        margin-bottom: -1px;
        border-bottom-right-radius: 0;
        border-bottom-left-radius: 0;
        }

        .form-signin input[type="password"] {
        margin-bottom: 10px;
        border-top-left-radius: 0;
        border-top-right-radius: 0;
        }

    </style>
    
     <link href="signin.css" rel="stylesheet">
</head>
<body class="text-center">
    <main class="form-signin">
        <form action="" method="POST">
            <img class="mb-4" src="imagen/Arch.jpg" alt="" width="125" height="">
            <h1 class="h3 mb-3 fw-normal">Iniciar sesión</h1>
            <div class="form-floating">
                <input type="text" class="form-control" name="username" id="floatingInput" placeholder="username">
                <label for="floatingInput">Usuario</label>
            </div>
            <div class="form-floating">
                <input type="password" class="form-control" name="password" id="floatingPassword" placeholder="Password">
                <label for="floatingPassword">Contraseña</label>
            </div>
            <?php
                if(isset($errorLogin)){
                    echo  '<div class="checkbox mb-3"><label>'.$errorLogin.'</label></div>';
                }
                $d_new = "new/0";
		$d_new_final = base64_encode($d_new);
            ?>
           
            <button class="w-100 btn btn-lg btn-primary" type="submit">Iniciar Sesión</button>
            <br><br>
            <a href="vistas/usuario.php?op=4&res=1">Registrarse</a>
              <div class="checkbox mb-3">
            <p class="mt-5 mb-3 text-muted">&copy; Ecuador 2022</p>
            
            </div>
        </form>
        </main>
    </body>
</html>
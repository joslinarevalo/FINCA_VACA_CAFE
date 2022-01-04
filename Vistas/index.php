<!DOCTYPE html>
<html lang="es">
    <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title>Login | Administrador</title>

      <!-- Google Font: Source Sans Pro -->
      <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
      <!-- Font Awesome -->
      <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
      <!-- Theme style -->
      <link rel="stylesheet" href="../dist/css/adminlte.min.css">
      <link rel="stylesheet" href="../plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
    </head>

<body class="hold-transition login-page">
    <div class="login-box">

      <!-- /.login-logo -->
      <div class="card card-outline card-success">
        
        <div class="card-header text-center">
          <a class="h1"><b>La Vaca</b> Café</a>
        </div>
        <div class="card-body">
         <div class="col-12 text-center">
            <img src="../dist/img/logo-n.png" alt="user-avatar" class="img-circle img-fluid">
          </div>
          <br>
          <p class="login-box-msg">Iniciar Sesión</p>

           <form id="formulario_login" method="post">
             <input type="hidden" name="iniciar_sesion" value="si_nueva">
             
             <label for="email_login">Usuario o Correo</label>
            <div class="input-group mb-3">
              <input type="text" class="form-control" placeholder="Email" id="email_login" name="email_login" autocomplete="off" required>
              <div class="input-group-append">
                <div class="input-group-text">
                  <span class="fas fa-user"></span>
                </div>
              </div>
            </div>
           
            <label for="contra_login">Contraseña</label>
            <div class="input-group mb-3">
              <input type="password" class="form-control" placeholder="Password" id="contra_login" name="contra_login" autocomplete="off" required>
              <div class="input-group-append">
                <div class="input-group-text">
                  <span class="fas fa-key"></span>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-8">
                  <p class="mb-1">
                    <a href="v_recupera_contra.php">No Recuerdo mi Contraseña</a>
                  </p>
              </div>
              <!-- /.col -->
              <div class="col-4">
                <button type="submit" class="btn btn-success btn-block">Entrar</button>
              </div>

              
              <!-- /.col -->
            </div>
          </form>

         
        </div>
      </div>
    </div>

    <!-- jQuery -->
    <script src="../plugins/jquery/jquery.min.js"></script>
    <!-- jquery-validation -->
    <script src="../plugins/jquery-validation/jquery.validate.min.js"></script>
    <script src="../plugins/jquery-validation/additional-methods.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../plugins/sweetalert2/sweetalert2.min.js"></script>
    <script src="../Scripts/inicio_sesion.js" type="text/javascript" charset="utf-8" async defer></script>
  </body>
</html>
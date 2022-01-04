<!DOCTYPE html>
<html lang="es">
    <head>        
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Usuarios | Registro</title>
        <!-- Google Font: Source Sans Pro -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
        <!-- daterange picker -->
        <link rel="stylesheet" href="../plugins/daterangepicker/daterangepicker.css">
        <!-- iCheck for checkboxes and radio inputs -->
        <link rel="stylesheet" href="../plugins/icheck-bootstrap/icheck-bootstrap.min.css">
        <!-- Bootstrap Color Picker -->
        <link rel="stylesheet" href="../plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css">
        <!-- Tempusdominus Bootstrap 4 -->
        <link rel="stylesheet" href="../plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
        <!-- Select2 -->
        <link rel="stylesheet" href="../plugins/select2/css/select2.min.css">
        <link rel="stylesheet" href="../plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
        <!-- Bootstrap4 Duallistbox -->
        <link rel="stylesheet" href="../plugins/bootstrap4-duallistbox/bootstrap-duallistbox.min.css">
        <!-- BS Stepper -->
        <link rel="stylesheet" href="../plugins/bs-stepper/css/bs-stepper.min.css">
        <!-- dropzonejs -->
        <link rel="stylesheet" href="../plugins/dropzone/min/dropzone.min.css">

        <link rel="stylesheet" href="../plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
        <!-- Toastr -->
        <link rel="stylesheet" href="../plugins/toastr/toastr.min.css">
        <!-- Theme style -->
        <link rel="stylesheet" href="../dist/css/adminlte.min.css">
    </head>
    <body class="hold-transition sidebar-mini">
        <!-- Site wrapper -->
        <div class="wrapper">
            <!-- Navbar -->
            <?php
                require_once ('../Menus/menusidebar.php');
            ?>
            <?php
                require_once ('../Menus/loader.php');
            ?>


            <!-- CCONTENIDO DE LA PÁGINA -->
            <div class="content-wrapper">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <div class="container-fluid">
                        <div class="row mb-2">
                        </div>
                    </div>
                  
                </section>
                <!-- Main content -->
                <section class="content">
                    <div class="card">
                        <div class="card-header bg-success">
                            <h3 class="card-title ">Usuarios</h3>
                        </div>
                        <div class="col-xs-12">
                        <div class="col-xs-1"></div>
                        <div class="col-xs-10"></div>
                    </div>

                        <!-- TABLA EMPLEADOS -->
                        <div class="card-body p-0" id="datos_tabla"> 
                        </div>
                    </div>                   
                </section>   
                <div class="modal fade" id="md_edit_usuario">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <form method="POST" name="formulario_registro" id="formulario_registro">
                                <div class="modal-header bg-success">
                                    <h4 class="modal-title">Usuarios | Editar</h4>
                                    <button
                                        type="button"
                                        class="close"
                                        data-dismiss="modal"
                                        aria-label="Close"
                                        >
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">                               
                                    <input type="hidden" id="almacenar_datos" name="almacenar_datos" value="si_actualizar_usuario">
                                    <input type="hidden" id="llave_usuario" name="llave_usuario" value="si_registro">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <span>
                                                    *
                                                </span>
                                                <label>Empleado</label>
                                                <div class="input-group mb-3">
                                                     <span class="input-group-text">
                                                            <i class="fas fa-user"></i>
                                                        </span>
                                                    <select class="form-control" id="empleado_usuario" name="empleado_usuario">
                                                    </select>
                                                </div>
                                                <span>
                                                    *
                                                </span>
                                                <label for="contrasena_usuario">Contraseña</label>
                                                    <div class="input-group mb-3">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text">
                                                                <i class="fas fa-key"></i>
                                                            </span>
                                                        </div>
                                                        <input type="password" class="form-control" autocomplete="off"
                                                        id="contrasena_usuario" name="contrasena_usuario" required minlength="5">
                                                    </div>
                                                <span>
                                                    *
                                                </span>
                                                <label for="recontrasena_usuario">Repita su Contraseña</label>
                                                    <div class="input-group mb-3">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text">
                                                                <i class="fas fa-key"></i>
                                                            </span>
                                                        </div>
                                                        <input type="password" class="form-control" autocomplete="off"
                                                        id="recontrasena_usuario" name="recontrasena_usuario" required minlength="5">
                                                    </div>                                             
                                                
                                            </div>
                                            <!-- /.col -->
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <span>
                                                       *
                                                    </span>
                                                    <label for="nombre_usuario">Nombre Usuario</label>
                                                    <div class="input-group mb-3">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text">
                                                                <i class="fas fa-user-tie"></i>
                                                            </span>
                                                        </div>
                                                        <input type="text" class="form-control" placeholder="juan" autocomplete="off"
                                                        id="nombre_usuario" name="nombre_usuario" required>
                                                    </div>  
                                                    <span>
                                                       *
                                                    </span>
                                                    <label for="correo_usuario">Correo</label>
                                                    <div class="input-group mb-3">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text">
                                                                <i class="fas fa-envelope"></i>
                                                            </span>
                                                        </div>
                                                        <input type="email" class="form-control" placeholder="juan@gmail.com" autocomplete="off"  required
                                                        id="correo_usuario" name="correo_usuario" >
                                                    </div>                                    
                                                </div>
                                            </div>
                                        </div>
                                    <div>
                                        <button id="limpiar" name="limpiar" type="reset" class="btn bg-success ">
                                            <i class="fas fa-trash"></i> Limpiar</button>

                                        <button type="submit" class="btn bg-success"><i class="fa fa-save"></i> Guardar</button>
                                        <span>
                                           * Campo Requerido
                                        </span>
                                    </div>
                                </div>    
                            </form>
                        </div>
                    </div>
                </div> 
            </div>             
            </div>

            <!-- MODAL GUARDAR -->
           

         

            <footer class="main-footer">
              <div class="float-right d-none d-sm-block">
              </div>
              <strong>UES &copy; 2021</strong>
              Todos los Derechos Reservados
            </footer>
            <aside class="control-sidebar control-sidebar-dark"></aside>
        </div>
       
        <!-- jQuery -->
        <script src="../plugins/jquery/jquery.min.js"></script>
        <!-- Bootstrap 4 -->        
        <script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

        <script src="../plugins/select2/js/select2.full.min.js"></script>
        <!-- Bootstrap4 Duallistbox -->
        <script src="../plugins/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min.js"></script>
        <!-- InputMask -->
        <script src="../plugins/moment/moment.min.js"></script>

        <script src="../plugins/inputmask/jquery.inputmask.min.js"></script>
        <!-- date-range-picker -->
        <script src="../plugins/daterangepicker/daterangepicker.js"></script>
        <!-- bootstrap color picker -->
        <script src="../plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js"></script>
        <!-- Tempusdominus Bootstrap 4 -->
        <script src="../plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
        <!-- Bootstrap Switch -->
        <script src="../plugins/bootstrap-switch/js/bootstrap-switch.min.js"></script>
        <!-- BS-Stepper -->
        <script src="../plugins/bs-stepper/js/bs-stepper.min.js"></script>
        <!-- dropzonejs -->
        <script src="../plugins/dropzone/min/dropzone.min.js"></script>
        <script src="../plugins/sweetalert2/sweetalert2.min.js"></script>
        <!-- jquery-validation -->
        <script src="../plugins/jquery-validation/jquery.validate.min.js"></script>
        <script src="../plugins/jquery-validation/additional-methods.min.js"></script>
        <!-- Toastr -->
        <script src="../plugins/toastr/toastr.min.js"></script>

        <!-- AdminLTE App -->
        <script src="../dist/js/adminlte.min.js"></script>
        <!-- AdminLTE for demo purposes -->
        <script src="../dist/js/demo.js"></script>  
        <script src="../Scripts/usuarios.js"></script> 
    </body>
</html>

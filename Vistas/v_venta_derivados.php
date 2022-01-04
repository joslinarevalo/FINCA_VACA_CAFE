<?php 
    date_default_timezone_set('America/El_Salvador');
    @session_start(); 
?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Compra | Nueva</title>
        <!-- Google Font: Source Sans Pro -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
         <!-- DataTables -->
        <link rel="stylesheet" href="../plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
        <link rel="stylesheet" href="../plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
        <link rel="stylesheet" href="../plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
        <!-- daterange picker -->
        <link rel="stylesheet" href="../plugins/daterangepicker/daterangepicker.css">
       
        <link rel="stylesheet" href="../plugins/bootstrap-datetimepicker-master/css/bootstrap-datetimepicker.css">

        <link rel="stylesheet" href="../plugins/bootstrap-datetimepicker-master/css/bootstrap-datetimepicker.min.css">

        <link rel="stylesheet" href="../plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css">
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

        <link rel="stylesheet" href="../plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
        <!-- dropzonejs -->
        <link rel="stylesheet" href="../plugins/dropzone/min/dropzone.min.css">
        <!-- Theme style -->
        <link rel="stylesheet" href="../dist/css/adminlte.min.css">
    </head>
    <body class="hold-transition sidebar-mini">
        <div class="wrapper">
            <!-- Navbar -->
            <?php
                require_once ('../Menus/menusidebar.php');
            ?>
            <?php
                require_once ('../Menus/loader.php');               
            ?>
            <!-- CONTENIDO DE LA PAGINA -->
            <div class="content-wrapper">               
                <section class="content-header">
                    <div class="container-fluid">                        
                    </div>
                </section>


                <!-- FROMULARIO VENTA --> 
                <form method="POST" name="formulario_registro_venta" id="formulario_registro_venta">
                    
                    <section class="content">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-12 col-sm-12">
                                    <div class="card">
                                        <div class="card-header bg-success">
                                            <h3 class="card-title">Ventas | Derivados</h3>
                                        </div>
                                        <input type="hidden" id="almacenar_venta" name="almacenar_venta" value="nueva_venta">
                                        <input type="hidden" id="empleado_venta" name="empleado_venta" <?php print 'value ="'.$_SESSION['idempleado'].'"'?>>
                                        <div class="row">
                                            <div class="col-md-10 offset-md-1">
                                                <div class="row">
                                                    <div class="col-6">
                                                        <div class="form-group">
                                                            <label>Cliente</label>
                                                            <div class="input-group mb-3">
                                                                <div class="input-group-prepend">
                                                                    <span class="input-group-text">
                                                                         <i class="fas fa-user"></i>
                                                                    </span>
                                                                </div>  
                                                                <select id="cliente_venta_d" name="cliente_venta_d" class="form-control">
                                                                </select>   
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-3">
                                                        <div class="form-group">
                                                            <label>Fecha</label>
                                                            <div class="input-group mb-3">
                                                                <div class="input-group-prepend">
                                                                    <span class="input-group-text">
                                                                        <i class="fas fa-calendar"></i>
                                                                    </span>
                                                                </div>
                                                                <input type="text" id="fecha_venta_d" name="fecha_venta_d" class="form-control form_datetime" placeholder="12-12-2021 12:00" readonly required >
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-3">
                                                        <div class="form-group">
                                                            <label>Vendedor</label>
                                                            <div class="input-group mb-3">
                                                                <div class="input-group-prepend">
                                                                    <span class="input-group-text">
                                                                        <i class="fas fa-user"></i>
                                                                    </span>
                                                                </div>
                                                                <input type="text" id="vendedor_d" name="vendedor_d" class="form-control" <?php print 'value ="'.$_SESSION['empleado'].'"'?> readonly required>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group text-center">
                                                        <a class="btn bg-success" data-toggle="modal" data-target="#md_seleccion_derivados">
                                                            <i class="fas fa-shopping-cart"></i>
                                                            Agregar
                                                            Producto
                                                        </a>
                                                        <a class="btn bg-success btn_limpiar">
                                                            <i class="fa fa-trash"></i>
                                                            Limpiar
                                                        </a>
                                                    </div>
                                                </div>                                                
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>

                    <!-- DETALLTE DE LA VENTA (TABLA) -->
                    <section class="content">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="card">
                                        <div class="col-12 table-responsive">
                                            <table id="tablaDetalleVentaD" class="table table-striped projects" width="100%">
                                                <thead>
                                                    <tr>
                                                        <th>Producto</th>
                                                        <th class="text-center col-2">Imagen</th>
                                                        <th class="text-center col-2">Precio Unitario $</th>
                                                        <th class="text-center col-2">Cantidad</th>
                                                        <th class="text-center col-2">Sub Total $</th>
                                                        <th class="text-center col-2">Acción</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                 

                                                </tbody>
                                            </table>
                                            <div class="form-group float-sm-right">
                                                <div class="col-2 float-sm-right">
                                                    <label>Total</label>
                                                    <input type="text" id="total_v_venta_d" name="total_v_venta_d" class="form-control" placeholder="$00.00" readonly>
                                                     <input type="hidden" id="total_g_venta_d" name="total_g_venta_d">
                                                </div>
                                                <div class="col-2 float-sm-right">
                                                    <label>Iva</label>
                                                    <input type="text" id="iva_v_venta_d" name="iva_v_venta_d" class="form-control" placeholder="$00.00" readonly>
                                                     <input type="hidden" id="iva_g_venta_d" name="iva_g_venta_d" >
                                                </div>
                                                <div class="col-2 float-sm-right">
                                                    <label>SubTotal</label>
                                                    <input type="text" id="subtotal_v_venta_d" name="subtotal_v_venta_d" class="form-control" placeholder="$00.00" readonly >
                                                     <input type="hidden" id="subtotal_g_venta_d" name="subtotal_g_venta_d">
                                                </div>
                                            </div>
                                            <br>
                                            <br>
                                            <br>
                                            <br>
                                            <div class="form-group float-sm-right">
                                                <button type="submit" class="btn bg-success">
                                                    <i class="fas fa-check"></i>
                                                    Vender
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </form>

                <!--MODAL DE SLECCIONE-->
                <div class="modal fade" id="md_seleccion_derivados"> 
                    <form  method="POST" name="formulario_busca_derivado" id="formulario_busca_derivado">              
                        <div class="modal-dialog modal-xl">
                            <div class="modal-content">
                                <div class="modal-header bg-success">
                                    <h4 class="modal-title">Añadir Producto</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="card">
                                        <!-- TABLA QUE MUESTRA LOS PRODUCTOS -->
                                        <div class="card-body p-0" id="tb_seleccion_derivados">                                       
                                        </div>
                                            <!-- /.card-body -->
                                    </div>
                                </div>
                                <div class="modal-footer float-right">
                                    <a class="btn bg-success btn_listo" data-dismiss="modal" >
                                        <i class="fa fa-check"></i>Listo
                                    </a>
                                </div>
                            </div>
                        </div>
                    </form>       
                </div>              
            </div>
              
            
           
            <footer class="main-footer">
                <div class="float-right d-none d-sm-block">                    
                </div>
                <strong>UES &copy; 2021</strong>
                Todos los Derechos Reservados
            </footer>
           
            <aside class="control-sidebar control-sidebar-dark">
            </aside>           
        </div>
       
        <!-- jQuery -->
        <script src="../plugins/jquery/jquery.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
        <!-- Bootstrap 4 -->
        <script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
        <!-- Select2 -->
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
        <!-- AdminLTE App -->
        <script src="../dist/js/adminlte.min.js"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/numeral.js/2.0.6/numeral.min.js"></script>
        <!-- jquery-validation -->
        <script src="../plugins/jquery-validation/jquery.validate.min.js"></script>
        <script src="../plugins/jquery-validation/additional-methods.min.js"></script>

        
        <script src="../plugins/datatables/jquery.dataTables.min.js"></script>
        <script src="../plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
        <script src="../plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
        <script src="../plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
        <script src="../plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
        <script src="../plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
        <script src="../plugins/datatables-buttons/js/buttons.html5.min.js"></script>
        <script src="../plugins/datatables-buttons/js/buttons.print.min.js"></script>
        <script src="../plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
     
        <script src="../plugins/bootstrap-datetimepicker-master/js/bootstrap-datetimepicker.js"></script>
        <script src="../plugins/bootstrap-datetimepicker-master/js/bootstrap-datetimepicker.min.js"></script>

        <script src="../plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
        <script src="../plugins/daterangepicker/daterangepicker.js"></script>
        <script src="../plugins/sweetalert2/sweetalert2.min.js"></script>      

        <script src="../dist/js/demo.js"></script> 

        <script src="../Scripts/venta_derivados.js"></script>       

      
    </body>
</html>

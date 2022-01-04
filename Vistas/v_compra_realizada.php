 <?php 
    @session_start(); 
    if (isset($_SESSION['logueado']) && $_SESSION['logueado']=="si") {
        if ($_SESSION['bloquear_pantalla']=="no") {
            // code...
            
        }else{
             
            header("Location: ../Vistas/v_bloquear_pantalla.php");
             
        }
    }else{
          header("Location: ../Vistas/index.php");
    }
    
?>    
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Compra | Nueva</title>
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

        <link href="../plugins2/bootstrap-datepicker/css/bootstrap-datepicker.min.css" rel="stylesheet">

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
                <form method="POST" name="formulario_registro_compra" id="formulario_registro_compra">
                    <section class="content">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-12 col-sm-12">
                                    <div class="card">
                                        <div class="card-header bg-success">
                                            <h3 class="card-title">Compras</h3>
                                        </div>
                                        <input type="hidden" id="almacenar_compra" name="almacenar_compra" value="nueva_compra">
                                        <input type="hidden" id="empleado_compra" name="empleado_compra" <?php print 'value ="'.$_SESSION['idempleado'].'"'?>>
                                        <div class="row">
                                            <div class="col-md-10 offset-md-1">
                                                <div class="row">
                                                    <div class="col-4">
        		                                        <div class="form-group">
        		                                            <label>Proveedor</label>
        		                                            <div class="input-group mb-3">
        		                                                <select class="form-control" id="proveedor_compra" name="proveedor_compra" required>
        		                                                    <option selected="selected">Todos</option>
        		                                                    <option value="1">Salinera Turcios</option>
        		                                                    <option value="2">Agroservicio El Frutal</option>
        		                                                    <option value="3">Agua El Manantial</option>
        		                                                    <option value="4">Finca Cuscatlán</option>
        		                                                 </select>
        		                                            </div>
        		                                        </div>
        		                                    </div>
                                                           
        		                                    <div class="col-4">
        		                                        <div class="form-group">
        		                                            <label>Tipo Documento</label>
        		                                            <select class="form-control" id="tipo_doc_compra" name="tipo_doc_compra" required>
        		                                                <option selected="selected">Factura</option>
        		                                                <option>Ticket</option>
        		                                                <option>Crédito Fiscal</option>
        		                                            </select>
        		                                        </div>		                                                
        		                                    </div>
        		                                    <div class="col-4">
        		                                        <div class="form-group">
        		                                            <label>No. Documento</label>
        		                                            <input type="text" class="form-control validcion_solo_numeros_fact" id="num_doc_compra" name="num_doc_compra" placeholder="12345678" maxlength="8" required>
        		                                        </div>
        		                                    </div>
        		                                            
        		                                    <div class="col-6">
        		                                        <div class="form-group">
        										            <label for="">Descripción</label>
        										            <input type="text" class="form-control" id="descrip_compra" name="descrip_compra" placeholder="Nueva Compra"  required>
        										        </div>
        								            </div>
        									        <div class="col-3">
        		                                        <div class="form-group">
        		                                            <label>Fecha Compra</label>
        		                                            <div class="form-group mb-3">
        		                                                <input type="datetime-local" class="form-control
        		                                                        disabled" name="fecha_compra" id="fecha_compra" placeholder="Juan..." required> 
        		                                            </div>
        		                                        </div>
        		                                    </div>
        		                                    <div class="col-3">
        		                                        <div class="form-group">
        		                                            <label>Fecha Sistema</label>
        		                                            <div class="input-group mb-3">
        		                                                <input type="text"  name="fecha_sistema_compra" id="fecha_sistema_compra" class="form-control" value="<?php echo date('d/m/Y H:i:s');?>" readonly="true">
        		                                            </div>
        		                                        </div>
                                                    </div>
                                                        
                                                    <div class="form-group text-center">
                                                        <a class="btn bg-success" data-toggle="modal" data-target="#md_agregar_producto">
                                                            <i class="fas fa-shopping-cart"></i>
                                                                Agregar
                                                                Producto
                                                        </a>
                                                        <a class="btn bg-success">
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
                                            <div class="col-12 table-responsive">
                                                <div id="tablaDetalleDerivados"></div>        
                                            </div>
                                                <div class="col-2 float-sm-right">
                                                    <label>Total</label>
                                                    <input id="Total_compra" name="Total_compra" type="text" class="form-control" placeholder="00.00" contenteditable="false" readonly="true">
                                                </div>
                                                <div class="col-2 float-sm-right">
                                                    <label>Iva</label>
                                                    <input id="Iva_compra" name="Iva_compra" type="text" class="form-control" placeholder="00.00" contenteditable="false" readonly="true">
                                                </div>
                                                <div class="col-2 float-sm-right">
                                                    <label>SubTotal</label>
                                                    <input id="Subtotal_compra" name="Subtotal_compra"  type="text" class="form-control" placeholder="00.00" contenteditable="false" readonly="true">
                                                </div>
                                            <br>
                                            <br>
                                            <br>
                                            <br>

                                            <div class="form-group float-sm-right">
                                                <button class="btn bg-success" type="submit">
                                                    <i class="fas fa-check"></i>
                                                    Comprar
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </form>

                <!--MODAL DE BUSQUEDA PARA PRODUCTO-->
                <div class="modal fade" id="md_agregar_producto"> 
                    <form  method="POST" name="formulario_buscaProducto" id="formulario_buscaProducto">               
                        <div class="modal-dialog modal-xl">
                            <div class="modal-content">
                                <div class="modal-header bg-success">
                                    <h4 class="modal-title">Añadir Producto</h4>
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
                                    <div class="card">
                                       
                                        <div class="card-header">
                                           
                                                <div class="row">
                                                    <div class="col-md-10
                                                        offset-md-1">
                                                        <div class="row">
                                                            <div class="col-6">
                                                                <div class="form-group">
                                                                    <label>Buscar</label>
                                                                    <div class="input-group
                                                                        mb-3">
                                                                        <input
                                                                            type="text"
                                                                            class="form-control"
                                                                            placeholder="botella de leche"
                                                                        >
                                                                        <div class="input-group-append">
                                                                            <button type="submit" class="btn btn-default">
                                                                                <i class="fa fa-search"></i>
                                                                            </button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>                                             
                                                        </div>
                                                    </div>
                                                </div>                                  
                                        </div>
                                        <!-- TABLA QUE MUESTRA LOS PRODUCTOS -->
                                        <div class="card-body p-0" id="tb_seleccion_productos">                                        
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
        
        <script src="../plugins2/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>

        <script src="../plugins/sweetalert2/sweetalert2.min.js"></script>      

        <script src="../dist/js/demo.js"></script> 

        <script src="../Scripts/compra_insumos_medi.js"></script>
        

    </body>
</html>

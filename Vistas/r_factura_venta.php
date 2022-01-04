<?php 
    date_default_timezone_set('America/El_Salvador');
    @session_start(); 
?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Venta | Factura</title>
        <!-- Google Font: Source Sans Pro -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
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
            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <div class="container-fluid">
                        <div class="row mb-2">
                            <div class="col-sm-6">
                                <h1>Factura</h1>
                            </div>
                            <div class="col-sm-6">
                                <ol class="breadcrumb float-sm-right"></ol>
                            </div>
                        </div>
                    </div>
                    <!-- /.container-fluid -->
                </section>
                <section class="content">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-12">
                                <!-- Main content -->
                                <div class="invoice p-3 mb-3">
                                    <!-- title row -->
                                    <div class="row invoice-info">
                                        <div class="col-sm-4 invoice-col">
                                            <img src="../dist/img/logo-n.png" alt="user-avatar" class="img-circle img-fluid">
                                        </div>
                                        <!-- /.col -->
                                        <div class="col-sm-4 invoice-col
                                            text-center">
                                            <address>
                                                <h4>
                                                    <strong>FINCA LA VACA CAFÉ</strong>
                                                </h4>
                                                CALLE LA INDIA
                                                <br>
                                                COMUNIDAD EL PROGRESO
                                                <br>
                                                POLIGONO A, LOTE 4
                                                <br>
                                                BARRIO SAN JUAN,
                                                COJUTEPEQUE.
                                            </address>
                                        </div>
                                        <!-- /.col -->
                                        <div class="col-sm-4 invoice-col">
                                            <img src="../dist/img/ues-a.png" alt="user-avatar" class="img
                                                img-fluid float-right">
                                        </div>
                                    </div>
                                    <!-- info row -->
                                    <br>
                                    <div class="row invoice-info">
                                        <div class="col-sm-4 invoice-col">
                                            <span>Vendedor</span>
                                            <address>
                                                <strong id="vendedor_fact">Administrador</strong>
                                                <br>
                                            </address>
                                        </div>
                                        <!-- /.col -->
                                        <div class="col-sm-4 invoice-col">
                                            Cliente
                                            <address>
                                                <strong id="nom_cliente_fact">Juan Hernández</strong>
                                                <br>
                                                <span>Dui: </span><strong id="dui_cliente_fact"></strong>
                                                <br>
                                                <span>Dirección: </span> <strong id="direc_cliente_fact"></strong>
                                                <br>
                                                <span>Telefono: (503)</span>  <strong id="tel_cliente_fact"></strong>
                                                <br>
                                            </address>
                                        </div>
                                        <!-- /.col -->
                                        <div class="col-sm-4 invoice-col">
                                            <b>Factura</b>
                                            <br>
                                            <b>No.</b>
                                            <strong id="num_fact"></strong>                                            
                                            <br>
                                            <span>Fecha y Hora:</span>
                                             <strong id="fecha_fact"></strong>   
                                        </div>
                                        <!-- /.col -->
                                    </div>
                                    <!-- /.row -->
                                    <!-- Table row -->
                                    <div class="row">
                                        <div class="table-responsive">                                            
                                                <div id="tb_factura_ver"></div> 
                                        </div>
                                        <!-- /.col -->
                                    </div>
                                    <!-- /.row -->
                                    <div class="row">
                                        <!-- accepted payments column -->
                                        <div class="col-6"></div>
                                        <!-- /.col -->
                                        <div class=" col-4 table-responsive">
                                            <div id="tb_sumas_factura">                                                
                                            </div>
                                        </div>
                                        <!-- /.col -->
                                    </div>
                                    <!-- /.row -->
                                    <!-- this row will not appear when printing -->
                                    <div class="row no-print">
                                        <div class="col-12">
                                            <a
                                                href="r_imprime_factura.php"
                                                rel="noopener"
                                                target="_blank"
                                                class="btn btn-success"
                                            >                                            
                                                <i class="fas fa-print"></i> Imprimir
                                            </a>
                                            <a href="../Vistas/v_registro_ventas.php"  class="btn btn-success float-right" style="margin-right: 5px;">
                                                <i class="fas fa-save"></i>
                                                Guardar
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.invoice -->
                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- /.row -->
                    </div>
                    <!-- /.container-fluid -->
                </section>
                <!-- /.content -->
            </div>
            <!-- /.content-wrapper -->
            <footer class="main-footer">
                <strong>UES &copy; 2021</strong>
                Todos los Derechos Reservados
            </footer>
            <!-- Control Sidebar -->
            <aside class="control-sidebar control-sidebar-dark">
                <!-- Control sidebar content goes here --></aside>
            <!-- /.control-sidebar -->
        </div>
        <!-- ./wrapper -->
        <!-- jQuery -->
        <script src="../plugins/jquery/jquery.min.js"></script>
        <!-- Bootstrap 4 -->
        <script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
        <!-- AdminLTE App -->
        <script src="../dist/js/adminlte.min.js"></script>
        <!-- AdminLTE for demo purposes -->
        <script src="../dist/js/demo.js"></script>
        <script src="../Scripts/factura_previa.js"></script>
        
    </body>
</html>

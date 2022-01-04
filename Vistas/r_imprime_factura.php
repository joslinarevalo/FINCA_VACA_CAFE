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
    <body>
        <div class="wrapper col-6 ">
            <?php
                require_once ('../Menus/loader.php');               
            ?>
            <!-- Main content -->
            <section class="invoice">
                <!-- title row -->
                <!-- info row -->
                <div class="row invoice-info">
                    <div class="col-sm-4 invoice-col">
                        <img src="../dist/img/logo-n.png" alt="user-avatar" class="img-circle img-fluid">
                    </div>
                    <!-- /.col -->
                    <div class="col-sm-4 invoice-col text-center">
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
                    <!-- /.col -->
                </div>
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
                    <div class="col-12 table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Cantidad</th>
                                    <th>Producto</th>
                                    <th>Precio Unitario</th>
                                    <th>Ventas Exentas</th>
                                    <th>Ventas Afectas</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>25</td>
                                    <td>Botella de Leche</td>
                                    <td>$1.50</td>
                                    <td></td>
                                    <td>$37.50</td>
                                </tr>
                                <tr>
                                    <td>1</td>
                                    <td>
                                        Marqueta de queso
                    Duro 50LB
                                    </td>
                                    <td>$64.00</td>
                                    <td></td>
                                    <td>$64.00</td>
                                </tr>
                                <tr>
                                    <td>1</td>
                                    <td>Ternero</td>
                                    <td>$250</td>
                                    <td></td>
                                    <td>$250</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
                <div class="row">
                    <!-- accepted payments column -->
                    <div class="col-6"></div>
                    <!-- /.col -->
                    <div class="col-6">
                        <div class="table-responsive">
                            <table class="table">
                                <tr>
                                    <th style="width:50%">Sumas:</th>
                                    <td>$351.50</td>
                                </tr>
                                <tr>
                                    <th>IVA(13%)</th>
                                    <td>$00.00</td>
                                </tr>
                                <tr>
                                    <th>Venta Total:</th>
                                    <td>$351.50</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </section>
            <!-- /.content -->
        </div>
        <!-- ./wrapper -->
        <!-- Page specific script -->
        <script>
         window.addEventListener("load", window.print());
        </script>
        <script src="../Scripts/factura_previa.js"></script>
    </body>
</html>

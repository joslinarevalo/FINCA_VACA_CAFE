
<!DOCTYPE html>
<html lang="es">
    <head>        
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Clientes | Nuevo</title>
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
        <div class="wrapper">
            <!-- Navbar -->
            <?php
                require_once ('../Menus/menusidebar.php');
            ?>
            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <div class="container-fluid">
                        <div class="row mb-2">
                            <div class="col-sm-6"></div>
                        </div>
                    </div>
                    <!-- /.container-fluid -->
                </section>

                <div class="col-xs-12">
                        <div class="col-xs-1"></div>
                        <div class="col-xs-10">
                            <div id="resultados"></div>
                        </div>
                        <div class="col-xs-1"></div>
                    </div>

                <!--FORMULARIO DEL CLIENTE -->
                <section class="content">
                    <div class="container-fluid">
                        <div class="card card-default">
                            <div class="card-header bg-success">
                                <h3 class="card-title">Datos</h3>
                            </div>
                            <form class="card-body" id="addCliente" name="addCliente" method="POST">
                                <input type="hidden" name="almacenar_datos" value="datonuevo">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="dui_cliente">Dui</label>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">
                                                    <i class="fas fa-newspaper"></i>
                                                </span>
                                            </div>
                                            <input type="text" class="form-control" placeholder="12345678-9"
                                            id="dui_cliente" name="dui_cliente" required="required"  class="form-control" data-inputmask='"mask": "99999999-9"' data-mask>
                                        </div>
                                        <label for="nombre_Cliente">Nombres</label>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">
                                                    <i class="fas fa-user"></i>
                                                </span>
                                            </div>
                                            <input type="text" class="form-control" placeholder="Juan..."
                                            id="nombre_Cliente" name="nombre_Cliente" required="required">
                                        </div>
                                        <label for="direc_cliente">Dirección</label>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">
                                                    <i class="fas fa-map-marked"></i>
                                                </span>
                                            </div>
                                            <input
                                                type="text"
                                                class="form-control"
                                                placeholder="Santo Domingo..."
                                                id="direc_cliente" name="direc_cliente" required="required"
                                            >
                                        </div>
                                    </div>
                                    <!-- /.col -->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="telefono_Cliente">Teléfono</label>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">
                                                        <i class="fas fa-phone-alt"></i>
                                                    </span>
                                                </div>
                                                <input
                                                    type="text"
                                                    class="form-control"
                                                    placeholder="1234-5678"
                                                    id="telefono_Cliente" name="telefono_Cliente" required="required" data-inputmask='"mask": "9999-9999"' data-mask
                                                >
                                            </div>
                                            <label for="apellido_Cliente">Apellidos</label>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">
                                                        <i class="fas fa-user"></i>
                                                    </span>
                                                </div>
                                                <input
                                                    type="text"
                                                    class="form-control"
                                                    placeholder="Mejía..."
                                                    id="apellido_Cliente" name="apellido_Cliente" required="required"
                                                >
                                            </div>
                                            
                                            <label for="estado_Cliente">Estado</label>  
                                            <div class="input-group mb-3">         
                                                <div class="form-group clearfix">
                                                    <div class="icheck-primary d-inline">
                                                        <input type="radio" value="activo" id="radio_activo" name="estado_cliente" checked disabled>
                                                        <label for="radio_activo">
                                                            Activo
                                                        </label>
                                                    </div>
                                                    <div class="icheck-primary d-inline">
                                                        <input type="radio" value="inactivo" id="radio_inactivo" name="estado_cliente" disabled>
                                                        <label for="radio_inactivo">
                                                            Inactivo
                                                        </label>
                                                    </div>                                              
                                                </div>
                                            </div>                                                                                      
                                        </div>
                                    </div>
                                </div>
                                <div>
                                    <button id="limpiar" name="limpiar" type="reset" class="btn bg-success ">
                                        <i class="fas fa-trash"></i> Limpiar</button>

                                    <button type="submit" class="btn bg-success"><i class="fa fa-save"></i> Guardar</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </section>
            </div>



            <footer class="main-footer">
                <div class="float-right d-none d-sm-block"></div>
                <strong>UES &copy; 2021</strong>
                Todos los Derechos Reservados
            </footer>
            <aside class="control-sidebar control-sidebar-dark"></aside>
        </div>
        <script src="../plugins/jquery/jquery.min.js"></script>
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
        <script src="../plugins/sweetalert2/sweetalert2.min.js"></script>
                <!-- Toastr -->
                <script src="../plugins/toastr/toastr.min.js"></script>
        <!-- AdminLTE App -->
        <script src="../dist/js/adminlte.min.js"></script>
        <!-- AdminLTE for demo purposes -->
        <script src="../dist/js/demo.js"></script>
        <script src="../Scripts/clientes.js"></script>
        <!-- Page specific script -->

            <script>
                $(function () {
                    var Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 3000
                    });

                    $('.swalDefaultSuccess').click(function () {
                        Toast.fire({
                            icon: 'success',
                            title: 'Datos Registrados Correctamente.'
                        })
                    });
                    $('.swalDefaultInfo').click(function () {
                        Toast.fire({
                            icon: 'info',
                            title: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
                        })
                    });
                    $('.swalDefaultError').click(function () {
                        Toast.fire({
                            icon: 'error',
                            title: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
                        })
                    });
                    $('.swalDefaultWarning').click(function () {
                        Toast.fire({
                            icon: 'warning',
                            title: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
                        })
                    });
                    $('.swalDefaultQuestion').click(function () {
                        Toast.fire({
                            icon: 'question',
                            title: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
                        })
                    });
                   
                });
            </script>      

            <script>
              $(function () {
                //Initialize Select2 Elements
                $('.select2').select2()

                //Initialize Select2 Elements
                $('.select2bs4').select2({
                  theme: 'bootstrap4'
                })

                //Datemask dd/mm/yyyy
                $('#datemask').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' })
                //Datemask2 mm/dd/yyyy
                $('#datemask2').inputmask('mm/dd/yyyy', { 'placeholder': 'mm/dd/yyyy' })
                //Money Euro
                $('[data-mask]').inputmask()

                //Date picker
                $('#reservationdate').datetimepicker({
                    format: 'L'
                });

                //Date and time picker
                $('#reservationdatetime').datetimepicker({ icons: { time: 'far fa-clock' } });

                //Date range picker
                $('#reservation').daterangepicker()
                //Date range picker with time picker
                $('#reservationtime').daterangepicker({
                  timePicker: true,
                  timePickerIncrement: 30,
                  locale: {
                    format: 'MM/DD/YYYY hh:mm A'
                  }
                })
                //Date range as a button
                $('#daterange-btn').daterangepicker(
                  {
                    ranges   : {
                      'Today'       : [moment(), moment()],
                      'Yesterday'   : [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                      'Last 7 Days' : [moment().subtract(6, 'days'), moment()],
                      'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                      'This Month'  : [moment().startOf('month'), moment().endOf('month')],
                      'Last Month'  : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
                    },
                    startDate: moment().subtract(29, 'days'),
                    endDate  : moment()
                  },
                  function (start, end) {
                    $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'))
                  }
                )

                //Timepicker
                $('#timepicker').datetimepicker({
                  format: 'LT'
                })

                //Bootstrap Duallistbox
                $('.duallistbox').bootstrapDualListbox()

                //Colorpicker
                $('.my-colorpicker1').colorpicker()
                //color picker with addon
                $('.my-colorpicker2').colorpicker()

                $('.my-colorpicker2').on('colorpickerChange', function(event) {
                  $('.my-colorpicker2 .fa-square').css('color', event.color.toString());
                })

                $("input[data-bootstrap-switch]").each(function(){
                  $(this).bootstrapSwitch('state', $(this).prop('checked'));
                })

              })
              // BS-Stepper Init
             
              // DropzoneJS Demo Code Start
              Dropzone.autoDiscover = false

              
            </script>
    </body>
</html>

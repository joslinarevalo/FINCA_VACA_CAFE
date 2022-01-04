<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Gatos | Reportes</title>
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
                    <div class="container-fluid"></div>
                </section>
                <!-- FROMULARIO COMPRA -->
                <section class="content">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-12 ">
                                <div class="card card-success">
                                    <div class="card-header">
                                        <h3 class="card-title">Gastos</h3>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-2">
                                                <div class="form-group">
                                                    <label>Proveedor</label>
                                                    <div class="input-group
                                                    mb-3">
                                                        <select class="form-control select2" style="width: 70%;">
                                                            <option selected="selected">Todos</option>
                                                            <option>Salinera Turcios</option>
                                                            <option>Agroservicio El Frutal</option>
                                                            <option>Agua El Manantial</option>
                                                            <option>Finca Cuscatlán</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-2">
                                                <div class="form-group">
                                                    <label>Fecha Inicio</label>
                                                    <div class="input-group mb-3">
                                                        <input type="datetime-local" class="form-control
                                                        disabled" placeholder="Juan...">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-2">
                                                <div class="form-group">
                                                    <label>Fecha Inicio</label>
                                                    <div class="input-group mb-3">
                                                        <input type="datetime-local" class="form-control
                                                        disabled" placeholder="Juan...">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-2">
                                                <div class="form-group">
                                                    <label>Gasto en</label>
                                                    <select class="form-control select2" style="width: 70%;">
                                                        <option selected="selected">Alimento</option>
                                                        <option>Medicamento</option>
                                                        <option>Maquinaria</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-2">
                                                <div class="form-group">
                                                    <label class="text-center">Ver</label> 
                                                    <div class="input-group mb-3">
                                                        <button class="btn                                                        
                                                    bg-success">
                                                        <i class="fa fa-eye"></i>
                                                        
                                                    </button>
                                                    </div> 
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /.card-body -->
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- DETALLTE DE LA COMPRA (TABLA) -->
                <section class="content">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card">
                                    <!-- /.card-header -->
                                    <div class="card-body">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th>Proveedor</th>
                                                    <th>Inverión</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>Salinera Turcios</td>
                                                    <td>$25.00</td>
                                                </tr>
                                                <tr>
                                                    <td>Agroservicio El Frutal</td>
                                                    <td>$150.00</td>
                                                </tr>
                                                <tr>
                                                    <td>Agua El Manantial</td>
                                                    <td>$30.00</td>
                                                </tr>
                                                <tr>
                                                    <td>Finca Cuscatlán</td>
                                                    <td>$350.</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="col-4" style="margin-left: 49%;">
                                        <div class="table-responsive">
                                            <table class="table float-right">
                                                <tr>
                                                    <th style="width:50%">Inversión Total:</th>
                                                    <td>$555.00</td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="form-group" style="margin-left: 90%;">
                                        <a href="r_imprime-gastos.html"
                                        rel="noopener"
                                        target="_blank"
                                        class="btn btn-success">
                                            <i class="fas
                                        fa-save"></i>
                                            Guardar
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
            <!-- /.content-wrapper -->
            <footer class="main-footer">
                <div class="float-right d-none d-sm-block">
                    <b>Version</b>
                    3.1.0
                </div>
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
        <!-- jQuery -->
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
        <script src="../plugins/jquery/jquery.min.js"></script>
        <!-- Bootstrap 4 -->
        <script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
        <!-- DataTables  & Plugins -->
        <script src="../plugins/datatables/jquery.dataTables2.min.js"></script>
        <script src="../plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
        <script src="../plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
        <script src="../plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
        <script src="../plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
        <script src="../plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
        <script src="../plugins/jszip/jszip.min.js"></script>
        <script src="../plugins/pdfmake/pdfmake.min.js"></script>
        <script src="../plugins/pdfmake/vfs_fonts.js"></script>
        <script src="../plugins/datatables-buttons/js/buttons.html5.min.js"></script>
        <script src="../plugins/datatables-buttons/js/buttons.print.min.js"></script>
        <script src="../plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
        <!-- AdminLTE App -->
        <script src="../dist/js/adminlte.min.js"></script>
        <!-- AdminLTE for demo purposes -->
        <script src="../dist/js/demo.js"></script>
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
            document.addEventListener('DOMContentLoaded', function () {
              window.stepper = new Stepper(document.querySelector('.bs-stepper'))
            })
          
            // DropzoneJS Demo Code Start
            Dropzone.autoDiscover = false
          
            // Get the template HTML and remove it from the doumenthe template HTML and remove it from the doument
            var previewNode = document.querySelector("#template")
            previewNode.id = ""
            var previewTemplate = previewNode.parentNode.innerHTML
            previewNode.parentNode.removeChild(previewNode)
          
            var myDropzone = new Dropzone(document.body, { // Make the whole body a dropzone
              url: "/target-url", // Set the url
              thumbnailWidth: 80,
              thumbnailHeight: 80,
              parallelUploads: 20,
              previewTemplate: previewTemplate,
              autoQueue: false, // Make sure the files aren't queued until manually added
              previewsContainer: "#previews", // Define the container to display the previews
              clickable: ".fileinput-button" // Define the element that should be used as click trigger to select files.
            })
          
            myDropzone.on("addedfile", function(file) {
              // Hookup the start button
              file.previewElement.querySelector(".start").onclick = function() { myDropzone.enqueueFile(file) }
            })
          
            // Update the total progress bar
            myDropzone.on("totaluploadprogress", function(progress) {
              document.querySelector("#total-progress .progress-bar").style.width = progress + "%"
            })
          
            myDropzone.on("sending", function(file) {
              // Show the total progress bar when upload starts
              document.querySelector("#total-progress").style.opacity = "1"
              // And disable the start button
              file.previewElement.querySelector(".start").setAttribute("disabled", "disabled")
            })
          
            // Hide the total progress bar when nothing's uploading anymore
            myDropzone.on("queuecomplete", function(progress) {
              document.querySelector("#total-progress").style.opacity = "0"
            })
          
            // Setup the buttons for all transfers
            // The "add files" button doesn't need to be setup because the config
            // `clickable` has already been specified.
            document.querySelector("#actions .start").onclick = function() {
              myDropzone.enqueueFiles(myDropzone.getFilesWithStatus(Dropzone.ADDED))
            }
            document.querySelector("#actions .cancel").onclick = function() {
              myDropzone.removeAllFiles(true)
            }
            // DropzoneJS Demo Code End
        </script>
    </body>
</html>
<!--<table class="table table-striped" id="example1">
    <thead class="thead-dark">
        <tr>
            <th scope="col">N°</th>
            <th scope="col">Nombre</th>
            <th scope="col">Estadio</th>
            <th scope="col">Puntos</th>
            <th scope="col">Acciones</th>
        </tr>
    </thead>
    <tbody>
       /*
                       // include_once ("../dao/DaoEquipo.php");
                        $daoE=new DaoEquipo();
                        $fila=$daoE->listaEquipo();
                        foreach($fila as $key=>$value){
                        
                    ?>
        <tr>
            <th scope="row" id="id"><  echo $value->getId(); ?></th>
            <td><  echo $value->getNombre(); ?></td>
            <td>< echo $value->getEstadio(); ?></td>
            <td>< echo $value->getPuntos(); ?></td>
            <td>
                <div class="btn-group" role="group" aria-label="Basic example">
                    <button href="#"  data-target="#editEquipoModal" class="edit btn btn-success btnEditar " data-toggle="modal" data-nombre='<?php echo $value->getNombre();?>' data-estadio='<?php echo $value->getEstadio();?>'  data-id='<?php echo $value->getId();?>' data-toggle="tooltip"  ><span class="fa fa-edit"></span></button>

                    <a href="#deleteEquipoModal" class="delete btn btn-danger btnBorrar" data-toggle="modal" data-id="<?php echo $value->getId();?>"><span class="fa fa-trash"></span></a>
                </div>
            </td>
        </tr>
        < }  ?>
    </tbody>
</table>
<script src=assets/js/jquery-3.4.1.min.js></script>
<script src=assets/js/bootstrap.min.js></script>
<script src="../scripts/plugins/miniplugin.js"></script>
<script src="../scripts/marcas/marca.js"></script>
<Paginacion
<script src="../resources/tablas/datatables.net/js/jquery.dataTables.min.js" type="text/javascript"></script>
<script src="../resources/tablas/datatables.net-bs/js/dataTables.bootstrap.min.js" type="text/javascript"></script>-->

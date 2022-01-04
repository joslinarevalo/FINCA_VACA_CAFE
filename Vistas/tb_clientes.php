
<table class="table table-striped projects" id="tablaCl">
    <thead>
        <tr> 
            <th class="text-center">DUI</th>                                       
            <th class="text-center">Nombres</th>
            <th class="text-center">Apellidos</th>
            <th class="text-center">Teléfono</th> 
            <th class="text-center">Dirección</th>                                      
            <th class="text-center">Acciones</th>                                        
         </tr>
         </thead>
            <tbody>
 
            <?php
                require_once ('../Daos/DaoCliente.php');
                daocl = new DaoCliente();
                $datos = $daoCl->listaCliente();
                foreach($datos as $row){
            ?>
         <tr>
            <td class="text-center"><?php  echo $row['nva_dui_cliente'] ?></td>
            <td class="text-center"><?php  echo $row['nva_nom_cliente'] ?></td>
            <td class="text-center"><?php  echo $row['nva_ape_cliente'] ?></td>           
            <td class="text-center"><?php  echo $row['txt_direc_cliente'] ?></td> 
            <td class="text-center"><?php  echo $row['nva_telefono_cliente'] ?></td>                                                                               
            <td class="project-actions text-center">                                            
                <button class="btn btn-info btn-sm" href="#" data-toggle="modal" data-target="#ClienteEdit" 
                    data-toggle="tooltip" >
                    <i class="fas fa-pencil-alt"></i>
                </button>
                <button class="btn btn-danger btn-sm" href="#BajaCliente" data-toggle="modal">
                    <i class="fas fa-trash"></i>
                </button>
            </td>
        </tr>

                                                            
                <?php }  ?>
                </tbody>
</table>
                       

         <script src="../plugins/jquery/jquery.min.js"></script>
        <!-- Bootstrap 4 -->
        <script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
        <!-- AdminLTE App -->
        <script src="../dist/js/adminlte.min.js"></script>
        <!-- AdminLTE for demo purposes -->
        <script src="../dist/js/demo.js"></script>

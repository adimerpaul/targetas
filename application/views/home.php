<section role="main" class="content-body">
            <header class="page-header">
                <h2>Personal</h2>

                <div class="right-wrapper pull-right">
                    <ol class="breadcrumbs">
                        <li>
                            <a href="<?=base_url()?>">
                                <i class="fa fa-home"></i>
                            </a>
                        </li>
                        <li><span>Home</span></li>
                        <li><span>Personal</span></li>
                    </ol>

                    <a class="sidebar-right-toggle" data-open="sidebar-right"><i class="fa fa-chevron-left"></i></a>
                </div>
            </header>

            <!-- start: page -->
    <section class="panel">
        <header class="panel-heading">
            <div class="panel-actions">
                <a href="#" class="fa fa-caret-down"></a>
                <a href="#" class="fa fa-times"></a>
            </div>
            <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target=".bs-example-modal-lg">Nuevo personal <i class="fa fa-plus-circle"></i></button>
            <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
                <div class="modal-dialog modal-lg" role="document">

                    <div class="modal-content">
                        <div class="modal-header bg-success" style="color: white">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title"><i class="fa fa-plus-circle"></i> Nuevo personal</h4>
                        </div>
                        <div class="modal-body">
                            <form class="form-horizontal" method="post" action="<?=base_url()?>Cliente/crear">
                                <div class="form-group">
                                    <label for="ci" class="col-sm-1 control-label">Carnet</label>
                                    <div class="col-sm-5">
                                        <input style="text-transform: uppercase" type="text" class="form-control" id="ci" placeholder="Carnet" name="ci" required>
                                    </div>
                                    <label for="nombres" class="col-sm-1 control-label">Nombres</label>
                                    <div class="col-sm-5">
                                        <input style="text-transform: uppercase" type="text" class="form-control" id="nombres" placeholder="Nombres" name="nombres" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="apellidos" class="col-sm-1 control-label">Apellidos</label>
                                    <div class="col-sm-5">
                                        <input style="text-transform: uppercase" type="text" class="form-control" id="apellidos" placeholder="Apellidos" name="apellidos" required>
                                    </div>
                                    <label for="cargo" class="col-sm-1 control-label">Unidad</label>
                                    <div class="col-sm-5">
                                        <input style="text-transform: uppercase" type="text" class="form-control" id="cargo" placeholder="Unidad" name="cargo" required>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar <i class="fa fa-trash-o"></i></button>
                                    <button type="submit" class="btn btn-success">Crear <i class="fa fa-plus-circle"></i></button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <div class="panel-body">
            <script>
                function eliminar(e){
                    if (!confirm('Seguro de eliminar?')){
                        e.preventDefault();
                    }
                }
            </script>
            <table class="table table-bordered table-striped mb-none" id="datatable-tabletools" data-swf-path="assets/vendor/jquery-datatables/extras/TableTools/swf/copy_csv_xls_pdf.swf">
                <thead>
                <tr>
                    <th>Carnet</th>
                    <th>Nombres</th>
                    <th>Apellidos</th>
                    <th class="hidden-phone">Unidad</th>
                    <th class="hidden-phone">Opciones</th>
                </tr>
                </thead>
                <tbody>
                <?php
                $query=$this->db->query("SELECT * FROM clientes where estado=1");
                foreach ($query->result() as $row){
                    echo "
                <tr class='gradeX'>
                    <td>$row->ci</td>
                    <td>$row->nombres</td>
                    <td>$row->apellidos</td>
                    <td class='center hidden-phone'>$row->cargo</td>
                    <td class='actions'>
                        <a href='' class='on-default edit-row' data-toggle='modal' data-target='#exampleModal' 
                        data-id='$row->id'
                        data-ci='$row->ci'
                        data-nombres='$row->nombres'
                        data-apellidos='$row->apellidos'
                        data-cargo='$row->cargo'
                        ><i class='fa fa-pencil'></i></a>
                        <a href='".base_url()."Cliente/borrar/$row->id' onclick='eliminar(event)' class='on-default remove-row'><i class='fa fa-trash-o'></i></a>
                    </td>
                </tr>";
                }
                ?>

                </tbody>
            </table>
            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header bg-warning" >
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="exampleModalLabel"><i class="fa fa-pencil"></i> Modificar personal </h4>
                        </div>
                        <div class="modal-body">
                            <form method="post" action="<?=base_url()?>Cliente/modificar">
                                <div class="form-group">
                                    <label for="ci2" class="col-sm-1 control-label">Carnet</label>
                                    <div class="col-sm-5">
                                        <input type="hidden" id="id2" name="id">
                                        <input style="text-transform: uppercase" type="text" class="form-control" id="ci2" placeholder="Carnet" name="ci" required>
                                    </div>
                                    <label for="nombres2" class="col-sm-1 control-label">Nombres</label>
                                    <div class="col-sm-5">
                                        <input style="text-transform: uppercase" type="text" class="form-control" id="nombres2" placeholder="Nombres" name="nombres" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="apellidos2" class="col-sm-1 control-label">Apellidos</label>
                                    <div class="col-sm-5">
                                        <input style="text-transform: uppercase" type="text" class="form-control" id="apellidos2" placeholder="Apellidos" name="apellidos" required>
                                    </div>
                                    <label for="cargo2" class="col-sm-1 control-label">Unidad</label>
                                    <div class="col-sm-5">
                                        <input style="text-transform: uppercase" type="text" class="form-control" id="cargo2" placeholder="Unidad" name="cargo" required>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar <i class="fa fa-trash-o"></i></button>
                                    <button type="submit" class="btn btn-warning">Modificar <i class="fa fa-edit"></i></button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
            <!-- end: page -->
        </section>
<script>
    window.onload= function (){
        $('#exampleModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget) // Button that triggered the modal
            // var recipient = button.data('whatever') // Extract info from data-* attributes
            $('#ci2').val(button.data('ci'));
            $('#nombres2').val(button.data('nombres'));
            $('#apellidos2').val(button.data('apellidos'));
            $('#cargo2').val(button.data('cargo'));
            $('#id2').val(button.data('id'));
            // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
            // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
            // var modal = $(this)
            // modal.find('.modal-title').text('New message to ' + recipient)
            // modal.find('.modal-body input').val(recipient)
        })

        var datatableInit = function() {
            var $table = $('#datatable-tabletools');

            $table.dataTable({
                sDom: "<'text-right mb-md'T>" + $.fn.dataTable.defaults.sDom,
                oTableTools: {
                    sSwfPath: $table.data('swf-path'),
                    aButtons: [
                        {
                            sExtends: 'pdf',
                            sButtonText: 'PDF'
                        },
                        {
                            sExtends: 'csv',
                            sButtonText: 'CSV'
                        },
                        {
                            sExtends: 'xls',
                            sButtonText: 'Excel'
                        },
                        {
                            sExtends: 'print',
                            sButtonText: 'Print',
                            sInfo: 'Please press CTR+P to print or ESC to quit'
                        }
                    ]
                }
            });

        };

        $(function() {
            datatableInit();
        });
    }
</script>

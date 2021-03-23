<link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.7.0/css/buttons.dataTables.min.css">
<section role="main" class="content-body">
    <header class="page-header">
        <h2>Reporte</h2>

        <div class="right-wrapper pull-right">
            <ol class="breadcrumbs">
                <li>
                    <a href="<?=base_url()?>">
                        <i class="fa fa-home"></i>
                    </a>
                </li>
                <li><span>Home</span></li>
                <li><span>Reporte</span></li>
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
            <form class="form-horizontal form-bordered" id="formulario">
                <div class="form-group">
                    <label class="col-md-3 control-label">Seleccionar fecha</label>
                    <div class="col-sm-8">
                        <div class="row">
<!--                            <div class="col-sm-2">-->
<!--                                <input type="text" class="form-control" placeholder=".col-sm-2">-->
<!--                            </div>-->
                            <div class="visible-xs mb-md"></div>
                            <div class="col-sm-3">
<!--                                <input type="text" class="form-control" placeholder=".col-sm-3">-->
                                <input type="date" id="fecha" value="<?=date('Y-m-d')?>" class="form-control">
                            </div>
                            <div class="visible-xs mb-md"></div>
                            <div class="col-sm-4">
<!--                                <input type="text" class="form-control" placeholder=".col-sm-4">-->
                                <button class="btn btn-block btn-success" type="submit">Buscar <i class="fa fa-eye"></i></button>
                            </div>
                        </div>

                    </div>
                </div>
            </form>
        </header>
        <div class="panel-body">
            <script>
                function eliminar(e){
                    if (!confirm('Seguro de eliminar?')){
                        e.preventDefault();
                    }
                }
            </script>
<!--            <button id="btn">asdsa</button>-->
            <table id="example" class="display" style="width:100%">
                <thead>
                <tr>
                    <th>Name</th>
                    <th>Position</th>
                    <th>Office</th>
                    <th>Age</th>
                    <th>Start date</th>
                    <th>Salary</th>
                </tr>
                </thead>
                <tbody id="datos">
<!--                <tr>-->
<!--                    <td>Tiger Nixon</td>-->
<!--                    <td>System Architect</td>-->
<!--                    <td>Edinburgh</td>-->
<!--                    <td>61</td>-->
<!--                    <td>2011/04/25</td>-->
<!--                    <td>$320,800</td>-->
<!--                </tr>-->
                </tbody>
            </table>
        </div>
    </section>
    <!-- end: page -->
</section>
<script src="https://code.jquery.com/jquery-3.5.1.js" defer></script>
<script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js" defer></script>
<script src="https://cdn.datatables.net/buttons/1.7.0/js/dataTables.buttons.min.js" defer></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js" defer></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js" defer></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js" defer></script>
<script src="https://cdn.datatables.net/buttons/1.7.0/js/buttons.html5.min.js" defer></script>
<script src="https://cdn.datatables.net/buttons/1.7.0/js/buttons.print.min.js" defer></script>
<script>
    window.onload= function (){
        var tabla=$('#example').DataTable( {
            dom: 'Bfrtip',
            buttons: [
                'copy', 'csv', 'excel', 'pdf', 'print'
            ]
        } );
        $('#btn').click(function (e){
            tabla.destroy();
            $('#datos').html("<tr>" +
                "<td>a</td>" +
                "<td>b</td>" +
                "<td>c</td>" +
                "<td>asdsa</td>" +
                "<td>asda</td>" +
                "<td>asd</td>" +
                "</tr>");
            tabla=$('#example').DataTable( {
                dom: 'Bfrtip',
                buttons: [
                    'copy', 'csv', 'excel', 'pdf', 'print'
                ]
            } );
        });
        $('#formulario').submit(function (e){
            tabla.destroy();
            $.ajax({
                url:'Reporte/buscar/'+$('#fecha').val(),
                success:function (e){
                    let datos=JSON.parse(e);
                    console.log(datos);
                }
            })
            return false;
        });

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

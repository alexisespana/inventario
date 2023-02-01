@extends('layouts.inicio')
@section('title', 'Lista de Productos')
@section('css')
    <link rel="stylesheet" href="{{ asset('css/Datatables/data-tables.min.css') }}">
@endsection

@section('content')
    @csrf

    <div id="highlight-table" class="card card card-default scrollspy">
        <div class="card-content">
            <h4 class="card-title">Highlight Table</h4>

            <div class="row">
                <table id="listaProductos" class="display" style="width:100%">
                    <thead>
                        <tr>
                            <th>id</th>
                            <th>Nombre</th>
                            <th>Cant. Stock</th>
                            <th>Precio venta</th>
                            <th>Precio compra</th>
                            <th>fecha_ing</th>
                            <th>fecha_venc</th>
                            <th>total</th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                    <tfoot class="text-center">
                        <tr>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                          
                           
                            <th></th>


                        </tr>
                    </tfoot>


                </table>
            </div>


        </div>

    @section('scripts')
        <script src="{{ asset('js/DataTables/jquery.dataTables.min.js') }}"></script>

        <script>
            $(document).ready(function() {

                $('#listaProductos').DataTable();
                productoscecidos();
            });

            function productoscecidos() {
                var url = " {{ route('productos-vencidos') }}";
                var token = $("input[name=_token]").val();
                var tipo_grado = $("#tipo_grado").val();
                var anio_selecionado = $("#anio_selecionado").val();
                var numberRenderer = $.fn.dataTable.render.number('.', ',', 0, '$', ).display;

                $('#listaProductos').DataTable({
                    destroy: true,
                    processing: true,
                    serverSide: false,


                    select: true,
                    paging: true,
                   

                    buttons: [{
                        extend: 'collection',
                        text: 'Excel',
                        extend: 'excel',
                        // action: Imprimir,
                        text: '<i class="cil-cloud-download "  style="color: green;"></i>',
                        titleAttr: 'Exportar Excel',
                        exportOptions: {
                            // columns: [ 5,13,1,2,14,3,6,7,4,15,16,17,18,19,20,21,11,12,8,22,23,24,10,25],
                            orthogonal: 'excel',
                            modifier: {
                                order: 'current',
                                page: 'all',
                                selected: false,
                            },

                        },
                        filename: function() {
                            var tipo_grado = $("#tipo_grado").val();
                            var anio_selecionado = $("#anio_selecionado").val();
                            var tipo_grado = $("#tipo_grado option:selected").text();
                            return 'Matrículas ' + tipo_grado + ' por año ' + anio_selecionado;
                        },
                    }],
                    language: {
                        "url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
                    },
                    ajax: {
                        "url": url,
                        "type": "POST",
                        "data": {
                            "_token": token,
                            "_method": "POST",
                            "tipo_grado": tipo_grado,
                            "anio_selecionado": anio_selecionado,

                        },
                    },
                    drawCallback: function() {
                        var api = this.api();

                        var num_rows = api.page.info().recordsTotal;

                        // si la carrera seleccionada no tiene registro se deshabilita el boton de descargar excel
                        if (num_rows == 0) {

                            $(".buttons-excel").attr('disabled', true);
                        } else {
                            $(".buttons-excel").attr('disabled', false);
                        }
                        // console.log(api.page.info());
                    },

                    "footerCallback": function(row, data, start, end, display) {
                        var api = this.api(),
                            data;
                        var intVal = function(i) {
                            return typeof i === 'string' ?
                                i.replace(/[\$,]/g, '') * 1 :
                                typeof i === 'number' ?
                                i : 0;
                        };

                        var suma = function(api, column) {

                            return numberRenderer(api
                            .column(column)
                            .data()
                            .reduce(function(a, b) {
                                return intVal(a) + intVal(b);
                            }, 0));


                        };
                        $(api.column(0).footer()).html('').attr('colspan', 2);
                        // $(api.column(1).footer()).html(suma(api, 2)).addClass('text-center');
                        // $(api.column(2).footer()).html(suma(api, 3));
                        $(api.column(1).footer()).html(suma(api, 2)).addClass('text-center');
                        $(api.column(2).footer()).html(suma(api, 3));
                        $(api.column(3).footer()).html(suma(api, 4));
                        $(api.column(6).footer()).html(suma(api, 7));
                        // $(api.column(4).footer()).html(suma(api, 5));
                    },
                    columns: [{
                            data: 'index',
                            name: 'index',
                            className: 'text-justify',
                            orderable: false,
                            searchable: false,
                        },
                        // {
                        //     data: 'id_prod',
                        //     name: 'id_prod',
                        //     className: 'text-justify',
                        // },
                        {
                            data: 'productos',
                            name: 'productos',
                            className: 'text-justify',
                        },
                        // {
                        //     data: 'TotalPostulantes',
                        //     name: 'TotalPostulantes'
                        // },
                        // {
                        //     data: 'TotSinMatricula',
                        //     name: 'TotSinMatricula'
                        // },
                        {
                            data: 'cantidad',
                            name: 'cantidad'
                        },
                        {
                            data: 'precio_venta',
                            name: 'precio_venta'
                        },
                        {
                            data: 'precio_compra',
                            name: 'precio_compra'
                        },
                        {
                            data: 'fecha_ingreso',
                            name: 'fecha_ingreso'
                        },
                        {
                            data: 'fecha_venc',
                            name: 'fecha_venc'
                        },
                        {
                            data: 'total',
                            name: 'total'
                        },

                    ],

                    columnDefs: [{
                        targets: [2, 3],

                    }],



                });
                var tipo_grado = $("#tipo_grado option:selected").text();
                $(".titulo_central").text('Matrículas ' + tipo_grado + ' por Año: ' + anio_selecionado);
            }
        </script>

    @stop
@endsection

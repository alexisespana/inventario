@extends('layouts.inicio')
@section('title', 'Lista de Productos')
@section('css')
    <link rel="stylesheet" href="{{ asset('css/Datatables/data-tables.min.css') }}">
@endsection

@section('content')
    <div id="highlight-table" class="card card card-default scrollspy">
        <div class="card-content">
            <h4 class="card-title">Highlight Table</h4>

            <div class="row">
                <table id="listaProductos" class="display" style="width:100%">
                    <thead>
                        <tr>
                            <th>Codigo</th>
                            <th>Nombre</th>
                            <th>Cant. Stock</th>
                            <th>Categoría</th>
                            <th>Precio venta</th>
                            <th>Precio compra</th>
                            <th>action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($opciones as $item)
                            <tr>
                                <td>{!! $item->codigo !!}</td>
                                <td>{!! $item->nombre !!}</td>
                                @isset($item->stock->cantidad)
                                    <td>{!! $item->stock->cantidad !!}</td>
                                @endisset
                                <td>{!! $item->categoria->nombre !!}</td>
                                @isset($item->precio->precio)
                                    <td>{!! Str::miles($item->precio->precio) !!}</td>
                                @endisset
                                @isset($item->stock->precio_compra)
                                <td>{!! isset($item->stock->precio_compra->precio)? Str::miles($item->stock->precio_compra->precio): 0 !!}</td>
                            @endisset
                              
                                <td><a onclick="editar(this)" id="{!! $item->codigo !!}"
                                        class="invoice-action-edit mr-4 green-text lightrn-1 modal-trigger"
                                        href="#editarProductos">
                                        <i class="material-icons">edit</i>
                                        <a onclick="detalles(this)" id="{!! $item->codigo !!}"
                                            class="invoice-action-view mr-4 modal-trigger" href="#editarProductos">
                                            <i class="material-icons">remove_red_eye</i>
                                        </a>
                                    </a>
                                </td>
                            </tr>
                        @endforeach


                    </tbody>

                </table>
            </div>


        </div>

    @section('scripts')
        <script src="{{ asset('js/DataTables/jquery.dataTables.min.js') }}"></script>

        <script>
            $(document).ready(function() {
                $('.modal').modal();
        $('#listaProductos').DataTable();

                // $('#listaProductos').DataTable();
                // $('#listaProductos').DataTable({scrollY:700,scrollX:!0});
            });

            function editar(obj) {
                var id = $(obj).attr('id');
                var url = '/productos/editar';
                var vista = 'editarProductos';
                var type = 'GET';
                ajax(id, vista, url, type);
            }

            function detalles(obj) {
                var id = $(obj).attr('id');
                var url = '/productos/detallesProductos';
                var vista = 'detallesProductos';
                var type = 'GET';
                ajax(id, vista, url, type);
            }

            function ajax(id, vista, url, type) {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                //we will send data and recive data fom our AjaxController
                $.ajax({
                    url: url,
                    data: {
                        'codigo': id,
                        'vista': vista,
                    },
                    type: type,
                    success: function(response) {
                        $('#editarProductos').empty();
                        $('.modal').append(response);
                    },
                    statusCode: {
                        404: function() {
                            alert('web not found');
                        }
                    },
                    error: function(x, xs, xt) {
                        //nos dara el error si es que hay alguno
                        // window.open(JSON.stringify(x));
                        console.log('error: ' + JSON.stringify(x) + "\n error string: " + xs +
                            "\n error throwed: " + xt);
                    }
                });
            }
        </script>

    @stop
@endsection

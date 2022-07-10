@extends('layouts.inicio')
@section('title', 'Ventas Realizadas')
@section('css')
<link rel="stylesheet" href="{{ asset('css/Datatables/data-tables.min.css') }}">

@endsection

@section('content')
    <div class="col s12">
        <div class="container">
            <div id="highlight-table" class="card card card-default scrollspy">
                <div class="card-content">
                    <h4 class="card-title">Highlight Table</h4>
                    <p class="mb-2">

                        <!-- Modal Trigger -->
                        <a class="waves-effect waves-light btn modal-trigger" href="#editarProductos">Modal</a>
                        <!-- Modal Structure -->

                    </p>

                    <!-- Page Length Options -->
                    <div class="row">
                        <div class="col s12"></div>
                        <div class="card">
                            <div class="card-content">
                                <h4 class="card-title">Page Length Options</h4>
                                <div class="row">
                                    <div class="col s12">
                                        <table id="lista_ventas" class="display" style="width:100%">
                                            <thead>
                                                <tr>
                                                    <th>codigo</th>
                                                    <th>Fecha</th>
                                                    <th>Medio Pago</th>
                                                    <th>Status</th>
                                                    <th>monto compra</th>
                                                    <th>cant. efectivo</th>
                                                    <th>Cambio</th>
                                                    <th>Cantidad Prod.</th>
                                                    <th>action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($opciones as $item)
                                                    <tr>
                                                        {{-- <td>{!! $item->codigo !!}</td> --}}
                                                        <td>{!! $item->cod_operacion !!}</td>
                                                        <td>{!! Str::fecha($item->created_at) !!}</td>
                                                        <td>{!! $item->medio_pago == 1 ? 'efectivo' : 'debito' !!}<i
                                                                class="material-icons  green-text tiny icon-demo">{!! $item->medio_pago == 1 ? 'attach_money' : 'credit_card' !!}</i>
                                                        </td>
                                                        <td><span
                                                                class="chip lighten-5 {!! $item->procesada == 1 ? 'green green-text' : 'red red-text' !!}">{!! $item->procesada == 1 ? 'procesada' : 'negada' !!}</span>
                                                        </td>
                                                        <td>{!! $item->valor_compra !!}</td>
                                                        <td>{!! $item->pagado !!}</td>
                                                        <td>{!! $item->cambio !!}</td>
                                                        <td>{!! $item->suma_prod !!}</td>
                                                        <td><a onclick="Detalles_Ventas(this)" id="{!! $item->id !!}"
                                                                class="mb-6 btn-floating detalles waves-effect waves-light purple lightrn-1 modal-trigger"
                                                                href="#editarProductos">
                                                                <i class="material-icons">visibility</i>
                                                            </a></td>
                                                    </tr>
                                                @endforeach


                                            </tbody>

                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


            </div>

        </div>
    </div>
@section('scripts')
<script src="{{ asset('js/DataTables/jquery.dataTables.min.js') }}"></script>


    <script>
          $(document).ready(function() {
                $('.modal').modal();
                $('#lista_ventas').DataTable();
                // $('#listaProductos').DataTable({scrollY:700,scrollX:!0});
            });

        function Detalles_Ventas(id) {
            var codigo = $(id).attr('id');
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });


            $.ajax({
                url: '/ventas/detalles',
                data: {
                    'codigo': codigo
                },
                type: 'get',
                success: function(response) {

                    $('.modal-body').empty().append(response);
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


        };
    </script>
@stop

@endsection

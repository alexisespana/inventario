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
                <h4 class="card-title">fecha:</h4>
                <div class="row mb-5">

                    <form action="/ventas/listar" method="post">
                        @csrf
                        <div class="input-field col s4">
                            <i class="material-icons prefix">account_circle</i>
                            <input id="icon_prefix" type="text" class="datepicker fecha1" name="fecha1" value="{!!$fecha_hoy !!}">
                            <label for="icon_prefix">fecha inicio</label>
                        </div>
                        <div class="input-field col s4">
                            <i class="material-icons prefix">phone</i>
                            <input id="icon_telephone" type="text" class="datepicker fecha2" name="fecha2" value="{!!$fecha_mañana !!}">
                            <label for="icon_telephone">fecha fin</label>
                        </div>
                        <div class="input-field col s4">
                            <button class="btn waves-effect waves-light " type="submit" name="action">Send
                                <i class="material-icons right">send</i>
                            </button>
                        </div>
                    </form>
                </div>
                <div class="row">
                    <div class="col s12 m8 l8">
                        <div class="card ">
                            <div class="card-content">
                                <h6 class="mb-0 mt-0 display-flex justify-content-between">Total Ventas
                                </h6>
                                <div class="current-balance-container">
                                </div>
                                <h5 class="center-align">{!! $resumenVentas->total_ventas !!}</h5>
                                <p class="medium-small center-align">total ventas hoy</p>
                            </div>
                            <div class="card-action">

                                <!--<div class="row">
                                    <div class="col s6 push-2"><span ><i class="material-icons ">credit_card</i> Ventas debito: ${--!! $resumenVentas->debito !!}</span></div>
                                    <div class="col s6 push-5"><span ><i class="material-icons ">attach_money</i> Ventas efectivo: ${--!! $resumenVentas->efectivo !!}</span></div>
                                </div>-->


                            </div>
                        </div>
                    </div>

                </div>





                <!-- Page Length Options -->
                <div class="row">
                    <div class="col s12"></div>
                    <div class="card">
                        <div class="card-content tabla">
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
                                                <td>{!! $item->medio_pago == 1 ? 'efectivo' : 'debito' !!}<i class="material-icons  green-text tiny icon-demo">{!! $item->medio_pago == 1 ? 'attach_money' : 'credit_card' !!}</i>
                                                </td>
                                                <td><span class="chip lighten-5 {!! $item->procesada == 1 ? 'green green-text' : 'red red-text' !!}">{!! $item->procesada == 1 ? 'procesada' : 'negada' !!}</span>
                                                </td>
                                                <td>{!! $item->valor_compra !!}</td>
                                                <td>{!! $item->pagado !!}</td>
                                                <td>{!! $item->cambio !!}</td>
                                                <td>{!! $item->suma_prod !!}</td>
                                                <td><a onclick="Detalles_Ventas(this)" id="{!! $item->id !!}" class="mb-6 btn-floating detalles waves-effect waves-light purple lightrn-1 modal-trigger" href="#editarProductos">
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
        $('.datepicker').datepicker({
            autoClose: true,
            format: 'dd-mm-yyyy'
        });
        $('#lista_ventas').DataTable();
        // $('#listaProductos').DataTable({scrollY:700,scrollX:!0});
    });

    function Detalles_Ventas(id) {
        var codigo = $(id).attr('id');
        ajax('/ventas/detalles', {
            'codigo': codigo
        }, 'get');

    };

    function filtrar_fecha() {
        var fecha1 = $('.fecha1').val();
        var fecha2 = $('.fecha2').val();
        //alert(fecha1+' '+fecha2);
        ajax('/ventas/listar ', {
            'fecha1': fecha1,
            'fecha2': fecha2
        }, 'POST');

    };

    function ajax(url, data, type) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });


        $.ajax({
            url: url,
            data: data,
            type: type,
            success: function(response) {
                if (type == 'get') {

                    $('.modal-body').empty().append(response);
                } else if (type == 'POST') {
                    $('.tabla').empty();
                }

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
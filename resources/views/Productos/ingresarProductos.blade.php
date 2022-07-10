@extends('layouts.inicio')

@section('content')
    <div id="highlight-table" class="card card card-default scrollspy">
        <div class="card-content">
            <h4 class="card-title text-center">Ingresar Productos</h4>

            <div class="row">


                <div class="col s12">
                    <div class="row">
                        <form class="col s12 form" method="POST" action="Ingresar">
                            @csrf
                            <div class="row">
                                <div class="input-field col offset-m3 s12 m3">

                                    <input id="icon_prefix" type="text" name="codigo" autofocus class="validate codigo">
                                    <label for="icon_prefix">codigo</label>
                                </div>
                            </div>
                            <div class="divider mb-3 mt-3"></div>

                            <div class="row">
                                <div class="input-field col s12 m3">

                                    <input id="nombre_prod" type="text" name="nombre_prod" class="validate">
                                    <label for="nombre_prod">nombre</label>
                                </div>
                                <div class="input-field col m3">
                                    <select name="categoria">
                                        @foreach ($productos->categoria as $value)
                                            <option value="{!! $value->id !!}">{!! $value->nombre !!}</option>
                                        @endforeach
                                    </select>
                                    <label>Categoría</label>
                                </div>

                                <div class="input-field col m3">
                                    <select name="unidad_medida">
                                        @foreach ($productos->unidadMedida as $value)
                                            <option value="{!! $value->id !!}">{!! $value->nombre !!}</option>
                                        @endforeach
                                    </select>
                                    <label>Unidad de medida</label>
                                </div>

                            </div>

                            <div class="row">
                                <div class="input-field col s12 m3">

                                    <input id="cantidad" type="text" name="cantidad" class="validate">
                                    <label for="cantidad">cantidad</label>
                                </div>

                                <div class="input-field col s12 m3">

                                    <input id="precio_venta" type="text" name="precio_venta" class="validate precio_prod">
                                    <label for="precio_venta">precio venta</label>
                                </div>
                                <div class="input-field col s12 m3">

                                    <input id="precio_compra" type="text" name="precio_compra" class="validate precio_prod">
                                    <label for="precio_compra">precio compra</label>
                                </div>


                            </div>
                            <div class="row">
                                <div class="input-field col s12 m3">
                                    <input id="fecha_venc" type="text" name="fecha_venc" placeholder="__/__/____"
                                        maxlength='10' class="date validate">
                                    <label for="fecha_venc">Fecha Vencimiento</label>
                                </div>
                                <div class="input-field col s12 m3">

                                    <input id="cant_promo" type="text" name="cant_promo" class="cant_promo validate">
                                    <label for="cant_promo">cantidad promo</label>
                                </div>

                                <div class="input-field col s12 m3">

                                    <input id="precio_promo" type="text" name="precio_promo" class="precio_promo validate">
                                    <label for="precio_promo">precio promoción</label>
                                </div>
                                <div class="input-field col s6">
                                    <button class="btn cyan waves-effect waves-light guardar right" type="button"
                                        name="action">Guardar
                                        <i class="material-icons right">send</i>
                                    </button>
                                </div>
                            </div>



                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.8/jquery.mask.min.js"></script>

    <script>
        $(document).ready(function() {
            $('.precio_prod, .precio_promo').mask('00.000', {
                min: 1,
                max: 20000,
                reverse: true
            });
            $('.date').mask('00/00/0000', {
                min: new Date(1990, 0, 1),
                max: new Date(2020, 0, 1),
            });

            $(document).on("click", ".guardar", function(e) {

                var form = $(".form"); // Agrega esta línea

               
                $.ajax({
                    type: form.attr('method'),
                    url: form.attr('action'),
                    data: form.serialize(),
                    beforeSend: function() {
                        // setting a timeout
                        $('.guardar').addClass('disabled');
                    },
                    success: function(data) {
                        form.trigger("reset");
                        $('.guardar').removeClass('disabled');
                        $('.codigo').focus();
                    },
                    error: function(x, xs, xt) {
                        $('.guardar').removeClass('disabled');

                        //nos dara el error si es que hay alguno
                        // window.open(JSON.stringify(x));
                        alert('error: ' + JSON.stringify(x) + "\n error string: " + xs +
                            "\n error throwed: " + xt);
                    }
                })
            });
        });
    </script>
@endsection

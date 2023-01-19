@extends('layouts.inicio')

@section('title', 'Registrar Ventas')
@section('css')
<link rel="stylesheet" href="{{ asset('css/autocomplete/jquery-iu.css') }}">
<link rel="stylesheet" href="{{ asset('css/sweetAlert/sweetAlert.min.css') }}">


<style>
    .ocultar {
        display: none !important
    }
</style>
@endsection

@section('content')
<div class="col s12">
    <div class="container">
        <section class="invoice-edit-wrapper section">
            <div class="row">
                <div class="col s12">
                    <div class="card">
                        <div class="card-content px-36">
                            <div class="invoice-product-details">
                                

                                <div class="row">
                                    <div class="input-field col s3 pull-s0 ">
                                        <input id="icon_telephone" type="text" name="codigo" class="validate buscarProducto autocomplete" autofocus>
                                        <label for="icon_telephone">Producto:</label>
                                    </div>
                                    <div class="col s5 push-s4">
                                        <div class="card">
                                            <div class="card-content gradient-45deg-indigo-purple white-text">
                                                <h5 class="card-stats-number white-text ">Total: <span class="total"></span> </h5>
                                                
                                            </div>
                                          
                                        </div>
                                    </div>
                                </div>
                                <div class="card-alert card red lighten-5 hide">
                                    <div class="card-content red-text prodNoEncontrado">
                                    </div>
                                  
                                  </div>
                                <div class="divider mb-3 mt-3"></div>
                                <table class="common">
                                    <thead>
                                        <tr>
                                            <th>codigo</th>
                                            <th colspan="3">Producto</th>
                                            <th>cantidad</th>
                                            <th class="">precio Unid.</th>
                                            <th class="">Precio</th>
                                            <th class="right-align">action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr class="trow hide codigo_prod">

                                            <td class='codigo'>
                                                <div class="precioPorducto">
                                                    <input class="hide" type="text" id="codigo" name="codigo[]" value="" />
                                                </div>
                                            </td>
                                            <td class='producto' colspan="3"></td>
                                            <td class='cantidad'></td>
                                            <td class=' valorProducto'></td>
                                            <td class=' precio'></td>

                                            <td class="right-align ">
                                                <a class='mb-6 btn-floating waves-effect waves-light red accent-2 list_cancel'>
                                                    <i class='material-icons'>clear</i></a>
                                            </td>
                                        </tr>


                                    </tbody>
                                </table>
                            </div>
                            <div class="divider mb-3 mt-3"></div>
                            <div class="invoice-subtotal ">
                                <div class="row">
                                    <div class="col m4 s12 metodoPago">

                                        <!-- Switch -->
                                        <div class="switch">
                                            <label>
                                                Efectivo
                                                <input type="checkbox" checked class="switch" name="metodoPago" onchange="metodoPago(this)">
                                                <span class="lever"></span>
                                                Débito
                                            </label>
                                        </div>
                                        <div class="row debito">
                                            <div class="input-field">
                                                <input id="boleta" type="text" name="nroBoleta" class="validate boleta">
                                                <label for="boleta">Nro Boleta:</label>
                                            </div>
                                        </div>

                                        <div class="row  efectivo ocultar ">
                                            <li class="display-flex justify-content-between">
                                                <span class="invoice-subtotal-title">&nbsp;</span>
                                                <h6 class="invoice-subtotal-value">
                                                    <input style="text-align:right" id="cant_efectivo" type="text" onkeyup="calcularVuelto(this)" name="cant_efectivo" class="validate cant_efectivo">
                                                </h6>
                                            </li>

                                            <li class="display-flex justify-content-between">
                                                <span class="invoice-subtotal-title">Total:</span>
                                                <h6 class="invoice-subtotal-value totalPagar">$0,00</h6>
                                            </li>
                                            <li class="display-flex justify-content-between">
                                                <span class="invoice-subtotal-title"> Vuelto:</span>
                                                <h6 class="invoice-subtotal-value vuelto">$0,00</h6>
                                            </li>
                                        </div>



                                    </div>
                                    <div class="col xl3 m6 s12 offset-xl4">
                                        <ul>


                                            <li class="display-flex justify-content-between">
                                                <span class="invoice-subtotal-title"> subTotal</span>
                                                <h6 class="invoice-subtotal-value subtotal">$0,00</h6>
                                            </li>
                                            <li class="display-flex justify-content-between">
                                                <span class="invoice-subtotal-title"> iva (19%):</span>
                                                <h6 class="invoice-subtotal-value iva">$0,00</h6>
                                            </li>
                                            <li class="display-flex justify-content-between">
                                                <span class="invoice-subtotal-title"> Total</span>
                                                <h6 class="invoice-subtotal-value precioTotal">$0,00</h6>
                                            </li>
                                            <li class="divider mt-2 mb-2"></li>

                                            <li class="mt-5">
                                                <a class="btn disabled btn-block waves-effect waves-light btn pagar " href="#editarProductos">Pagar</a>


                                            </li>

                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>
@section('scripts')
<script src="{{asset('js/sweetAlert/sweetalert2.min.js')}}"></script>
<script src="{{asset('js/mask/mask.min.js')}}"></script>
<script src="{{asset('js/autocomplete/jquery-ui.min.js')}}"></script>

<script>
    $(document).ready(function() {
        $('.autocomplete').autocomplete({
            source: function(request, response) {
                $.ajax({
                    url: '/productos/buscar',
                    type: 'get',
                    dataType: "json",
                    data: {

                        like: request.term
                    },
                    success: function(data) {
                        response($.map(data, function(item) {
                            return {
                                label: item.nombre,
                                value: item.codigo
                            };
                        }))

                    },

                    limit: 20, // The max amount of results that can be shown at once. Default: Infinity.


                    minLength: 4, // The minimum length of the input for the autocomplete to start. Default: 1.

                })
            }
        });
    });



    function metodoPago(params) {
        if ($(params).is(':checked')) {
            $('.debito').removeClass('ocultar');
            $('.efectivo').addClass('ocultar');
            $('.boleta').focus().val('');
            $('.vuelto').text('$0,00');



        } else {

            var suma = 0;
            $(".trow").not('.hide').find('td.precio').each(function() {
                precio = $(this).text().replace(".", "").replace(",00", "").replace("$", "");
                suma += parseFloat(precio);
            });
            $('.totalPagar').empty().append(number_format(suma, 2, ',', '.'));
            $('.debito').addClass('ocultar');
            $('.efectivo').removeClass('ocultar');
            $('.cant_efectivo').focus().val('');
            $('.vuelto').text('$0,00');



        }
    }

    function calcularVuelto(params) {

        var cant_efectivo = $(params).val();
        var suma = 0;
        $(".trow").not('.hide').find('td.precio').each(function() {
            precio = $(this).text().replace(".", "").replace(",00", "").replace("$", "");
            suma += parseFloat(precio);
        });
        cant_efectivo = cant_efectivo.replace(".", "");
        var vuelto = (parseFloat(cant_efectivo) - suma);
        $('.totalPagar').empty().append(number_format(suma, 2, ',', '.'));
        $('.vuelto').empty().append(number_format(vuelto, 2, ',', '.'));



    }


    function suma() {
        var suma = 0;
        $(".trow").not('.hide').find('td.precio').each(function() {
            precio = $(this).text().replace(".", "").replace(",00", "").replace("$", "");
            suma += parseFloat(precio);

        });
        var tasa = 19;
        var total = (suma * tasa) / 100;

        var valorProducto = (suma - total);

        // alert(suma);

        $('.subtotal').empty().append(number_format(valorProducto, 2, ',', '.'));
        $('.iva').empty().append(number_format(total, 2, ',', '.'));
        $('.precioTotal, .totalPagar, .total').empty().append(number_format(suma, 2, ',', '.'));
        // calcularVuelto($('.efectivo').find('input'));
    }


    function precio_cantidad(cant_prod, precio, unid_medida, precio_promo, promo) {


        $('.cant_efectivo').focus().val('');
        $('.vuelto').text('$0,00');
        var columna = $(cant_prod).attr('id');
        var cantidad = $(cant_prod).val();

        // prod_promo(columna);

        if (unid_medida ==
            '2') { // SI LA UNIDAD DE MEDIDA ES IGUAL A KGS SE CALCULA EL PRECIO DE ACUERDO A LOS GRAMOS INGRESADOS

            var kg = 1000;
            var valor = (cantidad * precio) / kg;
            $(".productos" + columna).find('td.precio_' + columna).empty().append(number_format(valor, 2, ',', '.'));

        } else {
            var prodPromo = $(".productos" + columna).find('td.green-text').length;
            if (prodPromo > 0 && promo <= cantidad) {
                var valor = (precio_promo * cantidad);

                $(".productos" + columna).find('td.valorProducto_' + columna).empty().append(number_format(precio_promo,
                    2, ',',
                    '.'));

            } else {

                var valor = (precio * cantidad);
                $(".productos" + columna).find('td.valorProducto_' + columna).empty().append(number_format(precio, 2,
                    ',', '.'));

            }
            // $('.cant_efectivo').focus().val('');
            // $('.vuelto').text('$0,00');
            // // var columna = $(cant_prod).attr('id');
            // // var cantidad = $(cant_prod).val();

            $(".productos" + columna).find('td.precio_' + columna).empty().append(number_format(valor, 2, ',', '.'));

        }

        suma();




    }

    function addNewRow(response) {
        var template = $("tr.trow:first");
        var count = $(".codigo").length;
        // alert(count);
        var newRow = template.clone();
        var lastRow = $("tr.trow:first").removeClass('hide productos' + (count - 1) + '').attr('id', 'productos' +
            count).addClass('productos' + count + '').after(newRow);
        var lastRow = $("tr.trow:last").removeClass().addClass('trow hide');


        $(".productos" + count).find('td.codigo').empty().append(response[0]["codigo"]);
        $(".productos" + count).find('td.valorProducto').removeClass('valorProducto_' + (count - 1) + '').addClass(
                'valorProducto_' + count + '')
            .empty().append(number_format(
                response[0]["precio"]["precio"], 2, ',', '.'));
        if ((response[0]["promo"])) {
            $(".productos" + count).find('td.producto').empty().addClass('green-text').append(
                '<span class=" tooltipped" data-position="top" data-tooltip="' + response[0]["promo"] + ' x ' +
                response[0]["precio"]["precio_promo"] + '">' + response[0]["nombre"] + '</span>');

        } else {
            $(".productos" + count).find('td.producto').empty().removeClass('green-text').append(response[0]["nombre"] +
                ' (' +
                response[0]["unidad_medida"]["simbolo"] + ')');
        }
        $(".productos" + count).find('td.cantidad').removeClass('cantidad_' + (count - 1) + '').addClass('cantidad_' +
            count + '').empty().append(
            ' <input style="text-align:right" id="' + count +
            '" type = "number" min="1" value="1" name = "cant_prod" class = "col s3 validate ' + response[0][
                "promo"
            ] + ' cant_prod" onchange= "precio_cantidad(this,' +
            response[0]["precio"]["precio"] + ',' + response[0]["unidad_medida"]["id"] + ',' + response[0]["precio"]
            ["precio_promo"] + ',' + response[0]["promo"] + ')" >');

        $(".productos" + count).find('td.precio').removeClass('precio_' + (count - 1) + '').addClass('precio_' + count +
            '').empty().append(number_format(
            response[0][
                "precio"
            ]["precio"], 2, ',', '.'));

        var template2 = $(".hide").find('input#codigo').clone();
        $(".productos" + count).find('td.codigo').append(template2);

        $(".productos" + count).find('#codigo').val(response[0]["codigo"]);


        $('.tooltipped').tooltip();

        suma();


        $(".list_cancel").on("click", function(event) {
            event.stopPropagation();
            event.stopImmediatePropagation();
            $(this).closest("tr").remove();

            $('tbody tr').each((tr_idx, tr) => {

                var id = $(tr).attr('id');

                $(tr).removeClass(id);


                $(tr).addClass('productos' + tr_idx);
                $(tr).find('input.cant_prod').attr('id', tr_idx);

                $(tr).children('td').each((td_idx, td) => {
                    var id = $(tr).attr('id');

                    // $(td).removeClass(id).addClass(tr_idx);
                    $(td).find('.cantidad').removeClass('cantidad');
                    $(td).find('.precio').addClass('productos' + tr_idx);


                });
            });
            suma();

        });


    }
    $(".buscarProducto").keyup(function(e) {
        $('.prodNoEncontrado').parent().addClass('hide');
        var codigo = $(this).val();
        var code = e.key; // recommended to use e.key, it's normalized across devices and languages
        if (code === "Enter") e.preventDefault();
        if (code === " " || code === "Enter" || code === "," || code === ";") {




            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            //we will send data and recive data fom our AjaxController
            $.ajax({
                url: '/productos/buscar',
                data: {
                    'codigo': codigo
                },
                type: 'get',
                success: function(response) {


                    if (response.length >= 1) {
                        

                        addNewRow(response);
                        $('.buscarProducto').val('');
                        $('.pagar').removeClass('disabled');
                    }
                    else{
                        $('.buscarProducto').val('');

                         $('.prodNoEncontrado').parent().removeClass('hide');
                         $('.prodNoEncontrado').html('<p>Producto no encontrado</p>');
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

        } // cierre de la condicion que espera presionar la tecla enter

    });





    $(".pagar").click(function(e) {

        const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                confirmButton: 'waves-effect waves-light  btn gradient-45deg-green-teal box-shadow-none border-round  mb-2',
                cancelButton: 'waves-effect waves-light  btn gradient-45deg-red-pink box-shadow-none border-round  mb-2'
            },
            buttonsStyling: false
        })

        swalWithBootstrapButtons.fire({
            title: 'registrar venta',
            text: "",
            icon: 'info',
            showCancelButton: true,
            confirmButtonText: 'Si, registrar la venta',
            cancelButtonText: 'No, Cancelar',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                pagar();
                metodoPago();
            } else if (
                /* Read more about handling dismissals below */
                result.dismiss === Swal.DismissReason.cancel
            ) {

                swalWithBootstrapButtons.fire(
                    'Cancelada',
                    'No se registró la venta, ha sido cancelada',
                    'error'
                )
              
            }
        })


    });

    function pagar() {
        // $(".trow").not('.hide').find('td.precio').each(function() {
        var codigo = $(".trow").not('.hide').find("input[id='codigo']")
            .map(function() {
                return $(this).val();
            }).get();

        var cantidad = $(".cant_prod")
            .map(function() {
                return $(this).val();
            }).get();

        var precioTotal = $('.precioTotal').text();
        var cant_efectivo = $('.cant_efectivo').val();
        var vuelto = $('.vuelto').text();
        var nroBoleta = $('.boleta').val();

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        //we will send data and recive data fom our AjaxController
        $.ajax({
            url: '/ventas/registrar',
            data: {
                'codigo': codigo,
                'cantidad': cantidad,
                'precioTotal': precioTotal,
                'cant_efectivo': cant_efectivo,
                'vuelto': vuelto,
                'nroBoleta': nroBoleta,
            },
            type: 'post',
            success: function(response) {
                window.location.replace("/");


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
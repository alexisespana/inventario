<div class="container">
    <!-- app invoice View Page -->
    <section class="invoice-view-wrapper section">
        <div class="row">
            <!-- invoice view page -->
            <div class="col s12">
                <div class="card">
                    <div class="card-content invoice-print-area">
                        <!-- header section -->
                        <div class="row invoice-date-number">
                            <div class="col xl4 s12">
                                <span class="invoice-number mr-1">Nro. Operación:</span>
                                <span class="black-text"><b>{!!$opciones[0]->cod_operacion !!}</b></span>
                            </div>
                            <div class="col xl8 s12">
                                <div class="invoice-date display-flex align-items-center flex-wrap">
                                    <div class="mr-3">
                                        <small>Date Issue:</small>
                                        <span class="black-text"><b>{!!$opciones[0]->created_at !!}</b></span>
                                    </div>
                                    <div>
                                        <small>Date Due:</small>
                                        <span class="black-text"><b><td>{!! Str::fecha($opciones[0]->created_at) !!}</td></b></span>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="divider mb-3 mt-3"></div>
                        <!-- product details table-->
                        <div class="invoice-product-details">
                            <table class="striped responsive-table">
                                <thead>
                                    <tr>
                                        <th>Productos</th>
                                        <th>Cant. Prod</th>
                                        <th>Categoría</th>
                                        <th class="right-align">precio unit.</th>
                                        <th class="right-align">precio prods</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($opciones as $key => $prod)
                                        @foreach ($opciones[0]->productos as $keys => $item)
                                            <tr>
                                                {{-- <td>{!! $item->codigo !!}</td> --}}
                                                <td>{!! $item->nombre !!}</td>
                                                <td>{!! json_decode($prod->cant_prods)[$keys] !!}</td>
                                                <td>{!! $item->categoria->nombre !!}</td>
                                                <td class="indigo-text right-align">{!! Str::miles($item->precio->precio) !!}</td>
                                                <td class="indigo-text right-align">{!! Str::miles(json_decode($prod->cant_prods)[$keys]*$item->precio->precio) !!}</td>


                                            </tr>
                                        @endforeach
                                    @endforeach

                                </tbody>
                            </table>
                        </div>
                        <!-- invoice subtotal -->
                        <div class="divider mt-3 mb-3"></div>
                        <div class="invoice-subtotal">
                            <div class="row">
                                <div class="col m5 s12">
                                    <ul>
                                        <li class="display-flex justify-content-between">
                                            <span class="invoice-subtotal-title">Medio de Pago</span>
                                            <h6 class="invoice-subtotal-value">{!!$opciones[0]->medio_pago == 1 ? 'efectivo' : 'debito' !!}<i
                                                    class="material-icons  green-text tiny icon-demo">{!!$opciones[0]->medio_pago == 1 ? 'attach_money' : 'credit_card' !!}</i>
                                            </h6>
                                        </li>
                                       
                                        <li class="display-flex justify-content-between">
                                            <span class="invoice-subtotal-title">Metodo de Pago</span>
                                            <h6 class="invoice-subtotal-value">{!!$opciones[0]->pagado !!}</h6>
                                        </li>
                                        <li class="display-flex justify-content-between">
                                            <span class="invoice-subtotal-title">Metodo de Pago</span>
                                            <h6 class="invoice-subtotal-value">{!!$opciones[0]->cambio !!}</h6>
                                        </li>



                                    </ul>
                                </div>
                                <div class="col xl4 m7 s12 offset-xl3">
                                    <ul>
                                        <li class="display-flex justify-content-between">
                                            <span class="invoice-subtotal-title">Total</span>
                                            <h4 class="invoice-subtotal-value">{!!$opciones[0]->valor_compra !!}</h4>
                                        </li>


                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section><!-- START RIGHT SIDEBAR NAV -->

</div>

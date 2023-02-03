<div class="modal-content">
        <div id="basic-form" class="card card card-default scrollspy pb-5">
            <div class="card-content">
                <h4 class="card-title">Basic Form</h4>
                @csrf
                <div class="row">
                    <div class="input-field col s3 push-s4 file-path-wrapper">
                        <input id="id_prod" type="hidden" name="id" value="{!! $editarProductos[0]->id !!}">

                        <input id="icon_prefix" type="text" disabled name="codigo" value="{!! $editarProductos[0]->codigo !!}"
                            class="validate">
                        <label class="active" for="icon_prefix">codigo</label>
                    </div>
                </div>
                <div class="row">


                    <div class="input-field col s6">
                        <i class="material-icons prefix">phone</i>
                        <input id="nombre" type="text" name="nombre" value="{!! $editarProductos[0]->nombre !!}"
                            class="validate">
                        <label class="active" for="nombre">nombre</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s6">
                        <i class="material-icons prefix">account_circle</i>
                        <input id="cantidad" type="text" name="cantidad" value="{!! $editarProductos[0]->stock->cantidad !!}"
                            class="validate">
                        <label class="active" for="cantidad">cantidad</label>
                    </div>

                    <div class="input-field col s6">
                        <i class="material-icons prefix">account_circle</i>
                        <input id="precio" type="number" name="precio" value="{!! $editarProductos[0]->precio->precio !!}"
                            class="validate">
                        <label class="active" for="precio">precio</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s6">
                        <i class="material-icons prefix">account_circle</i>
                        <input id="fecha_ingreso" type="text" class="date" name="fecha_ingreso" value="{!! $editarProductos[0]->stock->fecha_ingreso !!}"
                            class="validate">
                        <label class="active" for="fecha_ingreso">Fecha Ingreso</label>
                    </div>
                    <div class="input-field col s6">
                        <i class="material-icons prefix">account_circle</i>
                        <input id="fecha_venc" type="text" class="date" name="fecha_venc" value="{!! isset( $editarProductos[0]->stock->fecha_venc ) ?  $editarProductos[0]->stock->fecha_venc : '00/00/00'!!}"
                            class="validate">
                        <label class="active" for="fecha_venc">Fecha Vencimiento</label>
                    </div>
                </div>
                <div class="row">
                    <button class="btn cyan waves-effect waves-light right modificar_prod" type="button" name="action">Guardar
                        <i class="material-icons right">send</i>
                    </button>
                </div>
            </div>
        </div>
</div>
<div class="modal-footer">
    <a href="#!" class="modal-action modal-close waves-effect waves-red btn-flat ">Cerrar</a>

</div>
<script>
    $(document).ready(function() {
      
$('.date').mask('00/00/0000', {
        min: new Date(1990, 0, 1),
        max: new Date(2020, 0, 1),
    });
    });
</script>
    
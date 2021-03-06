<div class="modal-content">
    <form class="col s12" method="POST" action="/productos/Editar">
        <div id="basic-form" class="card card card-default scrollspy pb-5">
            <div class="card-content">
                <h4 class="card-title">Basic Form</h4>
                @csrf
                <div class="row">
                    <div class="input-field col s3 push-s4 file-path-wrapper">
                        <input id="icon_prefix" type="hidden" name="id" value="{!! $editarProductos[0]->id !!}">

                        <input id="icon_prefix" type="text" disabled name="codigo" value="{!! $editarProductos[0]->codigo !!}"
                            class="validate">
                        <label class="active" for="icon_prefix">codigo</label>
                    </div>
                </div>
                <div class="row">


                    <div class="input-field col s6">
                        <i class="material-icons prefix">phone</i>
                        <input id="icon_telephone" type="text" name="nombre" value="{!! $editarProductos[0]->nombre !!}"
                            class="validate">
                        <label class="active" for="icon_telephone">nombre</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s6">
                        <i class="material-icons prefix">account_circle</i>
                        <input id="icon_prefix" type="text" name="cantidad" value="{!! $editarProductos[0]->stock->cantidad !!}"
                            class="validate">
                        <label class="active" for="icon_prefix">cantidad</label>
                    </div>

                    <div class="input-field col s6">
                        <i class="material-icons prefix">account_circle</i>
                        <input id="icon_telephone" type="number" name="precio" value="{!! $editarProductos[0]->precio->precio !!}"
                            class="validate">
                        <label class="active" for="icon_telephone">precio</label>
                    </div>
                </div>
                <div class="row">
                    <button class="btn cyan waves-effect waves-light right" type="submit" name="action">Guardar
                        <i class="material-icons right">send</i>
                    </button>
                </div>
            </div>
        </div>
    </form>
</div>
<div class="modal-footer">
    <a href="#!" class="modal-action modal-close waves-effect waves-red btn-flat ">Cerrar</a>

</div>

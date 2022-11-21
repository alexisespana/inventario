<?php

namespace App\Providers\Ventas;

use App\Traits\Productos\ListarProductosTraits;
use Illuminate\Support\ServiceProvider;

class VentasServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    use ListarProductosTraits;
    public function __construct()
    {
        $this->baseUrl = env('MS_INVENTARIO');
    }


    public function listarVentas($idproducto)
    {
        $response = $this->envioParametros('GET', "Ventas/listar", $idproducto);
          //dd($response, 'estoy en ventas');

        return $response;
    }

    public function registrarVenta($venta)
    {
        $response = $this->envioParametros('POST', "Ventas/registrar", $venta);

        // dd($response, 'estoy en ventas');
        return $response;
    }

    public function DetallesVentas($venta)
    {
        $response = $this->envioParametros('GET', "Ventas/detalles", $venta);

        //  dd($response, 'estoy en detalles ventas');
        return $response;
    }


    public function envioParametros($method, $url, $data)
    {

        // dd($method);

        $response = json_decode($this->comunicServiceTraits($method, $url, $data));

        return $response;
    }
}

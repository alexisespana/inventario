<?php

namespace App\Providers\Productos;

use App\Traits\Productos\ListarProductosTraits;
use Illuminate\Support\ServiceProvider;

class ProductosServiceProvider extends ServiceProvider
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


    public function listarProductos($idproducto)
    {
        $response = $this->initialice('POST', "Productos/lista", $idproducto);
        return $response;
    }
    public function ingresarProductos($productos)
    {
        $response = $this->initialice('POST', "Productos/ingresarProductos", $productos);
         return $response;
    }

    public function registrarProductos($productos)
    {
        $response = $this->initialice('POST', "Productos/registrar", $productos);
         return $response;
    }

    public function editarProductos($idproducto)
    {
        $response = $this->initialice('POST', "Productos/editar", $idproducto);
        return $response;
    }
    public function productosVencidos($productos)
    {

        $response = $this->initialice('POST', "Productos/productosVencidos", $productos);
         return $response;
    }

    
    private function initialice($method, $url, $data)
    {

        // dd($method);

        $response = json_decode($this->comunicServiceTraits($method, $url, $data));
        
        return $response;
    }
}

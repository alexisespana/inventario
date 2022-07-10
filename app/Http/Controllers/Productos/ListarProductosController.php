<?php

namespace App\Http\Controllers\Productos;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;
use App\Providers\Productos\ProductosServiceProvider;

class ListarProductosController extends Controller
{
    public function __construct(
        ProductosServiceProvider $listaProductos

    ) {
        $this->ProductosServiceProvider = $listaProductos;
    }


    public function Inicio(Request $request)
    {
        return view('Ventas.IngresarVentas');
    }

    public function listarProductos()
    {

        $opciones = $this->ProductosServiceProvider->listarProductos(null);
            // dd($opciones[0]);

        return view('Productos.productos', compact('opciones'));
    }

    

    public function buscarProductos(Request $request )
    {

        $opciones = $this->ProductosServiceProvider->listarProductos($request->all());
           return($opciones);

        // return view('Productos.productos', compact('opciones'));
    }

    public function ingresarProductos(Request $request)
    {
        // dd($request->all());

        if ($request->isMethod('post')) {
            
            $registroPorductos = $this->ProductosServiceProvider->registrarProductos($request->all());

            // dd($registroPorductos);
            return redirect('productos/Ingresar')->with('mensaje', 'producto actualizado');
        }


        $productos = $this->ProductosServiceProvider->ingresarProductos($request->all());
            // dd($productos);


        return view('Productos.ingresarProductos',compact('productos'));
    }

    public function registrarProductos(Request $request)
    {
    }




    public function editarProductos(Request $request)
    {

        if ($request->isMethod('post')) {
            $editarProductos = $this->ProductosServiceProvider->editarProductos($request->all());

            // dd($editarProductos);

            return redirect('productos/lista')->with('mensaje', 'producto actualizado');
        }

        $editarProductos = $this->ProductosServiceProvider->listarProductos($request->all());

            // dd($editarProductos);

        return view('Productos/'.$request->vista, compact('editarProductos'));
    }
}

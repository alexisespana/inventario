<?php

namespace App\Http\Controllers\Productos;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;
use App\Providers\Productos\ProductosServiceProvider;
use Yajra\DataTables\Facades\DataTables;


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



    public function buscarProductos(Request $request)
    {

        $opciones = $this->ProductosServiceProvider->listarProductos($request->all());
        return ($opciones);

        // return view('Productos.productos', compact('opciones'));
    }

    public function ingresarProductos(Request $request)
    {
        // dd($request->all());

        if ($request->isMethod('post')) {

            $prod_vencidos = $this->ProductosServiceProvider->registrarProductos($request->all());

            // dd($prod_vencidos);
            return redirect('productos/Ingresar')->with('mensaje', 'producto actualizado');
        }


        $productos = $this->ProductosServiceProvider->ingresarProductos($request->all());
        // dd($productos);


        return view('Productos.ingresarProductos', compact('productos'));
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

        return view('Productos/' . $request->vista, compact('editarProductos'));
    }

    public function productosVencidos(Request $request)
    {


        if ($request->isMethod('post')) {
            $prod_vencidos = $this->ProductosServiceProvider->productosVencidos('');
              //dd($prod_vencidos[400]);
            $data = collect($prod_vencidos)->map(function ($prodVencidos, $index) {

                // if (isset($prodVencidos->beneficio)) {

                // if(isset($prodVencidos->beca_deportiva)){
                return
                    [
                        'index' => $index,
                        'id_prod' => $prodVencidos->id,
                        'productos' => $prodVencidos->nombre,
                        'cantidad' => isset($prodVencidos->stock->cantidad) ? $prodVencidos->stock->cantidad :0,
                        'precio_venta' => isset($prodVencidos->precio->precio) ? $prodVencidos->precio->precio :0,
                        'precio_compra' =>  isset($prodVencidos->stock->precio_compra->precio) ? $prodVencidos->stock->precio_compra->precio :0,
                        'fecha_ingreso' =>  isset($prodVencidos->stock->fecha_ingreso) ? $prodVencidos->stock->fecha_ingreso :0,
                        'fecha_venc' =>  isset($prodVencidos->stock->fecha_venc) ? $prodVencidos->stock->fecha_venc :0,
                        'total_precio' =>  isset($prodVencidos->stock->fecha_venc) ? $prodVencidos->stock->fecha_venc :0,
                    ];
                // }
                // }
            });
            //    dd($data);




            return DataTables::of($data)
                ->addIndexColumn()

                ->addColumn('total', function ($data) 
                {
                      if ($data )
                    {
                        $btn = ($data['precio_compra']*$data['cantidad']);
                    }

                    return $btn;
                })
                ->make(true);

            // return $prod_vencidos;
        } else {
            return view('Productos.productosVencidos');
        }
    }
}

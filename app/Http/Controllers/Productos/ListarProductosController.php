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
            //  dd($prod_vencidos[1]);
            $data = collect($prod_vencidos)->map(function ($prodVencidos, $index) {

                // if (isset($prodVencidos->beneficio)) {

                // if(isset($prodVencidos->beca_deportiva)){
                return
                    [
                        'index' => $index,
                        'id_prod' => $prodVencidos->id,
                        'productos' => $prodVencidos->nombre,
                        'cantidad' => $prodVencidos->cantidad,
                        'precio_venta' => $prodVencidos->porecio_venta,
                        'precio_compra' => $prodVencidos->precio_compra,
                        'fecha_ingreso' =>  $prodVencidos->fecha_ingreso,
                        'fecha_venc' =>  $prodVencidos->fecha_venc

                    ];
                // }
                // }
            });
            //    dd($data);




            return DataTables::of($data)
                ->addIndexColumn()

                // ->with('count', function () use ($TotalBecassAntiguos) {
                //     return ($TotalBecassAntiguos);
                // })
                // ->addColumn('view', function ($data) {
                //     $btn = '<button type="button" class="view btn btn-light" data-idcpbt="' . $data->nombre_corto_carrera . '"><i class="c-icon cil-touch-app"></i></button>';
                //     return $btn;
                // })
                // ->rawColumns(['view'])
                ->make(true);

            // return $prod_vencidos;
        } else {
            return view('Productos.productosVencidos');
        }
    }
}

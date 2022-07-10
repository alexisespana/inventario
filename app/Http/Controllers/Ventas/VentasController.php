<?php

namespace App\Http\Controllers\Ventas;

use App\Http\Controllers\Controller;
use App\Providers\Ventas\VentasServiceProvider;
use Illuminate\Http\Request;

class VentasController extends Controller
{
    public function __construct(
        VentasServiceProvider $ventas

    ) {
        $this->VentasServiceProvider = $ventas;
    }

    public function registrarVentas(Request $request)
    {

        //   dd($request->all());
        // $codigo = $request['codigo'];
       

        $opciones = $this->VentasServiceProvider->registrarVenta($request->all());
        return $opciones;
    }
    public function listarVentas(Request $request)
    {
        // dd($request->all());

        $opciones = $this->VentasServiceProvider->listarVentas(null);

        // dd($opciones);
        return view('Ventas.ventas', compact('opciones'));
    }
    public function DetallesVentas(Request $request)
    {
        //  dd($request->all());

        $opciones = $this->VentasServiceProvider->DetallesVentas($request->all());

        //  dd($opciones);
        return view('Ventas.DetallesVentas', compact('opciones'));
    }
}

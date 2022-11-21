<?php

namespace App\Http\Controllers\Ventas;

use App\Http\Controllers\Controller;
use App\Providers\Ventas\VentasServiceProvider;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use stdClass;

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

        if ($request->fecha1) {

            $fecha_hoy = date_create($request->fecha1);
            $fecha_hoy = date_format($fecha_hoy, 'Y-m-d');
            $fecha_mañana = date_create($request->fecha2);
            $fecha_mañana = date_format($fecha_mañana, 'Y-m-d');
            //dd($fecha_hoy,'hay rango de fechas');

        } else {
            $fecha_hoy = '';
            $fecha_mañana = '';

            //dd($fecha_hoy, 'aqui');
        }

        $opciones = $this->VentasServiceProvider->listarVentas(['fecha_hoy' => $fecha_hoy, 'fecha_mañana' => $fecha_mañana]);
        //dd($opciones);

        $total_ventas = 0;
        $debito = 0;
        $efectivo = 0;
        $prodVendido = [];
        if ($request->fecha1) {
            foreach ($opciones as $key => $value) {
                //   dd($value->valor_compra);
                if ($value->medio_pago == 1) {
                    $efectivo += str_replace(['$', '.', ','], ['', '', ''], substr($value->valor_compra, 0, -3));
                }

                if ($value->medio_pago == 2) {
                    $debito += str_replace(['$', '.', ',00'], ['', '', ''], substr($value->valor_compra, 0, -3));
                }
                $total_ventas += str_replace(['$', '.', ',00'], ['', '', ''], substr($value->valor_compra, 0, -3));

                foreach ($value->productos as $key => $item) {
                 
                        array_push($prodVendido, $item->codigo);
                   
                }
            }

          // dd( array_count_values($prodVendido),$opciones);


        }

        $resumenVentas = new stdClass();
        $resumenVentas->efectivo = number_format($efectivo, 0, ",", ".");
        $resumenVentas->debito = number_format($debito, 0, ",", ".");
        $resumenVentas->total_ventas = number_format($total_ventas, 0, ",", ".");


        //dd($resumenVentas);
        return view('Ventas.ventas', compact('opciones', 'resumenVentas', 'fecha_hoy', 'fecha_mañana'));
    }
    public function DetallesVentas(Request $request)
    {
        //  dd($request->all());

        $opciones = $this->VentasServiceProvider->DetallesVentas($request->all());

        //  dd($opciones);
        return view('Ventas.DetallesVentas', compact('opciones'));
    }
}

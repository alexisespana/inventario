<?php

use App\Http\Controllers\Productos\ListarProductosController;
use App\Http\Controllers\Ventas\VentasController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [ListarProductosController::class, 'Inicio'])->name('ingresar-ventas');


Route::prefix('productos')->group(function () {
    Route::get('/Ingresar', [ListarProductosController::class, 'ingresarProductos'])->name('ingresar-productos');
    Route::post('/Ingresar', [ListarProductosController::class, 'ingresarProductos'])->name('registrar-productos');
    Route::get('/lista', [ListarProductosController::class, 'listarProductos'])->name('lista-productos');
    Route::get('/editar', [ListarProductosController::class, 'editarProductos'])->name('editar-productos');
    Route::post('/Editar', [ListarProductosController::class, 'editarProductos'])->name('editar-productos');
    Route::get('/buscar', [ListarProductosController::class, 'buscarProductos'])->name('buscar-productos');
    Route::get('/detallesProductos', [ListarProductosController::class, 'editarProductos'])->name('detalles-productos');


    // Route::get('/lista', 'Productos\ListarProductosController@listarProductos')
});
Route::prefix('ventas')->group(function () {
    Route::any('/listar', [VentasController::class, 'listarVentas'])->name('lista-ventas');
    Route::post('/registrar', [VentasController::class, 'registrarVentas'])->name('registrar-venta');
    Route::get('/detalles', [VentasController::class, 'DetallesVentas'])->name('detalles-venta');
    Route::any('/resumen', [VentasController::class, 'ResumenVentas'])->name('resumen-ventas');

});

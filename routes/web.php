<?php
use App\Http\Controllers\Dashboard\PostController;
//use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/test1', function () {
    Echo "estoy en test";
});
Route::get('/contacto', function () {
    return view('contacto');
});
Route::get('/bio', function () {
    $msj2 = "Msj desde el servidor *-*";
    $data = ['msj2' => $msj2, "age" =>15, "name" => "pepe"];
    return view('bio', $data);
})->name ('bio');

Route::get('/producto', function () {
    //return redirect('/contacto');
    return to_route('bio');
});
route::get('/panel', function () {
    return view ('panel.panel1');
    });
route::get('/detalle', function () {
    return view ('detalle');
    });

Route::resource('post', PostController::class);

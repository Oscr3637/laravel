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

//Route::resource('post', PostController::class);

Route::group(['prefix' => 'dashboard'], function () {
    Route::resource('post', PostController::class);
    //Route::resource('category', CategoryController::class);
});
Route::middleware([App\Http\Middleware\TestMiddleware::class])->group(function () {
    Route::get('/test/{id}', function (int $id) {
        echo $id;
    });
});

Route::group(['prefix' => 'dashboard', 'middleware' => ['auth',App\Http\Middleware\UserIsAdminMiddleware::class]], function () {
    Route::get('/', function () {
        return view('dashboard.dashboard');
            })->name("dashboard");

    Route::resources([
        'post' => App\Http\Controllers\Dashboard\PostController::class,
        //'category' => App\Http\Controllers\Dashboard\CategoryController::class,
    ]);
});
    Route::get('/db', function () {
/*
$post = Post::join('categories', 'categories.id', '=', 'posts.category_id')->select('posts.*', 'categories.title as category')->orderBy('posts.created_at', 'desc')->toSql();
 echo $post;
*/
$ver = Post::limit(3)->toSql();
 echo $ver;

});

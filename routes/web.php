<?php
use App\Http\Controllers\Dashboard\PostController;
//use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;
use App\Models\User;
use App\Models\Category;
use App\Models\Profile;
use App\Http\Controllers\User\ProfileController;
use App\Models\Post;

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

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
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

Route::get('/perfil', function () {
    $profile = Profile::find(1);
    $user = $profile->user;
    dd($user->email);
});
Route::get('/relacion', function () {
    $category = Category::find(4);
    $posts = $category->posts;
    //dd($posts);
    foreach($posts as $post){
        echo $post->title. "<br>";
    }
});
Route::get('/muchos', function () {
   $post = Post::find(1);
   $tags = $post->tags;
   //dd($tags);
   foreach($tags as $tag){
      echo $tag->name. " <br>";
   }

   $tagClass = 'App\\Models\\Tag';
   if (class_exists($tagClass)) {
       $tag = $tagClass::find(1);
       if ($tag) {
           $posts = $tag->posts;
           foreach($posts as $post){
               echo $post->id. " <br>";
           }

           $post->tags()->attach($tag);
       }
   }
});
/*
    Route::get('/db', function () {

$post = Post::join('categories', 'categories.id', '=', 'posts.category_id')->select('posts.*', 'categories.title as category')->orderBy('posts.created_at', 'desc')->toSql();
 echo $post;

//$ver = Post::limit(3)->toSql();
 //echo $ver;

});

$posts7 = Post::where('id','>=', 1)->get();

foreach($posts7 as $post7){
  echo "Titulo: ". $post7->title . "<br>";
  echo "Slug: ". $post7->slug . "<br>";
  echo "Content: ". $post7->content . "<br>";
  echo "*************";
  }
// dd($posts7);

$post8 = Post::where('id','>=', 1)->pluck('title', 'id');

dd($post8);
});
*/
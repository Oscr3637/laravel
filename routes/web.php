<?php
use App\Http\Controllers\Dashboard\PostController;
//use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;
use App\Models\User;
use App\Models\Category;
use App\Models\Profile;
use App\Http\Controllers\User\ProfileController;
use App\Models\Post;
use App\Models\Tag;
use App\Models\Product;
use App\Http\Controllers\Blog\BlogController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\UserController;

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
Route::group(['prefix' => 'blog'], function () {
    Route::controller(BlogController::class)->group(function () {
       Route::get('', [BlogController::class, 'index'])->name('blog.index');
       Route::get('detail/{post}', [BlogController::class, 'show'])->name('blog.show');
     });
    });

Route::get("/poli", function(){
       $user = User::find(1);
       //$user->image()->create(['url'=> 'avatars/user1.jpg']);
       $product = Product::find(1);
       //$product->image()->create(['url' => 'avatars/producto1.jpg']);

       $imageUrl = $user->image->url;
       //dd($imageUrl);
       $imageUrl = $user->image->imageable_type;
       //dd($imageUrl);
       $imageUrl_pro = $product->image->url;
       dd($imageUrl_pro);
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
   $post = Post::find(5);
   $tag1 = Tag::find(1);
   $tag2 = Tag::find(2);
   $tag3 = Tag::find(3);
    //$post->tags()->attach([$tag1->id, $tag2->id, $tag3->id]);
    //$post->tags()->detach([$tag1->id, $tag2->id, $tag3->id]);

    //$post->tags()->sync([$tag1->id, $tag2->id, $tag3->id]);
    $post->tags()->sync([1,2,3,4]);

});
Route::get('/curso', [CourseController::class, 'index']);
Route::post('user/login', 'App\Http\Controllers\UserController@login');
npm instal
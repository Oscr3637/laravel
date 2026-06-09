<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Post\StoreRequest;
use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Requests\Post\PutRequest;
use App\Models\Category;
use Illuminate\View\View;
use Illuminate\Support\Facades\Gate;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        /* 
        return Post::create(
            ['title' => "test",
             'slug' => "test",
             'content' => "test",
             'item' => "item 1",
             'category_id' => 1,
             'description' => "test",
             'posted' => "not",
             'image' => "test"]
        );
*/
        /*$post = Post::find(3);
        //dd($post);
        return $post->update(
            [
                'title' => "test new",
                'slug' => "test",
                'content' => "test",
                'item' => "item 1",
                'category_id' => 1,
                'description' => "test",
                'posted' => "not",
                'image' => "test"
            ]
        );*/
        //$post = Post::get(); //con filtro/
        //$post = Post::all(); //  sin filtro
        //dd($post [0]);
        /*$post = Post::find(4);
         return $post ->delete();*/
        //$post = Post::find(3);
        //dd($post->category->title);
        //$categorias = Category::find(1);
        //dd($categorias->posts);
        // foreach ($categorias->posts as $po) {
        //   echo $po->title;
        //  echo "<br>";
        //}
        $posts = Post::paginate(4);

        return view('dashboard.post.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::pluck('id', 'title');
        $post = new Post();
        return view('dashboard.post.create', compact('categories', 'post'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        /*  $request->validate([
            "title" => "required|min:5|max:500",
            "slug" => "required|min:5|max:500",
            "content" => "required|min:7",
            "category_id" => "required|integer",
            "description" => "required|min:7",
            "posted" => "required"
        ]);*/
        /*$validated = Validator::make($request->all(), ["title" =>
            "required|min:5|max:500",
            "slug" => "required|min:5|max:500",
            "content" => "required|min:7",
            "category_id" => "required|integer",
            "description" => "required|min:7",
            "posted" => "required"
        ]); 
        
        //dd($validated->fails());
        dd($validated->errors());*/


        Post::create($request->validated());

        return to_route("post.index")->with('status', 'post creado correctamente');


        //dd($request->all());
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
         return view("dashboard.post.show",compact('post'));
         //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
          if (!Gate::allows('update-post', $post)) {
            return abort(403);
          }    
    //
        $categories = Category::pluck('id', 'title');
        return view('dashboard.post.edit', compact('categories', 'post'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PutRequest $request, Post $post)
    {
          if (!Gate::allows('update-post', $post)) {
            return abort(403);
          }
        $data = $request->validated();
        if (isset($data["image"])) {
            $data["image"] = time() . "." . $data["image"]->extension();
            $request->image->move(public_path("image"), $data["image"]);
        }
        session(['key-xx' => 'ENV-555']);
        $post->update($data);

        return to_route("post.index")->with('status', 'post actualizado correctamente');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        if (!Gate::allows('delete', $post)) {
            return abort(403);
        }
        //dd($post);     
        $post->delete();
        session()->forget('key-xx');
        return to_route("post.index")->with('status', 'post eleminado correctamente');
    }
}

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $categories = Category::paginate(2);
        return view('dashboard.category.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $category = new Category();
        return view('dashboard.category.create', compact('category'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        Category::create($request->validated());
        return to_route('category.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category): View
    {
        return view('dashboard.category.show', compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category): View
    {
        return view('dashboard.category.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PutRequest $request, Category $category)
    {
        $category->update($request->validated());
        return to_route('category.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $category->delete();
        return to_route('category.index');
    }
}

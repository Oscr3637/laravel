<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;
use App\Models\Category;

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
        $categorias = Category::find(1);
        //dd($categorias->posts);
        foreach($categorias->posts as $po){
            echo $po->title;
            echo "<br>";
        }
        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        //
    }
}

<?php
namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Http\Requests\Post\PutRequest;
use App\Http\Requests\Post\StoreRequest;
use App\Models\Post;
use Illuminate\Http\JsonResponse;
class PostController extends Controller
{
    public function index(): JsonResponse
    {
        return response()->json(Post::paginate(10));
    }
    public function store(StoreRequest $request): JsonResponse
    {
        return response()->json(Post::create($request->validated()));
    }
    public function show(Post $post): JsonResponse
    {
        return response()->json($post);
    }
    public function update(PutRequest $request, Post $post): JsonResponse
    {
        $post->update($request->validated());
        return response()->json($post);
    }
    public function destroy(Post $post): JsonResponse
    {
        $post->delete();
        return response()->json(['message' => 'Deleted'], 204);
    }
}

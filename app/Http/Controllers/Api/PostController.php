<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\PostRequest;
use App\Models\Post;
use Illuminate\Http\JsonResponse;

class PostController extends Controller
{
    public function __construct(
        protected readonly Post $post
    )
    {
    }

    /**
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        return $this->post->getAllPosts();
    }

    /**
     * @param PostRequest $request
     * @return JsonResponse
     */
    public function store(PostRequest $request): JsonResponse
    {
        return $this->post->addNewPost($request->validated());
    }

    /**
     * @param $id
     * @return JsonResponse
     */
    public function show($id): JsonResponse
    {
        return $this->post->getPostById($id);
    }

    /**
     * @param $id
     * @param PostRequest $request
     * @return JsonResponse
     */
    public function update($id, PostRequest $request): JsonResponse
    {
        return $this->post->updatePost($id, $request->validated());
    }

    /**
     * @param $id
     * @return JsonResponse
     */
    public function destroy($id): JsonResponse
    {
        return $this->post->deletePost($id);
    }
}

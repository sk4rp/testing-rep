<?php

namespace App\Models;

use App\Jobs\PostJob;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\JsonResponse;

/**
 * @property string $name
 * @property string $description
 * */
class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
    ];

    protected $casts = [
        'created_at' => 'timestamp',
        'updated_at' => 'timestamp',
    ];

    /**
     * @return JsonResponse
     */
    public function getAllPosts(): JsonResponse
    {
        return response()->json([
            'message' => 'Posts fetched successfully',
            'data' => self::query()->get()
        ]);
    }

    /**
     * @param array $data
     * @return JsonResponse
     */
    public function addNewPost(array $data): JsonResponse
    {
        return response()->json([
            'message' => 'Post added successfully',
            'data' => self::query()->create($data)
        ]);
    }

    /**
     * @param int $id
     * @return JsonResponse
     */
    public function getPostById(int $id): JsonResponse
    {
        return response()->json([
            'message' => 'Post fetched successfully',
            'data' => self::query()->findOrFail($id)
        ]);
    }

    /**
     * @param int $id
     * @param array $data
     * @return JsonResponse
     */
    public function updatePost(int $id, array $data): JsonResponse
    {
        self::query()->where('id', $id)->update($data);
        return response()->json([
            'message' => 'Post updated successfully'
        ]);
    }

    /**
     * @param int $id
     * @return JsonResponse
     */
    public function deletePost(int $id): JsonResponse
    {
        // TODO: пример постановки в очередь
        PostJob::dispatch($id);


        //self::query()->where('id', $id)->delete();
        return response()->json([
            'message' => 'Post deleted successfully'
        ]);
    }
}

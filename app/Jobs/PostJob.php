<?php

namespace App\Jobs;

use App\Models\Post;
use App\Services\UsefulService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class PostJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected int $postId;

    public function __construct(int $postId)
    {
        $this->postId = $postId;
    }

    public function handle(): void
    {
        Post::query()->where('id', $this->postId)->delete();
    }
}

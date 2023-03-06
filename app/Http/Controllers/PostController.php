<?php

namespace App\Http\Controllers;

use App\Http\Resources\PostCollection;
use App\Http\Resources\PostResource;
use App\Models\Post;
use App\Models\User;

class PostController extends Controller
{
    public function top()
    {
        $usersPost = User::query()
            ->with(['top', 'top.user'])
            ->get()
            ->map(function ($user) {
                return $user->top;
            })
            ->filter();

        return new PostCollection($usersPost);
    }

    public function show(Post $post)
    {
        $post->load('user');
        return new PostResource($post);
    }
}

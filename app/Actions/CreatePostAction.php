<?php

namespace App\Actions;

use App\Models\Post;

class CreatePostAction
{
    public function execute($postData): Post
    {
        $post = Post::find($postData["id"]);
        if ($post) {
            $post->fill([
                "body" => $postData["body"]
            ]);
        } else {
            $post = new Post([
                "id" => $postData["id"],
                "user_id" => $postData["userId"],
                "title" => $postData["title"],
                "body" => $postData["body"],
                "rating" => 0,
            ]);
        }
        return $post;
    }
}

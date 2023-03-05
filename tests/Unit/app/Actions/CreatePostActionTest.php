<?php

namespace Tests\Unit\app\Actions;

use App\Actions\CreatePostAction;
use App\Models\Post;
use Tests\TestCase;

class CreatePostActionTest extends TestCase
{

    public function testItCanCreateNewPosts()
    {

        $createPostAction = new CreatePostAction();
        $postData = [
            "userId" => 1,
            "id" => 2,
            "title" => "sunt aut facere repellat",
            "body" => "quia et suscipit\nsuscipit"
        ];
        $post = new Post([
            "id" => 3,
            "user_id" => $postData["userId"],
            "title" => $postData["title"],
            "body" => $postData["body"],
            "rating" => 0,
        ]);
        $post->save();

        $testResult = $createPostAction->execute($postData);
        $testResult->save();

        $this->assertEquals($post->rating, $testResult->rating);
    }

    public function testItCanUpdateExistsPosts()
    {
        $postData = [
            "userId" => 1,
            "id" => 3,
            "title" => "sunt aut facere repellat",
            "body" => "quia et suscipit\nsuscipit"
        ];
        $post = new Post([
            "id" => $postData["id"],
            "user_id" => $postData["userId"],
            "title" => $postData["title"],
            "body" => "test body",
            "rating" => 0,
        ]);
        $post->save();

        $createPostAction = new CreatePostAction();

        $testResult = $createPostAction->execute($postData);
        $testResult->save();

        $this->assertEquals($testResult->body, $postData['body']);
    }
}

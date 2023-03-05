<?php

namespace App\Console\Commands;

use App\Actions\CreatePostAction;
use App\Actions\CreateUserAction;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class GetPostCommand extends Command
{
    protected $signature = 'get:post';

    protected $description = 'Command to get first 50 post and save';

    private $createPostAction;
    private $createUserAction;

    public function __construct(CreatePostAction $createPostAction, CreateUserAction $createUserAction)
    {
        parent::__construct();
        $this->createPostAction = $createPostAction;
        $this->createUserAction = $createUserAction;
    }

    public function handle()
    {
        $this->line("Download first 50 post!");

        $response = Http::get("https://jsonplaceholder.typicode.com/posts");
        $posts = $response->collect()->take(50);

        $response = Http::get("https://jsonplaceholder.typicode.com/users");
        $users = $response->collect();

        foreach ($posts as $postData) {
            $userData = $users->firstWhere("id", $postData["userId"]);
            $this->createUserAction->execute($userData)
                ->save();

            $this->createPostAction->execute($postData)
                ->save();
        }

        $this->line("End");
    }
}

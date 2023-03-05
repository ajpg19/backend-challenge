<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserCollection;
use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        $users = User::query()
            ->with('posts')
            ->withAvg('posts', 'rating')
            ->orderByDesc('posts_avg_rating')
            ->get();

        return new UserCollection($users);
    }
}

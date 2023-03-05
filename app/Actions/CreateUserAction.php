<?php

namespace App\Actions;

use App\Models\User;

class CreateUserAction
{
    public function execute($userData): User
    {
        $user = User::find($userData["id"]);
        if (!$user)
        {
            $user = new User([
                "id" => $userData["id"],
                "name" => $userData["name"],
                "email" => $userData["email"],
                "city" => $userData["address"]["city"]
            ]);
        }
        return $user;
    }
}

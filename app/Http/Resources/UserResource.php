<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * @param Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            "id" => $this->id,
            "name" => $this->name,
            "email" => $this->when(request()->fullUrlIs('*/api/users'), $this->email),
            "city" => $this->when(request()->fullUrlIs('*/api/users'), $this->city),
            "posts" => PostResource::collection($this->whenLoaded("posts"))
        ];
    }
}

<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
{
    /**
     * @param Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            "id" => $this->id,
            "user_id" => $this->when(request()->fullUrlIs('*/api/users'), $this->user_id),
            "body" => $this->body,
            "title" => $this->title,
            "rating" => $this->when(request()->fullUrlIs('*/api/posts/top'), $this->rating),
            "user" => new UserResource($this->whenLoaded("user"))
        ];
    }
}

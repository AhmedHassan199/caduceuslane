<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class BookResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'description' => $this->description,
            'published_at' => $this->published_at,
            'bio' => $this->bio,
            'cover' => asset('storage/' . $this->cover), // Assuming cover image is stored in the 'public' disk
            'author' => new UserResource($this->whenLoaded('author')), // Include author details
        ];
    }
}

<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TaskResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'creator' => UserResource::make($this->creator),
            'assignee' => UserResource::make($this->assignee),
            'description' => $this->description,
            'deadline' => $this->deadline,
            'is_completed' => $this->is_completed
            ];
    }
}

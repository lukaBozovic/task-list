<?php

namespace App\Http\Services;


use App\Models\Task;

class TaskService
{
    public function store($requestValidated){
        $requestValidated['creator_id'] = auth()->user()->id;
        return Task::query()->create($requestValidated);
    }
}


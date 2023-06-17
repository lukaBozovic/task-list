<?php

namespace App\Http\Services;


use App\Mail\CreatedTaskMail;
use App\Models\Task;
use Illuminate\Support\Facades\Mail;

class TaskService
{
    public function store($requestValidated){
        $requestValidated['creator_id'] = auth()->user()->id;
        $task = Task::query()->create($requestValidated);
        Mail::to($task->assignee->email)->queue(new CreatedTaskMail($task));
        return $task;
    }

    public function getAssignedTasks(){
        return auth()->user()->assignedTasks();
    }

    public function getCreatedTasks(){
        return auth()->user()->createdTasks;
    }

    public function destroy(Task $task){
        $task->delete();
    }

    public function markAsCompleted(Task $task){
        $task->is_completed = true;
        $task->save();
    }
}


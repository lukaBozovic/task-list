<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTaskRequest;
use App\Http\Resources\TaskResource;
use App\Http\Services\TaskService;
use App\Models\Task;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class TaskController extends Controller
{
    private $taskService;

    public function __construct(TaskService $taskService)
    {
        $this->taskService = $taskService;
    }

    public function getAssignedTasks(){
        return TaskResource::collection($this->taskService->getAssignedTasks());
    }

    public function getCreatedTasks(){
        return TaskResource::collection($this->taskService->getCreatedTasks());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTaskRequest $request)
    {
        return TaskResource::make($this->taskService->store($request->validated()));
    }


    /**
     * Display the specified resource.
     */
    public function show(Task $task)
    {
        return TaskResource::make($task);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
//        if ($task->creator_id != auth()->user()->id)
//                return response('You are not creator of the task', ResponseAlias::HTTP_FORBIDDEN);
        //code above is replaced by the code in policy
        $this->authorize('destroy', $task);
        $this->taskService->destroy($task);
    }

    public function markAsCompleted(Task $task){
        $this->taskService->markAsCompleted($task);
        return TaskResource::make($task);
    }
}

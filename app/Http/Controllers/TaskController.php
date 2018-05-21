<?php

namespace App\Http\Controllers;

use App\ActiveRecord\Task;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Resources\Task as TaskResource;

class TaskController extends AbstractApiController
{
    protected $task;

    public function __construct(TaskResource $resource, Task $task)
    {
        parent::__construct($resource, $task);
        $this->task = $this->model;
    }

    public function store(Request $request)
    {
        dd($request->all());
        $task = $this->task->newInstance();
        $task->task = $request->get('task');
        $task->description = $request->get('description');
        $task->estimate = (int) $request->get('estimate');
        $task->created_at = Carbon::now();
        $task->updated_at = Carbon::now();
        $completed = false;
        $completed = false;
        if($task->completed_at){
            $completed = true;
        }
        if (!is_null($request->completed) && $request->completed != $completed ) {
            if($request->completed) {
                $task->completed_at = Carbon::now();
            }
            if(!$request->completed) {
                $task->completed_at = null;
            }
        }
        if ($task->save()) {
            return $this->resource->make($task);
        }
        return $this->jsonResponse(['error' => 'Could not create a task'], 500);
    }

    public function update(Request $request)
    {
        $task = $this->task->find($request->get('id'));
        if (!$task) {
            return $this->modelNotFound('task not found');
        }
        if (!is_null($request->task)) {
            $task->task = $request->get('task');
        }
        if (!is_null($request->description)) {
            $task->description = $request->get('description');
        }
        if (!is_null($request->estimate)) {
            $task->estimate = (int) $request->get('estimate');
        }
        $completed = false;
        if($task->completed_at){
            $completed = true;
        }
        if (!is_null($request->completed) && $request->completed != $completed ) {
            if($request->completed) {
                $task->completed_at = Carbon::now();
            }
            if(!$request->completed) {
                $task->completed_at = null;
            }
        }
        if ($task->save()) {
            if (!is_null($request->category)) {
                $task->categories()->sync([$request->category]);
            }
            if (!is_null($request->pomodoros)) {
                $task->pomodoros()->sync([$request->pomodoros]);
            }
            return $this->resource->make($task);
        }
        return $this->jsonResponse(['error' => 'Could not updated a task'], 500);
    }

    public function changeCompleteStatus($id)
    {
        $task = $this->task->find($id);
        if (!$task) {
            return $this->modelNotFound('task not found');
        }
        if ($task->completed_at) {
            $task->completed_at = null;
        } else {
            $task->completed_at = Carbon::now();
        }
        if ($task->save()) {
            $task->updated_at = Carbon::now();
            return $this->resource->make($task);
        }
        return $this->jsonResponse(['error' => 'Could not updated a task'], 500);
    }

    protected function updateRules(): array
    {
        return [];
    }

    protected function storeRules(): array
    {
        return [];
    }
}

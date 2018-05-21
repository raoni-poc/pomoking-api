<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;
use App\ActiveRecord\Task as TaskActiveRecord;

class Task extends Resource
{
    public function __construct(TaskActiveRecord $resource)
    {
        parent::__construct($resource);
    }

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        return parent::toArray($request);
//        return [
//            'id' => $this->id,
//            'task' => $this->task,
//            'description' => $this->description,
//            'estimate' => $this->estimate,
//            //'deleted_at' => $this->deleted_at,
//            'created_at' => $this->created_at,
//            'updated_at' => $this->updated_at,
//            'completed_at' => $this->completed_at,
//            'pomodoros' => Pomodoro::collection($this->pomodoros),
////            'users' => Users::collection($this->users),
//            'categories' => Category::collection($this->categories),
//        ];
    }
}

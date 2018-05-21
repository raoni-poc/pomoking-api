<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Traits\RestExceptionHandler;
use App\Http\Resources\Pomodoro as PomodoroResource;
use App\ActiveRecord\Pomodoro;

class PomodoroController extends Controller
{
    use RestExceptionHandler;

    protected $resource;
    protected $pomodoro;

    public function __construct(PomodoroResource $resource, Pomodoro $pomodoro)
    {
        $this->resource = $resource;
        $this->pomodoro = $pomodoro;
    }

    public function index()
    {
        //ex.: pag 1 - http://localhost:8000/api/v1/pomodoros
        //     pag 2 - http://localhost:8000/api/v1/pomodoros?page=2
        $pomodoro = $this->pomodoro->paginate(10);
        return $this->resource->collection($pomodoro);
    }

    public function show(int $id)
    {
        $pomodoro = $this->pomodoro->find($id);
        if (!$pomodoro) {
            return $this->modelNotFound('period not found');
        }
        return $this->resource->make($pomodoro);
    }

    public function destroy(int $id)
    {
        $pomodoro = $this->pomodoro->find($id);
        if (!$pomodoro) {
            return $this->modelNotFound('period not found');
        }
        try{
            $pomodoro->delete();
        } catch (\Exception $e){
            return $this->jsonResponse(['error' => 'Could not destroy a period'], 500);
        }
        return $this->resource->make($pomodoro);
    }

    public function store(Request $request)
    {
        $pomodoro = $this->pomodoro->newInstance();
        $pomodoro->start = date('Y-m-d h:i:s');
        $pomodoro->duration_in_minutes = $request->get('duration_in_minutes');
        $pomodoro->created_at = date('Y-m-d h:i:s');
        $pomodoro->updated_at = date('Y-m-d h:i:s');
        if ($pomodoro->save()) {
            return $this->resource->make($pomodoro);
        }
        return $this->jsonResponse(['error' => 'Could not create a period'], 500);
    }

    public function update(Request $request)
    {
        $pomodoro = $this->pomodoro->find($request->get('pomodoro_id'));
        if (!$pomodoro) {
            return $this->modelNotFound('period not found');
        }
        if (isset($request->start) || !empty($request->start)) {
            $pomodoro->start = $request->get('start');
        }
        if (isset($request->canceled_at) || !empty($request->canceled_at)) {
            $pomodoro->canceled_at = $request->get('canceled_at');
        }
        $pomodoro->updated_at = date('Y-m-d h:i:s');
        if ($pomodoro->save()) {
            return $this->resource->make($pomodoro);
        }
        return $this->jsonResponse(['error' => 'Could not updated a period'], 500);
    }
}

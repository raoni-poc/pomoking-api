<?php

namespace App\Http\Controllers;

use App\ActiveRecord\Category;
use App\ActiveRecord\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('tasks.index');
    }

    public function indexDataTable()
    {
        $dataTable = datatables(Auth::user()->tasks);
        $dataTable->editColumn('task', function (Task $task) {
            if ($task->completed_at) {
                $text = "<s>" . $task->task . "</s>";
            } else {
                $text = $task->task;
            }
            return "<span onclick='changeStatusComplete(" . json_encode($task) . ")'>$text</span>";
        });
        $dataTable->addColumn('action', function (Task $task) {
            return "<button type='button' class='btn btn-primary' data-toggle='modal' data-target='#edit' onclick='modalEdit(" . json_encode($task) . ")'>Edit</button> " .
                "<button type='button' class='btn btn-warning' data-toggle='modal' data-target='#destroy' onclick='modalDestroy(" . json_encode($task) . ")'>Delete</button>";
        });
        $dataTable->rawColumns(['task', 'action']);
        return $dataTable->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        throw new NotFoundHttpException;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (!$request->task) {
            $this->message("You can't leave task empty.", 'alert alert-warning');
            return redirect()->route('tasks.index')->withInput();
        }

        $task = new Task();
        $task->task = $request->task;
        $task->categories()->sync([$request->category]);

        if ($task->save()) {
            $task->users()->sync([Auth::user()->id]);
            $this->message("Success! Task create.", 'alert alert-success');
        } else {
            $this->message("Error! Task not saved yet.", 'alert alert-danger');
        }

        return redirect()->route('tasks.index')->withInput();
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        throw new NotFoundHttpException;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        throw new NotFoundHttpException;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if (!Auth::user()->tasks->contains($id)) {
            throw new NotFoundHttpException;
        }

        $task = Task::find($id);
        $task->task = $request->task;
        $task->categories()->sync([$request->category]);

        if ($task->save()) {
            $this->message("Success! Task edited.", 'alert alert-success');
        } else {
            $this->message("Error! Task not saved yet.", 'alert alert-danger');
        }

        return redirect()->route('tasks.index')->withInput();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (!Auth::user()->tasks->contains($id)) {
            throw new NotFoundHttpException;
        }
        $task = Task::find($id);
        if ($task->delete()) {
            $this->message("Task deleted.", 'alert alert-success');
        } else {
            $this->message("Error! Task not deleted yet.", 'alert alert-danger');
        }
        return redirect()->route('tasks.index')->withInput();
    }

    public function changeCompleteStatus($id)
    {
        if (!Auth::user()->tasks->contains($id)) {
            throw new NotFoundHttpException;
        }
        $task = Task::find($id);

        if ($task->completed_at) {
            $task->completed_at = null;
        } else {
            $task->completed_at = date('Y-m-d h:i:s');
        }
        $task->save();
        return $task->completed_at;
    }
}
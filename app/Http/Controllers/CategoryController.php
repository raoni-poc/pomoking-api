<?php

namespace App\Http\Controllers;

use App\ActiveRecord\Category;
use App\ActiveRecord\Task;
use Form;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
//        return view('categories.index');
    }

    public function indexDataTable()
    {
        $dataTable = datatables(Auth::user()->categories);
        $dataTable->addColumn('action', function($category){
            return "<button type='button' class='btn btn-primary' data-toggle='modal' data-target='#edit' onclick='modalEdit(".json_encode($category).")'>Edit</button> ".
                   "<button type='button' class='btn btn-warning' data-toggle='modal' data-target='#destroy' onclick='modalDestroy(".json_encode($category).")'>Delete</button>";
        });
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
        if (!$request->category) {
            $this->message("You can't leave category empty.", 'alert alert-warning');
//            return redirect()->route('categories.index')->withInput();
        }

        $category = new Category();
        $category->category = $request->category;

        if ($category->save()) {
            $category->users()->sync([Auth::user()->id]);
            $this->message("Success! Category create.", 'alert alert-success');
        } else {
            $this->message("Error! Category not saved yet.", 'alert alert-danger');
        }

//        return redirect()->route('categories.index')->withInput();
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
        if(!Auth::user()->categories->contains($id)){
            throw new NotFoundHttpException;
        }

        $category = Category::find($id);
        $category->category = $request->category;

        if($category->save()){
            $this->message("Success! Category edited.", 'alert alert-success');
        } else {
            $this->message("Error! Category not saved yet.", 'alert alert-danger');
        }

//        return redirect()->route('categories.index')->withInput();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(!Auth::user()->categories->contains($id)){
            throw new NotFoundHttpException;
        }
        $category = Category::find($id);
        if($category->delete()){
            $this->message("Category deleted.", 'alert alert-success');
        } else {
            $this->message("Error! Category not deleted yet.", 'alert alert-danger');
        }
//        return redirect()->route('categories.index')->withInput();
    }

    public function tasks($id)
    {
        if(!Auth::user()->categories->contains($id)){
            throw new NotFoundHttpException;
        }
    }

    public function tasksDataTable($id)
    {
        if(!Auth::user()->categories->contains($id)){
            throw new NotFoundHttpException;
        }
        $category = Category::find($id);
        $dataTable = datatables($category->tasks);
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
}

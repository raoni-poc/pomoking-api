<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TaskListController extends Controller
{
    public function showList($category)
    {
        return view('task-list.show');
    }
}

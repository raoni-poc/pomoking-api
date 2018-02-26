<?php

namespace Tests\App\ActiveRecord;

use App\ActiveRecord\Category;
use App\ActiveRecord\Task;
use App\ActiveRecord\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CategoryTaskRelationTest extends TestCase
{
    public function testRelation()
    {
        $category = new Category();
        $category->category = 'category test';
        $category->save();

        $task = new Task();
        $task->task = 'Task Test';
        $this->assertTrue($task->save());

        $category->tasks()->attach($task);

        $categoryAssert = Category::find($category->id);
        $taskAssert = Task::find($task->id);

        $this->assertEquals($categoryAssert->tasks->first()->id, $task->id);
        $this->assertEquals($taskAssert->categories->first()->id, $category->id);

        $task->delete();
        $category->delete();
    }
}
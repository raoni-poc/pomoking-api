<?php

namespace Tests\App\ActiveRecord;

use App\ActiveRecord\Category;
use App\ActiveRecord\Pomodoro;
use App\ActiveRecord\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CategoryPomodoroRelationTest extends TestCase
{
    public function testRelation()
    {
        $category = new Category();
        $category->category = 'category test';
        $category->save();

        $startAt = date("Y-m-d H:i:s");
        $duration = 15;
        $pomodoro = new Pomodoro();
        $pomodoro->start = $startAt;
        $pomodoro->duration_in_minutes = $duration;
        $pomodoro->save();

        $category->pomodoros()->attach($pomodoro);

        $categoryAssert = Category::find($category->id);
        $pomodoroAssert = Pomodoro::find($pomodoro->id);

        $this->assertEquals($categoryAssert->pomodoros->first()->id, $pomodoro->id);
        $this->assertEquals($pomodoroAssert->categories->first()->id, $category->id);

        $pomodoro->delete();
        $category->delete();
    }
}
<?php

namespace Tests\App\ActiveRecord;

use App\ActiveRecord\Category;
use App\ActiveRecord\Pomodoro;
use App\ActiveRecord\Task;
use App\ActiveRecord\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PomodoroTaskRelationTest extends TestCase
{
    public function testRelation()
    {
        $startAt = date("Y-m-d H:i:s");
        $duration = 15;
        $pomodoro = new Pomodoro();
        $pomodoro->start = $startAt;
        $pomodoro->duration_in_minutes = $duration;
        $pomodoro->save();
        
        $task = new Task();
        $task->task = 'Task Test';
        $this->assertTrue($task->save());

        $pomodoro->tasks()->attach($task);

        $pomodoroAssert = Pomodoro::find($pomodoro->id);
        $taskAssert = Task::find($task->id);

        $this->assertEquals($pomodoroAssert->tasks->first()->id, $task->id);
        $this->assertEquals($taskAssert->pomodoros->first()->id, $pomodoro->id);

        $task->delete();
        $pomodoro->delete();
    }
}
<?php

namespace Tests\App\ActiveRecord;

use App\ActiveRecord\Task;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TaskTestTest extends TestCase
{
    public function testCreateAndDelete()
    {
        $task = new Task();
        $task->task = 'Task Test';
        $this->assertTrue($task->save());

        $id = $task->id;
        $taskAssert = Task::find($id);

        $this->assertTrue($taskAssert instanceof Task);
        $this->assertEquals($taskAssert->task, 'Task Test');
        $this->assertTrue($task->delete());
        $this->assertNull(Task::find($id));
    }
}

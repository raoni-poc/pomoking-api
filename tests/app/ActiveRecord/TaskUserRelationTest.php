<?php

namespace Tests\App\ActiveRecord;

use App\ActiveRecord\Pomodoro;
use App\ActiveRecord\Task;
use App\ActiveRecord\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TaskUserRelationTest extends TestCase
{
    public function testRelation()
    {
        $task = new Task();
        $task->task = 'Task Test';
        $this->assertTrue($task->save());

        $email = 'user'.mt_rand(0,999999999).'@test.com';
        $user = new User();
        $user->name = 'User Test';
        $user->password = password_hash('Pass Test', PASSWORD_DEFAULT);
        $user->email = $email;
        $user->save();

        $task->users()->attach($user);

        $taskAssert = Task::find($task->id);
        $userAssert = User::find($user->id);

        $this->assertEquals($taskAssert->users->first()->id, $user->id);
        $this->assertEquals($userAssert->tasks->first()->id, $task->id);

        $user->delete();
        $task->delete();
    }
}
<?php

namespace Tests\App\ActiveRecord;

use App\ActiveRecord\Pomodoro;
use App\ActiveRecord\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PomodoroUserRelationTest extends TestCase
{
    public function testRelation()
    {
        $startAt = date("Y-m-d H:i:s");
        $duration = 15;
        $pomodoro = new Pomodoro();
        $pomodoro->start = $startAt;
        $pomodoro->duration_in_minutes = $duration;
        $pomodoro->save();

        $email = 'user'.mt_rand(0,999999999).'@test.com';
        $user = new User();
        $user->name = 'User Test';
        $user->password = password_hash('Pass Test', PASSWORD_DEFAULT);
        $user->email = $email;
        $user->save();

        $pomodoro->users()->attach($user);

        $pomodoroAssert = Pomodoro::find($pomodoro->id);
        $userAssert = User::find($user->id);

        $this->assertEquals($pomodoroAssert->users->first()->id, $user->id);
        $this->assertEquals($userAssert->pomodoros->first()->id, $pomodoro->id);

        $user->delete();
        $pomodoro->delete();
    }
}
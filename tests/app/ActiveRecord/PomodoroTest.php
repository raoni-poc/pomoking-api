<?php

namespace Tests\App\ActiveRecord;

use App\ActiveRecord\Pomodoro;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PomodoroTest extends TestCase
{
    public function testCreateAndDelete()
    {
        $startAt = date("Y-m-d H:i:s");
        $duration = 15;
        $pomodoro = new Pomodoro();
        $pomodoro->start = $startAt;
        $pomodoro->duration_in_minutes = $duration;

        $this->assertTrue($pomodoro->save());
        $id = $pomodoro->id;

        $pomodoroAssert = Pomodoro::find($id);

        $this->assertTrue($pomodoro instanceof Pomodoro);
        $this->assertEquals($pomodoro->start, $startAt);
        $this->assertEquals($pomodoro->duration_in_minutes, $duration);
        $this->assertEquals($pomodoroAssert->start, $startAt);
        $this->assertEquals($pomodoroAssert->duration_in_minutes, $duration);
        $this->assertTrue($pomodoro->delete());
        $this->assertNull(Pomodoro::find($id));
    }
}

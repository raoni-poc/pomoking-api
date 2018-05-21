<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\ActiveRecord\User::class, 50)->create()->each(function ($user) {
            $user->tasks()->saveMany(
                factory(App\ActiveRecord\Task::class, 100)->create()->each(function ($task) {
                    $task->pomodoros()->saveMany(factory(App\ActiveRecord\Pomodoro::class, mt_rand(0, 15)))->create();
                    $task->categories()->saveMany(factory(App\ActiveRecord\Category::class, 1))->create();
                })
            );
        });
    }
}

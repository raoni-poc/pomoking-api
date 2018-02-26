<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePomodoroTaskTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pomodoro_task', function (Blueprint $table) {
            $table->integer('pomodoro_id')->unsigned();
            $table->integer('task_id')->unsigned();
            $table->primary(['pomodoro_id','task_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pomodoro_task');
    }
}

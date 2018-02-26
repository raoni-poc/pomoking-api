<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoryPomodoroTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('category_pomodoro', function (Blueprint $table) {
            $table->integer('category_id')->unsigned();
            $table->integer('pomodoro_id')->unsigned();
            $table->primary(['category_id','pomodoro_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('category_pomodoro');
    }
}

<?php

namespace App\ActiveRecord;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * App\ActiveRecord\Category
 *
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\ActiveRecord\Pomodoro[] $pomodoros
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\ActiveRecord\Task[] $tasks
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\ActiveRecord\User[] $user
 * @mixin \Eloquent
 * @property int $id
 * @property string $category
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ActiveRecord\Category whereCategory($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ActiveRecord\Category whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ActiveRecord\Category whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ActiveRecord\Category whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ActiveRecord\Category whereUpdatedAt($value)
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\ActiveRecord\User[] $users
 */
class Category extends Model
{
    protected $table = 'categories';

    public function pomodoros()
    {
        return $this->belongsToMany(Pomodoro::class);
    }

    public function tasks()
    {
        return $this->belongsToMany(Task::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    protected static function boot() {
        parent::boot();

        static::deleting(function(Category $category) {
            $category->pomodoros()->sync([]);
            $category->users()->sync([]);
            $category->tasks()->sync([]);
        });
    }

}

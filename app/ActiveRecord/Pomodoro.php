<?php

namespace App\ActiveRecord;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\ActiveRecord\Pomodoro
 *
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\ActiveRecord\Task[] $task
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\ActiveRecord\User[] $user
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Query\Builder|\App\ActiveRecord\Pomodoro onlyTrashed()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Query\Builder|\App\ActiveRecord\Pomodoro withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\ActiveRecord\Pomodoro withoutTrashed()
 * @mixin \Eloquent
 * @property int $id
 * @property string $start
 * @property int $duration_in_minutes
 * @property string|null $canceled_at
 * @property string|null $deleted_at
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\ActiveRecord\Category[] $category
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ActiveRecord\Pomodoro whereCanceledAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ActiveRecord\Pomodoro whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ActiveRecord\Pomodoro whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ActiveRecord\Pomodoro whereDurationInMinutes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ActiveRecord\Pomodoro whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ActiveRecord\Pomodoro whereStart($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ActiveRecord\Pomodoro whereUpdatedAt($value)
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\ActiveRecord\Category[] $categories
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\ActiveRecord\Task[] $tasks
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\ActiveRecord\User[] $users
 */
class Pomodoro extends Model
{
    use SoftDeletes;

    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    public function tasks()
    {
        return $this->belongsToMany(Task::class);
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    protected static function boot() {
        parent::boot();

        static::deleting(function(Pomodoro $category) {
            $category->users()->sync([]);
            $category->tasks()->sync([]);
            $category->categories()->sync([]);
        });
    }
}

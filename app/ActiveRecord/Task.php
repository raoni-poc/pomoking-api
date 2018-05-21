<?php

namespace App\ActiveRecord;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\ActiveRecord\Task
 *
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Query\Builder|\App\ActiveRecord\Task onlyTrashed()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Query\Builder|\App\ActiveRecord\Task withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\ActiveRecord\Task withoutTrashed()
 * @mixin \Eloquent
 * @property int $id
 * @property string $task
 * @property string|null $deleted_at
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\ActiveRecord\Category[] $category
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ActiveRecord\Task whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ActiveRecord\Task whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ActiveRecord\Task whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ActiveRecord\Task whereTask($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ActiveRecord\Task whereUpdatedAt($value)
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\ActiveRecord\Category[] $categories
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\ActiveRecord\Pomodoro[] $pomodoros
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\ActiveRecord\User[] $users
 * @property string|null $completed_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ActiveRecord\Task whereCompletedAt($value)
 */
class Task extends Model
{
//    use SoftDeletes;
    public $timestamps = true;
    protected $dates = ['created_at', 'updated_at', 'completed_at'];

    public function pomodoros()
    {
        return $this->belongsToMany(Pomodoro::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    protected static function boot()
    {
        parent::boot();

        static::deleting(function (Task $category) {
            $category->pomodoros()->sync([]);
            $category->users()->sync([]);
            $category->categories()->sync([]);
        });
    }

//    public function getCompletedAtAttribute($value)
//    {
//        if (!is_null($value)) {
//            return Carbon::createFromTimeString($value);
//        }
//    }
}

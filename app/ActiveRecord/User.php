<?php

namespace App\ActiveRecord;

use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Spark\User as SparkUser;

/**
 * App\ActiveRecord\User
 *
 * @property-read string|null $photo_url
 * @property-read \Illuminate\Database\Eloquent\Collection|\Laravel\Spark\LocalInvoice[] $localInvoices
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\ActiveRecord\Pomodoro[] $pomodoros
 * @property-read \Illuminate\Database\Eloquent\Collection|\Laravel\Spark\Subscription[] $subscriptions
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\ActiveRecord\Task[] $tasks
 * @property-read \Illuminate\Database\Eloquent\Collection|\Laravel\Spark\Token[] $tokens
 * @mixin \Eloquent
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string $password
 * @property string|null $remember_token
 * @property bool $uses_two_factor_auth
 * @property string|null $authy_id
 * @property string|null $country_code
 * @property string|null $phone
 * @property string|null $two_factor_reset_code
 * @property int|null $current_team_id
 * @property string|null $stripe_id
 * @property string|null $current_billing_plan
 * @property string|null $card_brand
 * @property string|null $card_last_four
 * @property string|null $card_country
 * @property string|null $billing_address
 * @property string|null $billing_address_line_2
 * @property string|null $billing_city
 * @property string|null $billing_state
 * @property string|null $billing_zip
 * @property string|null $billing_country
 * @property string|null $vat_id
 * @property string|null $extra_billing_information
 * @property \Carbon\Carbon $trial_ends_at
 * @property string|null $last_read_announcements_at
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\ActiveRecord\Category[] $categories
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ActiveRecord\User whereAuthyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ActiveRecord\User whereBillingAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ActiveRecord\User whereBillingAddressLine2($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ActiveRecord\User whereBillingCity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ActiveRecord\User whereBillingCountry($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ActiveRecord\User whereBillingState($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ActiveRecord\User whereBillingZip($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ActiveRecord\User whereCardBrand($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ActiveRecord\User whereCardCountry($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ActiveRecord\User whereCardLastFour($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ActiveRecord\User whereCountryCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ActiveRecord\User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ActiveRecord\User whereCurrentBillingPlan($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ActiveRecord\User whereCurrentTeamId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ActiveRecord\User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ActiveRecord\User whereExtraBillingInformation($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ActiveRecord\User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ActiveRecord\User whereLastReadAnnouncementsAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ActiveRecord\User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ActiveRecord\User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ActiveRecord\User wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ActiveRecord\User wherePhotoUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ActiveRecord\User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ActiveRecord\User whereStripeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ActiveRecord\User whereTrialEndsAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ActiveRecord\User whereTwoFactorResetCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ActiveRecord\User whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ActiveRecord\User whereUsesTwoFactorAuth($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ActiveRecord\User whereVatId($value)
 * @property string|null $deleted_at
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Query\Builder|\App\ActiveRecord\User onlyTrashed()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ActiveRecord\User whereDeletedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\ActiveRecord\User withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\ActiveRecord\User withoutTrashed()
 */
class User extends SparkUser
{
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'authy_id',
        'country_code',
        'phone',
        'card_brand',
        'card_last_four',
        'card_country',
        'billing_address',
        'billing_address_line_2',
        'billing_city',
        'billing_zip',
        'billing_country',
        'extra_billing_information',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'trial_ends_at' => 'datetime',
        'uses_two_factor_auth' => 'boolean',
    ];

    public function pomodoros()
    {
        return $this->belongsToMany(Pomodoro::class);
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

        static::deleting(function(User $category) {
            $category->pomodoros()->sync([]);
            $category->tasks()->sync([]);
            $category->categories()->sync([]);
        });
    }
}

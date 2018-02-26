<?php

namespace App;

use Laravel\Spark\Team as SparkTeam;

/**
 * App\Team
 *
 * @property-read string $email
 * @property-read string|null $photo_url
 * @property-read \Illuminate\Database\Eloquent\Collection|\Laravel\Spark\Invitation[] $invitations
 * @property-read \Illuminate\Database\Eloquent\Collection|\Laravel\Spark\LocalInvoice[] $localInvoices
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read \App\ActiveRecord\User $owner
 * @property-read \Illuminate\Database\Eloquent\Collection|\Laravel\Spark\TeamSubscription[] $subscriptions
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\ActiveRecord\User[] $users
 * @mixin \Eloquent
 * @property int $id
 * @property int $owner_id
 * @property string $name
 * @property string|null $slug
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
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Team whereBillingAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Team whereBillingAddressLine2($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Team whereBillingCity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Team whereBillingCountry($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Team whereBillingState($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Team whereBillingZip($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Team whereCardBrand($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Team whereCardCountry($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Team whereCardLastFour($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Team whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Team whereCurrentBillingPlan($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Team whereExtraBillingInformation($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Team whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Team whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Team whereOwnerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Team wherePhotoUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Team whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Team whereStripeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Team whereTrialEndsAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Team whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Team whereVatId($value)
 */
class Team extends SparkTeam
{
    //
}

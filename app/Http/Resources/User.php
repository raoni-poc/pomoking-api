<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class User extends Resource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
      return [
        'id' => $this->id,
        'name' => $this->name,
        'email' => $this->email,
        'photo_url' => $this->photo_url,
        'uses_two_factor_auth' => $this->uses_two_factor_auth,
        'two_factor_reset_code' => $this->two_factor_reset_code,
        'current_team_id' => $this->current_team_id,
        'stripe_id' => $this->strip_id,
        'current_billing_plan' => $this->current_billing_plan,
        'billing_state' => $this->billing_state,
        'vat_id' => $this->vat_id,
        'trial_ends_at' => $this->trial_ends_at,
        'last_read_announcements_at' => $this->last_read_announcements_at,
        'created_at' => $this->created_at,
        'updated_at' => $this->update_at,
        'deleted_at' => $this->deleted_at,
        //'pomodoros' => Pomodoro::collection($this->pomodoros),
        //'tasks' => Task::collection($this->users),
        //'categories' => Categories::collection($this->categories),
      ];
    }
}

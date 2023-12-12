<?php

namespace App\Actions;

use App\Models\Reputation;

class CreateReputation
{
    /**
     * Create a reputation for a user
     */
    public function execute(array $attributes): Reputation
    {
        $reputation = new Reputation([
            'reason' => $attributes['reason'],
            'points' => $attributes['points'],
        ]);

        $reputation->giver_id = $attributes['giver_id'];
        $reputation->user_id = $attributes['user_id'];

        $reputation->save();

        return $reputation;
    }
}

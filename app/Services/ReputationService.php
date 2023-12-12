<?php

namespace App\Services;

use App\Models\User;
use App\Models\Reputation;

class ReputationService
{
    public function allowedReputationsForRole(User $user)
    {
        $allowedPoints = config('forum.allowed_reputation');

        foreach ($allowedPoints as $role => $reputations) {
            if ($user->hasRole($role)) {
                return $reputations;
            }
        }

        return $allowedPoints['default'];
    }

    public function getTotalReputation(User $user)
    {
        // return $user->reputations->count('points');
        $reputations = Reputation::select('id', 'points', 'reason')
            ->where('user_id', $user->id)
            ->whereNotNull('user_id')
            ->get();

        $totalReputation = $reputations->sum('points');

        return $totalReputation;
    }

    public function getReputationWithStyle(User $user)
    {
        $totalReputation = $this->getTotalReputation($user);

        $style = '';
        if ($totalReputation > 0) {
            $style = 'text-green-600';
        } elseif ($totalReputation < 0) {
            $style = 'text-red-600';
        } else {
            $style = 'text-gray-600';
        }

        return [
            'reputation' => $totalReputation,
            'style' => $style,
        ];
    }

    public function positiveReputations(User $user)
    {
        return $user->reputations()->where('points', '>', 0)->count();
    }

    public function negativeReputations(User $user)
    {
        return $user->reputations()->where('points', '<', 0)->count();
    }

    public function neutralReputations(User $user)
    {
        return $user->reputations()->where('points', '=', 0)->count();
    }

    public function positiveReputationsGiven(User $user)
    {
        return Reputation::where('giver_id', $user->id)->where('points', '>', 0)->count();
    }

    public function negativeReputationsGiven(User $user)
    {
        return Reputation::where('giver_id', $user->id)->where('points', '<', 0)->count();
    }

    public function neutralReputationsGiven(User $user)
    {
        return Reputation::where('giver_id', $user->id)->where('points', '=', 0)->count();
    }
}

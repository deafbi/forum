<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Credit extends Model
{
    use HasFactory;

    /**
     * Indicates if the model should be timestamped.
     */
    public $timestamps = false;

    /**
     * Get the user relationship.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(
            related: User::class,
            foreignKey: 'user_id',
        );
    }

    /**
     * Scope a query to only include credits of a given amount.
     */
    public function scopeOfAmount($query, $amount): void
    {
        return $query->where('amount', $amount);
    }

    /**
     * Give a user credit.
     */
    public function addCredit($user, $amount): void
    {
        $credit = new Credit;

        $credit->user_id = $user->id;
        $credit->amount = $amount;

        $credit->save();
    }

    /**
     * Take a user's credit.
     */
    public function removeCredit($user, $amount): void
    {
        $credit = Credit::where('user_id', $user->id)
            ->where('amount', $amount)
            ->first();

        $credit->delete();
    }
}

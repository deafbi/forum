<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Reputation extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * Remove the updated_at column from the model.
     */
    const UPDATED_AT = null;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'reason',
        'points' // Don't do this in production
    ];

    /**
     * The attributes that should be cast.
     */
    protected $casts = [
        'deleted_at' => 'datetime:Y-m-d H:i:s',
    ];

    /**
     * Get the user related to the given reputation.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(
            related: User::class,
            foreignKey: 'user_id',
        );
    }

    /**
     * Get the giver user related to the given reputation.
     */
    public function giver(): BelongsTo
    {
        return $this->belongsTo(User::class, 'giver_id');
    }

    /**
     * Get the amount of reputation points for the user.
     */
    public static function getPointsForUser(int $userId): int
    {
        return static::where('user_id', $userId)
            ->sum('points');
    }

    /**
     * Total amount of reputation points for the user.
     */
    public function getTotalPointsAttribute(): int
    {
        return static::getPointsForUser($this->user_id);
    }

    /**
     * Get the reputation logs.
     */
    public static function getReputationLogs($perPage = 10)
    {
        return self::with(['user', 'giver'])
            ->orderBy('created_at', 'desc')
            ->paginate($perPage);
    }

    /**
     * Get the reputation data for the given user.
     */
    public static function getReputationData(User $user, $perPage = 10)
    {
        return self::select('reason', 'points', 'created_at', 'giver_id')
            ->with('giver')
            ->where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->paginate($perPage);
    }

    /**
     * Set the created_at attribute.
     */
    public static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->created_at = $model->freshTimestamp();
        });
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Vouch extends Model
{
    use HasFactory;

    /**
     * Remove the updated_at column from the model.
     */
    const UPDATED_AT = null;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'type',
        'reason'
    ];

    /**
     * The attributes that should be cast.
     */
    protected $casts = [
        'deleted_at' => 'datetime:Y-m-d H:i:s',
    ];

    /**
     * Get the user that owns the vouch.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(
            related: User::class,
            foreignKey: 'user_id',
        );
    }

    /**
     * Get the user that has given the vouch.
     */
    public function vouchedByUser(): BelongsTo
    {
        return $this->belongsTo(
            related: User::class,
            foreignKey: 'vouched_by',
        );
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

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Profile extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'cover_image',
        'discord_id',
        'telegram_id',
        'btc_address',
        'eth_address',
    ];

    public function getRouteKeyName()
    {
        return 'user_id';
    }

    /**
     * Get the user profile related to the given profile.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(
            related: User::class,
            foreignKey: 'user_id',
        );
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UsernameHistory extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     */
    protected $table = 'username_history';

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        // 'previous_username',
        'new_username',
        // 'changed_at',
    ];

    /**
     * Get the user related to the given username history.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(
            related: User::class,
            foreignKey: 'user_id',
        );
    }

    /**
     * Change username. Add new username to username history.
     */
    public function changeUsername($user, $newUsername)
    {
        $this->create([
            'user_id' => $user->id,
            'previous_username' => $user->username,
            'new_username' => $newUsername,
            'changed_at' => now(),
        ]);
        $user->username = $newUsername;
        $user->save();
    }
}

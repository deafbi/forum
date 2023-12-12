<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Notification extends Model
{
    use HasFactory;

    protected $fillable = [
        'read',
    ];

    /**
     * Get the post related to the given notification.
     */
    public function post(): BelongsTo
    {
        return $this->belongsTo(
            related: Post::class,
            foreignKey: 'post_id',
        );
    }

    public function topic(): BelongsTo
    {
        return $this->belongsTo(
            related: Topic::class,
            foreignKey: 'topic_id',
        );
    }

    /**
     * Mark the notification as read.
     */
    public function markAsRead(): void
    {
        $this->read = true;
        $this->save();
    }
}

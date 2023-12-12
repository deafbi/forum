<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Like extends Model
{
    use HasFactory;

    /**
     * Get the user that owns the like.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(
            related: User::class,
            foreignKey: 'user_id',
        );
    }

    /**
     * Get the post that owns the like.
     */
    public function post(): BelongsTo
    {
        return $this->belongsTo(
            related: Post::class,
            foreignKey: 'post_id',
        );
    }

    /**
     * Like a post.
     */
    public function like($user, $post): void
    {
        $like = new Like;

        $like->user_id = $user->id;
        $like->post_id = $post->id;

        $like->save();
    }

    /**
     * Unlike a post.
     */
    public function unlike($user, $post): void
    {
        $like = Like::where('user_id', $user->id)
            ->where('post_id', $post->id)
            ->first();

        $like->delete();
    }

    /**
     * Boot the model.
     */
    protected static function boot()
    {
        parent::boot();

        static::created(function (Like $like) {
            $like->user->gainCredit('post_like');
        });

        static::deleting(function (Like $like) {
            $like->user->loseCredit('post_like');
        });
    }
}

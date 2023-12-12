<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Post extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'content',
    ];

    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = true;

    /**
     * The number of models to return for pagination.
     *
     * @var int
     */
    protected $perPage = 10;

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'is_first_post' => 'boolean',
    ];

    /**
     * Get the route key name for Laravel.
     */
    public function getRouteKeyName(): string
    {
        return 'slug';
    }

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
     * Get the topic reliationshop
     */
    public function topic(): BelongsTo
    {
        return $this->belongsTo(Topic::class);
    }

    /**
     * Get the likes relationship.
     */
    public function likes(): HasMany
    {
        return $this->hasMany(
            related: Like::class,
            foreignKey: 'post_id',
        );
    }

    public function isLikedByUser($user)
    {
        return $this->likes()->where('user_id', $user->id)->exists();
    }

    public function usersWhoLiked()
    {
        return $this->belongsToMany(User::class, 'likes', 'post_id', 'user_id')->withTimestamps() ?: collect([]);
    }

    public function scopeOfTopic($query, $topic)
    {
        return $query->where('topic_id', $topic);
    }

    public function path()
    {
        $perPage = config('forum.pagination.perPage');
        $replyPosition = $this->topic->posts()->pluck('slug')->search($this->slug);
        $page = ceil(($replyPosition + 1) / $perPage);
        // $page = ceil($replyPosition / $perPage);
        return $this->topic->path() . "?page={$page}#reply-{$this->slug}";
    }

    /**
     * Create a new post.
     */
    public static function createPost(array $data): Post
    {
        $post = new Post();
        $post->content = $data['content'];
        $post->user_id = $data['user_id'];
        $post->is_first_post = $data['is_first_post'];
        $post->topic_id = $data['topic_id'];
        $post->save();

        return $post;
    }

    public function scopeWithTopicAndCategory($query)
    {
        return $query->with([
            'topic:id,title,slug,category_id',
            'topic.category:id,slug,name',
        ]);
    }


    /**
     * The "booting" method of the model.
     * @TODO: When a post is deleted, the user's post count should be decremented.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        static::created(function ($post) {
            if (!$post->is_first_post) {
                $post->topic->increment('post_count');
                $post->user->increment('post_count');
                $post->user->gainCredit('post_published');
            }
        });

        static::deleting(function ($post) {
            if (!$post->is_first_post) {
                $post->topic->decrement('post_count');
                $post->user->decrement('post_count');
                $post->user->loseCredit('post_published');
            }
        });
    }
}

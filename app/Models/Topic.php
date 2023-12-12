<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Topic extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'title',
        'is_hidden',
        'locked',
        'pinned',
    ];

    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = true;

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'deleted_at' => 'datetime:Y-m-d H:i:s',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'deleted_at',
    ];

    /**
     * Get the route key name for Laravel.
     */
    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    /**
     * Get a string path for the topic
     *
     * @return string
     */
    public function path()
    {
        return "forum/categories/{$this->category->slug}/{$this->slug}";
    }

    /**
     * Get the path to the topic as a property.
     *
     * @return string
     */
    public function getPathAttribute()
    {
        return $this->path();
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
     * Get the posts relationship.
     */
    public function posts(): HasMany
    {
        return $this->hasMany(
            related: Post::class,
            foreignKey: 'topic_id',
        );
    }

    /**
     * Get the category relationship.
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(
            related: Category::class,
            foreignKey: 'category_id',
        );
    }

    public function subcategory()
    {
        return $this->belongsTo(Subcategory::class);
    }

    /**
     * Get the tags relationship.
     */
    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(
            related: Tag::class,
            table: 'topic_tag',
        );
    }

    public function viewers()
    {
        return $this->belongsToMany(
            related: User::class,
            table: 'topic_user',
            foreignPivotKey: 'topic_id',
            relatedPivotKey: 'user_id',
        )->withTimestamps();
    }

    public function usersWhoLiked()
    {
        return $this->belongsToMany(User::class, 'topic_user')->withTimestamps();
    }

    public function scopeWithCategory($query)
    {
        return $query->with([
            'category:id,slug,name',
        ]);
    }

    /**
     * Scope a query to only include pinned topics.
     */
    public function scopePinned($query): Builder
    {
        return $query->where('pinned', true);
    }

    // public function scopePinned(Builder $query): Builder
    // {
    //     return $query->where('is_pinned', true);
    // }

    /**
     * Boot the model.
     * @TODO: Take a closer look at this boot model method.
     */
    protected static function boot()
    {
        parent::boot();

        // static::creating(function (Topic $topic) {
        //     $topic->slug = Str::slug($topic->title);
        //     $topic->user_id = auth()->id();
        // });

        static::created(function (Topic $topic) {
            $topic->user->increment('topic_count');
            $topic->user->gainCredit('topic_published');
        });

        static::deleting(function (Topic $topic) {
            $topic->posts->each(function (Post $post) {
                $post->user->decrement('post_count');
                $post->user->loseCredit('post_published');
                $post->delete();
            });

            $topic->user->decrement('topic_count');
            $topic->user->loseCredit('topic_published');
        });
    }
}

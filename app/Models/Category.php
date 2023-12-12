<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class Category extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'title',
        'description',
        'section_id', // Don't do this
        'parent_id', // Don't do this
        'slug'
    ];

    /**
     * Get the route key name for Laravel.
     */
    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    /**
     * Get the topics associated with the given category.
     */
    public function topics(): HasMany
    {
        return $this->hasMany(
            related: Topic::class,
            foreignKey: 'category_id',
        );
    }

    /**
     * A category contains many replies, through its topics.
     */
    public function replies(): HasManyThrough
    {
        return $this->hasManyThrough(Post::class, Topic::class);
    }

    /**
     * Get the parent category.
     */
    public function parent(): BelongsTo
    {
        return $this->belongsTo(
            related: Category::class,
            foreignKey: 'parent_id',
        );
    }

    /**
     * Get the subcategories.
     */
    public function subcategories(): HasMany
    {
        return $this->hasMany(Subcategory::class);
    }

    public function section()
    {
        return $this->belongsTo(Section::class);
    }

    /**
     * Boot the model.
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($category) {
            $category->user_id = auth()->id();
            $category->slug = Str::slug($category->title);
        });

        static::deleting(function ($category) {
            $category->subcategories->detach();
            $category->topics->detach();
            $category->posts->detach();
        });
    }
}

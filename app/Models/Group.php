<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Group extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'name',
        'slug',
        'description',
        'color',
        'group_avatar',
        'owner_id', // Don't do this...
    ];

    /**
     * Get the route key name for Laravel.
     */
    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    /**
     * Get the users associated with the given group.
     */
    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class);
    }

    /**
     * Get the posts associated with the given group.
     */
    public function posts(): HasMany
    {
        return $this->hasMany(
            related: Post::class,
            foreignKey: 'group_id',
        );
    }

    /**
     * Get the owner of the group.
     */
    public function owner(): BelongsTo
    {
        return $this->belongsTo(
            related: User::class,
            foreignKey: 'owner_id',
        );
    }

    /**
     * Change the owner of the group.
     */
    public function changeOwner($user): void
    {
        $this->owner_id = $user->id;
        $this->save();
    }

    /**
     * Boot model
     */
    public static function boot()
    {
        parent::boot();

        static::creating(function ($group) {
            $group->owner_id = auth()->id();
            $group->slug = Str::slug($group->title);
        });
    }
}

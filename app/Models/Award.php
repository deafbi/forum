<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Award extends Model
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
        'name',
        'description',
        'icon',
    ];

    /**
     * Get the users associated with the given award.
     */
    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'user_awards')
            ->withTimestamps()
            ->withPivot('awarded_at');
    }

    public function userAwards()
    {
        return $this->hasMany(UserAward::class);
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

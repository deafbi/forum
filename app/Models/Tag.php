<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Tag extends Model
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
        'color',
    ];

    /**
     * Indicates if the model should be timestamped.
     */
    public $timestamps = false;

    /**
     * The attributes that should be cast.
     */
    protected $casts = [
        'deleted_at' => 'datetime:Y-m-d H:i:s',
    ];

    /**
     * Get the topics associated with the given tag.
     */
    public function topics(): BelongsToMany
    {
        return $this->belongsToMany(
            related: Topic::class,
        );
    }

    /**
     * Get the tags
     */
    public static function getTags()
    {
        return self::query()
            ->select('id', 'name', 'query')
            ->get();
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

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Report extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'reason',
    ];

    /**
     * The attributes that should be cast.
     */
    protected $casts = [
        'deleted_at' => 'datetime:Y-m-d H:i:s',
    ];

    /**
     * Get the reporter user related to the given report.
     */
    public function reporter()
    {
        return $this->belongsTo(
            related: User::class,
            foreignKey: 'reporter_user_id',
        );
    }

    /**
     * Get the reported user related to the given report.
     */
    public function reportedUser()
    {
        return $this->belongsTo(
            related: User::class,
            foreignKey: 'reported_user_id',
        );
    }

    /**
     * Get the reported post related to the given report.
     */
    public function reportedPost()
    {
        return $this->belongsTo(
            related: Post::class,
            foreignKey: 'reported_post_id',
        )->withTrashed();
    }
}

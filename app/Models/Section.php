<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Section extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'slug',
        'tab_id',
    ];

    public function tab()
    {
        return $this->belongsTo(Tab::class);
    }

    public function categories()
    {
        return $this->hasMany(Category::class);
    }
}

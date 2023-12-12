<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProfileVisit extends Model
{
    use HasFactory;

    protected $fillable = ['profile_id', 'visitor_id'];

    public function profile()
    {
        return $this->belongsTo(User::class, 'profile_id');
    }

    public function visitor()
    {
        return $this->belongsTo(User::class, 'visitor_id');
    }
}

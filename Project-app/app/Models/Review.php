<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    protected $fillable = ['sight_id', 'user_id', 'content', 'rating'];

    public function sight()
    {
        return $this->belongsTo(Sight::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
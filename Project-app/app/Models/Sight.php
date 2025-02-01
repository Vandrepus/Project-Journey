<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sight extends Model
{
    use HasFactory;

    protected $table = 'sights';

    protected $fillable = ['country_id', 'name', 'description', 'location', 'visible', 'category', 'opening_hours', 'average_rating', 'map_url', 'photo', 'submitted_by'];

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'submitted_by');
    }


    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function favoredByUsers()
    {
        return $this->belongsToMany(User::class, 'favorite_sights')->withTimestamps();
    }
}
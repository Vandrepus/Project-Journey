<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sight extends Model
{
    use HasFactory;

    protected $table = 'sights';

    protected $fillable = ['country_id', 'name', 'description', 'location', 'category', 'opening_hours', 'average_rating', 'map_url'];

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
}
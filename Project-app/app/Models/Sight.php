<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sight extends Model
{
    use HasFactory;

    protected $table = 'sights';

    protected $fillable = ['country_id', 'name', 'description', 'location', 'visible', 'category', 'opening_hours', 'average_rating', 'map_url', 'submitted_by'];

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
}
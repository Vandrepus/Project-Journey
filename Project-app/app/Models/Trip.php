<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Trip extends Model
{
    // Table name (optional, defaults to 'trips')
    protected $table = 'trips'; // If your table name is different, specify it here

    // Fillable attributes (allow mass assignment)
    protected $fillable = [
        'title',       // The heading or name of the trip
        'description', // The longer description text
        'image_path1', // Path to the first image (relative to the storage/app/public folder)
        'image_path2', // Path to the second image
    ];

    // Optional: Relationship to destination (if applicable)
    public function destination()
    {
        return $this->belongsTo(Destination::class);
    }
}

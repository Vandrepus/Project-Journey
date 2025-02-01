<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = ['name','capital', 'description', 'picture', 'submitted_by', 'visible'];

    /**
     * Relationship with Sight model.
     * A country can have many sights.
     */
    public function sights()
    {
        return $this->hasMany(Sight::class);
    }

    /**
     * Relationship with User model.
     * A country is proposed by a user.
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'submitted_by');
    }

    /**
     * Scope to filter only visible (approved) countries.
     */
    public function scopeVisible($query)
    {
        return $query->where('visible', true);
    }

    /**
     * Scope to filter only invisible (proposed) countries.
     */
    public function scopeProposed($query)
    {
        return $query->where('visible', false);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Šis modelis pārstāv valsti lietotāja piedāvātajā ceļojumu sistēmā.
 * Tas saglabā informāciju par valsts nosaukumu, galvaspilsētu, aprakstu,
 * attēlu, ierosinātāju un redzamības statusu.
 *
 * This model represents a country in the user-proposed travel system.
 * It stores information about the country's name, capital, description,
 * image, proposer, and visibility status.
 */
class Country extends Model
{
    use HasFactory;

    /**
     * Norāda, kuri atribūti ir aizpildāmi.
     *
     * Specifies which attributes are assignable.
     */ 
    protected $fillable = ['name', 'capital', 'description', 'picture', 'submitted_by', 'visible'];

    /**
     * Attiecības ar Sight modeli.
     * Vienai valstij var būt daudz apskates vietu.
     *
     * Relationship with Sight model.
     * A country can have many sights.
     */
    public function sights()
    {
        return $this->hasMany(Sight::class);
    }

    /**
     * Attiecības ar User modeli.
     * Valsti piedāvā lietotājs.
     *
     * Relationship with User model.
     * A country is proposed by a user.
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'submitted_by');
    }

    /**
     * Lokālais vaicājums, lai filtrētu tikai redzamās (apstiprinātās) valstis.
     *
     * Scope to filter only visible (approved) countries.
     */
    public function scopeVisible($query)
    {
        return $query->where('visible', true);
    }

    /**
     * Lokālais vaicājums, lai filtrētu tikai neredzamās (ierosīnātas) valstis.
     *
     * Scope to filter only invisible (proposed) countries.
     */
    public function scopeProposed($query)
    {
        return $query->where('visible', false);
    }
}

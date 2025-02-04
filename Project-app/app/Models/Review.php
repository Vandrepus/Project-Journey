<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Šis modelis pārstāv atsauksmes sistēmu, kas tiek izmantota, lai lietotāji varētu atstāt atsauksmes par redzēmēm.
 * Modelis ir savienots ar lietotājiem un redzēmēm, izmantojot attiecības.
 *
 * This model represents the review system used for users to leave reviews on sights.
 * The model is connected to users and sights through relationships.
 */
class Review extends Model
{
    use HasFactory;

    /**
     * Norāda, kuri atribūti ir aizpildāmi.
     *
     * Specifies which attributes are assignable.
     */ 
    protected $fillable = ['sight_id', 'user_id', 'content', 'rating'];

    /**
     * Šī funkcija definē attiecības starp atsauksmi un redzēmi.
     * Atsauksme pieder konkrētai redzēmei.
     *
     * This function defines the relationship between a review and a sight.
     * A review belongs to a specific sight.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function sight()
    {
        return $this->belongsTo(Sight::class);
    }

    /**
     * Šī funkcija definē attiecības starp atsauksmi un lietotāju.
     * Atsauksme pieder konkrētam lietotājam, kurš to ir atstājis.
     *
     * This function defines the relationship between a review and a user.
     * A review belongs to the specific user who left it.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

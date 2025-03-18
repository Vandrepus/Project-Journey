<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Šis modelis attēlo apskates objektus sistēmā un to saistību ar citām tabulām.
 * Tas satur informāciju par nosaukumu, atrašanās vietu, kategoriju, darba laiku, vidējo vērtējumu un kartes URL.
 * Apskates vietas var būt saistīti ar valstīm, lietotājiem, atsauksmēm un favorītiem.
 *
 * This model represents sights in the system and their relationships with other tables.
 * It includes details like name, location, category, opening hours, average rating, and map URL.
 * Sights can be associated with countries, users, reviews, and favorites.
 */
class Sight extends Model
{
    use HasFactory;

    /**
     * Norāda tabulu, kas saistīta ar šo modeli.
     *
     * Specifies the table associated with this model.
     */
    protected $table = 'sights';

    /**
     * Norāda, kuri atribūti ir aizpildāmi.
     *
     * Specifies which attributes are assignable.
     */ 
    protected $fillable = ['country_id','name','description','location','visible','category','opening_hours','average_rating','map_url','photo','submitted_by'];

    /**
     * Attiecības ar valsts modeli.
     * Katrs apskates objekts pieder vienai valstij.
     *
     * Relationship with the Country model.
     * Each sight belongs to one country.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    /**
     * Attiecības ar lietotāju modeli.
     * Katru apskates objektu iesniedz kāds lietotājs.
     *
     * Relationship with the User model.
     * Each sight is submitted by a user.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'submitted_by');
    }

    /**
     * Attiecības ar atsauksmēm.
     * Vienam apskates objektam var būt vairākas atsauksmes.
     *
     * Relationship with the Review model.
     * A sight can have multiple reviews.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    /**
     * Attiecības ar favorītiem.
     * Lietotāji var pievienot apskates objektus favorītiem.
     *
     * Relationship with user favorites.
     * Users can add sights to their favorites.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function favoredByUsers()
    {
        return $this->belongsToMany(User::class, 'favorite_sights')->withTimestamps();
    }

    public function isFavoritedBy($user)
    {
        return $this->favoredByUsers()->where('user_id', $user->id)->exists();
    }
}
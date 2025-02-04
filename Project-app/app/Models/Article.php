<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Šis modelis pārstāv Ziņas sistēmu, kas ļauj administratoriem publicēt ziņas un pārvaldīt ar tiem saistītos komentārus.
 * Modelis nodrošina attiecības starp rakstu un komentāriem.
 *
 * This model represents the article system, allowing administrators to publish articles and manage associated comments.
 * The model defines the relationships between an article and its comments.
 */
class Article extends Model
{
    use HasFactory;

    /**
     * Norāda, kuri atribūti ir aizpildāmi.
     *
     * Specifies which attributes are assignable.
     */ 
    protected $fillable = ['title', 'content', 'admin_id'];

    /**
     * Šī funkcija definē attiecības starp ziņam un tā komentāriem.
     * Rakstam var būt daudzi komentāri, kas pieder tam.
     *
     * This function defines the relationship between an article and its comments.
     * An article can have many comments associated with it.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}

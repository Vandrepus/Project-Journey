<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

/**
 * Šis modelis attēlo lietotāja informāciju un attiecības ar citiem modeļiem.
 * Lietotāji var izveidot kontu, pievienot redzējumus favorītiem, atstāt ziņojumus un pārvaldīt savus profilus.
 *
 * This model represents user information and relationships with other models.
 * Users can create an account, favorite sights, submit reports, and manage their profiles.
 */
class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * Norāda, kuri atribūti ir aizpildāmi.
     *
     * Specifies which attributes are mass assignable.
     */
    protected $fillable = ['name','surname','username','email','about_me','profile_picture','password',];

     /**
     * Norāda, kuri atribūti ir slēpti serializācijai.
     *
     * Specifies which attributes should be hidden for serialization.
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

     /**
     * Norāda atribūtus, kas jākonvertē noteiktos datu tipos.
     *
     * Specifies attributes that should be cast to specific data types.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

     /**
     * Pārbauda, vai lietotājs ir administrators.
     *
     * Checks if the user is an admin.
     *
     * @return bool
     */
    public function isAdmin()
    {
        return $this->usertype === 'admin';
    }

    /**
     * Attiecības ar ziņojumu modeli.
     * Lietotājam var būt vairāki ziņojumi.
     *
     * Relationship with the Report model.
     * A user can have multiple reports.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function reports()
    {
        return $this->hasMany(Report::class);
    }

     /**
     * Attiecības ar Apskates modeli.
     * Lietotājs var pievienot vairākus Apskates vietas favorītiem.
     *
     * Relationship with the Sight model.
     * A user can favorite multiple sights.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function favoriteSights()
    {
        return $this->belongsToMany(Sight::class, 'favorite_sights')->withTimestamps();
    }

}

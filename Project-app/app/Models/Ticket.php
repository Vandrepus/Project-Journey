<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Šis modelis attēlo tehniska atbalsta sistēmā.
 * Lietotāji var izveidot Pieprasījumu ar problēmu aprakstu, kas tiek apstrādātas administrācijas panelī.
 * Pieprasījums var saturēt atbildes no administrācijas vai atbalsta komandas.
 *
 * This model represents support tickets in the system.
 * Users can create tickets describing their issues, which are handled by the admin panel.
 * Tickets can contain replies from the administration or support team.
 */
class Ticket extends Model
{
    use HasFactory;

    /**
     * Norāda, kuri atribūti ir aizpildāmi.
     *
     * Specifies which attributes are assignable.
     */ 
    protected $fillable = ['user_id', 'subject', 'message', 'category', 'status'];

    /**
     * Attiecības ar lietotāju modeli.
     * Pieprasījumu izveido kāds konkrēts lietotājs.
     *
     * Relationship with the User model.
     * A ticket is created by a specific user.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Attiecības ar pieprasījumu atbildēm.
     * Katram pieprasījumam var būt vairākas atbildes no atbalsta komandas vai administratoriem.
     *
     * Relationship with ticket replies.
     * Each ticket can have multiple replies from the support team or administrators.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function replies()
    {
        return $this->hasMany(TicketReply::class);
    }
}

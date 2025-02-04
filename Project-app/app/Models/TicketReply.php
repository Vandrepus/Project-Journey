<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Šis modelis attēlo atbildes uz atbalsta pieprasījumiem sistēmā.
 * Atbildes var sniegt gan lietotāji, gan atbalsta komanda, lai risinātu problēmas un sniegtu palīdzību.
 *
 * This model represents replies to support tickets in the system.
 * Replies can be provided by both users and the support team to resolve issues and provide assistance.
 */
class TicketReply extends Model
{
    use HasFactory;

     /**
     * Norāda, kuri atribūti ir aizpildāmi.
     *
     * Specifies which attributes are assignable.
     */ 
    protected $fillable = ['ticket_id', 'user_id', 'message'];

    /**
     * Attiecības ar "Ticket" modeli.
     * Atbilde pieder konkrētai biļetei.
     *
     * Relationship with the Ticket model.
     * A reply belongs to a specific ticket.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function ticket()
    {
        return $this->belongsTo(Ticket::class);
    }

    /**
     * Attiecības ar lietotāja modeli.
     * Atbildi sniedz konkrēts lietotājs vai atbalsta komandas dalībnieks.
     *
     * Relationship with the User model.
     * A reply is provided by a specific user or a support team member.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

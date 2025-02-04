<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Šis modelis pārstāv atbildi forumā.
 * Atbilde ir saistīta ar konkrētu tēmu un lietotāju, kurš to izveidoja.
 * Lietotāji var ziņot par atbildēm, izmantojot daudzveidīgu attiecību.
 *
 * This model represents a reply in a forum.
 * A reply is associated with a specific topic and the user who created it.
 * Users can report replies using a polymorphic relationship.
 */
class Reply extends Model
{
    use HasFactory;

    /**
     * Norāda, kuri atribūti ir aizpildāmi.
     *
     * Specifies which attributes are assignable.
     */ 
    protected $fillable = ['topic_id', 'user_id', 'content'];

    /**
     * Attiecības ar Topic modeli.
     * Viena atbilde pieder vienai tēmai.
     *
     * Relationship with the Topic model.
     * A reply belongs to a single topic.
     */
    public function topic()
    {
        return $this->belongsTo(Topic::class);
    }

    /**
     * Attiecības ar User modeli.
     * Atbildi izveido konkrēts lietotājs.
     *
     * Relationship with the User model.
     * A reply is created by a specific user.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Attiecības ar Report modeli.
     * Atbilde var tikt ziņota vairākas reizes, izmantojot polymorphic attiecības.
     *
     * Relationship with the Report model.
     * A reply can be reported multiple times using a polymorphic relationship.
     */
    public function reports()
    {
        return $this->morphMany(Report::class, 'reportable');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Šis modelis attēlo diskusiju tēmas forumā.
 * Lietotāji var izveidot tēmas, kurās citi var pievienot atbildes un diskutēt par dažādām tēmām.
 *
 * This model represents discussion topics in the forum.
 * Users can create topics where others can add replies and discuss various subjects.
 */
class Topic extends Model
{
    use HasFactory;

    /**
     * Norāda, kuri atribūti ir aizpildāmi.
     *
     * Specifies which attributes are assignable.
     */ 
    protected $fillable = [ 'user_id','title','content'];

    /**
     * Attiecības ar lietotāju modeli.
     * Tēmu izveido konkrēts lietotājs.
     *
     * Relationship with the User model.
     * A topic is created by a specific user.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Attiecības ar atbilžu modeli.
     * Tēmai var būt vairākas atbildes, kuras pievieno citi lietotāji.
     *
     * Relationship with the Reply model.
     * A topic can have multiple replies submitted by other users.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function replies()
    {
        return $this->hasMany(Reply::class);
    }
}

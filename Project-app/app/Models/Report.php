<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Šis modelis pārstāv lietotāju iesniegtos ziņojumus par nepiemērotu saturu.
 * Ziņojums var attiekties uz dažāda veida modeļiem, piemēram, komentāriem, 
 * atsauksmēm vai atbildēm, izmantojot polymorphic attiecības.
 *
 * This model represents user-submitted reports regarding inappropriate content.
 * A report can be associated with various models such as comments, 
 * reviews, or replies using polymorphic relationships.
 */
class Report extends Model
{
    /**
     * Norāda, kuri atribūti ir aizpildāmi.
     *
     * Specifies which attributes are assignable.
     */ 
    protected $fillable = ['user_id', 'reportable_id', 'reportable_type', 'reason'];

    /**
     * Attiecības ar dažādiem modeļiem, kas var tikt ziņoti.
     * Polymorphic attiecības ļauj vienam modelim attiekties uz dažādiem modeļiem.
     *
     * Relationship with different models that can be reported.
     * Polymorphic relationships allow a single model to be associated with multiple models.
     */
    public function reportable()
    {
        return $this->morphTo();
    }

    /**
     * Attiecības ar User modeli.
     * Ziņojumu iesniedz konkrēts lietotājs.
     *
     * Relationship with the User model.
     * A report is submitted by a specific user.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

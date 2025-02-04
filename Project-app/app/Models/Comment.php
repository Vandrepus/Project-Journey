<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Šis modelis pārstāv komentārus sistēmā, kas saistīti ar ziņam un lietotājiem.
 * Tas arī nodrošina komentāru ziņošanu (reportēšanu) ar daudzveidīgo attiecību palīdzību.
 *
 * This model represents comments in the system, associated with articles and users.
 * It also supports reporting comments using a polymorphic relationship.
 */
class Comment extends Model
{
    use HasFactory;

    /**
     * Norāda, kuri atribūti ir aizpildāmi.
     *
     * Specifies which attributes are assignable.
     */ 
    protected $fillable = ['article_id', 'user_id', 'comment'];

    /**
     * Definē attiecības starp komentāru un rakstu.
     * Katrs komentārs pieder vienam rakstam.
     *
     * Defines the relationship between a comment and an article.
     * Each comment belongs to a single article.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function article()
    {
        return $this->belongsTo(Article::class);
    }

    /**
     * Definē attiecības starp komentāru un lietotāju.
     * Katrs komentārs pieder vienam lietotājam.
     *
     * Defines the relationship between a comment and a user.
     * Each comment belongs to a single user.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Nodrošina komentāru ziņošanu (reportēšanu), izmantojot daudzveidīgo attiecību.
     * Komentāri var tikt saistīti ar vairākiem ziņojumiem.
     *
     * Provides reporting functionality for comments using a polymorphic relationship.
     * Comments can be associated with multiple reports.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function reports()
    {
        return $this->morphMany(Report::class, 'reportable');
    }
}

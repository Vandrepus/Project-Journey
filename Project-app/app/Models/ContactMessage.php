<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Šis modelis pārstāv kontaktu ziņojumus, kurus Viesis var nosūtīt administrācijai.
 * Katrs ziņojums satur sūtītāja vārdu, e-pasta adresi, tēmu un pašu ziņojumu.
 *
 * This model represents contact messages that Guests can send to the administration.
 * Each message contains the sender's name, email address, subject, and the message itself.
 */
class ContactMessage extends Model
{
    use HasFactory;

    /**
     * Norāda, kuri atribūti ir aizpildāmi.
     *
     * Specifies which attributes are assignable.
     */ 
    protected $fillable = ['name', 'email', 'subject', 'message'];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'flag'];

    public function sights()
    {
        return $this->hasMany(Sight::class);
    }
}

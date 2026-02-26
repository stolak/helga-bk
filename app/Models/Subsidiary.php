<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subsidiary extends Model
{
    protected $table = 'subsidiary';

    protected $fillable = [
        'slug',
        'name',
        'shortName',
        'logo',
        'tagline',
        'slogan',
        'image',
        'icon',
        'overview',
        'vision',
        'mission',
    ];

    public function activities()
    {
        return $this->hasMany(SubsidiaryActivity::class, 'subsidiaryId');
    }
}


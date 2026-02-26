<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubsidiaryActivity extends Model
{
    protected $table = 'subsidiary_activities';

    protected $fillable = [
        'subsidiaryId',
        'activities',
    ];

    public function subsidiary()
    {
        return $this->belongsTo(Subsidiary::class, 'subsidiaryId');
    }
}


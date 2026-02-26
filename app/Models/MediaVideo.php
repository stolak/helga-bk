<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MediaVideo extends Model
{
    protected $table = 'media_video';

    // Columns provided don't include timestamps; keep enabled if table has them.
    // If your table does NOT have created_at/updated_at, set $timestamps = false.
    // public $timestamps = false;

    protected $fillable = [
        'title',
        'description',
        'url',
    ];
}


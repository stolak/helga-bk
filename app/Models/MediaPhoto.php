<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MediaPhoto extends Model
{
    protected $table = 'media_photo';

    // Table uses "update_at" (not "updated_at")
    const UPDATED_AT = 'update_at';

    protected $fillable = [
        'media_categoryId',
        'description',
        'url',
    ];

    public function category()
    {
        return $this->belongsTo(MediaPhotoCategory::class, 'media_categoryId');
    }
}


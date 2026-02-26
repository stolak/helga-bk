<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MediaPhotoCategory extends Model
{
    protected $table = 'media_photo_category';

    protected $fillable = [
        'name',
        'description',
    ];

    public function photos()
    {
        return $this->hasMany(MediaPhoto::class, 'media_categoryId');
    }
}


<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Album extends Model
{
    public function albumPhotos()
    {
        return $this->hasMany(AlbumPhoto::class);
    }
}

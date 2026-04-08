<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Wedding extends Model
{
    public function weddingPhotos()
    {
        return $this->hasMany(WeddingPhoto::class);
    }
}

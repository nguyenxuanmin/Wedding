<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FeedbackPhoto extends Model
{
     public function feedback()
    {
        return $this->belongsTo(feedback::class);
    }
}

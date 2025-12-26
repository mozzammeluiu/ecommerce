<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PickupPoint extends Model
{
    public function staff(): BelongsTo
    {
    	return $this->belongsTo(Staff::class);
    }
}

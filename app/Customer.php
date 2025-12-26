<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Customer extends Model
{
    public function user(): BelongsTo
    {
    	return $this->belongsTo(user::class);
    }
}

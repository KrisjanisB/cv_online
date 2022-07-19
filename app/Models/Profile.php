<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Profile extends Model
{


    protected $fillable = ['user_id', 'phone', 'address', 'city', 'country', 'zip'];


    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function getFullAddressAttribute(): string
    {
        return $this->address . ', ' . $this->city . ', ' . $this->country . ', ' . $this->zip;
    }
}

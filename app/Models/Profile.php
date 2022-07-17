<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{


    protected $fillable = ['user_id', 'phone', 'address', 'city', 'country', 'zip'];


    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function getFullAddressAttribute(): string
    {
        return $this->address . ', ' . $this->city . ', ' . $this->country . ', ' . $this->zip;
    }
}

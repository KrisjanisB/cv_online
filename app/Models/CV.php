<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class CV extends Model
{
    protected $table = 'cvs';

    protected $fillable = [
        'user_id',
        'is_published',
        'is_draft',
    ];

    protected $appends = [
        'education',
        'work',
        'user_is_owner'
    ];

    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function education(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Education::class, 'cv_id')->orderBy('order', 'asc');
    }

    public function work(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(WorkExperience::class, 'cv_id')->orderBy('order', 'asc');
    }

   public function scopePublicAccessable($query)
    {
        return $query->where('is_draft', false)
            ->where('is_published', true)
            ->orderBy('created_at', 'desc')
            ->with('user:id,name,email,surname')
            ->with('user.profile:id,user_id,city,country,address,phone');
    }

    public function scopeOwner($query)
    {
        return $this->scopePublicAccessable();
    }

    public function getEducationAttribute()
    {
        return $this->education()->orderBy('order', 'desc')->get();
    }

    public function getWorkAttribute()
    {
        return $this->work()->orderBy('order', 'desc')->get();
    }

    public function getUserIsOwnerAttribute()
    {
        if (Auth::id() == $this->user_id) {
            return true;
        } else {
            return false;
        }
    }

    public function updatePublishedState()
    {
        $this->is_published = !$this->is_published;
    }
}

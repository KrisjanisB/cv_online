<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CV extends Model
{
    protected $table = 'cvs';

    protected $fillable = [
        'user_id',
        'is_active',
        'is_published',
        'is_draft',
    ];

    protected $appends = [
        'education',
        'workExperiance',
    ];

    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function education(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Education::class, 'cv_id');
    }

    public function workExperiance(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(WorkExperience::class, 'cv_id');
    }

    public function getEducationAttribute()
    {
        return $this->education()->orderBy('order', 'desc')->get();
    }

    public function getWorkExperianceAttribute()
    {
        return $this->workExperiance()->orderBy('order', 'desc')->get();
    }
}

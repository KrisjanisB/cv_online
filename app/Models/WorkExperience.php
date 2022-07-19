<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class WorkExperience extends Model
{


    protected $fillable = [
        'cv_id',
        'user_id',
        'employer',
        'position',
        'start_date',
        'end_date',
        'description',
        'country',
        'city',
        'is_full_time',
        'is_active',
        'order'
    ];


    protected $dates = ['start_date', 'end_date'];

    public static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            $model->user_id = auth()->user()->id;
        });

    }

    public function cv(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(CV::class, 'cv_id');
    }

    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function getFormatedDateAttribute(): string
    {
        if ($this->end_date != null && !$this->is_active) {
            return $this->start_date->format('d/m/Y') . ' - ' . $this->end_date->format('d/m/Y');
        } else {
            return $this->start_date->format('d/m/Y') . ' - ' . 'Present';
        }

    }
}

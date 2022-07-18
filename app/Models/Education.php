<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Education extends Model
{

    protected $fillable = [
        'cv_id',
        'user_id',
        'institution',
        'degree',
        'faculty',
        'speciality',
        'start_date',
        'end_date',
        'description',
        'country',
        'is_finished',
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

    public const EDUCATION_LEVELS = ['Basic', 'Secondary', 'Vocational', 'Bachelor', 'Master', 'PhD'];

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

        if($this->end_date != null && $this->is_finished) {
            return $this->start_date->format('d/m/Y') . ' - ' .   $this->end_date->format('d/m/Y');
        } else {
            return $this->start_date->format('d/m/Y') . ' - ' . 'Present';
        }

    }


}

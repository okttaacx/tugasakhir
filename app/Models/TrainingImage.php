<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrainingImage extends Model
{
    use HasFactory;

    protected $table = 'training_images';

    protected $fillable = [
        'training_id',
        'image_path',
        'is_primary',
        'sort_order',
    ];

    protected $casts = [
        'is_primary' => 'boolean',
    ];

    /**
     * Relasi belongsTo ke model Training
     */
    public function training()
    {
        return $this->belongsTo(Training::class);
    }

    /**
     * Scope untuk mendapatkan gambar utama
     */
    public function scopePrimary($query)
    {
        return $query->where('is_primary', true);
    }

    /**
     * Scope untuk ordering gambar
     */
    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order')->orderBy('created_at');
    }
}
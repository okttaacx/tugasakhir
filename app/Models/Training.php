<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Training extends Model
{
    use HasFactory;

    protected $table = 'trainings';

    protected $fillable = [
        'title',
        'description',
        'start_date',
        'start_time',
        'end_date',
        'end_time',
        'capacity',
        'location',
        'image', // Keep for backward compatibility
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
    ];

    /**
     * Relasi hasMany ke TrainingImage
     */
    public function images()
    {
        return $this->hasMany(TrainingImage::class)->ordered();
    }

    /**
     * Get gambar utama (relasi)
     */
    public function primaryImage()
    {
        return $this->hasOne(TrainingImage::class)->where('is_primary', true);
    }

    /**
     * Relasi hasManyThrough untuk mendapatkan peserta pelatihan (User) melalui Registration.
     */
    public function participants()
    {
        return $this->hasManyThrough(User::class, Registration::class, 'training_id', 'id', 'id', 'user_id');
    }

    /**
     * Relasi hasMany ke model Registration, untuk mencatat siapa saja yang mendaftar.
     */
    public function registrations()
    {
        return $this->hasMany(Registration::class, 'training_id');
    }
}
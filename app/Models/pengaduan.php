<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengaduan extends Model
{
    use HasFactory;

    protected $table = 'pengaduan';

    protected $fillable = [
        'user_id',
        'nama_lengkap',
        'institusi',
        'alamat_institusi',
        'no_telp',
        'masalah_pengaduan',
        'balasan_admin',
        'tanggal_balasan',
        'status'
    ];

    protected $dates = [
        'tanggal_balasan',
        'created_at',
        'updated_at'
    ];

    protected $casts = [
        'tanggal_balasan' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    public function scopeDibalas($query)
    {
        return $query->where('status', 'dibalas');
    }
}
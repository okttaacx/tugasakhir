<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Visit extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'ip_address',
        'user_agent',
        'visit_date',
        'session_token',
    ];

    protected $casts = [
        'visit_date' => 'date',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Check if visit already exists for authenticated user
     */
    public static function userVisitExists(int $userId, string $sessionToken): bool
    {
        return self::where('user_id', $userId)
            ->where('session_token', $sessionToken)
            ->where('visit_date', now()->toDateString())
            ->exists();
    }

    /**
     * Check if visit already exists for guest user
     */
    public static function guestVisitExists(string $ipAddress): bool
    {
        return self::whereNull('user_id')
            ->where('ip_address', $ipAddress)
            ->where('visit_date', now()->toDateString())
            ->exists();
    }

    /**
     * Record new visit
     */
    public static function recordVisit(?int $userId, string $ipAddress, string $userAgent, ?string $sessionToken = null): void
    {
        self::create([
            'user_id' => $userId,
            'ip_address' => $ipAddress,
            'user_agent' => $userAgent,
            'visit_date' => now()->toDateString(),
            'session_token' => $sessionToken,
        ]);
    }
}

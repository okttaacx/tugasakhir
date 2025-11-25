<?php

namespace App\Services;

use App\Models\Visit;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class VisitTracker
{
    public function trackVisit(Request $request): void
    {
        $ipAddress = $this->getClientIpAddress($request);
        $userAgent = $request->userAgent() ?? '';

        if (Auth::check()) {
            $this->trackAuthenticatedUserVisit($ipAddress, $userAgent);
        } else {
            $this->trackGuestVisit($ipAddress, $userAgent);
        }
    }

    private function trackAuthenticatedUserVisit(string $ipAddress, string $userAgent): void
    {
        $userId = Auth::id();
        $sessionToken = session()->getId();

        // Double check dengan database locking
        $exists = Visit::where('user_id', $userId)
            ->where('session_token', $sessionToken)
            ->where('visit_date', now()->toDateString())
            ->lockForUpdate()
            ->exists();

        if (!$exists) {
            Visit::recordVisit($userId, $ipAddress, $userAgent, $sessionToken);
        }
    }

    private function trackGuestVisit(string $ipAddress, string $userAgent): void
    {
        // Double check dengan database locking
        $exists = Visit::whereNull('user_id')
            ->where('ip_address', $ipAddress)
            ->where('visit_date', now()->toDateString())
            ->lockForUpdate()
            ->exists();

        if (!$exists) {
            Visit::recordVisit(null, $ipAddress, $userAgent);
        }
    }

    private function getClientIpAddress(Request $request): string
    {
        // Priority urutan untuk mendapatkan real IP
        $ipKeys = [
            'HTTP_X_FORWARDED_FOR',
            'HTTP_X_REAL_IP',
            'HTTP_CLIENT_IP',
            'REMOTE_ADDR'
        ];

        foreach ($ipKeys as $key) {
            if ($request->server($key)) {
                $ip = $request->server($key);
                // Jika ada multiple IP, ambil yang pertama
                if (strpos($ip, ',') !== false) {
                    $ip = trim(explode(',', $ip)[0]);
                }

                // Validasi IP
                if (filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE)) {
                    return $ip;
                }
            }
        }

        // Fallback ke REMOTE_ADDR jika tidak ada IP valid
        return $request->ip();
    }
}

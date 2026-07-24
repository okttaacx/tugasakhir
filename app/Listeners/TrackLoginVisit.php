<?php

// File: app/Listeners/TrackLoginVisit.php

namespace App\Listeners;

use App\Models\Visit;
use Illuminate\Auth\Events\Login;
use Illuminate\Http\Request;

class TrackLoginVisit
{
    public function handle(Login $event): void
    {
        $request = request();

        if (!$request) return;

        $userId = $event->user->id;
        $sessionToken = session()->getId();
        $ipAddress = $this->getClientIp($request);
        $userAgent = $request->userAgent() ?? '';

        // Cek apakah sudah ada visit untuk session dan tanggal ini
        $exists = Visit::where('user_id', $userId)
            ->where('ip_address', $ipAddress)
            ->where('visit_date', now()->toDateString())
            ->exists();

        // Catat hanya jika belum ada untuk session ini hari ini
        if (!$exists) {
            Visit::recordVisit($userId, $ipAddress, $userAgent);
        }
    }

    private function getClientIp(Request $request): string
    {
        $ipKeys = ['HTTP_X_FORWARDED_FOR', 'HTTP_X_REAL_IP', 'HTTP_CLIENT_IP', 'REMOTE_ADDR'];

        foreach ($ipKeys as $key) {
            if ($request->server($key)) {
                $ip = trim(explode(',', $request->server($key))[0]);
                if (filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE)) {
                    return $ip;
                }
            }
        }

        return $request->ip();
    }
}

<?php

namespace App\Http\Middleware;

use App\Services\VisitTracker;
use Closure;
use Illuminate\Http\Request;

class TrackVisits
{
    private VisitTracker $visitTracker;

    public function __construct(VisitTracker $visitTracker)
    {
        $this->visitTracker = $visitTracker;
    }

    public function handle(Request $request, Closure $next)
    {
        // Track visit setelah response
        $response = $next($request);

        // Track untuk semua request web kecuali yang dikecualikan
        if (
            $request->isMethod('GET') &&
            !$request->expectsJson() &&
            !$request->is('api/*') &&
            !str_starts_with($request->path(), '_') &&
            $request->path() !== 'favicon.ico'
        ) {

            // Track untuk semua request web kecuali yang dikecualikan
            if (
                $request->isMethod('GET') &&
                !$request->expectsJson() &&
                !$request->is('api/*') &&
                !str_starts_with($request->path(), '_') &&
                $request->path() !== 'favicon.ico'
            ) {

                try {
                    \Log::info('Tracking visit for: ' . $request->path(), [
                        'ip' => $request->ip(),
                        'user_id' => auth()->id(),
                        'session' => session()->getId()
                    ]);

                    $this->visitTracker->trackVisit($request);
                } catch (\Exception $e) {
                    // Log error tapi jangan interrupt response
                    \Log::error('Visit tracking failed: ' . $e->getMessage(), [
                        'path' => $request->path(),
                        'ip' => $request->ip(),
                        'user_id' => auth()->id()
                    ]);
                }
            }
        }

        return $response;
    }
}

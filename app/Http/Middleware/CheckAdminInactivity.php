<?php

namespace App\Http\Middleware;

use App\Helpers\ApiResponseHelper;
use Closure;
use Illuminate\Http\Request;
use Carbon\Carbon;

class CheckAdminInactivity
{
    public function handle(Request $request, Closure $next)
    {
        $user = auth()->user();
        if ($user && $user->role === 'admin') {
            $lastActivity = $user->last_activity_at;

            if ($lastActivity) {
                // Calculate inactivity duration
                $inactivityDuration = Carbon::parse($lastActivity)->diffInMinutes(now());

                if ($inactivityDuration > 15) {
                    $user->currentAccessToken()->delete();

                    return ApiResponseHelper::error('Your session has expired due to inactivity. Please login again.', 401);
                }
            }

            $user->update(['last_activity_at' => now()]);
        }

        return $next($request);
    }
}

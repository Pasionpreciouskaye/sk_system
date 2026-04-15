<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class AccessLogger
{
    // DDoS threshold: requests per minute per IP before flagging
    private const DDOS_THRESHOLD = 100;
    private const DDOS_WINDOW = 60; // seconds

    public function handle(Request $request, Closure $next)
    {
        $ip = $request->ip();
        $method = $request->method();
        $path = $request->path();
        $userAgent = substr($request->userAgent() ?? 'unknown', 0, 150);

        // ── Track request rate per IP ──
        $rateKey = "access_rate:{$ip}";
        $requestCount = Cache::get($rateKey, 0) + 1;
        Cache::put($rateKey, $requestCount, self::DDOS_WINDOW);

        // ── Flag potential DDoS ──
        if ($requestCount > self::DDOS_THRESHOLD) {
            Log::channel('security')->warning('Potential DDoS detected', [
                'ip'      => $ip,
                'count'   => $requestCount,
                'path'    => $path,
                'method'  => $method,
                'agent'   => $userAgent,
            ]);
        }

        // ── Log access (skip assets to reduce noise) ──
        if (!$this->isAsset($path)) {
            $userId = optional($request->user())->id ?? 'guest';
            Log::channel('access')->info('HTTP ' . $method, [
                'ip'     => $ip,
                'user'   => $userId,
                'path'   => '/' . $path,
                'method' => $method,
                'agent'  => $userAgent,
            ]);
        }

        return $next($request);
    }

    private function isAsset(string $path): bool
    {
        return preg_match('/\.(css|js|png|jpg|jpeg|gif|webp|svg|ico|woff|woff2|ttf)$/i', $path);
    }
}

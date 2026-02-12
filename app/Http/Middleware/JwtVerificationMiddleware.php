<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class JwtVerificationMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        try {
            if ($token = $request->cookie('token')) {
                $user = \PHPOpenSourceSaver\JWTAuth\Facades\JWTAuth::setToken($token)->authenticate();
                if (!$user) {
                    return redirect()->route('login')->withErrors(['email' => 'Session expired, please login again.']);
                }
            } else {
                return redirect()->route('login')->withErrors(['email' => 'Unauthorized access, please login.']);
            }
        } catch (\PHPOpenSourceSaver\JWTAuth\Exceptions\TokenExpiredException $e) {
            return redirect()->route('login')->withErrors(['email' => 'Token has expired.']);
        } catch (\PHPOpenSourceSaver\JWTAuth\Exceptions\TokenInvalidException $e) {
            return redirect()->route('login')->withErrors(['email' => 'Token is invalid.']);
        } catch (\PHPOpenSourceSaver\JWTAuth\Exceptions\JWTException $e) {
            return redirect()->route('login')->withErrors(['email' => 'Token not found.']);
        }

        return $next($request);
    }
}

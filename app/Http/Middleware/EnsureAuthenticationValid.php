<?php

namespace App\Http\Middleware;

use App\Models\User;
use App\Models\UserTrack;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureAuthenticationValid
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!User::authenticated()) {
            return redirect('/login')->with('alert', [
                'icon' => 'error',
                'title' => 'Gagal!',
                'text' => 'Sesi tidak valid, silahkan login terlebih dahulu',
            ]);
        }

        $method = $request->method();
        if ($method != 'POST') {
            return $next($request);
        }

        // User Tracker
        $addressType = null;
        $address = null;
        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
            $addressType = 'HTTP_CLIENT_IP';
            $address = $_SERVER['HTTP_CLIENT_IP'];
        } else if (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $addressType = 'HTTP_X_FORWARDED_FOR';
            $address = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } else if (!empty($_SERVER['REMOTE_ADDR'])) {
            $addressType = 'REMOTE_ADDR';
            $address = $_SERVER['REMOTE_ADDR'];
        }
        $userTrack = new UserTrack();
        $userTrack->id_user = session('loggedIn')['id_user'];
        $userTrack->address_type = $addressType;
        $userTrack->address = $address;
        $userTrack->method = $method;
        $userTrack->prompt = $request->path();
        $userTrack->save();

        return $next($request);
    }
}

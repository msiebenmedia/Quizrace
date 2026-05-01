<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\QuizRaceUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class QuizRaceLoginController extends Controller
{
    public function showLogin()
    {
        if (session()->has('quizrace_token')) {
            return redirect()->route('dashboard');
        }

        return view('auth.login');
    }

    public function login(Request $request)
    {
        $validated = $request->validate([
            'login' => ['required', 'string'],
            'password' => ['required', 'string'],
        ]);

        $response = Http::acceptJson()->post(config('services.mentix.api_url') . '/auth/login', [
            'login' => $validated['login'],
            'password' => $validated['password'],
            'device_name' => 'QuizRace Webseite',
        ]);

        if (! $response->successful()) {
            return back()
                ->withInput($request->only('login'))
                ->withErrors([
                    'login' => 'Login fehlgeschlagen. Bitte prüfe deine Daten.',
                ]);
        }

        $data = $response->json();
        $user = $data['user'] ?? null;
        $token = $data['access_token'] ?? null;

        if (! $user || ! isset($user['id']) || ! $token) {
            return back()
                ->withInput($request->only('login'))
                ->withErrors([
                    'login' => 'Ungültige Antwort vom Login-Server.',
                ]);
        }

        QuizRaceUser::updateOrCreate(
            [
                'mentix_user_id' => $user['id'],
            ],
            [
                'last_login_at' => now(),
            ]
        );

        session([
            'quizrace_token' => $token,
            'quizrace_user' => $user,
        ]);

        return redirect()->route('dashboard');
    }

    public function logout(Request $request)
    {
        $token = session('quizrace_token');

        if ($token) {
            Http::acceptJson()
                ->withToken($token)
                ->post(config('services.mentix.api_url') . '/auth/logout');
        }

        $request->session()->forget([
            'quizrace_token',
            'quizrace_user',
        ]);

        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
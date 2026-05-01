<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\QuizRaceUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class MentixAuthController extends Controller
{
    public function login(Request $request)
    {
        $validated = $request->validate([
            'login' => ['required', 'string'],
            'password' => ['required', 'string'],
        ]);

        $response = Http::acceptJson()->post(config('services.mentix.api_url') . '/auth/login', [
            'login' => $validated['login'],
            'password' => $validated['password'],
            'device_name' => 'QuizRace',
        ]);

        if (! $response->successful()) {
            return response()->json([
                'message' => 'Login fehlgeschlagen.',
                'errors' => $response->json(),
            ], $response->status());
        }

        $data = $response->json();
        $user = $data['user'] ?? null;

        if (! $user || ! isset($user['id'])) {
            return response()->json([
                'message' => 'Ungültige Antwort vom Mentix-Login.',
            ], 422);
        }

        QuizRaceUser::updateOrCreate(
            [
                'mentix_user_id' => $user['id'],
            ],
            [
                'last_login_at' => now(),
            ]
        );

        return response()->json([
            'access_token' => $data['access_token'],
            'token_type' => $data['token_type'] ?? 'Bearer',
            'user' => $user,
        ]);
    }

    public function me(Request $request)
    {
        $token = $request->bearerToken();

        if (! $token) {
            return response()->json([
                'message' => 'Kein Token übergeben.',
            ], 401);
        }

        $response = Http::acceptJson()
            ->withToken($token)
            ->get(config('services.mentix.api_url') . '/auth/me');

        if (! $response->successful()) {
            return response()->json([
                'message' => 'Nicht authentifiziert.',
            ], 401);
        }

        $data = $response->json();
        $user = $data['user'] ?? null;

        if ($user && isset($user['id'])) {
            QuizRaceUser::updateOrCreate(
                [
                    'mentix_user_id' => $user['id'],
                ],
                [
                    'last_login_at' => now(),
                ]
            );
        }

        return response()->json($data);
    }

    public function logout(Request $request)
    {
        $token = $request->bearerToken();

        if ($token) {
            Http::acceptJson()
                ->withToken($token)
                ->post(config('services.mentix.api_url') . '/auth/logout');
        }

        return response()->json([
            'message' => 'Ausgeloggt.',
        ]);
    }
}
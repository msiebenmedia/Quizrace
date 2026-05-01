<!DOCTYPE html>
<html lang="de" data-theme="dark">
<head>
    <meta charset="UTF-8">
    <title>QuizRace Dashboard</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-base-200">
    <div class="navbar bg-base-100 border-b border-base-300 px-6">
        <div class="flex-1">
            <a href="{{ route('dashboard') }}" class="text-xl font-bold">
                🏁 QuizRace
            </a>
        </div>

        <div class="flex-none gap-3">
            <div class="text-sm text-base-content/70 hidden sm:block">
                {{ $user['name'] ?? $user['email'] ?? 'User' }}
            </div>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button class="btn btn-ghost btn-sm">
                    Logout
                </button>
            </form>
        </div>
    </div>

    <main class="max-w-6xl mx-auto p-6 space-y-6">
        <div class="hero bg-base-100 rounded-2xl border border-base-300">
            <div class="hero-content text-center py-12">
                <div>
                    <div class="text-6xl mb-4">🏎️</div>
                    <h1 class="text-4xl font-bold">
                        Willkommen bei QuizRace
                    </h1>
                    <p class="py-4 text-base-content/70">
                        Du bist erfolgreich eingeloggt.
                    </p>

                    <div class="badge badge-primary badge-lg">
                        Mentix User-ID: {{ $user['id'] ?? 'unbekannt' }}
                    </div>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div class="card bg-base-100 border border-base-300 shadow">
                <div class="card-body">
                    <h2 class="card-title">Rennen</h2>
                    <p class="text-base-content/60">
                        Hier landen später deine aktiven QuizRace-Spiele.
                    </p>
                </div>
            </div>

            <div class="card bg-base-100 border border-base-300 shadow">
                <div class="card-body">
                    <h2 class="card-title">Coins</h2>
                    <p class="text-base-content/60">
                        Später: externe Währung, Cosmetics und Belohnungen.
                    </p>
                </div>
            </div>

            <div class="card bg-base-100 border border-base-300 shadow">
                <div class="card-body">
                    <h2 class="card-title">Spielfigur</h2>
                    <p class="text-base-content/60">
                        Später: Outfit, Hut, Gesicht und eigene Figur.
                    </p>
                </div>
            </div>
        </div>
    </main>
</body>
</html>
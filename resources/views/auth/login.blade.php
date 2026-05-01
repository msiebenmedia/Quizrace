<!DOCTYPE html>
<html lang="de" data-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QuizRace Login</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen bg-base-200 text-base-content">
    <main class="relative min-h-screen overflow-hidden flex items-center justify-center px-4 py-10">

        <div class="absolute inset-0 pointer-events-none">
            <div class="absolute -top-40 -left-40 h-96 w-96 rounded-full bg-primary/25 blur-3xl"></div>
            <div class="absolute top-1/3 -right-32 h-96 w-96 rounded-full bg-secondary/20 blur-3xl"></div>
            <div class="absolute -bottom-32 left-1/3 h-80 w-80 rounded-full bg-accent/20 blur-3xl"></div>
        </div>

        <section class="relative w-full max-w-5xl grid lg:grid-cols-2 gap-6 items-stretch">

            <div class="hidden lg:flex card bg-base-100/70 backdrop-blur-xl border border-base-300 shadow-2xl overflow-hidden">
                <div class="card-body justify-between">
                    <div>
                        <div class="badge badge-primary badge-lg gap-2 mb-6">
                            🏁 QuizRace
                        </div>

                        <h1 class="text-5xl font-black leading-tight">
                            Bereit für das nächste Quiz-Rennen?
                        </h1>

                        <p class="mt-5 text-base-content/70 text-lg">
                            Logge dich ein, wähle dein Quiz und zeig deinen Freunden,
                            wer auf der Strecke wirklich Gas gibt.
                        </p>
                    </div>

                    <div class="grid grid-cols-3 gap-3">
                        <div class="rounded-2xl bg-base-200 border border-base-300 p-4">
                            <div class="text-3xl mb-2">⚡</div>
                            <div class="font-bold">Schnell</div>
                            <div class="text-xs text-base-content/50">Live Quiz</div>
                        </div>

                        <div class="rounded-2xl bg-base-200 border border-base-300 p-4">
                            <div class="text-3xl mb-2">🎮</div>
                            <div class="font-bold">Multiplayer</div>
                            <div class="text-xs text-base-content/50">2-6 Spieler</div>
                        </div>

                        <div class="rounded-2xl bg-base-200 border border-base-300 p-4">
                            <div class="text-3xl mb-2">🏆</div>
                            <div class="font-bold">Rennen</div>
                            <div class="text-xs text-base-content/50">Punkte & Items</div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card bg-base-100/90 backdrop-blur-xl border border-base-300 shadow-2xl">
                <div class="card-body p-7 sm:p-9">

                    <div class="text-center mb-7">
                        <div class="mx-auto mb-5 h-28 w-28 rounded-[2rem] bg-base-200 border border-base-300 shadow-xl flex items-center justify-center overflow-hidden">
                            <img
                                src="{{ asset('images/logo.png') }}"
                                alt="QuizRace Logo"
                                class="h-full w-full object-contain p-3"
                            >
                        </div>

                        <h2 class="text-3xl font-black">
                            Willkommen zurück
                        </h2>

                        <p class="text-base-content/60 mt-2">
                            Melde dich mit deinem Mentix-Account an.
                        </p>
                    </div>

                    @if ($errors->any())
                        <div class="alert alert-error mb-5">
                            <span class="text-xl">⚠️</span>
                            <span>{{ $errors->first() }}</span>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('login.store') }}" class="space-y-4">
                        @csrf

                        <div class="form-control">
                            <label class="label">
                                <span class="label-text font-semibold">Benutzername oder E-Mail</span>
                            </label>

                            <input
                                type="text"
                                name="login"
                                value="{{ old('login') }}"
                                class="input input-bordered input-lg w-full"
                                placeholder="dein-name oder mail@example.de"
                                required
                                autofocus
                            >
                        </div>

                        <div class="form-control">
                            <label class="label">
                                <span class="label-text font-semibold">Passwort</span>
                            </label>

                            <input
                                type="password"
                                name="password"
                                class="input input-bordered input-lg w-full"
                                placeholder="••••••••"
                                required
                            >
                        </div>

                        <button type="submit" class="btn btn-primary btn-lg w-full mt-2">
                            Einloggen
                        </button>
                    </form>

                    <div class="divider text-base-content/40">QuizRace</div>

                    <div class="rounded-2xl bg-base-200 border border-base-300 p-4 text-center">
                        <p class="text-sm text-base-content/60">
                            Authentifizierung über
                            <span class="font-bold text-base-content">mentix.pandaric.de</span>
                        </p>
                    </div>

                </div>
            </div>

        </section>
    </main>
</body>
</html>
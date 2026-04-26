<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login - Portal PPDB</title>
    <link rel="shortcut icon" href="{{ asset('logo-amt.webp') }}" type="image/webp">
    @vite(['resources/css/app.css'])
</head>

<body
    class="font-display bg-background-light dark:bg-background-dark text-slate-900 dark:text-slate-100 min-h-screen flex flex-col">
    <!-- Main Content Area with Background Gradient -->
    <main class="flex-1 flex flex-col items-center justify-center p-6 relative overflow-hidden">
        <!-- Subtle Green Gradient/Pattern Background -->
        <div
            class="absolute inset-0 z-0 opacity-10 pointer-events-none bg-[radial-gradient(circle_at_top_right,var(--tw-gradient-stops))] from-primary via-transparent to-transparent">
        </div>
        <div class="absolute inset-0 z-0 opacity-5 pointer-events-none"
            data-alt="Subtle geometric architectural pattern background">
            <svg height="100%" width="100%" xmlns="http://www.w3.org/2000/svg">
                <defs>
                    <pattern id="grid" x="0" y="0" width="40" height="40" patternUnits="userSpaceOnUse">
                        <path d="M 40 0 L 0 0 0 40" fill="none" stroke="currentColor" stroke-width="1"></path>
                    </pattern>
                </defs>
                <rect width="100%" height="100%" fill="url(#grid)"></rect>
            </svg>
        </div>
        <!-- Central Authentication Card -->
        <div
            class="relative z-10 w-full max-w-md bg-white dark:bg-slate-900 rounded-xl shadow-xl border border-primary/5 overflow-hidden">
            <!-- Login Form Content -->
            <div class="p-8">
                <div class="flex flex-col items-center gap-2 mb-6">
                    <div class="rtext-primary flex items-center justify-center">
                        <img class="w-20 h-20 object-contain" src="{{ asset('logo-amt.webp') }}" alt="Logo AMT">
                    </div>
                    <!-- <div class="text-center">
                        <h1 class="text-xl font-bold leading-tight tracking-tight">PPDB <span
                                class="text-primary">Unggul</span></h1>
                    </div> -->
                </div>
                <div class="text-center mb-8">
                    <h2 class="text-2xl font-bold text-slate-900 dark:text-white">Login</h2>
                    <p class="text-slate-500 dark:text-slate-400 text-sm mt-2">Silakan masuk menggunakan akun Anda</p>
                </div>
                <form class="space-y-5" onsubmit="return false;">
                    <!-- Username/NISN Field -->
                    <div class="space-y-2">
                        <label class="block text-sm font-medium text-slate-700 dark:text-slate-300" for="nisn">Email
                            /Username</label>
                        <div class="relative">
                            <iconify-icon icon="lucide:user"
                                class="absolute left-3 top-1/2 -translate-y-1/2 text-slate-400 text-xl"></iconify-icon>
                            <input
                                class="w-full pl-10 pr-4 py-3 bg-slate-50 dark:bg-slate-800 border-transparent focus:border-primary focus:ring-2 focus:ring-primary/20 rounded-lg text-sm transition-all shadow-sm"
                                id="nisn" placeholder="Contoh: 0012345678" type="text" />
                        </div>
                    </div>
                    <!-- Password Field -->
                    <div class="space-y-2">
                        <div class="flex justify-between items-center">
                            <label class="block text-sm font-medium text-slate-700 dark:text-slate-300"
                                for="password">Kata Sandi</label>
                            <a class="text-xs text-primary hover:underline font-medium" href="#">Lupa sandi?</a>
                        </div>
                        <div class="relative">
                            <iconify-icon icon="lucide:lock"
                                class="absolute left-3 top-1/2 -translate-y-1/2 text-slate-400 text-xl"></iconify-icon>
                            <input
                                class="w-full pl-10 pr-4 py-3 bg-slate-50 dark:bg-slate-800 border-transparent focus:border-primary focus:ring-2 focus:ring-primary/20 rounded-lg text-sm transition-all shadow-sm"
                                id="password" placeholder="••••••••" type="password" />
                        </div>
                    </div>
                    <!-- Remember Me -->
                    <div class="flex items-center">
                        <input class="w-4 h-4 text-primary bg-slate-100 border-slate-300 rounded focus:ring-primary"
                            id="remember" type="checkbox" />
                        <label class="ml-2 block text-sm text-slate-500 dark:text-slate-400" for="remember">Ingat
                            perangkat ini</label>
                    </div>
                    <!-- Primary Action Button -->
                    <a href="/dashboard"
                        class="w-full py-3.5 bg-accent hover:bg-amber-600 text-white font-bold rounded-lg shadow-lg shadow-accent/20 transition-all flex items-center justify-center gap-2 mt-4 group">
                        <span>Masuk ke Akun</span>
                        <iconify-icon icon="lucide:arrow-right" class="text-xl group-hover:translate-x-1 transition-transform"></iconify-icon>
                    </a>

                    <div class="relative py-4">
                        <div class="absolute inset-0 flex items-center">
                            <div class="w-full border-t border-slate-200 dark:border-slate-800"></div>
                        </div>
                        <div class="relative flex justify-center text-xs uppercase">
                            <span class="bg-white dark:bg-slate-900 px-2 text-slate-500">Atau masuk dengan</span>
                        </div>
                    </div>

                    <button
                        class="w-full py-3.5 bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 text-slate-700 dark:text-slate-200 font-semibold rounded-lg hover:bg-slate-50 dark:hover:bg-slate-700 transition-all flex items-center justify-center gap-3 group"
                        type="button">
                        <svg class="size-5" viewbox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"
                                fill="#4285F4"></path>
                            <path
                                d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"
                                fill="#34A853"></path>
                            <path
                                d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l3.66-2.84z"
                                fill="#FBBC05"></path>
                            <path
                                d="M12 5.38c1.62 0 3.06.56 4.21 1.66l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z"
                                fill="#EA4335"></path>
                        </svg>
                        <span>Google</span>
                    </button>
                </form>
                <p class="text-center text-sm text-slate-500 dark:text-slate-400 mt-6">
                    Belum punya akun? <a href="/register" class="text-primary font-bold hover:underline">Daftar di
                        sini</a>
                </p>
            </div>
        </div>
    </main>

    <script src="https://code.iconify.design/iconify-icon/2.1.0/iconify-icon.min.js"></script>
</body>

</html>

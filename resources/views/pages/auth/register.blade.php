<x-auth-layout title="Daftar">
    {{-- <div class="mb-6">
        <h2 class="text-xl font-black text-green-950 uppercase tracking-tight">Pendaftaran Akun</h2>
        <p class="text-slate-500 text-sm">Buat akun portal pendaftaran untuk memulai proses aplikasi Anda.</p>
    </div> --}}

    <form action="{{ route('register') }}" method="POST" class="space-y-4">
        @csrf
        <div class="text-center mb-8">
            <div class="inline-flex items-center justify-center size-18 mb-4">
                <img src="{{ asset('logo-amt.webp') }}" alt="Logo" class="size-18">
            </div>
            <h1 class="text-lg font-black text-green-950 uppercase tracking-tighter">Daftar Akun</h1>
            <p class="text-slate-500 text-sm mt-1">Daftarkan akun anda untuk melakukan pendaftaran</p>
        </div>
        <x-form-input
            type="text"
            name="name"
            id="name"
            :value="old('name')"
            required
            label="Nama Lengkap"
            icon="user-plus"
        />

        <x-form-input
            type="text"
            name="username"
            id="username"
            :value="old('username')"
            required
            label="Username"
            icon="at-sign"
        />

        <x-form-input
            type="email"
            name="email"
            id="email"
            :value="old('email')"
            required
            label="Alamat Email"
            icon="mail"
        />

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4" x-data="{ showPassword: false, showConfirmPassword: false }">
            <x-form-input
                x-bind:type="showPassword ? 'text' : 'password'"
                name="password"
                id="password"
                required
                label="Password"
                icon="lock"
            >
                <x-slot:suffix>
                    <button type="button" @click="showPassword = !showPassword" class="text-slate-400 hover:text-emerald-800 dark:hover:text-white transition-colors focus:outline-none flex items-center h-full" title="Tampilkan/Sembunyikan Password">
                        <iconify-icon :icon="showPassword ? 'lucide:eye-off' : 'lucide:eye'" class="text-xl"></iconify-icon>
                    </button>
                </x-slot:suffix>
            </x-form-input>

            <x-form-input
                x-bind:type="showConfirmPassword ? 'text' : 'password'"
                name="password_confirmation"
                id="password_confirmation"
                required
                label="Konfirmasi Password"
                icon="shield-check"
            >
                <x-slot:suffix>
                    <button type="button" @click="showConfirmPassword = !showConfirmPassword" class="text-slate-400 hover:text-emerald-800 dark:hover:text-white transition-colors focus:outline-none flex items-center h-full" title="Tampilkan/Sembunyikan Konfirmasi Password">
                        <iconify-icon :icon="showConfirmPassword ? 'lucide:eye-off' : 'lucide:eye'" class="text-xl"></iconify-icon>
                    </button>
                </x-slot:suffix>
            </x-form-input>
        </div>

        {{-- <div class="flex items-center gap-3 py-2">
            <input type="checkbox" required class="rounded-sm border-slate-300 text-green-900 focus:ring-green-900 size-4">
            <span class="text-[10px] text-slate-500 uppercase tracking-wide">Saya setuju dengan <a href="#" class="font-bold text-green-900 border-b border-green-900/30">Syarat & Ketentuan</a> pendaftaran.</span>
        </div> --}}

        <button type="submit" 
            class="w-full bg-green-900 text-white py-4 rounded-sm font-black uppercase tracking-[0.2em] text-xs hover:bg-green-800 transition-all shadow-xl shadow-green-900/20 active:scale-[0.98]">
            Buat Akun
        </button>
    </form>

    <div class="mt-8 pt-6 border-t border-slate-100 text-center">
        <p class="text-sm text-slate-500">
            Sudah punya akun? 
            <a href="{{ route('login') }}" class="font-black text-green-900 hover:text-yellow-600 transition-colors uppercase tracking-widest ml-1">Masuk Kembali</a>
        </p>
    </div>
</x-auth-layout>

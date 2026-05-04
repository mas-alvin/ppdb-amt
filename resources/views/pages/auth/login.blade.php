<x-auth-layout title="Masuk">
    <form action="{{ route('login') }}" method="POST" class="space-y-4">
        @csrf
        <div class="text-center mb-8">
            <div class="inline-flex items-center justify-center size-18 mb-4">
                <img src="{{ asset('logo-amt.webp') }}" alt="Logo" class="size-18">
            </div>
            <h1 class="text-lg font-black text-green-950 uppercase tracking-tighter">Masuk Akun</h1>
            <p class="text-slate-500 text-sm mt-1">Masuk dengan akun anda untuk melakukan pendaftaran</p>
        </div>
        <div>
            <label for="email" class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2">Email atau Username</label>
            <div class="relative">
                <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-slate-400">
                    <iconify-icon icon="lucide:user"></iconify-icon>
                </span>
                <input type="text" name="email" id="email" value="{{ old('email') }}" required autofocus
                    class="w-full pl-10 pr-4 py-3 text-sm border-slate-200 rounded-sm focus:ring-green-900 focus:border-green-900 bg-slate-50/50 transition-all placeholder:text-slate-300"
                    placeholder="nama@email.com atau username">
            </div>
            @error('email')
                <p class="text-red-500 text-[10px] font-bold mt-1 uppercase tracking-wider">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="password" class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2">Password</label>
            <div class="relative">
                <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-slate-400">
                    <iconify-icon icon="lucide:lock"></iconify-icon>
                </span>
                <input type="password" name="password" id="password" required
                    class="w-full pl-10 pr-4 py-3 text-sm border-slate-200 rounded-sm focus:ring-green-900 focus:border-green-900 bg-slate-50/50 transition-all placeholder:text-slate-300"
                    placeholder="••••••••">
            </div>
            @error('password')
                <p class="text-red-500 text-[10px] font-bold mt-1 uppercase tracking-wider">{{ $message }}</p>
            @enderror
        </div>

        <div class="flex items-center justify-between py-2">
            <label class="flex items-center gap-2 cursor-pointer group">
                <input type="checkbox" name="remember" class="rounded-sm border-slate-300 text-green-900 focus:ring-green-900 size-4">
                <span class="text-xs text-slate-500 group-hover:text-green-900 transition-colors">Ingat saya</span>
            </label>
            <a href="#" class="text-xs font-bold text-green-900 hover:text-yellow-600 transition-colors uppercase tracking-widest">Lupa Password?</a>
        </div>

        <button type="submit" 
            class="w-full bg-green-900 text-white py-4 rounded-sm font-black uppercase tracking-[0.2em] text-xs hover:bg-green-800 transition-all shadow-xl shadow-green-900/20 active:scale-[0.98]">
            MASUK SEKARANG
        </button>
    </form>

    <div class="mt-8 pt-6 border-t border-slate-100 text-center">
        <p class="text-sm text-slate-500">
            Belum punya akun? 
            <a href="{{ route('register') }}" class="font-black text-green-900 hover:text-yellow-600 transition-colors uppercase tracking-widest ml-1">Daftar Akun Baru</a>
        </p>
    </div>
</x-auth-layout>

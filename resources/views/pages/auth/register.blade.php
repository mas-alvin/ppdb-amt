<x-auth-layout title="Daftar">
    <div class="mb-6">
        <h2 class="text-xl font-black text-green-950 uppercase tracking-tight">Pendaftaran Akun</h2>
        <p class="text-slate-500 text-sm">Buat akun portal pendaftaran untuk memulai proses aplikasi Anda.</p>
    </div>

    <form action="{{ route('register') }}" method="POST" class="space-y-4">
        @csrf
        <div>
            <label for="name" class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2">Nama Lengkap</label>
            <div class="relative">
                <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-slate-400">
                    <iconify-icon icon="lucide:user-plus"></iconify-icon>
                </span>
                <input type="text" name="name" id="name" value="{{ old('name') }}" required
                    class="w-full pl-10 pr-4 py-3 text-sm border-slate-200 rounded-sm focus:ring-green-900 focus:border-green-900 bg-slate-50/50 transition-all placeholder:text-slate-300"
                    placeholder="Masukkan nama lengkap sesuai ijazah">
            </div>
            @error('name')
                <p class="text-red-500 text-[10px] font-bold mt-1 uppercase tracking-wider">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="username" class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2">Username</label>
            <div class="relative">
                <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-slate-400">
                    <iconify-icon icon="lucide:at-sign"></iconify-icon>
                </span>
                <input type="text" name="username" id="username" value="{{ old('username') }}" required
                    class="w-full pl-10 pr-4 py-3 text-sm border-slate-200 rounded-sm focus:ring-green-900 focus:border-green-900 bg-slate-50/50 transition-all placeholder:text-slate-300"
                    placeholder="pilih_username_anda">
            </div>
            @error('username')
                <p class="text-red-500 text-[10px] font-bold mt-1 uppercase tracking-wider">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="email" class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2">Alamat Email</label>
            <div class="relative">
                <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-slate-400">
                    <iconify-icon icon="lucide:mail"></iconify-icon>
                </span>
                <input type="email" name="email" id="email" value="{{ old('email') }}" required
                    class="w-full pl-10 pr-4 py-3 text-sm border-slate-200 rounded-sm focus:ring-green-900 focus:border-green-900 bg-slate-50/50 transition-all placeholder:text-slate-300"
                    placeholder="nama@email.com">
            </div>
            @error('email')
                <p class="text-red-500 text-[10px] font-bold mt-1 uppercase tracking-wider">{{ $message }}</p>
            @enderror
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
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
            <div>
                <label for="password_confirmation" class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2">Konfirmasi</label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-slate-400">
                        <iconify-icon icon="lucide:shield-check"></iconify-icon>
                    </span>
                    <input type="password" name="password_confirmation" id="password_confirmation" required
                        class="w-full pl-10 pr-4 py-3 text-sm border-slate-200 rounded-sm focus:ring-green-900 focus:border-green-900 bg-slate-50/50 transition-all placeholder:text-slate-300"
                        placeholder="••••••••">
                </div>
            </div>
        </div>

        <div class="flex items-center gap-3 py-2">
            <input type="checkbox" required class="rounded-sm border-slate-300 text-green-900 focus:ring-green-900 size-4">
            <span class="text-[10px] text-slate-500 uppercase tracking-wide">Saya setuju dengan <a href="#" class="font-bold text-green-900 border-b border-green-900/30">Syarat & Ketentuan</a> pendaftaran.</span>
        </div>

        <button type="submit" 
            class="w-full bg-green-900 text-white py-4 rounded-sm font-black uppercase tracking-[0.2em] text-xs hover:bg-green-800 transition-all shadow-xl shadow-green-900/20 active:scale-[0.98]">
            DAFTAR SEKARANG
        </button>
    </form>

    <div class="mt-8 pt-6 border-t border-slate-100 text-center">
        <p class="text-sm text-slate-500">
            Sudah punya akun? 
            <a href="{{ route('login') }}" class="font-black text-green-900 hover:text-yellow-600 transition-colors uppercase tracking-widest ml-1">Masuk Kembali</a>
        </p>
    </div>
</x-auth-layout>

<nav class="shadow-sm border-b border-gray-200 sticky top-0 z-50">

    <!-- Top Header -->
    <div class="bg-white relative overflow-hidden">

        <!-- Background Pattern Repeat -->
        <div class="absolute inset-0 opacity-5 pointer-events-none mix-blend-multiply top-0 left-0 w-full h-full"
            style="background-image: url('{{ asset('batik-pattern.png') }}'); background-size: 400px; background-repeat: repeat; background-position: center center;">
        </div>

        <div class="relative max-w-full px-4 sm:px-6 py-3 sm:py-4 flex items-center justify-between">

            <!-- Logo + Title -->
            <div class="flex items-center gap-3 sm:gap-4">
                <img src="{{ asset('logo-amt.webp') }}" alt="Logo" class="h-9 sm:h-10 md:h-12 w-auto">

                <div class="leading-tight">
                    <h1 class="text-sm sm:text-base md:text-lg font-bold text-green-900">
                        PPDB SMK AL-MUJTAMA'
                    </h1>

                    <p class="text-[10px] sm:text-xs md:text-sm text-gray-500">
                        Penerimaan Peserta Didik Baru Tahun Ajaran {{ now()->year }}
                    </p>
                </div>
            </div>

            <!-- Right Small Text Desktop -->
            <div class="hidden md:block">
                <p class="text-sm text-gray-500 font-medium">
                    Sistem Informasi PPDB Online
                </p>
            </div>
        </div>
    </div>

    <!-- Main Navigation -->
    <div class="bg-green-900 border-t border-green-800">
        <div class="max-w-auto px-4 sm:px-6">

            <div class="flex items-center justify-between h-14">

                <!-- Mobile Hamburger (Left) -->
                <button id="hamburger-btn-mobile"
                    class="md:hidden text-white p-2 rounded-lg hover:bg-green-800 transition-all">
                    <iconify-icon icon="lucide:menu" class="text-2xl"></iconify-icon>
                </button>

                <!-- Desktop Menu -->
                <div class="hidden md:flex items-center gap-1">

                    <a href="/"
                        class="px-4 py-2 text-sm font-semibold rounded-lg text-white/90 hover:bg-green-800 hover:text-white transition-all">
                        Beranda
                    </a>

                    <a href="/profile"
                        class="px-4 py-2 text-sm font-semibold rounded-lg text-white/90 hover:bg-green-800 hover:text-white transition-all">
                        Profile Sekolah
                    </a>

                    <a href="/kontak"
                        class="px-4 py-2 text-sm font-semibold rounded-lg text-white/90 hover:bg-green-800 hover:text-white transition-all">
                        Kontak
                    </a>

                    <a href="/informasi"
                        class="px-4 py-2 text-sm font-semibold rounded-lg text-white/90 hover:bg-green-800 hover:text-white transition-all">
                        Informasi
                    </a>

                    <a href="/brosur"
                        class="px-4 py-2 text-sm font-semibold rounded-lg text-white/90 hover:bg-green-800 hover:text-white transition-all">
                        Brosur
                    </a>
                </div>

                <!-- Mobile Center Title -->
                <div class="md:hidden absolute left-1/2 -translate-x-1/2">
                    <h2 class="text-white font-bold text-sm tracking-wide">
                        PPDB AMT
                    </h2>
                </div>

                <!-- Right Buttons -->
                <div class="flex items-center gap-3">
                    <a href="/login"
                        class="hidden md:flex items-center gap-2 bg-yellow-400 hover:bg-yellow-300 text-green-950 font-bold text-sm px-5 py-2 rounded-lg transition-all shadow-sm">
                        MASUK
                    </a>
                    <a href="/register"
                        class="bg-white hover:bg-gray-100 text-green-900 font-bold text-sm px-5 py-2 rounded-lg transition-all shadow-sm">
                        DAFTAR
                    </a>
                </div>

            </div>
        </div>
    </div>
</nav>

<!-- Mobile Sidebar Overlay -->
<div id="sidebar-overlay"
    class="fixed inset-0 bg-black/50 backdrop-blur-sm z-60 opacity-0 pointer-events-none transition-opacity duration-300 md:hidden">
</div>

<!-- Mobile Sidebar -->
<aside id="mobile-sidebar"
    class="fixed top-0 left-0 h-full w-72 bg-white z-70 shadow-2xl transform -translate-x-full transition-transform duration-300 ease-in-out md:hidden flex flex-col">

    <!-- Sidebar Header -->
    <div class="flex items-center justify-between p-5 border-b border-slate-100">
        <div class="flex items-center gap-2">
            <img src="{{ asset('logo-amt.webp') }}" alt="Logo" class="h-10 w-auto">
            <!-- Mengubah pembungkus teks menjadi flex-col agar menumpuk ke bawah -->
            <div class="flex flex-col justify-center">
                <span class="text-green-900 font-black tracking-wide text-lg leading-tight">PPDB <span
                        class="text-yellow-600">AMT</span></span>
                <span class="text-xs text-gray-400 font-medium leading-tight">TAHUN AJARAN {{ now()->year }}</span>
            </div>
        </div>
        <button id="sidebar-close-btn" class="p-2 text-slate-500 hover:bg-slate-100 rounded-lg transition-colors">
            <iconify-icon icon="lucide:x" class="text-xl"></iconify-icon>
        </button>
    </div>


    <!-- Navigation Links -->
    <nav class="flex-1 overflow-y-auto py-4 px-3">
        <p class="px-2 mb-2 text-[10px] font-bold text-slate-400 uppercase tracking-widest">Navigasi</p>

        <a href="/" class="flex items-center gap-3 px-4 py-3 rounded-lg transition-colors mb-1">
            <iconify-icon icon="lucide:home" class="text-xl shrink-0 text-green-700"></iconify-icon>
            <span class="text-sm font-medium">Beranda</span>
        </a>

        <a href="/profile" class="flex items-center gap-3 px-4 py-3 rounded-lg transition-colors mb-1">
            <iconify-icon icon="lucide:school" class="text-xl shrink-0 text-green-700"></iconify-icon>
            <span class="text-sm font-medium">Profile Sekolah</span>
        </a>

        <a href="/register" class="flex items-center gap-3 px-4 py-3 rounded-lg transition-colors mb-1">
            <iconify-icon icon="lucide:clipboard-list" class="text-xl shrink-0 text-green-700"></iconify-icon>
            <span class="text-sm font-medium">Pendaftaran</span>
        </a>

        <a href="/kontak" class="flex items-center gap-3 px-4 py-3 rounded-lg transition-colors mb-1">
            <iconify-icon icon="lucide:phone" class="text-xl shrink-0 text-green-700"></iconify-icon>
            <span class="text-sm font-medium">Kontak</span>
        </a>

        <a href="/informasi" class="flex items-center gap-3 px-4 py-3 rounded-lg transition-colors mb-1">
            <iconify-icon icon="lucide:info" class="text-xl shrink-0 text-green-700"></iconify-icon>
            <span class="text-sm font-medium">Informasi</span>
        </a>

        <a href="/brosur" class="flex items-center gap-3 px-4 py-3 rounded-lg transition-colors mb-1">
            <iconify-icon icon="lucide:book-open" class="text-xl shrink-0 text-green-700"></iconify-icon>
            <span class="text-sm font-medium">Brosur</span>
        </a>
    </nav>

    <!-- CTA Mobile -->
    <div class="p-4 border-t border-slate-100 space-y-2">
        <a href="/login"
            class="flex items-center justify-center w-full py-3 rounded-lg bg-green-50 text-green-900 font-bold text-sm border border-green-100 transition-all">
            Masuk
        </a>
        <a href="/register"
            class="flex items-center justify-center w-full py-3 rounded-lg bg-green-900 text-white font-bold text-sm transition-all">
            Daftar Sekarang
        </a>
    </div>
</aside>

<script>
    (function() {
        const hamburgerBtn = document.getElementById('hamburger-btn-mobile');
        const sidebarCloseBtn = document.getElementById('sidebar-close-btn');
        const sidebar = document.getElementById('mobile-sidebar');
        const overlay = document.getElementById('sidebar-overlay');

        function openSidebar() {
            sidebar.classList.remove('-translate-x-full');
            overlay.classList.remove('opacity-0', 'pointer-events-none');
            overlay.classList.add('opacity-100');
            document.body.style.overflow = 'hidden';
        }

        function closeSidebar() {
            sidebar.classList.add('-translate-x-full');
            overlay.classList.remove('opacity-100');
            overlay.classList.add('opacity-0', 'pointer-events-none');
            document.body.style.overflow = '';
        }

        if (hamburgerBtn) hamburgerBtn.addEventListener('click', openSidebar);
        if (sidebarCloseBtn) sidebarCloseBtn.addEventListener('click', closeSidebar);
        if (overlay) overlay.addEventListener('click', closeSidebar);
    })();
</script>

<nav class="bg-white dark:bg-slate-900 border-b border-slate-200 dark:border-slate-800 sticky top-0 z-50 px-6 py-3">
    <div class="max-w-7xl mx-auto flex items-center justify-between">
        <!-- Logo -->
        <div class="flex items-center gap-3">
            <img src="{{ asset('LOGO-PPDB.png') }}" alt="Logo" class="w-auto h-12">
        </div>

        <!-- Desktop Navigation Menu -->
        <div class="hidden md:flex items-center gap-1">
            <a class="px-4 py-2 rounded-lg {{ Request::is('dashboard') ? 'bg-primary/10 text-primary' : 'text-slate-600 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-slate-800' }} font-medium flex items-center gap-2"
                href="/dashboard">
                <iconify-icon icon="lucide:layout-dashboard" class="text-base"></iconify-icon> Dashboard
            </a>
            <a class="px-4 py-2 rounded-lg {{ Request::is('pendaftaran') ? 'bg-primary/10 text-primary' : 'text-slate-600 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-slate-800' }} font-medium flex items-center gap-2"
                href="/pendaftaran">
                <iconify-icon icon="lucide:clipboard-list" class="text-base"></iconify-icon> Pendaftaran
            </a>
            <a class="px-4 py-2 rounded-lg {{ Request::is('pendaftaran/dokumen') ? 'bg-primary/10 text-primary' : 'text-slate-600 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-slate-800' }} font-medium flex items-center gap-2"
                href="/pendaftaran/dokumen">
                <iconify-icon icon="lucide:file-text" class="text-base"></iconify-icon> Dokumen
            </a>
            <a class="px-4 py-2 rounded-lg {{ Request::is('pendaftaran/status') ? 'bg-primary/10 text-primary' : 'text-slate-600 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-slate-800' }} font-medium flex items-center gap-2"
                href="/pendaftaran/status">
                <iconify-icon icon="lucide:bar-chart-3" class="text-base"></iconify-icon> Status
            </a>
        </div>

        <!-- Right Side: Notifications, Settings, Profile + Hamburger on mobile -->
        <div class="flex items-center gap-3">
            <div class="hidden md:flex gap-2 border-r border-slate-200 dark:border-slate-700 pr-3 mr-1">
                <button
                    class="p-2 text-slate-500 hover:bg-slate-100 dark:hover:bg-slate-800 rounded-full transition-colors">
                    <iconify-icon icon="lucide:bell" class="text-xl"></iconify-icon>
                </button>
                <button
                    class="p-2 text-slate-500 hover:bg-slate-100 dark:hover:bg-slate-800 rounded-full transition-colors">
                    <iconify-icon icon="lucide:settings" class="text-xl"></iconify-icon>
                </button>
            </div>
            <div class="hidden md:flex items-center gap-2 cursor-pointer">
                <div class="size-8 rounded-full bg-slate-200 flex items-center justify-center overflow-hidden">
                    <iconify-icon icon="lucide:user" class="text-xl text-slate-400"></iconify-icon>
                </div>
                <span class="text-sm font-semibold hidden sm:block">Budi Santoso</span>
                <iconify-icon icon="lucide:log-out" class="text-base text-slate-400"></iconify-icon>
            </div>

            <!-- Hamburger Button (Mobile Only) -->
            <button id="hamburger-btn"
                class="md:hidden p-2 text-slate-600 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-slate-800 rounded-lg transition-colors"
                aria-label="Buka menu">
                <iconify-icon icon="lucide:menu" class="text-2xl"></iconify-icon>
            </button>
        </div>
    </div>
</nav>

<!-- Mobile Sidebar Overlay -->
<div id="sidebar-overlay"
    class="fixed inset-0 bg-black/50 backdrop-blur-sm z-60 opacity-0 pointer-events-none transition-opacity duration-300 md:hidden">
</div>

<!-- Mobile Sidebar -->
<aside id="mobile-sidebar"
    class="fixed top-0 left-0 h-full w-72 bg-white dark:bg-slate-900 z-70 shadow-2xl transform -translate-x-full transition-transform duration-300 ease-in-out md:hidden flex flex-col">

    <!-- Sidebar Header -->
    <div class="flex items-center justify-between p-5 border-b border-slate-100 dark:border-slate-800">
        <img src="{{ asset('LOGO-PPDB.png') }}" alt="Logo" class="h-10 w-auto">
        <button id="sidebar-close-btn"
            class="p-2 text-slate-500 hover:bg-slate-100 dark:hover:bg-slate-800 rounded-lg transition-colors"
            aria-label="Tutup menu">
            <iconify-icon icon="lucide:x" class="text-xl"></iconify-icon>
        </button>
    </div>

    <!-- User Info -->
    <div
        class="flex items-center gap-3 px-5 py-4 bg-primary/5 dark:bg-primary/10 border-b border-slate-100 dark:border-slate-800">
        <div class="size-10 rounded-full bg-slate-200 dark:bg-slate-700 flex items-center justify-center shrink-0">
            <iconify-icon icon="lucide:user" class="text-xl text-slate-400"></iconify-icon>
        </div>
        <div>
            <p class="text-sm font-bold text-slate-900 dark:text-white">Budi Santoso</p>
            <p class="text-xs text-slate-500 dark:text-slate-400">Siswa</p>
        </div>
    </div>

    <!-- Navigation Links -->
    <nav class="flex-1 overflow-y-auto py-4 px-3">
        <p class="px-2 mb-2 text-[10px] font-bold text-slate-400 uppercase tracking-widest">Menu Utama</p>
        <a href="/dashboard"
            class="flex items-center gap-3 px-4 py-3 rounded-xl {{ Request::is('dashboard') ? 'bg-primary/10 text-primary font-semibold' : 'text-slate-600 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-slate-800' }} transition-colors mb-1">
            <iconify-icon icon="lucide:layout-dashboard" class="text-xl shrink-0"></iconify-icon>
            <span class="text-sm font-medium">Dashboard</span>
        </a>
        <a href="/pendaftaran"
            class="flex items-center gap-3 px-4 py-3 rounded-xl {{ Request::is('pendaftaran') ? 'bg-primary/10 text-primary font-semibold' : 'text-slate-600 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-slate-800' }} transition-colors mb-1">
            <iconify-icon icon="lucide:clipboard-list" class="text-xl shrink-0"></iconify-icon>
            <span class="text-sm font-medium">Pendaftaran</span>
        </a>
        <a href="/pendaftaran/dokumen"
            class="flex items-center gap-3 px-4 py-3 rounded-xl {{ Request::is('pendaftaran/dokumen') ? 'bg-primary/10 text-primary font-semibold' : 'text-slate-600 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-slate-800' }} transition-colors mb-1">
            <iconify-icon icon="lucide:file-text" class="text-xl shrink-0"></iconify-icon>
            <span class="text-sm font-medium">Dokumen</span>
        </a>
        <a href="/pendaftaran/status"
            class="flex items-center gap-3 px-4 py-3 rounded-xl {{ Request::is('pendaftaran/status') ? 'bg-primary/10 text-primary font-semibold' : 'text-slate-600 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-slate-800' }} transition-colors mb-1">
            <iconify-icon icon="lucide:bar-chart-3" class="text-xl shrink-0"></iconify-icon>
            <span class="text-sm font-medium">Status</span>
        </a>

        <div class="my-3 border-t border-slate-100 dark:border-slate-800"></div>
        <p class="px-2 mb-2 text-[10px] font-bold text-slate-400 uppercase tracking-widest">Lainnya</p>

        <a href="#"
            class="flex items-center gap-3 px-4 py-3 rounded-xl text-slate-600 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-slate-800 transition-colors mb-1">
            <iconify-icon icon="lucide:bell" class="text-xl shrink-0"></iconify-icon>
            <span class="text-sm font-medium">Notifikasi</span>
        </a>
        <a href="#"
            class="flex items-center gap-3 px-4 py-3 rounded-xl text-slate-600 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-slate-800 transition-colors mb-1">
            <iconify-icon icon="lucide:settings" class="text-xl shrink-0"></iconify-icon>
            <span class="text-sm font-medium">Pengaturan</span>
        </a>
    </nav>

    <!-- Sidebar Footer (Logout) -->
    <div class="p-4 border-t border-slate-100 dark:border-slate-800">
        <a href="#"
            class="flex items-center gap-3 px-4 py-3 rounded-xl text-red-500 hover:bg-red-50 dark:hover:bg-red-900/20 transition-colors w-full">
            <iconify-icon icon="lucide:log-out" class="text-xl shrink-0"></iconify-icon>
            <span class="text-sm font-semibold">Keluar</span>
        </a>
    </div>
</aside>

<script>
    (function() {
        const hamburgerBtn = document.getElementById('hamburger-btn');
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

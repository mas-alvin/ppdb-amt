<nav class="shadow-sm border-b border-gray-200 sticky top-0 z-50">

    <!-- Top Header -->
    <div class="bg-white relative overflow-hidden">

        <!-- Background Pattern Repeat -->
        <div class="absolute inset-0 opacity-5 pointer-events-none mix-blend-multiply top-0 left-0 w-full h-full"
            style="background-image: url('{{ asset('batik-pattern.png') }}'); background-size: 400px; background-repeat: repeat; background-position: center center;">
        </div>

        <div
            class="relative max-w-full px-4 sm:px-6 sm:mx-auto md:mx-28 py-3 sm:py-4 flex items-center justify-between">

            <!-- Logo + Title -->
            <div class="flex items-center gap-3 sm:gap-4">
                <img src="{{ asset('logo-amt.webp') }}" alt="Logo"
                    class="h-9 sm:h-10 md:h-12 w-auto">

                <div class="leading-tight">
                    <h1 class="text-sm sm:text-base md:text-lg font-bold text-green-900">
                        PPDB SMK AL-MUJTAMA'
                    </h1>

                    <p class="text-[10px] sm:text-xs md:text-sm text-gray-500">
                        Penerimaan Peserta Didik Baru Tahun Ajaran 2026
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
        <div class="max-w-full px-4 sm:px-6 sm:mx-auto md:mx-28">

            <div class="flex items-center justify-between h-14">

                <!-- Mobile Hamburger (Left) -->
                <button id="hamburger-btn-mobile"
                    class="md:hidden text-white p-2 rounded-lg hover:bg-green-800 transition-all">
                    <iconify-icon icon="lucide:menu" class="text-2xl"></iconify-icon>
                </button>

                <!-- Desktop Menu -->
                <div class="hidden md:flex items-center gap-1">

                    <a href="{{ route('student.dashboard') }}"
                        class="px-4 py-2 text-sm font-semibold rounded-lg transition-all
                        {{ Request::routeIs('student.dashboard') 
                            ? 'bg-green-700 text-white' 
                            : 'text-white/90 hover:bg-green-800 hover:text-white' }}">
                        Dashboard
                    </a>

                    <a href="{{ route('student.pendaftaran.wizard') }}"
                        class="px-4 py-2 text-sm font-semibold rounded-lg transition-all
                        {{ Request::routeIs('student.pendaftaran.wizard') 
                            ? 'bg-green-700 text-white' 
                            : 'text-white/90 hover:bg-green-800 hover:text-white' }}">
                        Pendaftaran
                    </a>

                    <a href="{{ route('student.documents.index') }}"
                        class="px-4 py-2 text-sm font-semibold rounded-lg transition-all
                        {{ Request::routeIs('student.documents.index') 
                            ? 'bg-green-700 text-white' 
                            : 'text-white/90 hover:bg-green-800 hover:text-white' }}">
                        Dokumen
                    </a>

                    <a href="{{ route('student.status') }}"
                        class="px-4 py-2 text-sm font-semibold rounded-lg transition-all
                        {{ Request::routeIs('student.status') 
                            ? 'bg-green-700 text-white' 
                            : 'text-white/90 hover:bg-green-800 hover:text-white' }}">
                        Status
                    </a>

                </div>

                <!-- Mobile Center Title -->
                <div class="md:hidden absolute left-1/2 -translate-x-1/2">
                    <h2 class="text-white font-bold text-sm tracking-wide">
                        PPDB AMT
                    </h2>
                </div>

                <!-- Right Profile / Mobile Logout -->
                <div class="flex items-center gap-3">

                    <!-- Desktop Profile Section -->
                    <div
                        class="hidden md:flex items-center gap-3 cursor-pointer">

                        <!-- Profile Icon -->
                        <div
                            class="w-9 h-9 rounded-lg bg-white flex items-center justify-center shadow-sm">
                            <iconify-icon icon="lucide:user"
                                class="text-lg text-green-900"></iconify-icon>
                        </div>

                        <!-- User Info -->
                        <div class="leading-tight">
                            <p class="text-sm font-semibold text-white">
                                {{ auth()->user()->name }}
                            </p>
                            <p class="text-xs text-white/70 uppercase tracking-widest font-bold">
                                {{ auth()->user()->role }}
                            </p>
                        </div>

                        <!-- Logout Icon -->
                        <button type="button"
                            onclick="confirmLogout()"
                            class="ml-2 text-white/80 hover:text-white transition-all">
                            <iconify-icon icon="lucide:log-out"
                                class="text-xl"></iconify-icon>
                        </button>
                        
                        <form action="{{ route('logout') }}" method="POST" id="logout-form" class="hidden">
                            @csrf
                        </form>
                    </div>

                    <!-- Mobile Logout Icon -->
                    <button type="button"
                        onclick="confirmLogout()"
                        class="md:hidden text-white p-2 rounded-lg hover:bg-green-800 transition-all">
                        <iconify-icon icon="lucide:log-out"
                            class="text-2xl"></iconify-icon>
                    </button>

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
        <img src="{{ asset('LOGO-PPDB.png') }}" alt="Logo" class="h-10 w-auto">

        <button id="sidebar-close-btn"
            class="p-2 text-slate-500 hover:bg-slate-100 rounded-lg transition-colors">
            <iconify-icon icon="lucide:x" class="text-xl"></iconify-icon>
        </button>
    </div>

    <!-- User Info -->
    <div
        class="flex items-center gap-3 px-5 py-4 bg-green-50 border-b border-slate-100">
        <div
            class="size-10 rounded-lg bg-slate-200 flex items-center justify-center shrink-0">
            <iconify-icon icon="lucide:user"
                class="text-xl text-slate-400"></iconify-icon>
        </div>

        <div>
            <p class="text-sm font-bold text-slate-900">
                Alfiansyah
            </p>
            <p class="text-xs text-slate-500">
                Siswa
            </p>
        </div>
    </div>

    <!-- Navigation Links -->
    <nav class="flex-1 overflow-y-auto py-4 px-3">

        <p
            class="px-2 mb-2 text-[10px] font-bold text-slate-400 uppercase tracking-widest">
            Menu Utama
        </p>

        <a href="{{ route('student.dashboard') }}"
            class="flex items-center gap-3 px-4 py-3 rounded-lg transition-colors mb-1 {{ Request::routeIs('student.dashboard') ? 'bg-green-100 text-green-900' : 'text-slate-600' }}">
            <iconify-icon icon="lucide:layout-dashboard"
                class="text-xl shrink-0"></iconify-icon>
            <span class="text-sm font-medium">Dashboard</span>
        </a>

        <a href="{{ route('student.pendaftaran.wizard') }}"
            class="flex items-center gap-3 px-4 py-3 rounded-lg transition-colors mb-1 {{ Request::routeIs('student.pendaftaran.wizard') ? 'bg-green-100 text-green-900' : 'text-slate-600' }}">
            <iconify-icon icon="lucide:clipboard-list"
                class="text-xl shrink-0"></iconify-icon>
            <span class="text-sm font-medium">Pendaftaran</span>
        </a>

        <a href="{{ route('student.documents.index') }}"
            class="flex items-center gap-3 px-4 py-3 rounded-lg transition-colors mb-1 {{ Request::routeIs('student.documents.index') ? 'bg-green-100 text-green-900' : 'text-slate-600' }}">
            <iconify-icon icon="lucide:file-text"
                class="text-xl shrink-0"></iconify-icon>
            <span class="text-sm font-medium">Dokumen</span>
        </a>

        <a href="{{ route('student.status') }}"
            class="flex items-center gap-3 px-4 py-3 rounded-lg transition-colors mb-1 {{ Request::routeIs('student.status') ? 'bg-green-100 text-green-900' : 'text-slate-600' }}">
            <iconify-icon icon="lucide:bar-chart-3"
                class="text-xl shrink-0"></iconify-icon>
            <span class="text-sm font-medium">Status</span>
        </a>

    </nav>

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
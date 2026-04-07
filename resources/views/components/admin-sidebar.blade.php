@php
    use App\Support\AdminNav;

    $adminNavGroups = config('ppdb_admin.navigation', []);
@endphp

<aside id="sidebar"
    class="fixed inset-y-0 left-0 z-50 flex flex-col w-64 bg-emerald-900 text-white shadow-xl transform -translate-x-full transition-all duration-300 ease-in-out md:relative md:translate-x-0">

    <div class="flex items-center gap-3 h-16 px-6 border-b border-emerald-800 flex-shrink-0 overflow-hidden">
        <div class="flex items-center justify-center w-8 h-8 bg-emerald-500 rounded-lg flex-shrink-0">
            <x-admin.nav-icon name="layout-dashboard" class="w-5 h-5 text-white" />
        </div>
        <span class="brand-text text-lg font-bold tracking-tight whitespace-nowrap transition-opacity duration-200">PPDB Admin</span>
    </div>

    <nav class="flex-1 px-3 py-5 space-y-1 overflow-y-auto sidebar-scroll">
        @foreach ($adminNavGroups as $group)
            <p class="sidebar-label px-3 mb-2 text-xs font-semibold text-emerald-400 uppercase tracking-wider">
                {{ $group['section_label'] ?? $group['id'] }}
            </p>

            @foreach ($group['items'] ?? [] as $item)
                @php
                    $routeName = $item['route'] ?? '';
                    $href = AdminNav::routeUrl($routeName);
                    $missing = $href === '#';
                    $active = AdminNav::routeIsActive($routeName);
                    $itemClasses = $active
                        ? 'bg-emerald-800 text-white shadow-inner'
                        : 'text-emerald-100 hover:bg-emerald-800/50 hover:text-white';
                @endphp
                <a href="{{ $href }}"
                    @if ($missing) title="Route belum terdaftar" @endif
                    class="sidebar-item flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium transition-all {{ $itemClasses }} {{ $missing ? 'opacity-60' : '' }}">
                    <x-admin.nav-icon :name="$item['icon'] ?? 'layout-dashboard'" />
                    <span class="sidebar-text whitespace-nowrap">{{ $item['label'] ?? $item['id'] }}</span>
                </a>
            @endforeach
        @endforeach
    </nav>

    <div class="p-4 border-t border-emerald-800 flex-shrink-0">
        <div class="flex items-center gap-3">
            <img class="w-8 h-8 rounded-full border border-emerald-500"
                src="https://ui-avatars.com/api/?name=Admin+PPDB&background=10b981&color=fff&size=64" alt="">
            <div class="user-info min-w-0">
                <p class="text-sm font-medium text-white truncate">Administrator</p>
                <p class="text-[10px] text-emerald-400 uppercase tracking-tight">Panel</p>
            </div>
            <a href="/login" class="ml-auto text-emerald-400 hover:text-red-400 transition-colors flex-shrink-0"
                title="Keluar">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                </svg>
            </a>
        </div>
    </div>
</aside>

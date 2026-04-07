@props([
    'title' => 'Log sistem',
    'entries' => [],
])

<div class="bg-slate-900 text-slate-100 rounded-xl shadow-sm overflow-hidden font-mono text-xs">
    <div class="px-4 py-3 border-b border-slate-700 flex items-center justify-between">
        <h3 class="text-sm font-semibold text-white">{{ $title }}</h3>
        <span class="text-[10px] uppercase tracking-wider text-slate-500">read-only</span>
    </div>
    <ul class="max-h-56 overflow-y-auto divide-y divide-slate-800">
        @forelse ($entries as $entry)
            @php
                $lvl = $entry['level'] ?? 'info';
                $lvlCls =
                    match ($lvl) {
                        'warning' => 'text-amber-400',
                        'error' => 'text-red-400',
                        default => 'text-emerald-400',
                    };
            @endphp
            <li class="px-4 py-2 flex gap-3 hover:bg-slate-800/50">
                <span class="{{ $lvlCls }} w-14 flex-shrink-0">[{{ $lvl }}]</span>
                <span class="text-slate-500 flex-shrink-0">{{ $entry['time'] ?? '' }}</span>
                <span class="text-slate-300 min-w-0">{{ $entry['message'] ?? '' }}</span>
            </li>
        @empty
            <li class="px-4 py-6 text-slate-500 text-center">Tidak ada entri log.</li>
        @endforelse
    </ul>
</div>

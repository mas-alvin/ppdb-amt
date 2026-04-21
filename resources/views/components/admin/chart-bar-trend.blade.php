@props([
    'title' => null,
    'points' => [],
    'valueKey' => 'value',
    'labelKey' => 'label',
])

@php
    $vals = collect($points)->pluck($valueKey)->filter(fn ($v) => is_numeric($v));
    $max = $vals->max() ?: 1;
@endphp

<div class="bg-white rounded-lg p-2">
    @if($title)
        <h3 class="text-sm font-semibold text-gray-800 mb-4">{{ $title }}</h3>
    @endif
    <div class="flex items-end gap-2 h-40 pl-1">
        @forelse ($points as $p)
            @php $h = round(((float) ($p[$valueKey] ?? 0) / $max) * 100); @endphp
            <div class="flex-1 flex flex-col items-center gap-2 min-w-0 group">
                <div
                    class="w-full bg-emerald-500/90 rounded-t-md transition-all group-hover:bg-emerald-600 origin-bottom"
                    style="height: {{ max(8, $h) }}%"
                    title="{{ $p[$labelKey] ?? '' }}: {{ $p[$valueKey] ?? '' }}"></div>
                <span class="text-[10px] text-gray-400 truncate w-full text-center">{{ $p[$labelKey] ?? '' }}</span>
            </div>
        @empty
            <div class="flex-1 flex items-center justify-center text-xs text-gray-400 py-8">
                Belum ada data tren untuk periode ini.
            </div>
        @endforelse
    </div>
</div>

@props([
    'title' => null,
    'segments' => [],
    'labelKey' => 'label',
    'valueKey' => 'value',
    'colorKey' => 'color',
])

@php
    $total = collect($segments)->sum(fn ($s) => (float) ($s[$valueKey] ?? 0)) ?: 1;
@endphp

<div class="bg-white rounded-lg p-2">
    @if($title)
        <h3 class="text-sm font-semibold text-gray-800 mb-4">{{ $title }}</h3>
    @endif
    <div class="space-y-4">
        @forelse ($segments as $seg)
            @php
                $v = (float) ($seg[$valueKey] ?? 0);
                $pct = round(($v / $total) * 100);
                $bar = $seg[$colorKey] ?? 'bg-emerald-500';
            @endphp
            <div>
                <div class="flex justify-between text-xs mb-1">
                    <span class="font-medium text-gray-700">{{ $seg[$labelKey] ?? '' }}</span>
                    <span class="text-gray-400 tabular-nums">{{ $pct }}%</span>
                </div>
                <div class="h-2 rounded-lg bg-gray-100 overflow-hidden">
                    <div class="h-full rounded-lg {{ $bar }} transition-all duration-500" style="width: {{ $pct }}%">
                    </div>
                </div>
            </div>
        @empty
            <p class="text-xs text-gray-400 py-6 text-center">Segmentasi tahap akan terisi dari pipeline.</p>
        @endforelse
    </div>
</div>

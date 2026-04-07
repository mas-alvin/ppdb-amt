@props([
    'label',
    'value',
    'tone' => 'emerald',
    'hint' => null,
])

@php
    $tones = [
        'emerald' => ['bg' => 'bg-emerald-50', 'text' => 'text-emerald-600'],
        'blue' => ['bg' => 'bg-blue-50', 'text' => 'text-blue-600'],
        'amber' => ['bg' => 'bg-amber-50', 'text' => 'text-amber-600'],
        'red' => ['bg' => 'bg-red-50', 'text' => 'text-red-600'],
        'slate' => ['bg' => 'bg-slate-100', 'text' => 'text-slate-600'],
    ];
    $t = $tones[$tone] ?? $tones['emerald'];
@endphp

<div
    class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 flex gap-4 items-start transition-shadow hover:shadow-md">
    <div class="w-12 h-12 rounded-xl {{ $t['bg'] }} {{ $t['text'] }} flex items-center justify-center flex-shrink-0">
        @if ($slot->isEmpty())
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" />
            </svg>
        @else
            {{ $slot }}
        @endif
    </div>
    <div class="min-w-0 flex-1">
        <p class="text-xs font-medium text-gray-500 uppercase tracking-wide">{{ $label }}</p>
        <p class="text-2xl font-bold text-gray-900 mt-1 tabular-nums">{{ $value }}</p>
        @if ($hint)
            <p class="text-xs text-gray-400 mt-2">{{ $hint }}</p>
        @endif
    </div>
</div>

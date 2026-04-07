@props([
    'variant' => 'error',
    'title' => null,
])

@php
    $styles = [
        'error' => 'bg-red-50 border-red-100 text-red-800',
        'warning' => 'bg-amber-50 border-amber-100 text-amber-900',
        'info' => 'bg-blue-50 border-blue-100 text-blue-900',
    ];
    $cls = $styles[$variant] ?? $styles['error'];
@endphp

<div role="alert" {{ $attributes->merge(['class' => "rounded-xl border p-4 text-sm {$cls}"]) }}>
    @if ($title)
        <p class="font-semibold">{{ $title }}</p>
    @endif
    <div class="{{ $title ? 'mt-1 text-sm opacity-90' : '' }}">{{ $slot }}</div>
</div>

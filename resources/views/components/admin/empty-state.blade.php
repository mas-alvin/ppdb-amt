@props([
    'title' => 'Tidak ada data',
    'description' => null,
])

<div role="status"
    {{ $attributes->merge(['class' => 'flex flex-col items-center justify-center text-center rounded-xl border border-dashed border-gray-200 bg-gray-50/80 py-12 px-6']) }}>
    <div class="w-12 h-12 rounded-full bg-gray-200/80 text-gray-500 flex items-center justify-center mb-4">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
        </svg>
    </div>
    <p class="text-sm font-semibold text-gray-800">{{ $title }}</p>
    @if ($description)
        <p class="text-xs text-gray-500 mt-2 max-w-sm">{{ $description }}</p>
    @endif
    {{ $slot }}
</div>

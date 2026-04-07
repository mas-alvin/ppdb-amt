@props([
    'title' => 'Aktivitas terbaru',
    'items' => [],
])

<div class="bg-white rounded-xl border border-gray-100 shadow-sm overflow-hidden">
    <div class="px-6 py-4 border-b border-gray-50 flex items-center justify-between">
        <h3 class="text-sm font-semibold text-gray-800">{{ $title }}</h3>
    </div>
    <ul class="divide-y divide-gray-50 max-h-80 overflow-y-auto">
        @forelse ($items as $row)
            <li class="px-6 py-3 hover:bg-gray-50/80 transition-colors">
                <p class="text-sm text-gray-800">
                    <span class="font-semibold">{{ $row['actor'] ?? '' }}</span>
                    <span class="text-gray-600 font-normal"> {{ $row['action'] ?? '' }}</span>
                </p>
                <p class="text-xs text-gray-400 mt-1">{{ $row['time'] ?? '' }}</p>
            </li>
        @empty
            <li class="px-6 py-8">
                <p class="text-xs text-gray-400 text-center">Belum ada aktivitas yang dicatat.</p>
            </li>
        @endforelse
    </ul>
</div>

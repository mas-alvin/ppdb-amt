@props([
    'id',
    'title' => 'Modal Title',
    'size' => 'md', {{-- sm, md, lg, xl, 2xl --}}
])

@php
    $maxWidth = match ($size) {
        'sm' => 'max-w-sm',
        'md' => 'max-w-md',
        'lg' => 'max-w-lg',
        'xl' => 'max-w-xl',
        '2xl' => 'max-w-2xl',
        '4xl' => 'max-w-4xl',
        '6xl' => 'max-w-6xl',
        default => 'max-w-md',
    };
@endphp

<div x-show="{{ $id }}Open" 
     x-transition:enter="transition ease-out duration-300"
     x-transition:enter-start="opacity-0"
     x-transition:enter-end="opacity-100"
     x-transition:leave="transition ease-in duration-200"
     x-transition:leave-start="opacity-100"
     x-transition:leave-end="opacity-0"
     class="fixed inset-0 z-50 overflow-y-auto" 
     style="display: none;">
    
    {{-- Overlay --}}
    <div class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm transition-opacity" @click="{{ $id }}Open = false"></div>

    {{-- Modal Content --}}
    <div class="flex min-h-full items-center justify-center p-4">
        <div x-show="{{ $id }}Open"
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
             x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
             x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
             class="relative w-full {{ $maxWidth }} transform overflow-hidden rounded-lg bg-white shadow-2xl transition-all border border-slate-100">
            
            {{-- Header --}}
            <div class="flex items-center justify-between border-b border-slate-100 bg-slate-50/50 px-6 py-4">
                <h3 class="text-sm font-black text-green-950 uppercase tracking-widest">{{ $title }}</h3>
                <button @click="{{ $id }}Open = false" class="text-slate-400 hover:text-slate-600 transition-colors">
                    <iconify-icon icon="lucide:x" class="text-xl"></iconify-icon>
                </button>
            </div>

            {{-- Body --}}
            <div class="px-6 py-6 max-h-[75vh] overflow-y-auto">
                {{ $slot }}
            </div>

            {{-- Footer --}}
            @if(isset($footer))
                <div class="flex items-center justify-end gap-3 border-t border-slate-100 bg-slate-50/50 px-6 py-4">
                    {{ $footer }}
                </div>
            @endif
        </div>
    </div>
</div>

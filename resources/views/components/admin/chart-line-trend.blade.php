@props([
    'points' => [],
    'height' => 200,
])

@php
    $vals = collect($points)->pluck('value')->all();
    $max = !empty($vals) ? max($vals) : 1;
    $count = count($points);
    $width = 800; // Reference width for SVG
    $step = $count > 1 ? $width / ($count - 1) : $width;
    
    $path = "";
    foreach($points as $i => $p) {
        $x = $i * $step;
        $y = $height - (($p['value'] / ($max ?: 1)) * $height * 0.8) - ($height * 0.1);
        $path .= ($i === 0 ? "M" : "L") . " $x $y";
    }

    // Gradient path
    $gradientPath = $path . " L " . ($width) . " $height L 0 $height Z";
@endphp

<div class="relative w-full" x-data="{ hovered: null }">
    <svg viewBox="0 0 {{ $width }} {{ $height }}" class="w-full h-auto overflow-visible" preserveAspectRatio="none">
        <defs>
            <linearGradient id="lineGradient" x1="0" y1="0" x2="0" y2="1">
                <stop offset="0%" stop-color="#10b981" stop-opacity="0.2" />
                <stop offset="100%" stop-color="#10b981" stop-opacity="0" />
            </linearGradient>
        </defs>
        
        <!-- Grid lines -->
        @for($i = 0; $i <= 4; $i++)
            <line x1="0" y1="{{ ($height / 4) * $i }}" x2="{{ $width }}" y2="{{ ($height / 4) * $i }}" stroke="#f1f5f9" stroke-width="1" />
        @endfor

        <!-- Area Gradient -->
        @if($count > 1)
            <path d="{{ $gradientPath }}" fill="url(#lineGradient)" />
        @endif

        <!-- The Line -->
        <path d="{{ $path }}" fill="none" stroke="#059669" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" class="drop-shadow-lg" />

        <!-- Data Points -->
        @foreach($points as $i => $p)
            @php 
                $x = $i * $step;
                $y = $height - (($p['value'] / ($max ?: 1)) * $height * 0.8) - ($height * 0.1);
            @endphp
            <circle cx="{{ $x }}" cy="{{ $y }}" r="4" fill="#059669" stroke="white" stroke-width="2" class="cursor-pointer transition-all hover:r-6" 
                @mouseenter="hovered = {{ $i }}" @mouseleave="hovered = null" />
        @endforeach
    </svg>

    <!-- Labels -->
    <div class="flex justify-between mt-4">
        @foreach($points as $i => $p)
            <span class="text-[10px] font-bold text-slate-400 uppercase tracking-tighter">{{ $p['label'] }}</span>
        @endforeach
    </div>

    <!-- Tooltip -->
    <div x-show="hovered !== null" 
         x-transition x-data="{ points: [], hovered: null }"
         class="absolute pointer-events-none bg-emerald-950 text-white px-3 py-1.5 rounded-sm text-[10px] font-bold shadow-xl -translate-x-1/2 -translate-y-full"
         :style="`left: ${(hovered / {{ $count > 1 ? $count - 1 : 1 }}) * 100}%; top: -10px`"
    >
        <span x-text="points[hovered]?.label"></span>: <span x-text="points[hovered]?.value"></span>
    </div>
    
    <script>
        document.addEventListener('alpine:init', () => {
            // Ensure points is available to Alpine
            // This is a bit hacky but works for simple components
        })
    </script>
</div>

<script>
    window.chartPoints = @json($points);
</script>

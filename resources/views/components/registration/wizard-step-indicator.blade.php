@props(['activeStep' => 1])

<div class="w-full max-w-4xl mx-auto mb-16">
    <div class="flex items-center justify-between relative px-4">
        <!-- Progress Line Background (Connecting the circles) -->
        <div class="absolute top-6 left-12 right-12 h-0.5 bg-slate-200 -z-10"></div>
        
        <!-- Active Progress Line -->
        <div class="absolute top-6 left-12 h-0.5 bg-green-900 transition-all duration-700 -z-10"
            style="width: calc({{ (($activeStep - 1) / 4) * 100 }}% - {{ (($activeStep - 1) / 4) * 3 }}rem); max-width: calc(100% - 6rem);"></div>

        @php
            $steps = [
                ['icon' => 'lucide:user', 'label' => 'Pribadi'],
                ['icon' => 'lucide:users', 'label' => 'Keluarga'],
                ['icon' => 'lucide:activity', 'label' => 'Fisik'],
                ['icon' => 'lucide:award', 'label' => 'Prestasi'],
                ['icon' => 'lucide:rocket', 'label' => 'Final'],
            ];
        @endphp

        @foreach ($steps as $index => $step)
            @php $stepNum = $index + 1; @endphp
            <button type="button" @click="step = {{ $stepNum }}" class="flex flex-col items-center gap-4 focus:outline-none group">
                <!-- Square Icon -->
                <div @class([
                    'size-12 rounded-lg flex items-center justify-center transition-all duration-500 border-2 bg-white',
                    'border-green-900 bg-green-900 text-white shadow-xl shadow-green-900/20 scale-110 z-10' => $activeStep == $stepNum,
                    'border-green-900 bg-green-50 text-green-900 z-10' => $activeStep > $stepNum,
                    'border-slate-100 text-slate-400 group-hover:border-slate-200 z-10' => $activeStep < $stepNum,
                ])>
                    @if ($activeStep == $stepNum)
                        <iconify-icon icon="{{ $step['icon'] }}" class="text-xl"></iconify-icon>
                    @elseif ($activeStep > $stepNum)
                        <iconify-icon icon="lucide:check" class="text-xl"></iconify-icon>
                    @else
                        <iconify-icon icon="{{ $step['icon'] }}" class="text-xl"></iconify-icon>
                    @endif
                </div>
                <!-- Label -->
                <span @class([
                    'text-[10px] font-black uppercase tracking-[0.2em] transition-colors',
                    'text-green-950' => $activeStep == $stepNum,
                    'text-green-700' => $activeStep > $stepNum,
                    'text-slate-400 group-hover:text-slate-500' => $activeStep < $stepNum,
                ])>
                    {{ $step['label'] }}
                </span>
            </button>
        @endforeach
    </div>
</div>

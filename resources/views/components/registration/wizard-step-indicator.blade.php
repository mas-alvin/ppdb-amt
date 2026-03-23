@props(['activeStep' => 1])

<div class="w-full max-w-4xl mx-auto mb-12">
    <div class="flex items-center justify-between relative px-4">
        <!-- Progress Line Background (Connecting the circles) -->
        <div class="absolute top-6 left-12 right-12 h-0.5 bg-slate-200 dark:bg-slate-700 -z-10"></div>
        
        <!-- Active Progress Line -->
        <div class="absolute top-6 left-12 h-0.5 bg-primary transition-all duration-500 -z-10"
            style="width: calc({{ (($activeStep - 1) / 4) * 100 }}% - {{ (($activeStep - 1) / 4) * 3 }}rem); max-width: calc(100% - 6rem);"></div>

        @php
            $steps = [
                ['icon' => 'lucide:user', 'label' => 'Pribadi'],
                ['icon' => 'lucide:users', 'label' => 'Orang Tua'],
                ['icon' => 'lucide:activity', 'label' => 'Periodik'],
                ['icon' => 'lucide:award', 'label' => 'Prestasi'],
                ['icon' => 'lucide:check-square', 'label' => 'Final'],
            ];
        @endphp

        @foreach ($steps as $index => $step)
            @php $stepNum = $index + 1; @endphp
            <button type="button" @click="step = {{ $stepNum }}" class="flex flex-col items-center gap-3 focus:outline-none group">
                <!-- Circle Icon -->
                <div @class([
                    'size-12 rounded-full flex items-center justify-center transition-all duration-300 border bg-white dark:bg-slate-900',
                    'border-primary bg-primary text-white shadow-lg shadow-primary/20 scale-110' => $activeStep == $stepNum,
                    'border-primary text-primary' => $activeStep > $stepNum,
                    'border-slate-200 dark:border-slate-700 text-slate-400 group-hover:border-slate-300 group-hover:text-slate-500' => $activeStep < $stepNum,
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
                    'text-[10px] sm:text-xs font-bold uppercase tracking-widest transition-colors',
                    'text-primary' => $activeStep == $stepNum,
                    'text-slate-500 dark:text-slate-400' => $activeStep > $stepNum,
                    'text-slate-400 group-hover:text-slate-500' => $activeStep < $stepNum,
                ])>
                    {{ $step['label'] }}
                </span>
            </button>
        @endforeach
    </div>
</div>

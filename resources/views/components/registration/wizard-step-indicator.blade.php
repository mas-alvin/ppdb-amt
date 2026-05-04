@props(['activeStep' => 1])

<div class="w-full max-w-screen mx-auto mb-16">
    <div class="flex items-center justify-between relative px-4">
        <!-- Progress Line Track -->
        <div class="absolute top-6 left-[2.5rem] right-[2.5rem] h-1 z-0">
            <!-- Background Line -->
            <div class="w-full h-full bg-slate-200 rounded-full"></div>
            <!-- Active Line -->
            <div class="absolute top-0 left-0 h-full bg-green-900 transition-all duration-700 rounded-full"
                :style="`width: ${(step - 1) * 25}%`"
                style="width: {{ ($activeStep - 1) * 25 }}%;"></div>
        </div>

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
                <!-- Icon Circle (Reactive with Alpine) -->
                <div 
                    :class="{
                        'border-green-900 bg-green-900 text-white shadow-xl shadow-green-900/20 scale-110 z-10': step == {{ $stepNum }},
                        'border-green-700 bg-green-900 text-white z-10': step > {{ $stepNum }},
                        'border-slate-200 bg-white text-slate-400 z-10': step < {{ $stepNum }}
                    }"
                    class="size-12 rounded-lg flex items-center justify-center transition-all duration-500 border-2 relative"
                >
                    <template x-if="step > {{ $stepNum }}">
                        <iconify-icon icon="lucide:check" class="text-xl font-bold"></iconify-icon>
                    </template>
                    <template x-if="step <= {{ $stepNum }}">
                        <iconify-icon icon="{{ $step['icon'] }}" class="text-xl"></iconify-icon>
                    </template>
                </div>
                <!-- Label (Reactive with Alpine) -->
                <span 
                    :class="{
                        'text-green-950 font-black': step == {{ $stepNum }},
                        'text-green-700 font-bold': step > {{ $stepNum }},
                        'text-slate-400 group-hover:text-slate-500': step < {{ $stepNum }}
                    }"
                    class="text-[10px] font-black uppercase tracking-[0.2em] transition-colors"
                >
                    {{ $step['label'] }}
                </span>
            </button>
        @endforeach
    </div>
</div>

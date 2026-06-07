@props([
    'id' => null,
    'label' => null,
    'type' => 'text',
    'placeholder' => '',
    'icon' => null,
    'value' => '',
    'required' => false,
    'name' => '',
])

<div class="space-y-2">
    <div class="relative pt-2 logic-floating-wrapper">
        @if ($icon)
            <iconify-icon icon="lucide:{{ $icon }}"
                class="absolute left-4 top-1/2 text-slate-400 text-xl pointer-events-none z-20 floating-icon-element"></iconify-icon>
        @endif
        
        <input type="{{ $type }}" id="{{ $id ?? $name }}" name="{{ $name }}" value="{{ $value }}"
            placeholder=" " {{ $required ? 'required' : '' }} 
            @class([
                'peer floating-label-input w-full pr-12 py-3.5 bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-700 focus:border-emerald-700 focus:ring-2 focus:ring-emerald-700/20 rounded-xl text-sm transition-all shadow-sm focus:outline-none text-gray-800 dark:text-gray-100 z-10',
                'has-icon' => $icon,
                'border-red-500 ring-1 ring-red-500 focus:border-red-500 focus:ring-red-500/20' => $errors->has($name),
            ])
            {{ $attributes }} />

        @if ($label)
            <label for="{{ $id ?? $name }}" class="absolute text-sm text-slate-400 dark:text-slate-500 duration-200 transform pointer-events-none z-20 floating-label-text transition-all origin-left bg-white dark:bg-slate-900 px-1">
                {{ $label }} @if ($required)
                    <span class="text-red-500">*</span>
                @endif
            </label>
        @endif

        @if (isset($suffix))
            <div class="logic-floating-wrapper-suffix">
                {{ $suffix }}
            </div>
        @endif
    </div>
    @error($name)
        <p class="text-xs font-semibold text-red-600 mt-1 pl-1">{{ $message }}</p>
    @enderror
</div>

@once
<style>
    /* Wrapper styling */
    .logic-floating-wrapper {
        position: relative !important;
        padding-top: 0.5rem !important;
    }

    /* Vertical icon alignment */
    .logic-floating-wrapper .floating-icon-element {
        position: absolute !important;
        top: 55% !important;
        transform: translateY(-50%) !important;
        left: 1rem !important;
    }

    /* Lock typing offset */
    .floating-label-input {
        padding-left: 1rem !important;
    }
    .floating-label-input.has-icon {
        padding-left: 2.75rem !important;
    }

    /* Suffix positioning */
    .logic-floating-wrapper-suffix {
        position: absolute !important;
        right: 1rem !important;
        top: 50% !important;
        transform: translateY(-50%) !important;
        margin-top: 0.25rem !important; /* Menyeimbangkan pt-2 */
        z-index: 20 !important;
        display: flex !important;
        align-items: center !important;
    }

    /* Default label state */
    .floating-label-input ~ .floating-label-text {
        top: calc(50% + 4px) !important;
        transform: translateY(-50%) scale(1) !important;
        background-color: transparent !important;
        color: #94a3b8 !important;
        left: 1rem !important;
    }
    
    /* Jika input memiliki ikon, geser posisi label awal ke kanan ikon */
    .floating-label-input.has-icon ~ .floating-label-text {
        left: 2.75rem !important; 
    }

    /* Focused/Active label state */
    .floating-label-input:focus ~ .floating-label-text,
    .floating-label-input:not(:placeholder-shown) ~ .floating-label-text {
        top: 7px !important;
        left: 1rem !important;
        transform: translateY(-50%) scale(0.85) !important;
        background-color: #ffffff !important;
        padding: 4px !important;
        color: #0a4332 !important;
    }
    
    /* Sinkronisasi Mode Gelap */
    .dark .floating-label-input:focus ~ .floating-label-text,
    .dark .floating-label-input:not(:placeholder-shown) ~ .floating-label-text {
        background-color: #0f172a !important;
        color: #34d399 !important;
    }
</style>
@endonce
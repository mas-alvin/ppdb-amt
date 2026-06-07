@props([
    'id' => null,
    'label' => null,
    'options' => [],
    'selected' => '',
    'required' => false,
    'name' => '',
])

<div class="space-y-2">
    <div class="relative pt-2 logic-floating-wrapper">
        <select 
            id="{{ $id ?? $name }}" 
            name="{{ $name }}" 
            {{ $required ? 'required' : '' }}
            @class([
                'peer floating-label-select w-full pr-10 py-3.5 bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-700 focus:border-emerald-700 focus:ring-2 focus:ring-emerald-700/20 rounded-xl text-sm transition-all shadow-sm appearance-none focus:outline-none text-gray-800 dark:text-gray-100 z-10',
                'border-red-500 ring-1 ring-red-500 focus:border-red-500 focus:ring-red-500/20' => $errors->has($name),
            ]) 
            {{ $attributes }}>
            <option value="" disabled {{ $selected == '' ? 'selected' : '' }}>Pilih...</option>
            @foreach ($options as $key => $value)
                <option value="{{ $key }}" {{ $selected == (string) $key ? 'selected' : '' }}>{{ $value }}</option>
            @endforeach
        </select>
        
        <div class="absolute inset-y-0 right-0 flex items-center pr-4 pointer-events-none text-slate-400 z-20 pt-2">
            <iconify-icon icon="lucide:chevron-down" class="text-xl"></iconify-icon>
        </div>

        @if ($label)
            <label for="{{ $id ?? $name }}" class="absolute text-sm duration-200 transform pointer-events-none z-20 floating-label-text transition-all origin-left bg-white dark:bg-slate-900 px-1">
                {{ $label }} @if ($required)
                    <span class="text-red-500">*</span>
                @endif
            </label>
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

    /* Lock typing/text offset */
    .floating-label-select {
        padding-left: 1rem !important;
    }

    /* Permanent top floating state for select label */
    .floating-label-select ~ .floating-label-text {
        top: 7px !important;
        left: 1rem !important;
        transform: translateY(-50%) scale(0.85) !important;
        background-color: #ffffff !important;
        padding: 4px !important;
        color: #94a3b8 !important;
    }

    /* Focused label state */
    .floating-label-select:focus ~ .floating-label-text {
        color: #0a4332 !important;
    }
    
    /* Dark Mode support */
    .dark .floating-label-select ~ .floating-label-text {
        background-color: #0f172a !important;
    }
    
    .dark .floating-label-select:focus ~ .floating-label-text {
        color: #34d399 !important;
    }
</style>
@endonce

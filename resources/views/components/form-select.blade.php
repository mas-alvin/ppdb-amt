@props([
    'id',
    'label',
    'options' => [],
    'placeholder' => 'Pilih...',
    'icon' => null,
    'selected' => '',
    'required' => false,
    'name' => '',
])

<div class="space-y-2">
    @if ($label)
        <label class="block text-sm font-medium text-slate-700 dark:text-slate-300" for="{{ $id ?? $name }}">
            {{ $label }} @if ($required)
                <span class="text-red-500">*</span>
            @endif
        </label>
    @endif
    <div class="relative">
        @if ($icon)
            <iconify-icon icon="lucide:{{ $icon }}"
                class="absolute left-3 top-1/2 -translate-y-1/2 text-slate-400 text-xl pointer-events-none"></iconify-icon>
        @endif
        <select id="{{ $id ?? $name }}" name="{{ $name }}" {{ $required ? 'required' : '' }}
            @class([
                'w-full py-3 bg-slate-50 dark:bg-slate-800 border-transparent focus:border-primary focus:ring-2 focus:ring-primary/20 rounded-lg text-sm transition-all shadow-sm appearance-none',
                'pl-10' => $icon,
                'px-4' => !$icon,
            ]) {{ $attributes }}>
            <option value="" disabled {{ $selected == '' ? 'selected' : '' }}>{{ $placeholder }}</option>
            @foreach ($options as $key => $value)
                <option value="{{ $key }}" {{ $selected == $key ? 'selected' : '' }}>{{ $value }}
                </option>
            @endforeach
        </select>
        <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none text-slate-400">
            <iconify-icon icon="lucide:chevron-down" class="text-xl"></iconify-icon>
        </div>
    </div>
</div>

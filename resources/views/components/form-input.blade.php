@props([
    'id',
    'label',
    'type' => 'text',
    'placeholder' => '',
    'icon' => null,
    'value' => '',
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
                class="absolute left-3 top-1/2 -translate-y-1/2 text-slate-400 text-xl"></iconify-icon>
        @endif
        <input type="{{ $type }}" id="{{ $id ?? $name }}" name="{{ $name }}" value="{{ $value }}"
            placeholder="{{ $placeholder }}" {{ $required ? 'required' : '' }} @class([
                'w-full py-3 bg-slate-50 dark:bg-slate-800 border-transparent focus:border-primary focus:ring-2 focus:ring-primary/20 rounded-lg text-sm transition-all shadow-sm',
                'pl-10' => $icon,
                'px-4' => !$icon,
            ])
            {{ $attributes }} />
    </div>
</div>

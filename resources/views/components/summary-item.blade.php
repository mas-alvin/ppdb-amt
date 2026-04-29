@props(['label', 'value', 'highlight' => false])

<div>
    <dt class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-1">
        {{ $label }}
    </dt>
    <dd class="text-sm font-bold {{ $highlight ? 'text-green-700 bg-green-50 px-2 py-0.5 rounded inline-block' : 'text-slate-800' }}">
        {{ $value }}
    </dd>
</div>

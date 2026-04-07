@props(['rows' => 5, 'cols' => 5])

<div class="animate-pulse space-y-3 rounded-xl border border-gray-100 bg-white p-4" aria-hidden="true">
    <div class="flex gap-2">
        @for ($c = 0; $c < $cols; $c++)
            <div class="h-4 bg-gray-200 rounded flex-1"></div>
        @endfor
    </div>
    @for ($r = 0; $r < $rows; $r++)
        <div class="flex gap-2">
            @for ($c = 0; $c < $cols; $c++)
                <div class="h-10 bg-gray-100 rounded flex-1"></div>
            @endfor
        </div>
    @endfor
</div>

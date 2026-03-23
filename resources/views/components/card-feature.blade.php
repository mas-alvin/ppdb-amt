@props(['icon', 'title', 'description'])

<div
    class="group p-8 rounded-2xl bg-white dark:bg-background-dark border border-primary/10 hover:border-primary transition-all shadow-sm hover:shadow-xl">
    <div
        class="size-14 rounded-xl bg-primary/10 flex items-center justify-center mb-6 group-hover:bg-primary group-hover:text-white transition-all text-primary">
        <iconify-icon icon="lucide:{{ $icon }}" class="text-3xl"></iconify-icon>
    </div>
    <h3 class="text-xl font-bold mb-3 text-emerald-dark dark:text-white">{{ $title }}</h3>
    <p class="text-slate-600 dark:text-slate-400">{{ $description }}</p>
</div>

<section class="relative z-30 -mt-16 px-4">
    <div class="max-w-7xl mx-auto grid grid-cols-2 md:grid-cols-4 gap-4">
        {{-- Stat items can be hardcoded or passed via a loop --}}
        @php
            $stats = [
                ['icon' => 'users', 'val' => '1500+', 'label' => 'Siswa'],
                ['icon' => 'user-square', 'val' => '120+', 'label' => 'Guru'],
                ['icon' => 'building-2', 'val' => '45', 'label' => 'Fasilitas'],
                ['icon' => 'award', 'val' => '200+', 'label' => 'Prestasi'],
            ];
        @endphp

        @foreach ($stats as $stat)
            <div
                class="bg-white dark:bg-emerald-dark p-6 rounded-2xl shadow-xl flex flex-col items-center text-center border border-primary/10">
                <iconify-icon icon="lucide:{{ $stat['icon'] }}" class="text-primary text-4xl mb-2"></iconify-icon>
                <span class="text-2xl font-black text-slate-900 dark:text-white">{{ $stat['val'] }}</span>
                <span
                    class="text-sm text-slate-500 dark:text-emerald-100/70 uppercase tracking-widest font-bold">{{ $stat['label'] }}</span>
            </div>
        @endforeach
    </div>
</section>

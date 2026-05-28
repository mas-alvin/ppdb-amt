<x-layout-public>
    <x-navbar-public />

    {{-- Hero Section --}}
    <section class="relative py-20 overflow-hidden bg-green-900 text-white">
        <div class="absolute inset-0 opacity-10 pointer-events-none"
            style="background-image: url('{{ asset('bg-amt.jpg') }}'); background-size: cover; background-repeat: no-repeat; background-position: center center;">
        </div>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center">
            <h1 class="text-4xl md:text-5xl font-black mb-4">Brosur Pendaftaran</h1>
            <p class="text-lg text-white/80 max-w-2xl mx-auto">
                Unduh brosur resmi Penerimaan Peserta Didik Baru SMK Al-Mujtama' untuk mendapatkan rincian informasi program keahlian, sarana, dan fasilitas kami.
            </p>
        </div>
    </section>

    {{-- Brochure Content Section --}}
    <section class="py-20 bg-slate-50 relative">
        <div class="max-w-4xl mx-auto px-4 sm:px-6">
            @if($brochurePath)
                <div class="bg-white rounded-2xl shadow-xl border border-slate-100 overflow-hidden" data-aos="fade-up">
                    {{-- Premium header inside card --}}
                    <div class="p-6 md:p-8 bg-green-950 text-white flex flex-col sm:flex-row items-center justify-between gap-4">
                        <div class="flex items-center gap-4">
                            <div class="size-12 rounded-lg bg-white/10 flex items-center justify-center text-yellow-400">
                                <iconify-icon icon="lucide:file-text" class="text-2xl"></iconify-icon>
                            </div>
                            <div>
                                <h3 class="font-black text-lg">Brosur Resmi PPDB SMK Al-Mujtama'</h3>
                                <p class="text-white/60 text-xs uppercase tracking-widest font-semibold">Tahun Pelajaran {{ \App\Models\Setting::getValue('academic_year', now()->year . '/' . (now()->year + 1)) }}</p>
                            </div>
                        </div>

                        <a href="{{ asset('storage/' . $brochurePath) }}" download
                            class="inline-flex items-center gap-2 px-6 py-3 rounded-lg bg-yellow-500 hover:bg-yellow-400 text-green-950 font-black text-sm transition-all shadow-lg shadow-yellow-500/20 active:scale-95">
                            <iconify-icon icon="lucide:download"></iconify-icon>
                            UNDUH BROSUR (JPG)
                        </a>
                    </div>

                    {{-- Dynamic File Preview based on extension --}}
                    @php
                        $extension = strtolower(pathinfo($brochurePath, PATHINFO_EXTENSION));
                    @endphp

                    <div class="bg-slate-100 p-4 min-h-[500px] flex items-center justify-center">
                        @if($extension === 'pdf')
                            <iframe src="{{ asset('storage/' . $brochurePath) }}" class="w-full h-[600px] border-none rounded-lg shadow-inner"></iframe>
                        @else
                            <img src="{{ asset('storage/' . $brochurePath) }}" alt="Brosur PPDB" class="max-w-full h-auto rounded-lg shadow-md object-contain">
                        @endif
                    </div>
                </div>
            @else
                {{-- Premium Glassmorphism Empty State --}}
                <div class="relative p-12 text-center rounded-2xl bg-white/40 backdrop-blur-xl border border-white/60 shadow-xl" data-aos="fade-up">
                    <div class="size-20 bg-green-900/10 text-green-900 rounded-full flex items-center justify-center mx-auto mb-6">
                        <iconify-icon icon="lucide:info" class="text-4xl"></iconify-icon>
                    </div>
                    <h3 class="text-2xl font-black text-green-950 mb-3">Brosur Belum Tersedia</h3>
                    <p class="text-slate-600 max-w-md mx-auto mb-8 text-sm leading-relaxed">
                        Saat ini panitia pendaftaran sedang mematangkan materi brosur terbaru. Silakan periksa kembali halaman ini beberapa saat lagi, atau hubungi pusat informasi kami.
                    </p>
                    <a href="/kontak" class="inline-flex items-center gap-2 px-8 py-3 rounded-lg bg-green-900 text-white font-bold text-sm shadow-md hover:bg-green-800 transition-all">
                        <iconify-icon icon="lucide:phone-call"></iconify-icon>
                        Hubungi Kontak Layanan
                    </a>
                </div>
            @endif
        </div>
    </section>

    {{-- Call to Action --}}
    <section class="py-20 bg-green-900 text-white text-center">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
            <h3 class="text-3xl font-black mb-4">Ingin Segera Mendaftar?</h3>
            <p class="text-white/80 mb-8">Pendaftaran online dibuka 24 jam. Segera buat akun Anda dan mulailah mengisi formulir pendaftaran.</p>
            <a href="/register" class="inline-block px-8 py-4 rounded-lg bg-yellow-500 hover:bg-yellow-400 text-green-950 font-black text-lg transition-all shadow-xl shadow-yellow-500/30 hover:-translate-y-1">
                Mulai Pendaftaran
            </a>
        </div>
    </section>
</x-layout-public>

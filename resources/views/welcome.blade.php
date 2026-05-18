<x-layout-public>
    {{-- =====================================================
         PUBLIC NAVBAR (halaman beranda)
         ===================================================== --}}
    <x-navbar-public />
    {{-- =====================================================
         HERO SECTION (Premium Redesign)
         ===================================================== --}}
    <section id="beranda"
        class="relative min-h-screen md:min-h-[800px] flex items-center overflow-hidden bg-slate-50">

        {{-- Sophisticated Background Overlay --}}
        <div class="absolute inset-0 z-0">
            {{-- Primary Background Image --}}
            <img alt="SMK AL-MUJTAMA'" class="w-full h-full object-cover scale-105" src="{{ asset('bg-amt.jpg') }}" />

            {{-- Gradient Overlays --}}
            <div class="absolute inset-0 bg-linear-to-b from-white/40 via-white/80 to-white z-10"></div>
            <div class="absolute inset-0 bg-linear-to-r from-white via-white/60 to-transparent z-10 hidden md:block">
            </div>

            {{-- Decorative Mesh Gradient (Subtle) --}}
            <div
                class="absolute top-0 right-0 w-[500px] h-[500px] bg-green-400/20 rounded-lg blur-3xl -translate-y-1/2 translate-x-1/2 z-10">
            </div>
            <div
                class="absolute bottom-0 left-0 w-[400px] h-[400px] bg-yellow-400/10 rounded-lg blur-3xl translate-y-1/2 -translate-x-1/2 z-10">
            </div>
        </div>

        <div class="relative z-20 w-full max-w-auto mx-10 px-4 sm:px-6 lg:px-8 py-12 md:py-24">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">

                {{-- Left Content --}}
                <div class="lg:col-span-7 xl:col-span-7" data-aos="fade-right">

                    <h1
                        class="text-4xl sm:text-5xl md:text-6xl lg:text-7xl font-black text-green-950 leading-[1.1] mb-8">
                        Langkah <span class="text-yellow-600 italic">Emas</span> <br class="hidden sm:block">
                        Menuju Masa Depan <br class="hidden sm:block">
                        <span class="text-transparent bg-clip-text bg-linear-to-r from-green-700 to-green-900">
                            Cerdas Berakhlak
                        </span>
                    </h1>

                    <p
                        class="text-base md:text-lg text-slate-600 leading-relaxed mb-10 max-w-2xl border-l-4 border-yellow-500 pl-6">
                        SMK AL-MUJTAMA' Pamekasan menghadirkan pendidikan vokasi berbasis nilai pesantren. Kami mencetak
                        lulusan siap kerja, kompetitif, dan berkarakter mulia di era digital.
                    </p>

                    <div class="flex flex-col sm:flex-row items-center gap-4">
                        <a href="/register"
                            class="group w-full sm:w-auto inline-flex items-center justify-center gap-3 px-10 py-4 rounded-lg bg-green-900 text-white font-black text-lg hover:bg-green-800 transition-all shadow-2xl shadow-green-900/40 active:scale-95">
                            DAFTAR SEKARANG
                            <iconify-icon icon="lucide:arrow-right"
                                class="text-xl group-hover:translate-x-2 transition-transform"></iconify-icon>
                        </a>
                        <a href="/#profile"
                            class="w-full sm:w-auto inline-flex items-center justify-center gap-3 px-10 py-4 rounded-lg bg-white/50 backdrop-blur-md text-green-950 font-bold text-lg border-2 border-green-900/10 hover:bg-white hover:border-green-900/30 transition-all active:scale-95">
                            PROFIL SEKOLAH
                        </a>
                    </div>

                    {{-- Stats Summary --}}
                    <div class="mt-16 grid grid-cols-2 sm:grid-cols-3 gap-6 md:gap-10 border-t border-slate-200 pt-10">
                        <div class="group">
                            <p
                                class="text-3xl md:text-4xl font-black text-green-950 group-hover:text-yellow-600 transition-colors">
                                1.5K+</p>
                            <p class="text-xs md:text-sm text-slate-500 font-black uppercase tracking-widest mt-1">
                                Siswa Aktif</p>
                        </div>
                        <div class="group">
                            <p
                                class="text-3xl md:text-4xl font-black text-green-950 group-hover:text-yellow-600 transition-colors">
                                120+</p>
                            <p class="text-xs md:text-sm text-slate-500 font-black uppercase tracking-widest mt-1">
                                Tenaga Ahli</p>
                        </div>
                        <div class="group col-span-2 sm:col-span-1">
                            <p
                                class="text-3xl md:text-4xl font-black text-green-950 group-hover:text-yellow-600 transition-colors">
                                45+</p>
                            <p class="text-xs md:text-sm text-slate-500 font-black uppercase tracking-widest mt-1">
                                Fasilitas Modern</p>
                        </div>
                    </div>
                </div>

                {{-- Right Decorative Card (Desktop Only) --}}
                <div class="hidden lg:block lg:col-span-5 relative" data-aos="zoom-in" data-aos-delay="200">
                    <!-- PEMBUNGKUS KONTEN UTAMA -->
                    <div
                        class="relative z-10 p-8 rounded-lg bg-white/40 backdrop-blur-xl border border-white/40 shadow-[0_32px_64px_-16px_rgba(0,0,0,0.1)] overflow-hidden">

                        {{-- Image Placeholder with overlay --}}
                        <div class="relative h-[450px] w-full bg-slate-200 rounded-lg overflow-hidden mb-6">
                            <img src="{{ asset('bg-amt.jpg') }}" class="w-full h-full object-cover" alt="Student">
                            <div class="absolute inset-0 bg-linear-to-t from-green-950/80 to-transparent"></div>

                            <div class="absolute bottom-6 left-6 right-6">
                                <h3 class="text-white text-2xl font-black mb-2 leading-tight">Membangun Karakter
                                    Melalui Pendidikan</h3>
                                <p class="text-white/80 text-sm">Bergabunglah dengan komunitas pembelajar kami.</p>
                            </div>
                        </div>

                        {{-- Card Background Pattern --}}
                        <div class="absolute -right-20 -bottom-20 w-64 h-64 bg-green-600/10 rounded-lg blur-3xl"></div>
                    </div>

                    <!-- LAYER PALING ATAS (KARTU MENGAPUNG DIPINDAH KE SINI) -->
                    <div
                        class="absolute z-50 -top-4 -right-4 p-4 bg-yellow-500 text-green-950 font-black rounded-lg shadow-xl rotate-3">
                        PPDB {{ now()->year }}
                    </div>

                    {{-- Floating Mini Cards: Akreditasi Grade A+ --}}
                    <div
                        class="absolute z-50 -bottom-2 -left-4 p-5 bg-green-900 text-white rounded-lg shadow-2xl flex items-center gap-3 -rotate-3 border border-white/20">
                        <div class="size-10 bg-white/20 rounded-lg flex items-center justify-center">
                            <iconify-icon icon="lucide:check-circle" class="text-2xl"></iconify-icon>
                        </div>
                        <div>
                            <p class="text-xs font-bold text-white/70 uppercase">Akreditasi</p>
                            <p class="text-lg font-black leading-tight">Grade A+</p>
                        </div>
                    </div>

                    {{-- Background Decorative Rings --}}
                    <div
                        class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[120%] h-[120%] border border-green-900/5 rounded-lg -z-10 pointer-events-none">
                    </div>
                    <div
                        class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[110%] h-[110%] border border-green-900/5 rounded-lg -z-10 pointer-events-none rotate-12">
                    </div>
                </div>


            </div>
        </div>
    </section>

    {{-- =====================================================
         FEATURES / WHY US (id=profile)
         ===================================================== --}}
    <section id="profile" class="py-24 relative overflow-hidden bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">

            <div class="text-center max-w-3xl mx-auto mb-20">
                <h2 class="text-sm font-black text-yellow-600 uppercase tracking-[0.3em] mb-4">Keunggulan Kami</h2>
                <h3 class="text-3xl md:text-5xl font-black text-green-950 mb-6">
                    Pendidikan Berkualitas untuk <br> Generasi Masa Depan
                </h3>
                <p class="text-slate-600 text-lg">
                    Kami memadukan nilai-nilai luhur pesantren dengan kemajuan teknologi modern untuk menciptakan
                    lingkungan belajar yang inspiratif.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                {{-- Feature 1 --}}
                <div
                    class="group p-10 rounded-lg bg-slate-50 border border-slate-100 hover:bg-white hover:border-green-200 transition-all duration-500 hover:shadow-2xl hover:shadow-green-900/5">
                    <div
                        class="size-16 rounded-lg bg-green-900 flex items-center justify-center mb-8 text-white shadow-lg shadow-green-900/20 group-hover:scale-110 transition-transform">
                        <iconify-icon icon="lucide:book-open" class="text-3xl"></iconify-icon>
                    </div>
                    <h4 class="text-2xl font-bold text-green-950 mb-4">Kurikulum Terintegrasi</h4>
                    <p class="text-slate-600 leading-relaxed">
                        Perpaduan kurikulum nasional dan kurikulum pesantren yang membentuk kecerdasan intelektual dan
                        spiritual.
                    </p>
                </div>

                {{-- Feature 2 --}}
                <div
                    class="group p-10 rounded-lg bg-slate-50 border border-slate-100 hover:bg-white hover:border-green-200 transition-all duration-500 hover:shadow-2xl hover:shadow-green-900/5">
                    <div
                        class="size-16 rounded-lg bg-yellow-500 flex items-center justify-center mb-8 text-white shadow-lg shadow-yellow-500/20 group-hover:scale-110 transition-transform">
                        <iconify-icon icon="lucide:users" class="text-3xl"></iconify-icon>
                    </div>
                    <h4 class="text-2xl font-bold text-green-950 mb-4">Pengajar Berdedikasi</h4>
                    <p class="text-slate-600 leading-relaxed">
                        Tenaga pendidik profesional yang tidak hanya mengajar, tetapi juga menjadi mentor dan teladan
                        bagi siswa.
                    </p>
                </div>

                {{-- Feature 3 --}}
                <div
                    class="group p-10 rounded-lg bg-slate-50 border border-slate-100 hover:bg-white hover:border-green-200 transition-all duration-500 hover:shadow-2xl hover:shadow-green-900/5">
                    <div
                        class="size-16 rounded-lg bg-green-700 flex items-center justify-center mb-8 text-white shadow-lg shadow-green-700/20 group-hover:scale-110 transition-transform">
                        <iconify-icon icon="lucide:laptop" class="text-3xl"></iconify-icon>
                    </div>
                    <h4 class="text-2xl font-bold text-green-950 mb-4">Fasilitas Modern</h4>
                    <p class="text-slate-600 leading-relaxed">
                        Laboratorium komputer, workshop, dan area olahraga yang lengkap untuk mendukung proses
                        eksplorasi siswa.
                    </p>
                </div>
            </div>
        </div>
    </section>

    {{-- =====================================================
         MAJORS / PROGRAM KEAHLIAN
         ===================================================== --}}
    <section class="py-24 bg-green-950 relative overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="flex flex-col md:flex-row justify-between items-end mb-16 gap-8">
                <div class="max-w-2xl">
                    <h2 class="text-sm font-black text-yellow-500 uppercase tracking-[0.3em] mb-4">Program Keahlian
                    </h2>
                    <h3 class="text-3xl md:text-5xl font-black text-white">
                        Pilih Jalur Kesuksesanmu
                    </h3>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 max-w-5xl mx-auto">
                {{-- Major 1 --}}
                <div
                    class="group bg-white/5 backdrop-blur-md rounded-lg overflow-hidden border border-white/10 hover:border-yellow-500/50 transition-all duration-500">
                    <div class="relative h-64 overflow-hidden">
                        <img src="https://images.unsplash.com/photo-1517694712202-14dd9538aa97?q=80&w=2070&auto=format&fit=crop"
                            class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                        <div class="absolute inset-0 bg-linear-to-t from-green-950 via-transparent to-transparent">
                        </div>
                        <div class="absolute bottom-6 left-6">
                            <span
                                class="px-3 py-1 rounded-lg bg-yellow-500 text-green-950 text-[10px] font-black uppercase">Unggulan</span>
                        </div>
                    </div>
                    <div class="p-8">
                        <h4 class="text-2xl font-bold text-white mb-3">Pengembangan Perangkat Lunak & Gim (PPLG)</h4>
                        <p class="text-white/60 mb-6 leading-relaxed">
                            Kuasai dunia teknologi melalui pengembangan aplikasi web, mobile, dan sistem cerdas masa
                            depan.
                        </p>
                        <a href="#"
                            class="inline-flex items-center gap-2 text-yellow-500 font-bold hover:gap-4 transition-all">
                            Lihat Detail <iconify-icon icon="lucide:chevron-right"></iconify-icon>
                        </a>
                    </div>
                </div>

                {{-- Major 2 --}}
                <div
                    class="group bg-white/5 backdrop-blur-md rounded-lg overflow-hidden border border-white/10 hover:border-yellow-500/50 transition-all duration-500">
                    <div class="relative h-64 overflow-hidden">
                        <img src="https://smkn2magetan.sch.id/wp-content/uploads/2023/05/IMG_76661-scaled.jpg"
                            class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                        <div class="absolute inset-0 bg-linear-to-t from-green-950 via-transparent to-transparent">
                        </div>
                    </div>
                    <div class="p-8">
                        <h4 class="text-2xl font-bold text-white mb-3">Desain dan Produksi Busana (DPB)</h4>
                        <p class="text-white/60 mb-6 leading-relaxed">
                            Eksplorasi kreativitas dalam desain busana, teknik menjahit modern, dan kewirausahaan
                            fashion.
                        </p>
                        <a href=""
                            class="inline-flex items-center gap-2 text-yellow-500 font-bold hover:gap-4 transition-all">
                            Lihat Detail <iconify-icon icon="lucide:chevron-right"></iconify-icon>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </section>

    {{-- =====================================================
         CTA SECTION
         ===================================================== --}}
    <section class="py-24 bg-white relative overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div
                class="relative rounded-lg bg-linear-to-br from-green-900 to-green-950 p-12 md:p-20 overflow-hidden shadow-2xl">

                <div class="relative z-10 max-w-3xl mx-auto text-center">
                    <h2 class="text-3xl md:text-5xl font-black text-white mb-8 leading-tight">
                        Siap Menjadi Bagian dari <br> Keluarga Besar Kami?
                    </h2>
                    <p class="text-white/70 text-lg md:text-xl mb-12 max-w-2xl mx-auto">
                        Jangan lewatkan kesempatan untuk mendapatkan pendidikan terbaik. Proses pendaftaran mudah dan
                        cepat melalui sistem online kami.
                    </p>
                    <div class="flex flex-col sm:flex-row items-center justify-center gap-6">
                        <a href="/register"
                            class="w-full sm:w-auto px-12 py-5 rounded-lg bg-yellow-500 hover:bg-yellow-400 text-green-950 font-black text-xl transition-all shadow-xl shadow-yellow-500/30 hover:-translate-y-1">
                            Daftar Sekarang
                        </a>
                        <a href="/kontak"
                            class="w-full sm:w-auto px-12 py-5 rounded-lg bg-white/10 hover:bg-white/20 text-white font-bold text-xl backdrop-blur-sm transition-all border border-white/20">
                            Hubungi Kami
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- =====================================================
         MAP / KONTAK SECTION (id=kontak)
         ===================================================== --}}
    <section id="kontak" class="py-24 bg-slate-50 relative overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">

                <div>
                    <h2 class="text-sm font-black text-yellow-600 uppercase tracking-[0.3em] mb-4">Lokasi & Kontak</h2>
                    <h3 class="text-3xl md:text-5xl font-black text-green-950 mb-8">
                        Kunjungi Sekolah Kami
                    </h3>

                    <div class="space-y-8">
                        <div class="flex gap-6">
                            <div
                                class="size-14 rounded-lg bg-green-900/10 flex items-center justify-center text-green-900 shrink-0">
                                <iconify-icon icon="lucide:map-pin" class="text-2xl"></iconify-icon>
                            </div>
                            <div>
                                <h4 class="text-xl font-bold text-green-950 mb-1">Alamat Utama</h4>
                                <p class="text-slate-600">Jl. Raya Pegantenan No.KM. 09, Tengracak, Plakpak, Kec. Pegantenan, Kabupaten Pamekasan, Jawa Timur 69361</p>
                            </div>
                        </div>

                        <div class="flex gap-6">
                            <div
                                class="size-14 rounded-lg bg-green-900/10 flex items-center justify-center text-green-900 shrink-0">
                                <iconify-icon icon="lucide:phone" class="text-2xl"></iconify-icon>
                            </div>
                            <div>
                                <h4 class="text-xl font-bold text-green-950 mb-1">Telepon & WhatsApp</h4>
                                <p class="text-slate-600">(0324) 322551 / +62 812-3456-7890</p>
                            </div>
                        </div>

                        <div class="flex gap-6">
                            <div
                                class="size-14 rounded-lg bg-green-900/10 flex items-center justify-center text-green-900 shrink-0">
                                <iconify-icon icon="lucide:mail" class="text-2xl"></iconify-icon>
                            </div>
                            <div>
                                <h4 class="text-xl font-bold text-green-950 mb-1">Email Resmi</h4>
                                <p class="text-slate-600">smkalmujtama@gmail.com</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="relative group">
                    <div class="absolute -inset-4 bg-linear-to-br from-green-900 to-yellow-500 opacity-20 rounded-lg blur-2xl group-hover:opacity-30 transition-opacity"></div>
                    <div class="relative rounded-lg overflow-hidden shadow-2xl border-4 border-white aspect-video lg:aspect-square">
                        <iframe
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d989.8239220694884!2d113.47735938333!3d-7.091683052537438!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd9d41a55555555%3A0x742aae086b15ec3f!2sPondok%20Pesantren%20Al%20-%20Mujtama&#39;!5e0!3m2!1sid!2sid!4v1779071442995!5m2!1sid!2sid"
                            width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade" class="w-full h-full"></iframe>
                    </div>
                </div>

            </div>
        </div>
    </section>
</x-layout-public>

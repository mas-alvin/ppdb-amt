<x-layout-public>
    <x-navbar-public />

    {{-- Hero Section --}}
    <section class="relative py-20 overflow-hidden bg-green-900 text-white">
        <div class="absolute inset-0 opacity-10 pointer-events-none"
            style="background-image: url('{{ asset('bg-amt.jpg') }}'); background-size: cover; background-repeat: no-repeat; background-position: center center;">
        </div>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center">
            <h1 class="text-4xl md:text-5xl font-black mb-4">Profil Sekolah</h1>
            <p class="text-lg text-white/80 max-w-2xl mx-auto">
                Mengenal lebih dekat SMK Al-Mujtama', lembaga pendidikan yang memadukan nilai pesantren dan teknologi
                modern.
            </p>
        </div>
    </section>

    {{-- Visi & Misi --}}
    <section class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-12 items-center">
                <div>
                    <h2 class="text-sm font-black text-yellow-600 uppercase tracking-[0.3em] mb-4">Visi & Misi</h2>
                    <h3 class="text-3xl font-black text-green-950 mb-6">Arah dan Tujuan Kami</h3>
                    <p class="text-slate-600 mb-6 leading-relaxed">
                        SMK Al-Mujtama' berkomitmen untuk mencetak generasi yang tidak hanya unggul dalam bidang
                        teknologi dan kejuruan, tetapi juga memiliki pondasi akhlak yang kokoh berdasarkan nilai-nilai
                        Islam.
                    </p>
                    <div class="space-y-4">
                        <div class="flex gap-4">
                            <div
                                class="size-8 rounded-full bg-green-100 flex items-center justify-center text-green-900 shrink-0">
                                <iconify-icon icon="lucide:check" class="text-lg"></iconify-icon>
                            </div>
                            <div>
                                <h4 class="font-bold text-green-950">Visi</h4>
                                <p class="text-slate-600 text-sm">Mewujudkan sumber daya manusia beriman dan bertaqwa,
                                    beretos kerja tinggi, dan berkemandirian melalui pendidikan berbasis pondok
                                    pesantren yang berakar pada masyarakat madani.</p>
                            </div>
                        </div>
                        <div class="flex gap-4">
                            <div
                                class="size-8 rounded-full bg-green-100 flex items-center justify-center text-green-900 shrink-0">
                                <iconify-icon icon="lucide:check" class="text-lg"></iconify-icon>
                            </div>
                            <div>
                                <h4 class="font-bold text-green-950">Misi</h4>
                                <p class="text-slate-600 text-sm">1. Mensinergikan potensi pondok pesantren dengan
                                    stake-holder sehingga memiliki dukungan yang maksimal terhadap pembentukan SDM yang
                                    berkualitas;</p>
                                <p class="text-slate-600 text-sm">2. Membekali siswa dengan keterampilan kecakapan hidup
                                    (lifeskill) yang dilandasi moralitas dan kejujuran yang tinggi;</p>
                                <p class="text-slate-600 text-sm">3. Menguatkan pola manajerial sekolah yang berbasis
                                    pada keterampilan, inovatif dan kreatif, guna mempercepat peningkatan mutu.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="relative group">
                    <div
                        class="absolute -inset-4 bg-linear-to-br from-green-900 to-yellow-500 opacity-20 rounded-lg blur-2xl group-hover:opacity-30 transition-opacity">
                    </div>
                    <div
                        class="relative rounded-lg overflow-hidden shadow-2xl border-4 border-white aspect-video bg-slate-200">
                        <iframe class="absolute inset-0 w-full h-full"
                            src="https://www.youtube.com/embed/y42Kxd_yPEs?si=YfIh6iFc4a4cVOGs&autoplay=1&mute=0"
                            title="YouTube video player" frameborder="0"
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture;"
                            referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Keunggulan Kami (Copied from welcome.blade.php) --}}
    <section class="py-20 bg-slate-50 relative overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">

            <div class="text-center max-w-3xl mx-auto mb-16">
                <h2 class="text-sm font-black text-yellow-600 uppercase tracking-[0.3em] mb-4">Keunggulan Kami</h2>
                <h3 class="text-3xl md:text-4xl font-black text-green-950 mb-6">
                    Pendidikan Berkualitas untuk Generasi Masa Depan
                </h3>
                <p class="text-slate-600 text-lg">
                    Kami memadukan nilai-nilai luhur pesantren dengan kemajuan teknologi modern untuk menciptakan
                    lingkungan belajar yang inspiratif.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                {{-- Feature 1 --}}
                <div
                    class="group p-10 rounded-lg bg-white border border-slate-100 hover:border-green-200 transition-all duration-500 hover:shadow-2xl hover:shadow-green-900/5">
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
                    class="group p-10 rounded-lg bg-white border border-slate-100 hover:border-green-200 transition-all duration-500 hover:shadow-2xl hover:shadow-green-900/5">
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
                    class="group p-10 rounded-lg bg-white border border-slate-100 hover:border-green-200 transition-all duration-500 hover:shadow-2xl hover:shadow-green-900/5">
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

    {{-- Program Keahlian --}}
    <section class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-3xl mx-auto mb-16">
                <h2 class="text-sm font-black text-yellow-600 uppercase tracking-[0.3em] mb-4">Program Keahlian</h2>
                <h3 class="text-3xl font-black text-green-950 mb-6">Pilihan Masa Depanmu</h3>
                <p class="text-slate-600 text-lg">
                    Kami menyediakan program keahlian yang relevan dengan kebutuhan industri saat ini.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div
                    class="p-8 rounded-lg border border-slate-100 hover:border-green-200 transition-all bg-slate-50 flex gap-6">
                    <div
                        class="size-14 rounded-lg bg-green-900/10 flex items-center justify-center text-green-900 shrink-0">
                        <iconify-icon icon="lucide:code" class="text-2xl"></iconify-icon>
                    </div>
                    <div>
                        <h4 class="text-xl font-bold text-green-950 mb-2">Pengembangan Perangkat Lunak & Gim (PPLG)</h4>
                        <p class="text-slate-600 text-sm">Mempelajari pemrograman web, mobile, desktop, serta pembuatan
                            game interaktif.</p>
                    </div>
                </div>
                <div
                    class="p-8 rounded-lg border border-slate-100 hover:border-green-200 transition-all bg-slate-50 flex gap-6">
                    <div
                        class="size-14 rounded-lg bg-green-900/10 flex items-center justify-center text-green-900 shrink-0">
                        <iconify-icon icon="lucide:scissors" class="text-2xl"></iconify-icon>
                    </div>
                    <div>
                        <h4 class="text-xl font-bold text-green-950 mb-2">Desain dan Produksi Busana (DPB)</h4>
                        <p class="text-slate-600 text-sm">Mempelajari desain busana, teknik menjahit modern, pola
                            busana, dan kewirausahaan fashion.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-layout-public>

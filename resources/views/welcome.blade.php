<x-layout-public>
    {{-- =====================================================
         PUBLIC NAVBAR (halaman beranda)
         ===================================================== --}}
    <nav id="public-navbar"
        class="bg-white/80 dark:bg-slate-900/80 backdrop-blur-lg border-b border-slate-200/60 dark:border-slate-800/60 sticky top-0 z-50 transition-all duration-300">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16">
                <!-- Logo -->
                <a href="/" class="flex items-center gap-3 shrink-0">
                    <img src="{{ asset('LOGO-PPDB.png') }}" alt="Logo PPDB" class="h-10 w-auto">
                </a>

                <!-- Desktop Navigation -->
                <div class="hidden md:flex items-center gap-1">
                    <a href="/#beranda"
                        class="px-4 py-2 rounded-lg text-slate-600 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-slate-800 font-medium text-sm flex items-center gap-2 transition-colors">
                        <iconify-icon icon="lucide:home" class="text-lg"></iconify-icon> Beranda
                    </a>
                    <a href="/#profile"
                        class="px-4 py-2 rounded-lg text-slate-600 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-slate-800 font-medium text-sm flex items-center gap-2 transition-colors">
                        <iconify-icon icon="lucide:school" class="text-lg"></iconify-icon> Profile
                    </a>
                    <a href="/register"
                        class="px-4 py-2 rounded-lg text-slate-600 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-slate-800 font-medium text-sm flex items-center gap-2 transition-colors">
                        <iconify-icon icon="lucide:clipboard-list" class="text-lg"></iconify-icon> Pendaftaran
                    </a>
                    <a href="/#kontak"
                        class="px-4 py-2 rounded-lg text-slate-600 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-slate-800 font-medium text-sm flex items-center gap-2 transition-colors">
                        <iconify-icon icon="lucide:phone" class="text-lg"></iconify-icon> Kontak
                    </a>
                </div>

                <!-- Desktop CTA -->
                <div class="hidden md:flex items-center gap-3">
                    <a href="/login"
                        class="px-4 py-2 rounded-lg border border-primary text-primary font-semibold text-sm hover:bg-primary hover:text-white transition-all duration-200">
                        Masuk
                    </a>
                    <a href="/register"
                        class="px-4 py-2 rounded-lg bg-primary text-white font-semibold text-sm hover:bg-primary/90 transition-all duration-200 shadow-sm shadow-primary/20">
                        Daftar Sekarang
                    </a>
                </div>

                <!-- Mobile Hamburger -->
                <button id="public-hamburger-btn"
                    class="md:hidden p-2 text-slate-600 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-slate-800 rounded-lg transition-colors"
                    aria-label="Buka menu">
                    <iconify-icon icon="lucide:menu" class="text-2xl"></iconify-icon>
                </button>
            </div>
        </div>
    </nav>

    <!-- Mobile Overlay -->
    <div id="public-sidebar-overlay"
        class="fixed inset-0 bg-black/50 backdrop-blur-sm z-60 opacity-0 pointer-events-none transition-opacity duration-300 md:hidden">
    </div>

    <!-- Mobile Sidebar -->
    <aside id="public-mobile-sidebar"
        class="fixed top-0 left-0 h-full w-72 bg-white dark:bg-slate-900 z-70 shadow-2xl transform -translate-x-full transition-transform duration-300 ease-in-out md:hidden flex flex-col">
        <!-- Header -->
        <div class="flex items-center justify-between p-5 border-b border-slate-100 dark:border-slate-800">
            <img src="{{ asset('LOGO-PPDB.png') }}" alt="Logo" class="h-10 w-auto">
            <button id="public-sidebar-close"
                class="p-2 text-slate-500 hover:bg-slate-100 dark:hover:bg-slate-800 rounded-lg transition-colors"
                aria-label="Tutup menu">
                <iconify-icon icon="lucide:x" class="text-xl"></iconify-icon>
            </button>
        </div>

        <!-- Navigation Links -->
        <nav class="flex-1 overflow-y-auto py-4 px-3">
            <p class="px-2 mb-3 text-[10px] font-bold text-slate-400 uppercase tracking-widest">Navigasi</p>
            <a href="/#beranda"
                class="flex items-center gap-3 px-4 py-3 rounded-xl text-slate-600 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-slate-800 transition-colors mb-1">
                <iconify-icon icon="lucide:home" class="text-xl shrink-0 text-primary"></iconify-icon>
                <span class="text-sm font-medium">Beranda</span>
            </a>
            <a href="/#profile"
                class="flex items-center gap-3 px-4 py-3 rounded-xl text-slate-600 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-slate-800 transition-colors mb-1">
                <iconify-icon icon="lucide:school" class="text-xl shrink-0 text-primary"></iconify-icon>
                <span class="text-sm font-medium">Profile Sekolah</span>
            </a>
            <a href="/register"
                class="flex items-center gap-3 px-4 py-3 rounded-xl text-slate-600 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-slate-800 transition-colors mb-1">
                <iconify-icon icon="lucide:clipboard-list" class="text-xl shrink-0 text-primary"></iconify-icon>
                <span class="text-sm font-medium">Pendaftaran</span>
            </a>
            <a href="/#kontak"
                class="flex items-center gap-3 px-4 py-3 rounded-xl text-slate-600 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-slate-800 transition-colors mb-1">
                <iconify-icon icon="lucide:phone" class="text-xl shrink-0 text-primary"></iconify-icon>
                <span class="text-sm font-medium">Kontak</span>
            </a>
        </nav>

        <!-- CTA Buttons -->
        <div class="p-4 border-t border-slate-100 dark:border-slate-800 space-y-2">
            <a href="/login"
                class="flex items-center justify-center gap-2 w-full py-3 rounded-xl border border-primary text-primary font-semibold text-sm hover:bg-primary hover:text-white transition-all">
                <iconify-icon icon="lucide:lock" class="text-base"></iconify-icon> Masuk
            </a>
            <a href="/register"
                class="flex items-center justify-center gap-2 w-full py-3 rounded-xl bg-primary text-white font-semibold text-sm hover:bg-primary/90 transition-all shadow-sm shadow-primary/20">
                <iconify-icon icon="lucide:user-plus" class="text-base"></iconify-icon> Daftar Sekarang
            </a>
        </div>
    </aside>

    <script>
        (function() {
            const btn = document.getElementById('public-hamburger-btn');
            const closeBtn = document.getElementById('public-sidebar-close');
            const sidebar = document.getElementById('public-mobile-sidebar');
            const overlay = document.getElementById('public-sidebar-overlay');

            function openSidebar() {
                sidebar.classList.remove('-translate-x-full');
                overlay.classList.remove('opacity-0', 'pointer-events-none');
                overlay.classList.add('opacity-100');
                overlay.classList.add('overflow-x-hidden');
                document.body.style.overflow = 'hidden';
            }

            function closeSidebar() {
                sidebar.classList.add('-translate-x-full');
                overlay.classList.remove('opacity-100');
                overlay.classList.add('opacity-0', 'pointer-events-none');
                document.body.style.overflow = '';
            }

            if (btn) btn.addEventListener('click', openSidebar);
            if (closeBtn) closeBtn.addEventListener('click', closeSidebar);
            if (overlay) overlay.addEventListener('click', closeSidebar);
        })();
    </script>

    {{-- =====================================================
         HERO SECTION
         ===================================================== --}}
    <section id="beranda" class="relative min-h-[600px] md:min-h-[650px] flex items-center overflow-hidden">
        {{-- Background Image --}}
        <div class="absolute inset-0 z-0">
            <div class="absolute inset-0 bg-linear-to-r from-white/95 via-white/80 to-white/30 z-10"></div>
            <img alt="Kampus UIM" class="w-full h-full object-cover" src="{{ asset('bg-amt.jpg') }}" />
        </div>

        {{-- Content --}}
        <div class="relative z-20 w-full max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 md:py-24">
            <div class="max-w-2xl">
                {{-- Small Heading --}}
                <p class="text-2xl md:text-3xl font-extrabold text-slate-700 italic mb-1">
                    Selamat Datang di
                </p>

                {{-- Main Title --}}
                <h1 class="text-3xl md:text-5xl font-black text-primary leading-tight mb-5">
                    Website Penerimaan Peserta Didik Baru (PPDB)
                </h1>

                {{-- Period Badge --}}
                <div class="flex items-center gap-3 mb-5">
                    <span
                        class="inline-flex items-center px-5 py-2 rounded-full border-2 border-red-500 text-red-500 font-black text-xl md:text-2xl tracking-wide">
                        2026 / 2027 Ganjil
                    </span>
                </div>

                {{-- University Name --}}
                <h2 class="text-2xl md:text-3xl font-black text-primary mb-4">
                    SMK AL-MUJTAMA'
                </h2>

                {{-- Description --}}
                <p class="text-sm md:text-base text-slate-600 leading-relaxed mb-8 max-w-xl">
                    SMK AL-MUJTAMA' Pamekasan, adalah sekolah yang berada dibawah naungan Pondok Pesantren
                    yang beralamatkan di Jl. Raya Pegantenan KM 09 Pamekasan
                </p>

                {{-- CTA Buttons --}}
                <div class="flex flex-col sm:flex-row items-start gap-4">
                    <a href="/login"
                        class="inline-flex items-center gap-2 px-8 py-3 rounded-lg border-2 border-primary text-primary font-bold text-base hover:bg-primary hover:text-white transition-all duration-300 shadow-sm">
                        <iconify-icon icon="lucide:lock" class="text-xl"></iconify-icon>
                        Login
                    </a>
                    <a href="/pendaftaran"
                        class="inline-flex items-center gap-2 px-8 py-3 rounded-lg bg-primary text-white font-bold text-base hover:bg-primary/90 transition-all duration-300 shadow-lg shadow-primary/25">
                        <iconify-icon icon="lucide:user-plus" class="text-xl"></iconify-icon>
                        Daftar Sekarang
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Stats Section -->
    <section class="relative z-30 -mt-16 px-4">
        <div class="max-w-7xl mx-auto grid grid-cols-2 md:grid-cols-4 gap-4">
            <div
                class="bg-white dark:bg-emerald-dark p-6 rounded-2xl shadow-xl flex flex-col items-center text-center border border-primary/10">
                <iconify-icon icon="lucide:users" class="text-primary text-4xl mb-2"></iconify-icon>
                <span class="text-2xl font-black text-slate-900 dark:text-white">1500+</span>
                <span
                    class="text-sm text-slate-500 dark:text-emerald-100/70 uppercase tracking-widest font-bold">Siswa</span>
            </div>
            <div
                class="bg-white dark:bg-emerald-dark p-6 rounded-2xl shadow-xl flex flex-col items-center text-center border border-primary/10">
                <iconify-icon icon="lucide:user-check" class="text-primary text-4xl mb-2"></iconify-icon>
                <span class="text-2xl font-black text-slate-900 dark:text-white">120+</span>
                <span
                    class="text-sm text-slate-500 dark:text-emerald-100/70 uppercase tracking-widest font-bold">Guru</span>
            </div>
            <div
                class="bg-white dark:bg-emerald-dark p-6 rounded-2xl shadow-xl flex flex-col items-center text-center border border-primary/10">
                <iconify-icon icon="lucide:building-2" class="text-primary text-4xl mb-2"></iconify-icon>
                <span class="text-2xl font-black text-slate-900 dark:text-white">45</span>
                <span
                    class="text-sm text-slate-500 dark:text-emerald-100/70 uppercase tracking-widest font-bold">Fasilitas</span>
            </div>
            <div
                class="bg-white dark:bg-emerald-dark p-6 rounded-2xl shadow-xl flex flex-col items-center text-center border border-primary/10">
                <iconify-icon icon="lucide:award" class="text-primary text-4xl mb-2"></iconify-icon>
                <span class="text-2xl font-black text-slate-900 dark:text-white">200+</span>
                <span
                    class="text-sm text-slate-500 dark:text-emerald-100/70 uppercase tracking-widest font-bold">Prestasi</span>
            </div>
        </div>
    </section>

    {{-- =====================================================
         WHY US SECTION (id=profile)
         ===================================================== --}}
    <section id="profile" class="py-24 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="mb-16">
            <h2 class="text-3xl md:text-4xl font-black text-emerald-dark dark:text-primary mb-4">
                Mengapa Bersekolah di Sini?
            </h2>
            <div class="h-1.5 w-24 bg-accent rounded-full"></div>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div
                class="group p-8 rounded-2xl bg-white dark:bg-background-dark border border-primary/10 hover:border-primary transition-all shadow-sm hover:shadow-xl">
                <div
                    class="size-14 rounded-xl bg-primary/10 flex items-center justify-center mb-6 group-hover:bg-primary group-hover:text-white transition-all text-primary">
                    <iconify-icon icon="lucide:globe" class="text-3xl"></iconify-icon>
                </div>
                <h3 class="text-xl font-bold mb-3 text-emerald-dark dark:text-white">
                    Kurikulum Internasional
                </h3>
                <p class="text-slate-600 dark:text-slate-400">
                    Standar global dalam setiap mata pelajaran untuk mempersiapkan siswa
                    di kancah dunia.
                </p>
            </div>
            <div
                class="group p-8 rounded-2xl bg-white dark:bg-background-dark border border-primary/10 hover:border-primary transition-all shadow-sm hover:shadow-xl">
                <div
                    class="size-14 rounded-xl bg-primary/10 flex items-center justify-center mb-6 group-hover:bg-primary group-hover:text-white transition-all text-primary">
                    <iconify-icon icon="lucide:brain-circuit" class="text-3xl"></iconify-icon>
                </div>
                <h3 class="text-xl font-bold mb-3 text-emerald-dark dark:text-white">
                    Pengajar Ahli
                </h3>
                <p class="text-slate-600 dark:text-slate-400">
                    Didukung oleh tenaga pendidik profesional yang berpengalaman di
                    bidang masing-masing.
                </p>
            </div>
            <div
                class="group p-8 rounded-2xl bg-white dark:bg-background-dark border border-primary/10 hover:border-primary transition-all shadow-sm hover:shadow-xl">
                <div
                    class="size-14 rounded-xl bg-primary/10 flex items-center justify-center mb-6 group-hover:bg-primary group-hover:text-white transition-all text-primary">
                    <iconify-icon icon="lucide:microscope" class="text-3xl"></iconify-icon>
                </div>
                <h3 class="text-xl font-bold mb-3 text-emerald-dark dark:text-white">
                    Lab &amp; Fasilitas Modern
                </h3>
                <p class="text-slate-600 dark:text-slate-400">
                    Laboratorium lengkap dengan teknologi terbaru untuk mendukung
                    praktek dan riset.
                </p>
            </div>
            <div
                class="group p-8 rounded-2xl bg-white dark:bg-background-dark border border-primary/10 hover:border-primary transition-all shadow-sm hover:shadow-xl">
                <div
                    class="size-14 rounded-xl bg-primary/10 flex items-center justify-center mb-6 group-hover:bg-primary group-hover:text-white transition-all text-primary">
                    <iconify-icon icon="lucide:trophy" class="text-3xl"></iconify-icon>
                </div>
                <h3 class="text-xl font-bold mb-3 text-emerald-dark dark:text-white">
                    Ekstrakurikuler Luas
                </h3>
                <p class="text-slate-600 dark:text-slate-400">
                    Beragam pilihan pengembangan bakat mulai dari seni, olahraga, hingga
                    teknologi robotic.
                </p>
            </div>
            <div
                class="group p-8 rounded-2xl bg-white dark:bg-background-dark border border-primary/10 hover:border-primary transition-all shadow-sm hover:shadow-xl">
                <div
                    class="size-14 rounded-xl bg-primary/10 flex items-center justify-center mb-6 group-hover:bg-primary group-hover:text-white transition-all text-primary">
                    <iconify-icon icon="lucide:shield-check" class="text-3xl"></iconify-icon>
                </div>
                <h3 class="text-xl font-bold mb-3 text-emerald-dark dark:text-white">
                    Lingkungan Aman
                </h3>
                <p class="text-slate-600 dark:text-slate-400">
                    Sistem keamanan 24 jam dan lingkungan belajar yang kondusif bagi
                    perkembangan anak.
                </p>
            </div>
            <div
                class="group p-8 rounded-2xl bg-white dark:bg-background-dark border border-primary/10 hover:border-primary transition-all shadow-sm hover:shadow-xl">
                <div
                    class="size-14 rounded-xl bg-primary/10 flex items-center justify-center mb-6 group-hover:bg-primary group-hover:text-white transition-all text-primary">
                    <iconify-icon icon="lucide:star" class="text-3xl"></iconify-icon>
                </div>
                <h3 class="text-xl font-bold mb-3 text-emerald-dark dark:text-white">
                    Beasiswa Unggulan
                </h3>
                <p class="text-slate-600 dark:text-slate-400">
                    Program dukungan biaya pendidikan bagi siswa berprestasi di bidang
                    akademik maupun non-akademik.
                </p>
            </div>
        </div>
    </section>

    <!-- Horizontal Scroll Majors -->
    <section class="py-24 bg-primary/5">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mb-12 flex justify-between items-end">
            <div>
                <h2 class="text-3xl md:text-4xl font-black text-emerald-dark dark:text-primary mb-4">
                    Pilihan Jalur &amp; Jurusan
                </h2>
                <p class="text-slate-600 dark:text-slate-400">
                    Temukan minat dan bakatmu melalui program keahlian kami.
                </p>
            </div>
            <div class="hidden md:flex gap-2">
                <button
                    class="size-10 rounded-full border border-primary flex items-center justify-center text-primary hover:bg-primary hover:text-white transition-all">
                    <iconify-icon icon="lucide:chevron-left" class="text-2xl"></iconify-icon>
                </button>
                <button
                    class="size-10 rounded-full border border-primary flex items-center justify-center text-primary hover:bg-primary hover:text-white transition-all">
                    <iconify-icon icon="lucide:chevron-right" class="text-2xl"></iconify-icon>
                </button>
            </div>
        </div>
        <div class="flex overflow-x-auto no-scrollbar gap-6 px-4 sm:px-6 lg:px-8 pb-10">
            <!-- Card 1 -->
            <div
                class="min-w-[300px] md:min-w-[350px] bg-white dark:bg-background-dark rounded-2xl overflow-hidden border border-primary/10 shadow-lg hover:-translate-y-2 transition-transform">
                <img alt="IT Major" class="w-full h-48 object-cover"
                    src="https://lh3.googleusercontent.com/aida-public/AB6AXuDO-w0Q56FqGbdSHfq-UVeOH3VIRXHQ8c_TI_LbpKZa8UPlEd25utD1BSqcebVJkkHTiFUlketzoGGZPMTvUA_Gh-Vz4Uh_HgwSu3A3iW-y-HrtgLtoHTZvkPFVFfEBauv6-8EonShiEbbvHMkKLDldIb5cdA4JPm9nySNR80D6KLCr1mYMYo6tBGsR5rmUQdgFjufBN5Jd5D2oLNGTJlFa1AROCScHONblWJwqqiOzJBgQVaFIDGjUhUHUQsvHl_MGjFBVWqVBPWB9" />
                <div class="p-6">
                    <span
                        class="px-3 py-1 bg-primary/20 text-emerald-dark dark:text-primary text-xs font-bold rounded-full uppercase mb-3 inline-block">Teknologi</span>
                    <h3 class="text-xl font-bold mb-2 dark:text-white">
                        Rekayasa Perangkat Lunak
                    </h3>
                    <p class="text-sm text-slate-600 dark:text-slate-400 mb-4">
                        Mempelajari desain web, mobile apps, dan pengembangan sistem
                        perangkat lunak modern.
                    </p>
                    <a class="text-primary font-bold text-sm flex items-center gap-1 group" href="#">
                        Detail Jurusan
                        <iconify-icon icon="lucide:arrow-right"
                            class="text-base group-hover:translate-x-1 transition-transform"></iconify-icon>
                    </a>
                </div>
            </div>
            <!-- Card 2 -->
            <div
                class="min-w-[300px] md:min-w-[350px] bg-white dark:bg-background-dark rounded-2xl overflow-hidden border border-primary/10 shadow-lg hover:-translate-y-2 transition-transform">
                <img alt="Business Major" class="w-full h-48 object-cover"
                    src="https://lh3.googleusercontent.com/aida-public/AB6AXuCCLOQurDcHwuojd0jkANNlKaUC-DxzslUZXf1s0OE60AgLHRtOb1eRDKs5v99PHvxtxY2lJq-z2w9KtbTwDLo6YYRMQzn8FdpUEWcTmYr7QQjn_tm_HPBhqUwJAQXVIE_mInK8K_lag_lHJw-CT0Ki7aPUtjFTA7CNNvrqS1n0wQFgzo2ow07KElS8ae4GmLKjP-lQREzViYTqjDLFRFQcPKfPuUw95z5QNVxjkw-GL4vjRxyswG_08lwHN3nKi8qi3IHEMtLGiRSf" />
                <div class="p-6">
                    <span
                        class="px-3 py-1 bg-accent/20 text-accent text-xs font-bold rounded-full uppercase mb-3 inline-block">Manajemen</span>
                    <h3 class="text-xl font-bold mb-2 dark:text-white">
                        Bisnis &amp; Pemasaran Digital
                    </h3>
                    <p class="text-sm text-slate-600 dark:text-slate-400 mb-4">
                        Menguasai strategi pasar, branding, dan teknik jualan di era
                        digital yang dinamis.
                    </p>
                    <a class="text-primary font-bold text-sm flex items-center gap-1 group" href="#">
                        Detail Jurusan
                        <iconify-icon icon="lucide:arrow-right"
                            class="text-base group-hover:translate-x-1 transition-transform"></iconify-icon>
                    </a>
                </div>
            </div>
            <!-- Card 3 -->
            <div
                class="min-w-[300px] md:min-w-[350px] bg-white dark:bg-background-dark rounded-2xl overflow-hidden border border-primary/10 shadow-lg hover:-translate-y-2 transition-transform">
                <img alt="Industrial Major" class="w-full h-48 object-cover"
                    src="https://lh3.googleusercontent.com/aida-public/AB6AXuBduO_KG3GCVa4BDWkWgb26qoNyFXuO_oy1_ZbltsUXWf-7VqnppZR9wyoht5vP6lCx2ySiYTEJXLepU49m779xrfh6tDwaWAWVRcGvYANBgQ5si0JL-i6_MQKuNhGUw3SgG1c-4_-GRxhDsAslPcGPWCowa2RYf7oVWddAKre3-V6rX0F1R2i1m512uJ3tqaFyXuK_TD8ea8oAt3hptTixeoxWbxEPvn5Dpd4A8IR4bXA_lnKvokomXzYwHAI2ADnRPHyMrXyrlNPl" />
                <div class="p-6">
                    <span
                        class="px-3 py-1 bg-blue-100 text-blue-600 text-xs font-bold rounded-full uppercase mb-3 inline-block">Industri</span>
                    <h3 class="text-xl font-bold mb-2 dark:text-white">
                        Teknik Mekatronika
                    </h3>
                    <p class="text-sm text-slate-600 dark:text-slate-400 mb-4">
                        Gabungan teknik mesin dan elektronika untuk sistem otomasi
                        industri masa depan.
                    </p>
                    <a class="text-primary font-bold text-sm flex items-center gap-1 group" href="#">
                        Detail Jurusan
                        <iconify-icon icon="lucide:arrow-right"
                            class="text-base group-hover:translate-x-1 transition-transform"></iconify-icon>
                    </a>
                </div>
            </div>
        </div>
    </section>

    {{-- =====================================================
         MAP / KONTAK SECTION (id=kontak)
         ===================================================== --}}
    <section id="kontak" class="relative bg-slate-50 dark:bg-background-dark py-16 md:py-24">
        {{-- Section Header --}}
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mb-12">
            <div class="flex items-center gap-3 mb-4">
                <div class="size-12 rounded-xl bg-primary/10 flex items-center justify-center text-primary">
                    <iconify-icon icon="lucide:map-pin" class="text-2xl"></iconify-icon>
                </div>
                <div>
                    <h2 class="text-3xl md:text-4xl font-black text-emerald-dark dark:text-primary">
                        Lokasi Kampus
                    </h2>
                </div>
            </div>
            <div class="h-1.5 w-24 bg-accent rounded-full"></div>
        </div>

        {{-- Map + Info Card Container --}}
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="relative rounded-3xl overflow-hidden shadow-2xl border border-primary/10">
                {{-- Google Maps Embed --}}
                <div class="w-full h-[450px] md:h-[500px]">
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3958.123456789!2d113.4747!3d-7.1627!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd77f5f5f5f5f5f%3A0x5f5f5f5f5f5f5f5f!2sUniversitas%20Islam%20Madura!5e0!3m2!1sid!2sid!4v1700000000000!5m2!1sid!2sid"
                        class="w-full h-full border-0" allowfullscreen="" loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>

                {{-- Info Card Overlay --}}
                <div
                    class="absolute z-20 left-4 md:left-8 bottom-4 md:bottom-8 right-4 md:right-auto md:w-[420px] bg-white/95 dark:bg-emerald-dark/95 backdrop-blur-lg p-6 md:p-8 rounded-2xl shadow-2xl border border-white/20">
                    {{-- Card Header --}}
                    <div class="flex items-center gap-3 mb-5">
                        <div
                            class="size-10 rounded-full bg-primary flex items-center justify-center text-white shadow-lg shadow-primary/30">
                            <iconify-icon icon="lucide:graduation-cap" class="text-xl"></iconify-icon>
                        </div>
                        <div>
                            <h4 class="text-xl font-black text-emerald-dark dark:text-white leading-tight">
                                Universitas Islam Madura
                            </h4>
                            <p class="text-xs text-primary font-semibold">Kampus Utama — Pamekasan</p>
                        </div>
                    </div>

                    {{-- Divider --}}
                    <div class="h-px bg-linear-to-r from-primary/30 via-primary/10 to-transparent mb-5"></div>

                    {{-- Contact Info --}}
                    <div class="space-y-3">
                        <div class="flex items-start gap-3 group">
                            <iconify-icon icon="lucide:map-pin"
                                class="text-primary text-xl mt-0.5 group-hover:scale-110 transition-transform"></iconify-icon>
                            <p class="text-slate-600 dark:text-emerald-50/80 text-sm leading-relaxed">
                                Jl. PP. Miftahul Ulum Bettet, Pamekasan, Madura, Jawa Timur 69351
                            </p>
                        </div>
                        <div class="flex items-start gap-3 group">
                            <iconify-icon icon="lucide:phone"
                                class="text-primary text-xl mt-0.5 group-hover:scale-110 transition-transform"></iconify-icon>
                            <p class="text-slate-600 dark:text-emerald-50/80 text-sm">
                                (0324) 322551
                            </p>
                        </div>
                        <div class="flex items-start gap-3 group">
                            <iconify-icon icon="lucide:mail"
                                class="text-primary text-xl mt-0.5 group-hover:scale-110 transition-transform"></iconify-icon>
                            <p class="text-slate-600 dark:text-emerald-50/80 text-sm">
                                info@uim.ac.id
                            </p>
                        </div>
                        <div class="flex items-start gap-3 group">
                            <iconify-icon icon="lucide:clock"
                                class="text-primary text-xl mt-0.5 group-hover:scale-110 transition-transform"></iconify-icon>
                            <p class="text-slate-600 dark:text-emerald-50/80 text-sm">
                                Senin – Sabtu: 08.00 – 16.00 WIB
                            </p>
                        </div>
                    </div>

                    {{-- Action Button --}}
                    <a href="https://maps.google.com/?q=Universitas+Islam+Madura+Pamekasan" target="_blank"
                        rel="noopener noreferrer"
                        class="mt-6 w-full bg-primary hover:bg-primary/90 text-white font-bold py-3.5 rounded-xl transition-all flex items-center justify-center gap-2 shadow-lg shadow-primary/20 hover:shadow-xl hover:shadow-primary/30">
                        <iconify-icon icon="lucide:navigation" class="text-xl"></iconify-icon>
                        Buka di Google Maps
                    </a>
                </div>
            </div>
        </div>
    </section>
</x-layout-public>

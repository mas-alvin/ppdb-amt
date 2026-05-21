<x-layout-public>
    <x-navbar-public />

    {{-- Hero Section --}}
    <section class="relative py-20 overflow-hidden bg-green-900 text-white">
        <div class="absolute inset-0 opacity-10 pointer-events-none"
            style="background-image: url('{{ asset('bg-amt.jpg') }}'); background-size: cover; background-repeat: no-repeat; background-position: center center;">
        </div>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center">
            <h1 class="text-4xl md:text-5xl font-black mb-4">Hubungi Kami</h1>
            <p class="text-lg text-white/80 max-w-2xl mx-auto">
                Punya pertanyaan seputar PPDB atau SMK Al-Mujtama'? Tim kami siap membantu Anda.
            </p>
        </div>
    </section>

    {{-- Contact Content (Adapted from welcome.blade.php) --}}
    <section class="py-20 bg-white relative overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">

                <div>
                    <h2 class="text-sm font-black text-yellow-600 uppercase tracking-[0.3em] mb-4">Lokasi & Kontak</h2>
                    <h3 class="text-3xl font-black text-green-950 mb-8">
                        Kunjungi Sekolah Kami
                    </h3>

                    <div class="space-y-8">
                        <div class="flex gap-6">
                            <div class="size-14 rounded-lg bg-green-900/10 flex items-center justify-center text-green-900 shrink-0">
                                <iconify-icon icon="lucide:map-pin" class="text-2xl"></iconify-icon>
                            </div>
                            <div>
                                <h4 class="text-xl font-bold text-green-950 mb-1">Alamat Utama</h4>
                                <p class="text-slate-600">Jl. Raya Pegantenan No.KM. 09, Tengracak, Plakpak, Kec. Pegantenan, Kabupaten Pamekasan, Jawa Timur 69361</p>
                            </div>
                        </div>

                        <div class="flex gap-6">
                            <div class="size-14 rounded-lg bg-green-900/10 flex items-center justify-center text-green-900 shrink-0">
                                <iconify-icon icon="lucide:phone" class="text-2xl"></iconify-icon>
                            </div>
                            <div>
                                <h4 class="text-xl font-bold text-green-950 mb-1">Telepon & WhatsApp</h4>
                                <a href="https://wa.me/6287811156664" target="_blank" class="text-slate-600">087811156664</a>
                            </div>
                        </div>

                        <div class="flex gap-6">
                            <div class="size-14 rounded-lg bg-green-900/10 flex items-center justify-center text-green-900 shrink-0">
                                <iconify-icon icon="lucide:mail" class="text-2xl"></iconify-icon>
                            </div>
                            <div>
                                <h4 class="text-xl font-bold text-green-950 mb-1">Email Resmi</h4>
                                <p class="text-slate-600">smkalmujtama@gmail.com</p>
                            </div>
                        </div>
                    </div>

                    {{-- Jam Kerja --}}
                    <div class="mt-12 p-6 rounded-lg bg-slate-50 border border-slate-100">
                        <h4 class="font-bold text-green-950 mb-2">Jam Pelayanan PPDB</h4>
                        <p class="text-slate-600 text-sm">Senin - Kamis: 07.30 - 11:30 WIB</p>
                        <p class="text-slate-600 text-sm">Sabtu - Ahad: 08.00 - 11.00 WIB</p>
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

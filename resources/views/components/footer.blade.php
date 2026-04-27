{{-- =====================================================
         FOOTER
         ===================================================== --}}
    <footer class="bg-green-950 text-white py-16">
        <div class="max-w-full px-4 sm:mx-auto md:mx-28">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-12 mb-16">
                <div class="md:col-span-2">
                    <div class="flex items-center gap-2">
                        <img src="{{ asset('logo-amt.webp') }}" alt="Logo" class="h-14 w-auto p-2 rounded-lg">
                        <h1 class="text-lg font-bold">PPDB SMK AL-MUJTAMA' PAMEKASAN</h1>
                    </div>
                    <p class="text-white/60 max-w-sm leading-relaxed my-8">
                        SMK AL-MUJTAMA' Pamekasan berkomitmen untuk mencetak generasi yang cerdas secara intelektual dan memiliki kedalaman spiritual yang kuat.
                    </p>
                    <div class="flex gap-4">
                        <a href="#" class="size-10 rounded-lg bg-white/10 flex items-center justify-center hover:bg-yellow-500 hover:text-green-950 transition-all">
                            <iconify-icon icon="lucide:facebook"></iconify-icon>
                        </a>
                        <a href="#" class="size-10 rounded-lg bg-white/10 flex items-center justify-center hover:bg-yellow-500 hover:text-green-950 transition-all">
                            <iconify-icon icon="lucide:instagram"></iconify-icon>
                        </a>
                        <a href="#" class="size-10 rounded-lg bg-white/10 flex items-center justify-center hover:bg-yellow-500 hover:text-green-950 transition-all">
                            <iconify-icon icon="lucide:youtube"></iconify-icon>
                        </a>
                    </div>
                </div>
                
                <div>
                    <h5 class="text-lg font-bold mb-8 text-yellow-500">Navigasi</h5>
                    <ul class="space-y-4 text-white/60">
                        <li><a href="/#beranda" class="hover:text-white transition-colors">Beranda</a></li>
                        <li><a href="/#profile" class="hover:text-white transition-colors">Profil Sekolah</a></li>
                        <li><a href="/register" class="hover:text-white transition-colors">Pendaftaran</a></li>
                        <li><a href="/#kontak" class="hover:text-white transition-colors">Kontak</a></li>
                    </ul>
                </div>

                <div>
                    <h5 class="text-lg font-bold mb-8 text-yellow-500">Tautan Penting</h5>
                    <ul class="space-y-4 text-white/60">
                        <li><a href="#" class="hover:text-white transition-colors">Syarat & Ketentuan</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">Kebijakan Privasi</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">Bantuan (FAQ)</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">Portal Alumni</a></li>
                    </ul>
                </div>
            </div>

            <div class="pt-8 border-t border-white/10 flex flex-col md:flex-row justify-between items-center gap-4">
                <p class="text-white/40 text-sm text-center md:text-left">
                    &copy; 2026 PPDB SMK AL-MUJTAMA' Pamekasan. Hak Cipta Dilindungi Undang-Undang.
                </p>
                <p class="text-white/40 text-sm flex items-center gap-1">
                    Made with <iconify-icon icon="lucide:heart" class="text-red-500"></iconify-icon> for better education
                </p>
            </div>
        </div>
    </footer>
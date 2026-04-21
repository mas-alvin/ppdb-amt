<x-admin-layout title="Verifikasi Berkas" :breadcrumbs="[['label' => 'Verifikasi']]">
    <div class="mb-8" data-aos="fade-down">
        <h2 class="text-2xl font-black text-green-950 uppercase tracking-tight">Verifikasi Berkas Calon Siswa</h2>
        <p class="text-sm text-slate-500 mt-1 max-w-2xl">Periksa dan validasi keabsahan dokumen persyaratan (Ijazah, KK, Akta, dll) yang telah diunggah oleh pendaftar.</p>
    </div>
    <x-admin.resource-table resource-key="documents" />
</x-admin-layout>

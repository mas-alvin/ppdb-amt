<x-admin-layout title="Akun Siswa" :breadcrumbs="[['label' => 'Akun Siswa']]">
    <div class="space-y-6">
        <div class="bg-white p-6 rounded-sm border border-slate-100 shadow-sm flex flex-col md:flex-row md:items-center justify-between gap-4" data-aos="fade-down">
            <div>
                <h2 class="text-2xl font-black text-green-950 uppercase tracking-tight">Manajemen Akun Siswa</h2>
                <p class="text-sm text-slate-500 mt-1 max-w-2xl">Kelola data login dan informasi autentikasi untuk seluruh calon siswa pendaftar.</p>
            </div>
            <div class="px-4 py-2 bg-slate-50 rounded-sm border border-slate-100">
                <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest text-center">Total Akun</p>
                <p class="text-xl font-black text-green-900 text-center">{{ $users->count() }}</p>
            </div>
        </div>

        {{-- Notification Toast / Flash message --}}
        @if(session('success'))
            <div class="p-4 bg-green-50 border border-green-200 text-green-900 rounded-lg text-sm font-bold flex items-center gap-3 animate-fade-in" data-aos="fade-down">
                <iconify-icon icon="lucide:check-circle" class="text-xl text-green-900"></iconify-icon>
                {{ session('success') }}
            </div>
        @endif
        @if(session('error'))
            <div class="p-4 bg-red-50 border border-red-200 text-red-900 rounded-lg text-sm font-bold flex items-center gap-3 animate-fade-in" data-aos="fade-down">
                <iconify-icon icon="lucide:alert-circle" class="text-xl text-red-900"></iconify-icon>
                {{ session('error') }}
            </div>
        @endif

        <div class="bg-white rounded-sm border border-slate-100 shadow-sm overflow-hidden" data-aos="fade-up">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-slate-50 border-b border-slate-100">
                            <th class="px-6 py-4 text-[10px] font-black text-slate-400 uppercase tracking-[0.2em]">Nama Pengguna</th>
                            <th class="px-6 py-4 text-[10px] font-black text-slate-400 uppercase tracking-[0.2em]">Email</th>
                            <th class="px-6 py-4 text-[10px] font-black text-slate-400 uppercase tracking-[0.2em]">Tanggal Daftar</th>
                            <th class="px-6 py-4 text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-50">
                        @forelse ($users as $user)
                            <tr class="hover:bg-slate-50/50 transition-colors group">
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-3">
                                        <div class="size-10 rounded-sm bg-green-900 flex items-center justify-center text-white font-black text-xs shadow-lg shadow-green-900/20 uppercase">
                                            {{ substr($user->name, 0, 1) }}
                                        </div>
                                        <p class="text-sm font-black text-green-950 uppercase tracking-tight">{{ $user->name }}</p>
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-sm font-medium text-slate-600">{{ $user->email }}</td>
                                <td class="px-6 py-4 text-sm font-medium text-slate-400">{{ $user->created_at->format('d M Y H:i') }}</td>
                                <td class="px-6 py-4 text-right">
                                    <div class="flex items-center justify-end gap-2">
                                        <!-- Reset Password Button -->
                                        <button type="button" 
                                                onclick="confirmResetPassword('{{ $user->id }}', '{{ addslashes($user->name) }}')"
                                                class="p-2 text-slate-300 hover:text-emerald-600 hover:bg-emerald-50 rounded-sm transition-all"
                                                title="Reset Password">
                                            <iconify-icon icon="lucide:key-round" class="text-lg"></iconify-icon>
                                        </button>

                                        <!-- Delete Account Form -->
                                        <form action="{{ route('admin.portal-users.destroy', $user->id) }}" method="POST" onsubmit="return confirmDelete(event, 'Apakah Anda yakin ingin menghapus akun siswa ini? Semua berkas dan pendaftaran siswa akan ikut dihapus secara permanen.')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="p-2 text-slate-300 hover:text-red-600 hover:bg-red-50 rounded-sm transition-all" title="Hapus Akun">
                                                <iconify-icon icon="lucide:trash-2" class="text-lg"></iconify-icon>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-6 py-12 text-center text-slate-400 italic">Belum ada akun siswa.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Hidden form for resetting password -->
    <form id="reset-password-form" action="" method="POST" class="hidden">
        @csrf
    </form>

    <x-slot name="scripts">
        <script>
            function confirmResetPassword(userId, userName) {
                Swal.fire({
                    title: 'Reset Password',
                    html: `Apakah Anda yakin ingin mereset password untuk siswa <strong>${userName}</strong> menjadi <strong>password123</strong>?`,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#047857', // green-700
                    cancelButtonColor: '#64748b',
                    confirmButtonText: 'Ya, Reset!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        const form = document.getElementById('reset-password-form');
                        let url = "{{ route('admin.portal-users.reset-password', ':id') }}";
                        form.action = url.replace(':id', userId);
                        form.submit();
                    }
                });
            }
        </script>
    </x-slot>
</x-admin-layout>

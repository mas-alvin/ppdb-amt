<!DOCTYPE html>
<html lang="id" class="h-full bg-slate-50">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Authentikasi' }} — PPDB SMK AL-MUJTAMA'</title>
    <link rel="shortcut icon" href="{{ asset('logo-amt.webp') }}" type="image/webp">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.iconify.design/iconify-icon/1.0.7/iconify-icon.min.js"></script>
    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="h-full flex items-center justify-center p-4">

    <div class="w-full max-w-md">
        {{-- Logo & Brand --}}
        {{-- <div class="text-center mb-8">
            <div class="inline-flex items-center justify-center size-16 bg-green-900 rounded-sm shadow-2xl shadow-green-900/20 mb-4">
                <img src="{{ asset('logo-amt.webp') }}" alt="Logo" class="size-10">
            </div>
            <h1 class="text-2xl font-black text-green-950 uppercase tracking-tighter">PPDB SMK AL-MUJTAMA'</h1>
            <p class="text-slate-500 text-sm mt-1">Sistem Informasi Penerimaan Siswa Baru</p>
        </div> --}}

        {{-- Main Card --}}
        <div class="bg-white rounded-sm border border-slate-100 shadow-2xl overflow-hidden">
            <div class="h-1 bg-gradient-to-r from-green-900 via-yellow-500 to-green-900"></div>
            <div class="p-8">
                {{ $slot }}
            </div>
        </div>

        {{-- Footer --}}
        <p class="text-center text-slate-400 text-xs mt-8 uppercase font-bold tracking-widest">
            &copy; {{ date('Y') }} SMK AL-MUJTAMA' — All Rights Reserved
        </p>
    </div>

    @if(session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: "{{ session('success') }}",
                confirmButtonColor: '#064e3b',
            });
        </script>
    @endif

    @if(session('error'))
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Opps!',
                text: "{{ session('error') }}",
                confirmButtonColor: '#064e3b',
            });
        </script>
    @endif

</body>
</html>

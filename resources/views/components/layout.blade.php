<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap">
    <title>PPDB Online</title>
    <link rel="shortcut icon" href="{{ asset('logo-amt.webp') }}" type="image/webp">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @vite(['resources/css/app.css'])
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }

        .no-scrollbar::-webkit-scrollbar {
            display: none;
        }

        .no-scrollbar {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }
    </style>
</head>

<body class="bg-background-light dark:bg-background-dark text-slate-900 dark:text-slate-100 font-display">
    <x-navbar />

    {{ $slot }}

    <script src="https://code.iconify.design/iconify-icon/2.1.0/iconify-icon.min.js"></script>
    <script>
        function confirmLogout() {
            Swal.fire({
                title: 'Keluar Portal?',
                text: "Anda akan mengakhiri sesi pendaftaran ini.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#064e3b',
                cancelButtonColor: '#ef4444',
                confirmButtonText: 'YA, KELUAR',
                cancelButtonText: 'BATAL'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('logout-form').submit();
                }
            })
        }
    </script>
</body>

</html>

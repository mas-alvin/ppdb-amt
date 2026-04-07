<?php

/**
 * Konfigurasi panel administrator PPDB — disusun dari analisis alur sisi pendaftar (portal).
 *
 * Sumber turunan (dari views: dashboard, wizard pendaftaran, dokumen, status):
 * - Entitas: akun_pengguna, aplikasi_pendaftaran, data_pribadi_kontak, data_orang_tua_wali,
 *   data_fisik_perjalanan, prestasi, program_kesejahteraan, asal_sekolah, dokumen_persyaratan,
 *   riwayat_tahapan, konten_pengumuman, jadwal_gelombang.
 *
 * Menu navigasi TIDAK di-hardcode di Blade; struktur di bawah adalah satu sumber kebenaran.
 */

return [

    'meta' => [
        'derived_from' => 'student_portal_views',
        'locale_default' => 'id',
    ],

    /*
    |--------------------------------------------------------------------------
    | Model domain (pendaftar) → kemampuan admin
    |--------------------------------------------------------------------------
    */
    'student_entities' => [
        [
            'key' => 'portal_user',
            'student_actions' => ['register', 'login', 'view_dashboard'],
            'admin_capabilities' => ['crud', 'monitor', 'impersonation_ready'],
        ],
        [
            'key' => 'registration_application',
            'student_actions' => ['submit_wizard', 'resume_wizard', 'view_completeness'],
            'admin_capabilities' => ['crud', 'verify', 'bulk_stage_change', 'report'],
        ],
        [
            'key' => 'registration_personal_contact',
            'student_actions' => ['fill_personal', 'fill_address', 'fill_contact'],
            'admin_capabilities' => ['crud', 'inspect', 'export'],
        ],
        [
            'key' => 'registration_guardian',
            'student_actions' => ['fill_guardian_ayah', 'fill_guardian_ibu', 'fill_guardian_wali'],
            'admin_capabilities' => ['crud', 'inspect'],
        ],
        [
            'key' => 'registration_periodic_school',
            'student_actions' => ['fill_physical', 'fill_commute', 'fill_school_origin'],
            'admin_capabilities' => ['crud', 'inspect'],
        ],
        [
            'key' => 'registration_achievement',
            'student_actions' => ['add_optional_achievement'],
            'admin_capabilities' => ['crud', 'inspect'],
        ],
        [
            'key' => 'registration_welfare',
            'student_actions' => ['fill_kks_pkh_kip'],
            'admin_capabilities' => ['crud', 'inspect', 'report'],
        ],
        [
            'key' => 'registration_document',
            'student_actions' => ['upload', 'replace', 'view_status'],
            'admin_capabilities' => ['crud', 'verify', 'bulk_download', 'audit'],
        ],
        [
            'key' => 'registration_pipeline',
            'student_actions' => ['view_timeline', 'view_stage'],
            'admin_capabilities' => ['monitor', 'configure_stages', 'notify'],
        ],
        [
            'key' => 'portal_content',
            'student_actions' => ['read_announcements'],
            'admin_capabilities' => ['crud', 'schedule', 'publish'],
        ],
        [
            'key' => 'ppdb_schedule',
            'student_actions' => ['view_deadline'],
            'admin_capabilities' => ['configure', 'monitor'],
        ],
        [
            'key' => 'audit_log',
            'student_actions' => ['implicit_events'],
            'admin_capabilities' => ['read', 'export', 'retention_config'],
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Navigasi modular (route name → item). Label merupakan data konfigurasi, bukan string tersebar di UI.
    |--------------------------------------------------------------------------
    */
    'navigation' => [
        [
            'id' => 'grp_overview',
            'section_label' => 'Ringkasan',
            'items' => [
                [
                    'id' => 'nav_dashboard',
                    'route' => 'admin.dashboard',
                    'icon' => 'layout-dashboard',
                    'label' => 'Ringkasan operasional',
                ],
            ],
        ],
        [
            'id' => 'grp_ppdb_core',
            'section_label' => 'Inti PPDB',
            'items' => [
                [
                    'id' => 'nav_registrations',
                    'route' => 'admin.registrations.index',
                    'icon' => 'clipboard-list',
                    'label' => 'Aplikasi pendaftaran',
                    'entity_keys' => ['registration_application', 'registration_personal_contact', 'registration_guardian', 'registration_periodic_school', 'registration_achievement', 'registration_welfare'],
                ],
                [
                    'id' => 'nav_documents',
                    'route' => 'admin.documents.index',
                    'icon' => 'files',
                    'entity_keys' => ['registration_document'],
                    'label' => 'Antrian dokumen',
                ],
                [
                    'id' => 'nav_pipeline',
                    'route' => 'admin.pipeline.index',
                    'icon' => 'git-branch',
                    'entity_keys' => ['registration_pipeline'],
                    'label' => 'Tahap & alur seleksi',
                ],
                [
                    'id' => 'nav_portal_users',
                    'route' => 'admin.portal-users.index',
                    'icon' => 'users',
                    'entity_keys' => ['portal_user'],
                    'label' => 'Pengguna portal',
                ],
            ],
        ],
        [
            'id' => 'grp_portal',
            'section_label' => 'Portal & jadwal',
            'items' => [
                [
                    'id' => 'nav_content',
                    'route' => 'admin.content.index',
                    'icon' => 'megaphone',
                    'entity_keys' => ['portal_content'],
                    'label' => 'Konten & pengumuman',
                ],
                [
                    'id' => 'nav_schedule',
                    'route' => 'admin.schedule.index',
                    'icon' => 'calendar-clock',
                    'entity_keys' => ['ppdb_schedule'],
                    'label' => 'Gelombang & jadwal',
                ],
            ],
        ],
        [
            'id' => 'grp_analytics',
            'section_label' => 'Analitik',
            'items' => [
                [
                    'id' => 'nav_reporting',
                    'route' => 'admin.reporting.index',
                    'icon' => 'chart-bar',
                    'label' => 'Analitik & ekspor',
                    'entity_keys' => ['registration_application', 'registration_document', 'audit_log'],
                ],
            ],
        ],
        [
            'id' => 'grp_system',
            'section_label' => 'Sistem',
            'items' => [
                [
                    'id' => 'nav_activity',
                    'route' => 'admin.activity.index',
                    'icon' => 'scroll-text',
                    'entity_keys' => ['audit_log'],
                    'label' => 'Log aktivitas',
                ],
                [
                    'id' => 'nav_settings',
                    'route' => 'admin.settings.index',
                    'icon' => 'settings',
                    'label' => 'Konfigurasi sistem',
                ],
            ],
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Definisi KPI dasbor (nilai diisi backend/query; fallback demo di bawah)
    |--------------------------------------------------------------------------
    */
    'dashboard_kpis' => [
        [
            'id' => 'kpi_total_apps',
            'entity_key' => 'registration_application',
            'metric' => 'count_all',
            'label' => 'Total aplikasi aktif',
            'tone' => 'emerald',
        ],
        [
            'id' => 'kpi_verified_docs',
            'entity_key' => 'registration_document',
            'metric' => 'count_verified',
            'label' => 'Dokumen terverifikasi',
            'tone' => 'blue',
        ],
        [
            'id' => 'kpi_pending_review',
            'entity_key' => 'registration_document',
            'metric' => 'count_pending',
            'label' => 'Menunggu tinjauan',
            'tone' => 'amber',
        ],
        [
            'id' => 'kpi_rejected',
            'entity_key' => 'registration_application',
            'metric' => 'count_rejected',
            'label' => 'Ditolak / perbaikan',
            'tone' => 'red',
        ],
    ],

    /** Seed numerik untuk UI hingga integrasi query */
    'dashboard_kpi_demo_values' => [
        'kpi_total_apps' => 1245,
        'kpi_verified_docs' => 3890,
        'kpi_pending_review' => 320,
        'kpi_rejected' => 33,
    ],

    'charts_demo' => [
        'trend_registrations_by_week' => [
            ['label' => 'Minggu 1', 'value' => 120],
            ['label' => 'Minggu 2', 'value' => 190],
            ['label' => 'Minggu 3', 'value' => 210],
            ['label' => 'Minggu 4', 'value' => 175],
        ],
        'distribution_by_stage' => [
            ['label' => 'Draf', 'value' => 18, 'color' => 'bg-slate-300'],
            ['label' => 'Verifikasi', 'value' => 34, 'color' => 'bg-amber-400'],
            ['label' => 'Seleksi', 'value' => 28, 'color' => 'bg-blue-500'],
            ['label' => 'Diterima', 'value' => 12, 'color' => 'bg-emerald-500'],
            ['label' => 'Cadangan', 'value' => 8, 'color' => 'bg-violet-400'],
        ],
    ],

    'activity_feed_demo' => [
        ['actor' => 'Budi Santoso', 'action' => 'mengirim formulir pendaftaran', 'time' => '10 menit lalu'],
        ['actor' => 'Siti Aminah', 'action' => 'mengunggah dokumen rapor', 'time' => '25 menit lalu'],
        ['actor' => 'Andi Wijaya', 'action' => 'memperbarui data orang tua', 'time' => '1 jam lalu'],
        ['actor' => 'Sistem', 'action' => 'memverifikasi batch 10 berkas', 'time' => '2 jam lalu'],
    ],

    'system_log_demo' => [
        ['level' => 'info', 'message' => 'Sinkronisasi penyimpanan dokumen selesai.', 'time' => '14:02:11'],
        ['level' => 'warning', 'message' => 'Ambang unggahan mendekati kuota.', 'time' => '13:41:02'],
        ['level' => 'info', 'message' => 'Job reminder tenggat gelombang dijalanlan.', 'time' => '12:15:33'],
    ],

    /*
    |--------------------------------------------------------------------------
    | Skema tabel antarmuka (kolom + seed baris) — sambungkan ke query Eloquent nanti
    |--------------------------------------------------------------------------
    */
    'resource_tables' => [
        'registrations' => [
            'entity_keys' => ['registration_application'],
            'empty' => [
                'title' => 'Belum ada aplikasi',
                'description' => 'Data akan muncul setelah pendaftar mengirim formulir.',
            ],
            'columns' => [
                ['key' => 'ref', 'label' => 'Ref', 'sortable' => true],
                ['key' => 'nama', 'label' => 'Nama', 'sortable' => true],
                ['key' => 'tahap', 'label' => 'Tahap', 'sortable' => true],
                ['key' => 'kelengkapan', 'label' => 'Kelengkapan', 'sortable' => true],
                ['key' => 'diperbarui', 'label' => 'Diperbarui', 'sortable' => true],
            ],
            'filters' => [
                ['key' => 'tahap', 'label' => 'Tahap', 'options' => ['semua' => 'Semua', 'draf' => 'Draf', 'verifikasi' => 'Verifikasi', 'seleksi' => 'Seleksi']],
                ['key' => 'jalur', 'label' => 'Jalur', 'options' => ['semua' => 'Semua', 'umum' => 'Umum', 'prestasi' => 'Prestasi']],
            ],
            'demo_rows' => [
                ['id' => '1', 'ref' => 'PPDB-2026-00421', 'nama' => 'Budi Santoso', 'tahap' => 'Verifikasi', 'kelengkapan' => '72%', 'diperbarui' => '2 jam lalu'],
                ['id' => '2', 'ref' => 'PPDB-2026-00418', 'nama' => 'Siti Aminah', 'tahap' => 'Seleksi', 'kelengkapan' => '100%', 'diperbarui' => '1 hari lalu'],
                ['id' => '3', 'ref' => 'PPDB-2026-00402', 'nama' => 'Andi Wijaya', 'tahap' => 'Draf', 'kelengkapan' => '35%', 'diperbarui' => '3 hari lalu'],
            ],
        ],
        'documents' => [
            'entity_keys' => ['registration_document'],
            'empty' => [
                'title' => 'Antrian dokumen kosong',
                'description' => 'Belum ada unggahan yang memerlukan tindakan.',
            ],
            'columns' => [
                ['key' => 'pemohon', 'label' => 'Pemohon', 'sortable' => true],
                ['key' => 'jenis', 'label' => 'Jenis dokumen', 'sortable' => true],
                ['key' => 'status', 'label' => 'Status', 'sortable' => true],
                ['key' => 'unggah', 'label' => 'Diunggah', 'sortable' => true],
            ],
            'filters' => [
                ['key' => 'status', 'label' => 'Status', 'options' => ['semua' => 'Semua', 'pending' => 'Menunggu', 'verified' => 'Terverifikasi', 'rejected' => 'Ditolak']],
            ],
            'demo_rows' => [
                ['id' => 'd1', 'pemohon' => 'Budi Santoso', 'jenis' => 'Ijazah', 'status' => 'Menunggu', 'unggah' => 'Hari ini'],
                ['id' => 'd2', 'pemohon' => 'Siti Aminah', 'jenis' => 'Kartu Keluarga', 'status' => 'Terverifikasi', 'unggah' => 'Kemarin'],
            ],
        ],
        'portal_users' => [
            'entity_keys' => ['portal_user'],
            'empty' => [
                'title' => 'Tidak ada pengguna',
                'description' => 'Pengguna portal muncul setelah registrasi akun.',
            ],
            'columns' => [
                ['key' => 'nama', 'label' => 'Nama', 'sortable' => true],
                ['key' => 'email', 'label' => 'Email', 'sortable' => true],
                ['key' => 'terakhir_login', 'label' => 'Terakhir aktif', 'sortable' => true],
                ['key' => 'status', 'label' => 'Status', 'sortable' => true],
            ],
            'filters' => [
                ['key' => 'status', 'label' => 'Status', 'options' => ['semua' => 'Semua', 'aktif' => 'Aktif', 'suspend' => 'Suspen']],
            ],
            'demo_rows' => [
                ['id' => 'u1', 'nama' => 'Budi Santoso', 'email' => 'budi@mail.test', 'terakhir_login' => '10 menit lalu', 'status' => 'Aktif'],
            ],
        ],
        'content' => [
            'entity_keys' => ['portal_content'],
            'empty' => [
                'title' => 'Belum ada konten',
                'description' => 'Tambahkan pengumuman agar terlihat di dasbor pendaftar.',
            ],
            'columns' => [
                ['key' => 'judul', 'label' => 'Judul', 'sortable' => true],
                ['key' => 'tipe', 'label' => 'Tipe', 'sortable' => true],
                ['key' => 'terbit', 'label' => 'Terbit', 'sortable' => true],
                ['key' => 'status', 'label' => 'Status', 'sortable' => true],
            ],
            'filters' => [
                ['key' => 'tipe', 'label' => 'Tipe', 'options' => ['semua' => 'Semua', 'pengumuman' => 'Pengumuman', 'berita' => 'Berita']],
            ],
            'demo_rows' => [
                ['id' => 'c1', 'judul' => 'Jadwal Seleksi Gelombang 1', 'tipe' => 'Pengumuman', 'terbit' => '2026-03-26', 'status' => 'Terbit'],
            ],
        ],
        'activity' => [
            'entity_keys' => ['audit_log'],
            'empty' => [
                'title' => 'Log kosong',
                'description' => 'Aktivitas tercatat setelah integrasi audit diaktifkan.',
            ],
            'columns' => [
                ['key' => 'waktu', 'label' => 'Waktu', 'sortable' => true],
                ['key' => 'aktifitas', 'label' => 'Aktivitas', 'sortable' => false],
                ['key' => 'pelaku', 'label' => 'Pelaku', 'sortable' => true],
                ['key' => 'meta', 'label' => 'Meta', 'sortable' => false],
            ],
            'filters' => [
                ['key' => 'level', 'label' => 'Level', 'options' => ['semua' => 'Semua', 'info' => 'Info', 'warning' => 'Peringatan']],
            ],
            'demo_rows' => [
                ['id' => 'a1', 'waktu' => '14:05', 'aktifitas' => 'Verify dokumen', 'pelaku' => 'admin@amt.test', 'meta' => 'batch #12'],
            ],
        ],
    ],

];

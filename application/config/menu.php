<?php
    $config['menu'] = array(
        array(
            "name" => 'dashboard',
            'title' => azlang('Dashboard'),
            'icon' => 'tachometer-alt',
            'url' => 'home',
            'role' => array(
                array(
                    'role_name' => 'role_table',
                    'role_title' => 'Data'
                ),
            ),
            'submenu' => array(),
        ), 
        array(
            "name" => "master",
            "title" => "Master",
            "icon" => "database",
            "url" => "",
            "submenu" => array(
                array(
                    "name" => "master_urusan_pemerintah",
                    "title" => "Urusan Pemerintah",
                    "url" => "master_urusan_pemerintah",
                    "submenu" => array()
                ),
                array(
                    "name" => "master_bidang_urusan",
                    "title" => "Bidang Urusan",
                    "url" => "master_bidang_urusan",
                    "submenu" => array()
                ),
                array(
                    "name" => "master_program",
                    "title" => "Program",
                    "url" => "master_program",
                    "submenu" => array()
                ),
                array(
                    "name" => "master_kegiatan",
                    "title" => "Kegiatan",
                    "url" => "master_kegiatan",
                    "submenu" => array()
                ),  
                array(
                    "name" => "master_sub_kegiatan",
                    "title" => "Sub Kegiatan",
                    "url" => "master_sub_kegiatan",
                    "submenu" => array()
                ),
                array(
                    "name" => "master_paket_belanja",
                    "title" => "Paket Belanja",
                    "url" => "master_paket_belanja",
                    "submenu" => array(),
                    'role' => array(
                        array(
                            'role_name' => 'role_view_paket_belanja',
                            'role_title' => 'Hanya lihat data'
                        ),
                    ),
                ),
                array(
                    "name" => "master_akun_belanja",
                    "title" => "Akun Belanja",
                    "url" => "master_akun_belanja",
                    "submenu" => array(),
                ),
                array(
                    "name" => "master_kategori",
                    "title" => "Kategori",
                    "url" => "master_kategori",
                    "submenu" => array()
                ),
                array(
                    "name" => "master_sub_kategori",
                    "title" => "Sub Kategori",
                    "url" => "master_sub_kategori",
                    "submenu" => array()
                ),
                array(
                    "name" => "master_kendaraan",
                    "title" => "Kendaraan",
                    "url" => "master_kendaraan",
                    "submenu" => array()
                ),
                array(
                    "name" => "master_ruang",
                    "title" => "Ruang",
                    "url" => "master_ruang",
                    "submenu" => array()
                ),
                array(
                    "name" => "master_satuan",
                    "title" => "Satuan",
                    "url" => "master_satuan",
                    "submenu" => array()
                ),
                array(
                    "name" => "master_sumber_dana",
                    "title" => "Sumber Dana",
                    "url" => "master_sumber_dana",
                    "submenu" => array()
                ),
                array(
                    "name" => "master_kode_rekening",
                    "title" => "Kode Rekening",
                    "url" => "master_kode_rekening",
                    "submenu" => array()
                ),
            ),
        ),
        array(
            "name" => "realisasi_anggaran",
            "title" => "Realisasi Anggaran",
            "icon" => "shopping-cart",
            "url" => "realisasi_anggaran",
            'submenu' => array(),
            'role' => array(
                array(
                    'role_name' => 'role_bypass',
                    'role_title' => 'Bisa realisasi anggaran sebelum bulan RAK'
                ),
                array(
                    'role_name' => 'role_view_realisasi_anggaran',
                    'role_title' => 'Hanya lihat data'
                ),
            ),
        ),
        array(
            "name" => "verifikasi_dokumen",
            "title" => "Verifikasi Dokumen",
            "icon" => "user",
            "url" => "verifikasi_dokumen",
            'submenu' => array(),
            'role' => array(),
        ),
        array(
            "name" => "npd",
            "title" => "Nota Pencairan Dana",
            "icon" => "file",
            "url" => "npd",
            'submenu' => array(),
            'role' => array(
                array(
                    'role_name' => 'role_view_npd',
                    'role_title' => 'Hanya lihat data'
                ),
            ),
        ),
        array(
            "name" => "pembayaran",
            "title" => "Pembayaran",
            "icon" => "credit-card",
            "url" => "pembayaran",
            'submenu' => array(),
        ),
        array(
            "name" => "evaluasi_anggaran",
            "title" => "Evaluasi Anggaran",
            "icon" => "check-square",
            "url" => "evaluasi_anggaran",
            'submenu' => array(),
        ),
        array(
            "name" => "npd_panjer",
            "title" => "NPD Panjer",
            "icon" => "file",
            "url" => "npd_panjer",
            'submenu' => array(),
            'role' => array(
                array(
                    'role_name' => 'role_view_npd_panjer',
                    'role_title' => 'Hanya lihat data'
                ),
            ),
        ),
        array(
            "name" => "report",
            "title" => "Laporan",
            "url" => "report",
            "icon" => "file",
            "submenu" => array(),
            'role' => array(
                array(
                    'role_name' => 'role_report_realisasi_anggaran',
                    'role_title' => 'Laporan Realisasi Anggaran',
                ),
                array(
                    'role_name' => 'role_report_sisa_realisasi_anggaran',
                    'role_title' => 'Laporan Sisa Realisasi Anggaran',
                ),
                array(
                    'role_name' => 'role_report_evaluasi_anggaran',
                    'role_title' => 'Laporan Evaluasi Anggaran',
                ),
            ),
        ),
        array(
            "name" => "information",
            "title" => "Informasi",
            "icon" => "bullhorn",
            "url" => "information",
            'submenu' => array(),
        ),
        array(
            "name" => "manual_book",
            "title" => "Buku Petunjuk",
            "icon" => "file-pdf",
            "url" => "manual_book",
            'submenu' => array(),
        ),
        array(
            "name" => "user",
            "title" => azlang("User"),
            "icon" => "user",
            "url" => "",
            "submenu" => array(
                array(
                    "name" => "user_user",
                    "title" => azlang("Tambah/Edit Pengguna"),
                    "url" => "user",
                    "submenu" => array()
                ),
                array(
                    "name" => "user_user_role",
                    "title" => azlang("Hak Akses"),
                    "url" => "user_role",
                    "submenu" => array()
                ),
            )
        ),
    );


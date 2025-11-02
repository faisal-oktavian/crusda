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
            "name" => "warehouse",
            "title" => "Sistem Gudang",
            "icon" => "box",
            "url" => "",
            "submenu" => array(
                array(
                    "name" => "master",
                    "title" => "Master",
                    "url" => "",
                    "submenu" => array(
                        array(
                            "name" => "product",
                            "title" => "Produk",
                            "url" => "product",
                            "submenu" => array()
                        ),
                        array(
                            "name" => "product_category",
                            "title" => "Kategori Produk",
                            "url" => "product_category",
                            "submenu" => array()
                        ),
                        array(
                            "name" => "product_unit",
                            "title" => "Satuan Stok",
                            "url" => "product_unit",
                            "submenu" => array()
                        ),
                        array(
                            "name" => "product_unit_detail",
                            "title" => "Satuan Stok Detail",
                            "url" => "product_unit_detail",
                            "submenu" => array()
                        ),
                        array(
                            "name" => "warehouse",
                            "title" => "Gudang",
                            "url" => "warehouse",
                            "submenu" => array()
                        ),
                    )
                ),
                array(
                    "name" => "stock",
                    "title" => "Stok",
                    "url" => "",
                    "submenu" => array(
                        array(
                            "name" => "stock",
                            "title" => "Daftar Stok",
                            "url" => "stock",
                            "submenu" => array()
                        ),
                        array(
                            "name" => "minimum_stock",
                            "title" => "Stok Minimal",
                            "url" => "minimum_stock",
                            "submenu" => array()
                        ),
                        array(
                            "name" => "stock_history",
                            "title" => "Riwayat Stok",
                            "url" => "stock_history",
                            "submenu" => array()
                        ),
                        array(
                            "name" => "stock_opname",
                            "title" => "Stok Opname",
                            "url" => "stock_opname",
                            "submenu" => array()
                        ),
                    )
                ),
            )
        ),
        array(
            "name" => "oc_cashier",
            "title" => "Buka/Tutup Kasir",
            "icon" => "dollar-sign",
            "url" => "oc_cashier",
            'submenu' => array(),
        ),
        array(
            "name" => "pos",
            "title" => "Penjualan",
            "icon" => "shopping-cart",
            "url" => "pos",
            'submenu' => array(),
        ),
        array(
            "name" => "purchasing",
            "title" => "Pembelian",
            "icon" => "shopping-cart",
            "url" => "purchasing",
            "submenu" => array(),
            "role" => array(
                array(
                    'role_name' => 'purchase_order',
                    'role_title' => 'Pemesanan'
                ),
                array(
                    'role_name' => 'purchase_receipt',
                    'role_title' => 'Penerimaan'
                ),
                array(
                    'role_name' => 'purchase_invoice',
                    'role_title' => 'Faktur'
                ),
            )
        ),
        array(
            "name" => "income_expense",
            "title" => "Pemasukan/Pengeluaran",
            "icon" => "money-bill-wave",
            "url" => "income_expense",
            'submenu' => array(),
        ),
        array(
            "name" => "customer",
            "title" => "Manajemen Pelanggan",
            "icon" => "user-friends",
            "url" => "customer",
            'submenu' => array(),
        ),
        array(
            "name" => "supplier",
            "title" => "Manajemen Supplier",
            "icon" => "users",
            "url" => "supplier",
            'submenu' => array(),
        ),
        array(
            "name" => "report",
            "title" => "Laporan",
            "url" => "report",
            "icon" => "file",
            "submenu" => array(),
            "role" => array(
                array(
                    'role_name' => 'acc_report_acc',
                    'role_title' => 'Laporan Akuntansi'
                ),
                array(
                    'role_name' => 'acc_report_sales',
                    'role_title' => 'Laporan Penjualan'
                ),
                array(
                    'role_name' => 'acc_report_purchase',
                    'role_title' => 'Laporan Pembelian'
                ),
                array(
                    'role_name' => 'acc_report_asset',
                    'role_title' => 'Laporan Aset'
                ),
                array(
                    'role_name' => 'acc_report_bank',
                    'role_title' => 'Laporan Bank'
                ),
                array(
                    'role_name' => 'acc_report_tax',
                    'role_title' => 'Laporan Pajak'
                ),
            )
        ),
        array(
            "name" => "setting",
            "title" => "Pengaturan",
            "icon" => "cogs",
            "url" => "",
            "submenu" => array(
                array(
                    "name" => "user",
                    "title" => "Pengguna",
                    "url" => "user",
                    "submenu" => array()
                ),
                array(
                    "name" => "user_role",
                    "title" => "Hak Akses",
                    "url" => "user_role",
                    "submenu" => array()
                ),
                array(
                    "name" => "information",
                    "title" => "Toko",
                    "url" => "information",
                    "submenu" => array()
                ),
            )
        ),
    );


<?php

return [
    [
        'title' => 'Dashboard',
        'icon'  => 'bi bi-house',
        'route' => 'admin/dashboard',
        'roles' => ['admin', 'super_user']
    ],
    [
        'title' => 'Manajemen Konten',
        'icon'  => 'bi bi-edit',
        'roles' => ['admin', 'super_user'],
        'submenu' => [
            [
                'title' => 'Berita',
                'route' => 'admin/posts?type=news',
                'roles' => ['admin', 'super_user']
            ],
            [
                'title' => 'Pengumuman',
                'route' => 'admin/posts?type=announcement',
                'roles' => ['admin', 'super_user']
            ],
            [
                'title' => 'Profil Sekolah',
                'route' => 'admin/pages/profil',
                'roles' => ['admin', 'super_user']
            ],
            [
                'title' => 'Visi dan Misi',
                'route' => 'admin/pages/visi-misi',
                'roles' => ['admin', 'super_user']
            ],
        ]
    ],
    [
        'title' => 'Perpustakaan',
        'icon'  => 'bi bi-book',
        'roles' => ['admin', 'super_user'],
        'submenu' => [
            [
                'title' => 'Daftar Buku',
                'route' => 'admin/books',
                'roles' => ['admin', 'super_user']
            ],
            [
                'title' => 'Kategori Buku',
                'route' => 'admin/book-categories',
                'roles' => ['admin', 'super_user']
            ],
            [
                'title' => 'Peminjaman',
                'route' => 'admin/borrowings',
                'roles' => ['admin', 'super_user']
            ],
            [
                'title' => 'Pengembalian',
                'route' => 'admin/returns',
                'roles' => ['admin', 'super_user']
            ],
        ]
    ],
    [
        'title' => 'Manajemen User',
        'icon'  => 'bi bi-person-gear',
        'roles' => ['super_user'],
        'submenu' => [
            [
                'title' => 'Data User',
                'route' => 'admin/users',
                'roles' => ['super_user']
            ],
            [
                'title' => 'Grup Pengguna',
                'route' => 'admin/user-groups',
                'roles' => ['super_user']
            ],
            [
                'title' => 'Hak Akses',
                'route' => 'admin/permissions',
                'roles' => ['super_user']
            ],
        ]
    ],
    [
        'title' => 'Pengaturan',
        'icon'  => 'bi bi-database-gear',
        'roles' => ['super_user'],
        'submenu' => [
            [
                'title' => 'Konfigurasi Umum',
                'route' => 'settings/general',
                'roles' => ['super_user']
            ],
        ]
    ],
];

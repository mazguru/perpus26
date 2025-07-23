<?php

return [
    [
        'title' => 'Dashboard',
        'icon'  => 'bi bi-house',
        'route' => 'dashboard',
        'roles' => ['admin', 'super_user']
    ],
    [
        'title' => 'Manajemen Konten',
        'icon'  => 'bi bi-edit',
        'roles' => ['admin', 'super_user'],
        'submenu' => [
            [
                'title' => 'Berita',
                'route' => 'blog/posts?type=news',
                'roles' => ['admin', 'super_user']
            ],
            [
                'title' => 'Pengumuman',
                'route' => 'blog/posts?type=announcement',
                'roles' => ['admin', 'super_user']
            ],
            [
                'title' => 'Profil Sekolah',
                'route' => 'blog/pages/profil',
                'roles' => ['admin', 'super_user']
            ],
            [
                'title' => 'Visi dan Misi',
                'route' => 'blog/pages/visi-misi',
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
                'title' => 'Umum',
                'route' => 'settings/general',
                'roles' => ['super_user']
            ],
            [
                'title' => 'Profil Sekolah',
                'route' => 'settings/profil',
                'roles' => ['super_user']
            ],
            [
                'title' => 'Media Sosial',
                'route' => 'settings/medsos',
                'roles' => ['super_user']
            ],
            [
                'title' => 'Media',
                'route' => 'settings/media',
                'roles' => ['super_user']
            ],
            [
                'title' => 'Menulis',
                'route' => 'settings/writing',
                'roles' => ['super_user']
            ],
            [
                'title' => 'Membaca',
                'route' => 'settings/reading',
                'roles' => ['super_user']
            ],
        ]
    ],
];

<?php

return [
    [
        'title' => 'Dashboard',
        'icon'  => 'bi bi-house',
        'route' => 'dashboard',
        'roles' => ['admin', 'super_user']
    ],
    [
        'title' => 'Manajemen Tulisan',
        'icon'  => 'bi bi-edit',
        'roles' => ['admin', 'super_user'],
        'submenu' => [
            [
                'title' => 'Semua Tulisan',
                'route' => 'blog/posts',
                'roles' => ['admin', 'super_user']
            ],
            [
                'title' => 'Tambah Tulisan',
                'route' => 'blog/posts/create',
                'roles' => ['admin', 'super_user']
            ],
            [
                'title' => 'Kategori Tulisan',
                'route' => 'blog/category',
                'roles' => ['admin', 'super_user']
            ],
            [
                'title' => 'Halaman',
                'route' => 'blog/page',
                'roles' => ['admin', 'super_user']
            ],
            [
                'title' => 'Komentar',
                'route' => 'blog/comment',
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

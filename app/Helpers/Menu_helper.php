<?php
// Settings
if (! function_exists('menuadmin')) {
    function menuadmin()
    {
        return [
            [
                'title' => 'Dashboard',
                'icon'  => 'bi bi-house',
                'route' => 'dashboard',
                'roles' => ['administrator', 'super_user']
            ],
            [
                'title' => 'Manajemen Tulisan',
                'icon'  => 'bi bi-newspaper',
                'roles' => ['administrator', 'super_user'],
                'submenu' => [
                    [
                        'title' => 'Semua Tulisan',
                        'route' => 'blog/posts',
                        'roles' => ['administrator', 'super_user']
                    ],
                    [
                        'title' => 'Tambah Tulisan',
                        'route' => 'blog/posts/create',
                        'roles' => ['administrator', 'super_user']
                    ],
                    [
                        'title' => 'Halaman',
                        'route' => 'blog/page',
                        'roles' => ['administrator', 'super_user']
                    ],
                    [
                        'title' => 'Komentar',
                        'route' => 'blog/comment',
                        'roles' => ['administrator', 'super_user']
                    ],
                ]
            ],
            [
                'title' => 'Manajemen Halaman',
                'icon'  => 'bi bi-newspaper',
                'roles' => ['administrator', 'super_user'],
                'submenu' => [
                    [
                        'title' => 'Semua Halaman',
                        'route' => 'blog/page',
                        'roles' => ['administrator', 'super_user']
                    ],
                    [
                        'title' => 'Tambah Halaman',
                        'route' => 'blog/page/create',
                        'roles' => ['administrator', 'super_user']
                    ],
                ]
            ],
            [
                'title' => 'Kategori',
                'icon'  => 'bi bi-house',
                'route' => 'blog/category',
                'roles' => ['administrator', 'super_user']
            ],
            [
                'title' => 'Media Galeri',
                'icon'  => 'bi bi-images',
                'roles' => ['super_user'],
                'submenu' => [
                    [
                        'title' => 'Foto',
                        'route' => 'media/albums',
                        'roles' => ['super_user']
                    ],
                    [
                        'title' => 'Video',
                        'route' => 'media/galeri-video',
                        'roles' => ['super_user']
                    ],
                    [
                        'title' => 'Tautan',
                        'route' => 'media/tautan',
                        'roles' => ['super_user']
                    ],

                ]
            ],
            [
                'title' => 'Tampilan',
                'icon'  => 'bi bi-display',
                'roles' => ['super_user'],
                'submenu' => [
                    [
                        'title' => 'Menu',
                        'route' => 'admin/menu',
                        'roles' => ['super_user']
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
                        'route' => 'users/users',
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
    }
}

<!-- Sticky Navbar -->
<!-- Sticky Header -->
<header class="bg-white shadow">
    <div class="container mx-auto px-4 py-2">

        <!-- Baris 1: Logo + Search -->
        <div class="flex flex-col md:flex-row items-center justify-between gap-4">
            <div class="flex items-center gap-2">
                <img src="logo.png" alt="Logo" class="h-10 w-10" />
                <h1 class="text-2xl font-bold text-green-800">Perpustakaan Ulil Albab</h1>
            </div>
            <div class="w-full md:w-1/3">
                <div class="relative">
                    <input type="text" placeholder="Search..." class="w-full border border-gray-300 rounded-md pl-10 pr-4 py-2 focus:outline-none focus:ring-2 focus:ring-green-500" />
                    <span class="absolute left-3 top-2.5 text-gray-500">🔍</span>
                </div>
            </div>
        </div>


    </div>
</header>
<!-- Baris 2: Menu Navigasi -->
<nav class ="sticky top-0 z-50">
<div class="mt-4 flex flex-wrap justify-center gap-4 text-sm font-medium text-gray-700">
    <a href="#" class="hover:text-green-600">Beranda</a>
    <div class="relative group">
        <button class="hover:text-green-600">Profil</button>
        <div class="absolute mt-1 left-1/2 -translate-x-1/2 w-40 bg-white shadow-lg hidden group-hover:block z-50">
            <a href="#" class="block px-4 py-2 hover:bg-gray-100">Visi & Misi</a>
            <a href="#" class="block px-4 py-2 hover:bg-gray-100">Struktur</a>
        </div>
    </div>
    <a href="#" class="hover:text-green-600">Galeri</a>
    <a href="#" class="hover:text-green-600">Kemitraan</a>
    <div class="relative group">
        <button class="hover:text-green-600">Data & Fakta</button>
        <div class="absolute mt-1 left-1/2 -translate-x-1/2 w-40 bg-white shadow-lg hidden group-hover:block z-50">
            <a href="#" class="block px-4 py-2 hover:bg-gray-100">Statistik</a>
            <a href="#" class="block px-4 py-2 hover:bg-gray-100">Laporan</a>
        </div>
    </div>
    <a href="#" class="hover:text-green-600">SLiMS</a>
    <a href="#" class="hover:text-green-600">Hubungi Kami</a>
</div>
</nav>

<!-- Hero Section -->
<section class="relative h-[80vh] bg-cover bg-center" style="background-image: url('/path/to/your-image.jpg');">
    <div class="absolute inset-0 bg-black/40"></div>
    <div class="relative z-10 flex flex-col items-center justify-center h-full text-center px-4 text-white">
        <h2 class="text-4xl md:text-5xl font-bold mb-4">Perpustakaan Ulil Albab</h2>
        <p class="max-w-2xl text-lg font-light">
            Perpustakaan Ulil Albab MAN 3 Bantul membekali pemustaka mandiri, berprestasi, dan memiliki jiwa literat, untuk siap memimpin negeri.
        </p>
    </div>
</section>
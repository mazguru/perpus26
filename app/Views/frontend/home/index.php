<!-- Hero Section -->
<?= $this->include('frontend/home/hero') ?>



<!-- Berita Section -->
 <?= $this->include('frontend/home/berita') ?>


<?= $this->include('frontend/home/galery') ?>
<?= $this->include('frontend/home/layanan') ?>
<!-- Layanan Section -->
<section id="layanan" class="bg-gray-50 py-16">
    <div class="max-w-screen-xl mx-auto px-4">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-bold text-gray-800 mb-2">Layanan Kami</h2>
            <div class="w-24 h-1 bg-blue-600 mx-auto mb-4"></div>
            <p class="text-gray-600 max-w-2xl mx-auto">Kami menyediakan berbagai layanan untuk memenuhi kebutuhan literasi dan pengetahuan Anda.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
            <!-- Layanan 1 -->
            <div class="service-card bg-white rounded-lg p-6 shadow-md transition duration-300 text-center">
                <div class="bg-blue-100 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                    </svg>
                </div>
                <h3 class="text-xl font-semibold text-gray-800 mb-2">Peminjaman Buku</h3>
                <p class="text-gray-600">Pinjam buku fisik dari koleksi kami yang luas dengan sistem peminjaman yang mudah dan cepat.</p>
                <a href="#" class="inline-block mt-4 text-blue-600 hover:text-blue-800 font-medium">Pelajari lebih lanjut</a>
            </div>

            <!-- Layanan 2 -->
            <div class="service-card bg-white rounded-lg p-6 shadow-md transition duration-300 text-center">
                <div class="bg-blue-100 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                    </svg>
                </div>
                <h3 class="text-xl font-semibold text-gray-800 mb-2">E-Library</h3>
                <p class="text-gray-600">Akses ribuan e-book, jurnal elektronik, dan sumber digital lainnya dari mana saja.</p>
                <a href="#" class="inline-block mt-4 text-blue-600 hover:text-blue-800 font-medium">Pelajari lebih lanjut</a>
            </div>

            <!-- Layanan 3 -->
            <div class="service-card bg-white rounded-lg p-6 shadow-md transition duration-300 text-center">
                <div class="bg-blue-100 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                    </svg>
                </div>
                <h3 class="text-xl font-semibold text-gray-800 mb-2">Ruang Belajar</h3>
                <p class="text-gray-600">Nikmati ruang belajar yang nyaman dan tenang untuk belajar individu atau kelompok.</p>
                <a href="#" class="inline-block mt-4 text-blue-600 hover:text-blue-800 font-medium">Pelajari lebih lanjut</a>
            </div>

            <!-- Layanan 4 -->
            <div class="service-card bg-white rounded-lg p-6 shadow-md transition duration-300 text-center">
                <div class="bg-blue-100 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                </div>
                <h3 class="text-xl font-semibold text-gray-800 mb-2">Program & Acara</h3>
                <p class="text-gray-600">Ikuti berbagai program menarik seperti diskusi buku, lokakarya, dan acara literasi lainnya.</p>
                <a href="#" class="inline-block mt-4 text-blue-600 hover:text-blue-800 font-medium">Pelajari lebih lanjut</a>
            </div>
        </div>
    </div>
</section>

<!-- Kontak Section -->
 <?= $this->include('frontend/home/contact')?>


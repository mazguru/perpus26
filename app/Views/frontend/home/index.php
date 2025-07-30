<!-- Hero Section -->
<?= $this->include('frontend/home/hero') ?>



<!-- Berita Section -->
 <?= $this->include('frontend/home/berita') ?>


<?= $this->include('frontend/home/galery') ?>
<!-- Layanan Section -->
<section id="layanan" class="bg-gray-50 py-16">
    <div class="max-w-screen-xl mx-auto px-4">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-bold text-gray-800 mb-2">Layanan Kami</h2>
            <div class="w-24 h-1 bg-indigo-600 mx-auto mb-4"></div>
            <p class="text-gray-600 max-w-2xl mx-auto">Kami menyediakan berbagai layanan untuk memenuhi kebutuhan literasi dan pengetahuan Anda.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
            <!-- Layanan 1 -->
            <div class="service-card bg-white rounded-lg p-6 shadow-md transition duration-300 text-center">
                <div class="bg-indigo-100 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                    </svg>
                </div>
                <h3 class="text-xl font-semibold text-gray-800 mb-2">Peminjaman Buku</h3>
                <p class="text-gray-600">Pinjam buku fisik dari koleksi kami yang luas dengan sistem peminjaman yang mudah dan cepat.</p>
                <a href="#" class="inline-block mt-4 text-indigo-600 hover:text-indigo-800 font-medium">Pelajari lebih lanjut</a>
            </div>

            <!-- Layanan 2 -->
            <div class="service-card bg-white rounded-lg p-6 shadow-md transition duration-300 text-center">
                <div class="bg-indigo-100 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                    </svg>
                </div>
                <h3 class="text-xl font-semibold text-gray-800 mb-2">E-Library</h3>
                <p class="text-gray-600">Akses ribuan e-book, jurnal elektronik, dan sumber digital lainnya dari mana saja.</p>
                <a href="#" class="inline-block mt-4 text-indigo-600 hover:text-indigo-800 font-medium">Pelajari lebih lanjut</a>
            </div>

            <!-- Layanan 3 -->
            <div class="service-card bg-white rounded-lg p-6 shadow-md transition duration-300 text-center">
                <div class="bg-indigo-100 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                    </svg>
                </div>
                <h3 class="text-xl font-semibold text-gray-800 mb-2">Ruang Belajar</h3>
                <p class="text-gray-600">Nikmati ruang belajar yang nyaman dan tenang untuk belajar individu atau kelompok.</p>
                <a href="#" class="inline-block mt-4 text-indigo-600 hover:text-indigo-800 font-medium">Pelajari lebih lanjut</a>
            </div>

            <!-- Layanan 4 -->
            <div class="service-card bg-white rounded-lg p-6 shadow-md transition duration-300 text-center">
                <div class="bg-indigo-100 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                </div>
                <h3 class="text-xl font-semibold text-gray-800 mb-2">Program & Acara</h3>
                <p class="text-gray-600">Ikuti berbagai program menarik seperti diskusi buku, lokakarya, dan acara literasi lainnya.</p>
                <a href="#" class="inline-block mt-4 text-indigo-600 hover:text-indigo-800 font-medium">Pelajari lebih lanjut</a>
            </div>
        </div>
    </div>
</section>

<!-- Kontak Section -->
<section id="kontak" class="bg-indigo-700 text-white py-16">
    <div class="max-w-screen-xl mx-auto px-4">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-bold mb-2">Hubungi Kami</h2>
            <div class="w-24 h-1 bg-white mx-auto mb-4"></div>
            <p class="max-w-2xl mx-auto opacity-90">Ada pertanyaan atau saran? Jangan ragu untuk menghubungi kami melalui salah satu saluran di bawah ini.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <!-- Alamat -->
            <div class="bg-indigo-800 rounded-lg p-6 text-center">
                <div class="bg-indigo-600 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                </div>
                <h3 class="text-xl font-semibold mb-3">Alamat</h3>
                <p class="opacity-90">Jl. Perpustakaan No. 123<br>Kota Ilmu, 12345<br>Indonesia</p>
            </div>

            <!-- Kontak -->
            <div class="bg-indigo-800 rounded-lg p-6 text-center">
                <div class="bg-indigo-600 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                    </svg>
                </div>
                <h3 class="text-xl font-semibold mb-3">Telepon & Email</h3>
                <p class="opacity-90">+62 123 4567 890<br>info@perpustakaankita.ac.id</p>
            </div>

            <!-- Jam Operasional -->
            <div class="bg-indigo-800 rounded-lg p-6 text-center">
                <div class="bg-indigo-600 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <h3 class="text-xl font-semibold mb-3">Jam Operasional</h3>
                <p class="opacity-90">Senin - Jumat: 08.00 - 20.00<br>Sabtu: 09.00 - 17.00<br>Minggu: Tutup</p>
            </div>
        </div>

        <!-- Form Kontak -->
        <div class="mt-12 bg-white rounded-lg shadow-lg p-8 max-w-3xl mx-auto">
            <h3 class="text-2xl font-semibold text-gray-800 mb-6 text-center">Kirim Pesan</h3>
            <form id="contact-form" class="space-y-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="name" class="block text-gray-700 font-medium mb-2">Nama</label>
                        <input type="text" id="name" name="name" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 text-gray-900" required>
                    </div>
                    <div>
                        <label for="email" class="block text-gray-700 font-medium mb-2">Email</label>
                        <input type="email" id="email" name="email" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 text-gray-900" required>
                    </div>
                </div>
                <div>
                    <label for="subject" class="block text-gray-700 font-medium mb-2">Subjek</label>
                    <input type="text" id="subject" name="subject" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 text-gray-900" required>
                </div>
                <div>
                    <label for="message" class="block text-gray-700 font-medium mb-2">Pesan</label>
                    <textarea id="message" name="message" rows="4" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 text-gray-900" required></textarea>
                </div>
                <div class="text-center">
                    <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-medium py-3 px-8 rounded-lg transition duration-300">Kirim Pesan</button>
                </div>
            </form>
            <div id="form-success" class="hidden mt-4 p-4 bg-green-100 text-green-700 rounded-lg text-center">
                Terima kasih! Pesan Anda telah terkirim.
            </div>
        </div>
    </div>
</section>
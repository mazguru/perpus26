<!-- Hero Section -->
<section id="beranda" class="hero-pattern min-h-[80vh] flex items-center">
    <div class="max-w-screen-xl mx-auto px-4 py-16">
        <div class="flex flex-col md:flex-row items-center">
            <div class="md:w-1/2 mb-10 md:mb-0">
                <h1 class="text-4xl md:text-5xl font-bold text-indigo-900 mb-4">Selamat Datang di Perpustakaan Kita</h1>
                <p class="text-lg text-gray-700 mb-8">Temukan ribuan koleksi buku, jurnal, dan sumber pengetahuan lainnya untuk menginspirasi dan memperluas wawasan Anda.</p>
                <div class="flex flex-col sm:flex-row space-y-4 sm:space-y-0 sm:space-x-4">
                    <a href="#layanan" class="bg-indigo-600 hover:bg-indigo-700 text-white font-medium py-3 px-6 rounded-lg transition duration-300 text-center">Jelajahi Layanan</a>
                    <a href="#katalog" class="bg-white hover:bg-gray-100 text-indigo-600 font-medium py-3 px-6 rounded-lg border border-indigo-600 transition duration-300 text-center">Katalog Buku</a>
                </div>
            </div>
            <div class="md:w-1/2 flex justify-center">
                <svg class="w-full max-w-lg" viewBox="0 0 500 400" xmlns="http://www.w3.org/2000/svg">
                    <rect x="70" y="50" width="360" height="300" rx="10" fill="#e2e8f0" />
                    <rect x="90" y="70" width="320" height="260" rx="5" fill="#fff" />
                    <rect x="110" y="90" width="60" height="220" rx="2" fill="#4c1d95" />
                    <rect x="180" y="90" width="60" height="220" rx="2" fill="#5b21b6" />
                    <rect x="250" y="90" width="60" height="220" rx="2" fill="#6d28d9" />
                    <rect x="320" y="90" width="60" height="220" rx="2" fill="#7c3aed" />
                    <circle cx="140" cy="60" r="15" fill="#fcd34d" />
                    <path d="M50,180 C20,150 20,250 50,220 L50,180" fill="#4f46e5" />
                    <path d="M450,180 C480,150 480,250 450,220 L450,180" fill="#4f46e5" />
                    <circle cx="50" cy="200" r="20" fill="#4f46e5" />
                    <circle cx="450" cy="200" r="20" fill="#4f46e5" />
                </svg>
            </div>
        </div>
    </div>
</section>

<!-- Berita Section -->
<section id="berita" class="bg-white py-16">
    <div class="max-w-screen-xl mx-auto px-4">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-bold text-gray-800 mb-2">Berita Terbaru</h2>
            <div class="w-24 h-1 bg-indigo-600 mx-auto mb-4"></div>
            <p class="text-gray-600 max-w-2xl mx-auto">Ikuti perkembangan terbaru dari perpustakaan kami, termasuk acara, koleksi baru, dan informasi penting lainnya.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <!-- Berita 1 -->
            <?php foreach ($artikel as $a): ?>
                <div class="news-card bg-white rounded-lg overflow-hidden shadow-md transition duration-300">
                    <div class="h-48 bg-indigo-100 flex items-center justify-center">
                        <?php if ($a['post_image']): ?>
                            <img src="<?= base_url() ?>/media_library/posts/thumbs/<?= $a['post_image'] ?>" class="w-full h-40 object-cover mb-2">
                        <?php else : ?>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-24 w-24 text-indigo-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>

                        <?php endif ?>
                    </div>
                    <div class="p-6">
                        <span class="text-xs font-semibold text-indigo-600 uppercase tracking-wider">Acara</span>
                        <h3 class="text-xl font-semibold text-gray-800 mt-2"><?= esc($a['post_title']) ?></h3>
                        <p class="text-gray-600 mt-3">Bergabunglah dalam diskusi menarik bersama penulis terkenal membahas karya terbaru mereka pada Sabtu, 15 Juni 2023.</p>
                        <div class="mt-4 flex items-center">
                            <span class="text-sm text-gray-500">12 Mei 2023</span>
                            <a href="/post/<?= $a['post_slug'] ?>" class="ml-auto text-indigo-600 hover:text-indigo-800 font-medium">Baca selengkapnya</a>
                        </div>
                    </div>
                </div>

            <?php endforeach ?>


            <!-- Berita 2 -->
            <div class="news-card bg-white rounded-lg overflow-hidden shadow-md transition duration-300">
                <div class="h-48 bg-indigo-100 flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-24 w-24 text-indigo-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                    </svg>
                </div>
                <div class="p-6">
                    <span class="text-xs font-semibold text-indigo-600 uppercase tracking-wider">Koleksi Baru</span>
                    <h3 class="text-xl font-semibold text-gray-800 mt-2">100+ Buku Baru Telah Ditambahkan</h3>
                    <p class="text-gray-600 mt-3">Perpustakaan kami baru saja menambahkan lebih dari 100 judul buku baru dari berbagai genre untuk Anda nikmati.</p>
                    <div class="mt-4 flex items-center">
                        <span class="text-sm text-gray-500">5 Mei 2023</span>
                        <a href="#" class="ml-auto text-indigo-600 hover:text-indigo-800 font-medium">Baca selengkapnya</a>
                    </div>
                </div>
            </div>

            <!-- Berita 3 -->
            <div class="news-card bg-white rounded-lg overflow-hidden shadow-md transition duration-300">
                <div class="h-48 bg-indigo-100 flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-24 w-24 text-indigo-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z" />
                    </svg>
                </div>
                <div class="p-6">
                    <span class="text-xs font-semibold text-indigo-600 uppercase tracking-wider">Pengumuman</span>
                    <h3 class="text-xl font-semibold text-gray-800 mt-2">Perpanjangan Jam Operasional</h3>
                    <p class="text-gray-600 mt-3">Mulai bulan Juni, perpustakaan akan buka lebih lama pada hari Jumat dan Sabtu untuk mengakomodasi pengunjung di akhir pekan.</p>
                    <div class="mt-4 flex items-center">
                        <span class="text-sm text-gray-500">28 April 2023</span>
                        <a href="#" class="ml-auto text-indigo-600 hover:text-indigo-800 font-medium">Baca selengkapnya</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="text-center mt-10">
            <a href="#" class="inline-block bg-indigo-50 hover:bg-indigo-100 text-indigo-600 font-medium py-3 px-6 rounded-lg transition duration-300">Lihat Semua Berita</a>
        </div>
    </div>
</section>

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
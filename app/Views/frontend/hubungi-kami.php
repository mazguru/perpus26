<style>
    .contact-card {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .contact-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px -5px rgba(59, 130, 246, 0.4);
    }

    .map-container {
        position: relative;
        overflow: hidden;
        height: 400px;
        border-radius: 0.5rem;
    }

    .form-input:focus {
        border-color: #3b82f6;
        box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.3);
    }
</style>
<!-- Hero Section -->
<section class="bg-pumpkin-700 text-white py-16">
    <div class="container mx-auto px-4 text-center">
        <h1 class="text-4xl md:text-5xl font-bold mb-4">Hubungi Kami</h1>
        <p class="text-xl max-w-2xl mx-auto text-pumpkin-100">Kami siap membantu Anda. Jangan ragu untuk menghubungi kami dengan pertanyaan, saran, atau kebutuhan informasi lainnya.</p>
    </div>
</section>

<!-- Contact Info Cards -->
<section class="py-16 bg-white">
    <div class="container mx-auto px-4">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="contact-card bg-gradient-to-br from-pumpkin-50 to-pumpkin-100 p-8 rounded-lg shadow-md text-center">
                <div class="bg-pumpkin-600 text-white rounded-full w-16 h-16 flex items-center justify-center mx-auto mb-6">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                    </svg>
                </div>
                <h3 class="text-xl font-semibold text-pumpkin-800 mb-2">Telepon</h3>
                <p class="text-gray-600 mb-4">Senin - Jumat: 08.00 - 16.00</p>
                <a href="tel:+6221123456789" class="text-pumpkin-600 font-medium hover:text-pumpkin-800 transition"><?= session('phone') ?></a>
            </div>

            <div class="contact-card bg-gradient-to-br from-pumpkin-50 to-pumpkin-100 p-8 rounded-lg shadow-md text-center">
                <div class="bg-pumpkin-600 text-white rounded-full w-16 h-16 flex items-center justify-center mx-auto mb-6">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                    </svg>
                </div>
                <h3 class="text-xl font-semibold text-pumpkin-800 mb-2">Email</h3>
                <p class="text-gray-600 mb-4">Respon dalam 24 jam</p>
                <a href="mailto:info@perpustakaandigital.id" class="text-pumpkin-600 font-medium hover:text-pumpkin-800 transition"><?= session('email') ?></a>
            </div>

            <div class="contact-card bg-gradient-to-br from-pumpkin-50 to-pumpkin-100 p-8 rounded-lg shadow-md text-center">
                <div class="bg-pumpkin-600 text-white rounded-full w-16 h-16 flex items-center justify-center mx-auto mb-6">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                </div>
                <h3 class="text-xl font-semibold text-pumpkin-800 mb-2">Alamat</h3>
                <p class="text-gray-600 mb-4">Jam Kunjungan: 08.00 - 15.00</p>
                <address class="not-italic text-pumpkin-600">
                    <?= session('street_address') ?>, <?= session('village') ?>, <?= session('sub_district') ?>,<br> Kab. <?= session('district') ?> <?= session('postal_code') ?>
                </address>
            </div>
        </div>
    </div>
</section>

<!-- Contact Form & Map -->
<section class="py-16 bg-saddle-50">
    <div class="container mx-auto px-4">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12" x-data="formMessage">
            <!-- Contact Form -->
            <div class="bg-white p-8 rounded-lg shadow-lg">
                <h2 class="text-2xl font-bold text-pumpkin-800 mb-6">Kirim Pesan</h2>
                <form x-show="formVisible" x-transition @submit.prevent="submitComment" class="space-y-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-2">
                        <div>
                            <label for="comment_author" class="block text-gray-700 font-medium mb-2">Nama</label>
                            <input type="text" id="comment_author" x-model="form.comment_author" class="w-full px-4 py-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-pumpkin-500">
                            <p x-text="formErrors.comment_author" class="text-red-500 text-sm mt-1">Nama wajib diisi</p>
                        </div>
                        <div>
                            <label for="email" class="block text-gray-700 font-medium mb-2">Email</label>
                            <input type="email" id="email" x-model="form.comment_email" class="w-full px-4 py-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-pumpkin-500">
                            <p x-text="formErrors.comment_email" class="text-red-500 text-sm mt-1">Email tidak valid</p>
                        </div>
                    </div>

                    <div>
                        <label for="subject" class="block text-gray-700 font-medium mb-2">Subjek</label>
                        <input type="text" id="subject" x-model="form.comment_subject" class="w-full px-4 py-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-pumpkin-500">
                    </div>

                    <div>
                        <label for="url" class="block text-gray-700 font-medium mb-2">URL (Opsional)</label>
                        <input type="url" id="url" x-model="form.comment_url" class="w-full px-4 py-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-pumpkin-500">
                    </div>

                    <div>
                        <label for="message" class="block text-gray-700 font-medium mb-2">Pesan</label>
                        <textarea id="message" x-model="form.comment_content" rows="5" class="w-full px-4 py-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-pumpkin-500"></textarea>
                        <p x-text="formErrors.comment_content" class="text-red-500 text-sm mt-1">Pesan wajib diisi</p>
                    </div>

                    <button type="submit" class="bg-pumpkin-600 text-white px-6 py-3 rounded-md font-medium hover:bg-pumpkin-700 transition w-full">
                        Kirim Pesan
                    </button>
                </form>
                <div x-show="successMessage" x-transition class="p-4 flex items-center space-x-3 text-green-700 bg-green-100 border border-green-300 rounded-md">

                    <svg class="w-24 h-24" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                    </svg>
                    <p x-text="successMessage"></p>
                </div>
            </div>

            <!-- Map -->
            <div>
                <h2 class="text-2xl font-bold text-pumpkin-800 mb-6">Lokasi Kami</h2>
                <div class="map-container relative shadow-lg rounded-lg overflow-hidden">
                    <iframe class="w-full h-96 border-0"
                        loading="lazy" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3953.3703213789295!2d110.37239887588585!3d-7.75048867684847!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e7a599a1fab85ff%3A0x18a4aaeea7cf1026!2sSMP%20Islam%20Al%20Azhar%2026%20Yogyakarta!5e0!3m2!1sid!2sid!4v1754240266251!5m2!1sid!2sid" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>


                    <div class="absolute bottom-0 left-0 w-full h-full bg-black bg-opacity-75 p-4 text-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 text-white mx-auto mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                        <h3 class="text-xl font-semibold text-white mb-2">
                            <?= session('nama_perpus') ?><br><?= session('school_name') ?>
                        </h3>
                        <p class="text-white">
                            <?= session('street_address') ?>,
                            <?= session('village') ?>,
                            <?= session('sub_district') ?>,
                            Kab. <?= session('district') ?> <?= session('postal_code') ?>
                        </p>
                        <div class="mt-4">
                            <a href="https://maps.app.goo.gl/WsvxHVhN4JkibG6D9"
                                target="_blank"
                                class="inline-flex items-center text-white hover:text-pumpkin-800">
                                <span>Buka di Google Maps</span>
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="mt-8 bg-pumpkin-50 p-6 rounded-lg border border-pumpkin-100">
                    <h3 class="text-lg font-semibold text-pumpkin-800 mb-3">Jam Operasional</h3>
                    <ul class="space-y-2 text-gray-700">
                        <li class="flex justify-between">
                            <span>Senin - Jumat</span>
                            <span class="font-medium">07:00 - 16:00</span>
                        </li>
                        <li class="flex justify-between">
                            <span>Sabtu</span>
                            <span class="font-medium">08:00 - 13:00</span>
                        </li>

                        <li class="flex justify-between text-red-600">
                            <span>Minggu & Hari Libur Nasional</span>
                            <span class="font-medium">Tutup</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- FAQ Section -->
<section class="py-16 bg-white">
    <div class="container mx-auto px-4">
        <h2 class="text-3xl font-bold text-pumpkin-800 text-center mb-12">Pertanyaan yang Sering Diajukan</h2>
        <div class="max-w-3xl mx-auto space-y-6">
            <div class="bg-pumpkin-50 rounded-lg overflow-hidden shadow-md">
                <button class="faq-toggle w-full flex justify-between items-center p-5 text-left focus:outline-none" onclick="toggleFAQ(this)">
                    <span class="font-medium text-pumpkin-800">Bagaimana cara menjadi anggota perpustakaan?</span>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-pumpkin-600 transform transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </button>
                <div class="faq-content hidden px-5 pb-5 text-gray-600">
                    <p>Untuk menjadi anggota perpustakaan, Anda perlu mengisi formulir pendaftaran yang tersedia di meja informasi atau melalui website kami. Sertakan kartu identitas (KTP/SIM/Kartu Pelajar) dan foto terbaru. Setelah diverifikasi, kartu anggota akan diterbitkan dalam 1-2 hari kerja.</p>
                </div>
            </div>

            <div class="bg-pumpkin-50 rounded-lg overflow-hidden shadow-md">
                <button class="faq-toggle w-full flex justify-between items-center p-5 text-left focus:outline-none" onclick="toggleFAQ(this)">
                    <span class="font-medium text-pumpkin-800">Berapa lama masa peminjaman buku?</span>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-pumpkin-600 transform transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </button>
                <div class="faq-content hidden px-5 pb-5 text-gray-600">
                    <p>Masa peminjaman buku standar adalah 14 hari. Anda dapat memperpanjang masa peminjaman sebanyak dua kali, masing-masing untuk 7 hari, selama tidak ada anggota lain yang memesan buku tersebut.</p>
                </div>
            </div>

            <div class="bg-pumpkin-50 rounded-lg overflow-hidden shadow-md">
                <button class="faq-toggle w-full flex justify-between items-center p-5 text-left focus:outline-none" onclick="toggleFAQ(this)">
                    <span class="font-medium text-pumpkin-800">Apakah perpustakaan menyediakan akses e-book?</span>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-pumpkin-600 transform transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </button>
                <div class="faq-content hidden px-5 pb-5 text-gray-600">
                    <p>Ya, perpustakaan kami menyediakan akses ke ribuan e-book dan jurnal elektronik. Anggota perpustakaan dapat mengakses koleksi digital kami melalui portal online dengan menggunakan ID anggota dan kata sandi yang diberikan saat pendaftaran.</p>
                </div>
            </div>

            <div class="bg-pumpkin-50 rounded-lg overflow-hidden shadow-md">
                <button class="faq-toggle w-full flex justify-between items-center p-5 text-left focus:outline-none" onclick="toggleFAQ(this)">
                    <span class="font-medium text-pumpkin-800">Bagaimana cara memesan ruang diskusi?</span>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-pumpkin-600 transform transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </button>
                <div class="faq-content hidden px-5 pb-5 text-gray-600">
                    <p>Ruang diskusi dapat dipesan melalui sistem reservasi online di website kami atau langsung di meja informasi. Pemesanan dapat dilakukan hingga 2 minggu sebelumnya. Setiap anggota dapat memesan ruang diskusi selama maksimal 2 jam per hari.</p>
                </div>
            </div>
        </div>
    </div>
</section>
<script>
    // Toggle FAQ
    function toggleFAQ(element) {
        const content = element.nextElementSibling;
        const icon = element.querySelector('svg');

        if (content.classList.contains('hidden')) {
            content.classList.remove('hidden');
            icon.classList.add('rotate-180');
        } else {
            content.classList.add('hidden');
            icon.classList.remove('rotate-180');
        }
    }
</script>
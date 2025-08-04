<!-- Contact Section -->
<section id="contact" class="py-16">
    <div class="container mx-auto px-4">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-bold text-gray-800 mb-4">Hubungi Kami</h2>
            <p class="text-gray-600 max-w-2xl mx-auto">Ada pertanyaan atau saran? Jangan ragu untuk menghubungi kami</p>
        </div>

        <div class="flex flex-col md:flex-row gap-12">
            <div class="md:w-1/2 " x-data="formMessage">
                <div class="bg-white p-8 rounded-lg shadow-md h-full">
                    <form x-show="formVisible" x-transition @submit.prevent="submitComment" class="space-y-6">
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
            </div>
            <div class="md:w-1/2">
                <div class="bg-white p-8 rounded-lg shadow-md h-full">
                    <h3 class="text-xl font-bold text-gray-800 mb-6">Informasi Kontak</h3>
                    <div class="space-y-6">
                        <div class="flex items-start">
                            <div class="bg-pumpkin-100 p-3 rounded-full mr-4">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-pumpkin-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                            </div>
                            <div>
                                <h4 class="font-medium text-gray-800 mb-1">Alamat</h4>
                                <p class="text-gray-600"><?= session('street_address') ?>, <?= session('village') ?>, <?= session('sub_district') ?>, Kab. <?= session('district') ?> <?= session('postal_code') ?></p>
                            </div>
                        </div>
                        <div class="flex items-start">
                            <div class="bg-pumpkin-100 p-3 rounded-full mr-4">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-pumpkin-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                </svg>
                            </div>
                            <div>
                                <h4 class="font-medium text-gray-800 mb-1">Telepon</h4>
                                <p class="text-gray-600"><?= session('phone') ?></p>
                            </div>
                        </div>
                        <div class="flex items-start">
                            <div class="bg-pumpkin-100 p-3 rounded-full mr-4">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-pumpkin-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                </svg>
                            </div>
                            <div>
                                <h4 class="font-medium text-gray-800 mb-1">Email</h4>
                                <p class="text-gray-600"><?= session('email') ?></p>
                            </div>
                        </div>
                        <div class="flex items-start">
                            <div class="bg-pumpkin-100 p-3 rounded-full mr-4">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-pumpkin-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <div>
                                <h4 class="font-medium text-gray-800 mb-1">Jam Operasional</h4>
                                <p class="text-gray-600">Senin - Jumat: 07.00 - 16.00 WIB</p>
                                <p class="text-gray-600">Sabtu: 08.00 - 13.00 WIB</p>
                            </div>
                        </div>
                    </div>
                    <div class="mt-8">
                        <h4 class="font-medium text-gray-800 mb-4">Ikuti Kami</h4>
                        <div class="flex space-x-4">
                            <a href="<?= session('facebook') ?>" class="bg-pumpkin-100 p-3 rounded-full text-pumpkin-600 hover:bg-pumpkin-200 transition">
                                <span class="bi bi-facebook"></span>
                            </a>
                            <a href="<?= session('instagram') ?>" class="bg-pumpkin-100 p-3 rounded-full text-pumpkin-600 hover:bg-pumpkin-200 transition">
                                <span class="bi bi-instagram"></span>
                            </a>
                            <a href="<?= session('twitter') ?>" class="bg-pumpkin-100 p-3 rounded-full text-pumpkin-600 hover:bg-pumpkin-200 transition">
                                <span class="bi bi-twitter"></span>
                            </a>
                            <a href="<?= session('youtube') ?>" class="bg-pumpkin-100 p-3 rounded-full text-pumpkin-600 hover:bg-pumpkin-200 transition">
                                <span class="bi bi-youtube"></span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
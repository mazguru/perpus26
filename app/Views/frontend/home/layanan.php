<style>
    .gradient-bg {
        background: linear-gradient(135deg, #2563eb, #1e40af);
    }
</style>
<!-- Membership Section -->
<section id="membership" class="py-16 gradient-bg text-white">
    <div class="container mx-auto px-4">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-bold mb-4">Layanan dan Program</h2>
            <p class="max-w-2xl mx-auto text-blue-100">Melalui layanan dan program ini, perpustakaan menjadi pusat belajar yang dinamis, inovatif, dan berperan aktif dalam membentuk generasi literat dan kreatif.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <!-- Basic Plan -->
            <div class="bg-white rounded-lg overflow-hidden shadow-lg text-gray-800 transition-transform hover:-translate-y-2 duration-300">
                <div class="p-6 bg-gray-50">
                    <h3 class="text-xl font-bold mb-2">Layanan Perpustakaan</h3>
                    <p class="text-gray-600 text-sm">Pada tahun 2025, perpustakaan SMP Islam Al Azhar 26 Yogyakarta merancang kegiatan layan perpustakaan yang ditujukan kepada pemustaka</p>
                </div>
                <div class="p-6">
                    <?php
                    $layanan = [
                        'Layanan Baca di Tempat',
                        'Layanan Sirkulasi',
                        'Layanan Referensi',
                        'Layanan Penelusuran Informasi',
                        'Layanan Silang Layan',
                        'Layanan Bimbingan Literasi Informasi',
                    ];
                    ?>

                    <ul class="space-y-2 mb-2">
                        <?php foreach ($layanan as $item): ?>
                            <li class="flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-green-500 mr-2" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                                </svg>
                                <span><?= esc($item) ?></span>
                            </li>
                        <?php endforeach; ?>
                    </ul>

                </div>
                <div class="w-full mt-4 px-4">
                    <button @click="window.location.href= _BASEURL +'page/layanan-perpustakaan'" class="w-full bg-blue-600 text-white font-medium py-2 rounded-lg hover:bg-blue-700 transition">Selengkapnya</button>
                </div>
            </div>

            <!-- Standard Plan -->
            <div class="bg-white rounded-lg overflow-hidden shadow-lg text-gray-800 transform scale-105 z-10">
                <div class="p-6 bg-blue-600 text-white">
                    <div class="flex justify-between items-center mb-2">
                        <h3 class="text-xl font-bold">PROGRAM PERPUSTAKAAN</h3>
                    </div>
                    <p class="text-blue-100 text-sm">Great for regular library users.</p>
                </div>
                <div class="p-2">
                    <?php
                    $kegiatan = [
                        [
                            'judul' => 'Gerakan Literasi Sekolah',
                            'deskripsi' => 'Dilaksanakan setiap minggu pada hari P5 untuk meningkatkan minat baca siswa. Kegiatan meliputi membaca bersama, game, menggambar, resensi, dan lainnya, didampingi guru/pustakawan. Hasil kegiatan diharapkan menjadi karya literasi yang diinventaris perpustakaan.',
                            'icon' => 'book-open',
                        ],
                        [
                            'judul' => 'Lomba Pojok Literasi',
                            'deskripsi' => 'Siswa menghias pojok literasi dengan membawa buku dari rumah. Pojok akan dinilai saat Bulan Bahasa. Tujuannya untuk mendorong siswa saling bertukar buku dan memperluas bacaan.',
                            'icon' => 'sparkles',
                        ],
                        [
                            'judul' => 'Pengadaan Koleksi Baru',
                            'deskripsi' => 'Meningkatkan akses buku digital bagi warga sekolah melalui komputer PSB atau perangkat pribadi.',
                            'icon' => 'cloud-download',
                        ],
                        [
                            'judul' => 'Studi Banding Perpustakaan',
                            'deskripsi' => 'Dilaksanakan dua kali setahun untuk belajar dari perpustakaan sekolah terbaik di DIY guna pengembangan layanan perpustakaan.',
                            'icon' => 'academic-cap',
                        ],
                    ];
                    ?>

                    <div class="grid md:grid-cols-2 lg:grid-cols-2 gap-6">
                        <?php foreach ($kegiatan as $item): ?>
                            <div class="bg-white rounded-lg overflow-hidden shadow-lg text-gray-800 transition-transform hover:-translate-y-2 duration-300">
                                <div class="p-6 bg-gray-50 text-center">
                                    <!-- Ikon besar -->
                                    <div class="flex justify-center mb-4">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-blue-600" viewBox="0 0 24 24" fill="currentColor">
                                            <?php switch ($item['icon']):
                                                case 'book-open': ?>
                                                    <path d="M12 6a2 2 0 00-2-2H4a2 2 0 00-2 2v10a2 2 0 002 2h6a2 2 0 002-2h0a2 2 0 002 2h6a2 2 0 002-2V6a2 2 0 00-2-2h-6a2 2 0 00-2 2z" />
                                                    <?php break; ?>
                                                <?php
                                                case 'sparkles': ?>
                                                    <path d="M5 3L3 8l5-2 2-5L5 3zm14 4l2 5-5-2-2-5 5 2zm-6 6l-3 7-3-7h6z" />
                                                    <?php break; ?>
                                                <?php
                                                case 'cloud-download': ?>
                                                    <path d="M12 2a6 6 0 00-6 6v2H5a3 3 0 000 6h14a3 3 0 000-6h-1V8a6 6 0 00-6-6zm0 10v4m0 0l-2-2m2 2l2-2" />
                                                    <?php break; ?>
                                                <?php
                                                case 'academic-cap': ?>
                                                    <path d="M12 14L2 9l10-5 10 5-10 5zm0 0v6m0 0l-3-3m3 3l3-3" />
                                                    <?php break; ?>
                                            <?php endswitch; ?>
                                        </svg>
                                    </div>
                                    <h3 class="text-md font-bold mb-2"><?= esc($item['judul']) ?></h3>

                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                    <div class="w-full mt-4">
                        <button @click="window.location.href= _BASEURL +'page/program-perpustakaan'" class="w-full bg-blue-600 text-white font-medium py-2 rounded-lg hover:bg-blue-700 transition">Selengkapnya</button>
                    </div>
                </div>
            </div>

            <!-- Premium Plan -->
            <div class="bg-white rounded-lg overflow-hidden shadow-lg text-gray-800 transition-transform hover:-translate-y-2 duration-300">

                <div class="py-6 px-4 bg-gray-50">


                    <h3 class="text-xl font-bold mb-2">Layanan Referensi</h3>
                    <p class="text-gray-600 text-sm">4 jenis layanan referensi yang dapat dimanfaatkan oleh pemustaka.</p>

                </div>
                <div class="p-6">
                    <?php
                    $lp = [
                        'Layanan meja informasi (reference desk)',
                        'Layanan penelusuran',
                        'Layanan bimbingan penggunaan koleksi referensi',
                        'Layanan kesiagaan informasi',
                    ];
                    ?>

                    <ul class="space-y-2 mb-2">
                        <?php foreach ($lp as $item): ?>
                            <li class="flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-green-500 mr-2" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                                </svg>
                                <span><?= esc($item) ?></span>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
                <div class="w-full px-4 mt-4">
                <button @click="window.location.href= _BASEURL +'page/layanan-referensi'" class="w-full px-4 bg-blue-600 text-white font-medium py-2 rounded-lg hover:bg-blue-700 transition">Selengkapnya</button>
                </div>
            </div>
        </div>
    </div>
</section>
<footer class="bg-[#1a1a1a] text-white">
    <div class="max-w-7xl mx-auto px-6 py-10 grid grid-cols-1 md:grid-cols-4 gap-10 text-sm relative z-10">
        <!-- About Us -->
        <div>
            <div class="mb-4">
                <h2 class="text-lg font-semibold mb-2 border-b border-pumpkin-500">About Us</h2>
                <p class="text-gray-300 leading-relaxed">
                    <?=session('meta_description')?>
                </p>
            </div>
            <div class="flex space-x-3 mt-4">
                <a class="p-2 border rounded-md hover:bg-pumpkin-200" href="<?= session('facebook') ?>" title="Facebook"><i class="bi bi-facebook" aria-hidden="true"></i></a>
                <a class="p-2 border rounded-md hover:bg-pumpkin-200" href="<?= session('twitter') ?>" title="Twitter"><i class="bi bi-twitter" aria-hidden="true"></i></a>
                <a class="p-2 border rounded-md hover:bg-pumpkin-200" href="<?= session('instagram') ?>" title="Instagram"><i class="bi bi-instagram"></i></a>
                <a class="p-2 border rounded-md hover:bg-pumpkin-200" href="<?= session('youtube') ?>" title="Instagram"><i class="bi bi-youtube" aria-hidden="true"></i></a>
            </div>
        </div>

        <!-- Our Links -->
        <div>
            <h2 class="text-lg font-semibold mb-4 border-b border-pumpkin-500 inline-block pb-1">Jam Buka Layanan</h2>
            <div class="space-y-2 text-gray-300">
                <p>Senin - Jum'at : 07.00 - 16.00 WIB</p>
                <p>Sabtu : 08.00 - 13.00 WIB</p>
                <p>Istirahat : 12.01 - 13.00</p>
            </div>
        </div>

        <!-- Contact Us -->
        <div>
            <h2 class="text-lg font-semibold mb-4 border-b border-pumpkin-500 inline-block pb-1">Contact Us</h2>
            <div class="space-y-2 text-gray-300">
                <div class="flex items-start space-x-2">
                    <span class="bi bi-geo-alt text-pumpkin-400"></span>
                    <span>Jl. Padjajaran, Sumberan, Mlati, Sleman 55284</span>
                </div>
                <div class="flex items-start space-x-2">
                    <span class="bi bi-envelope"></span>
                    <span><?= session('email')?></span>
                </div>
                <div class="flex items-start space-x-2">
                    <span class="bi bi-whatsapp"></span>
                    <div>
                        <p>Bu Ruri : +62 856-2630-023</p>
                        <p>Bu Afifah : +62 877-8477-0063</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Statistik Kunjungan -->
        <div x-data="visitSummary()" x-init="loadSummary()">
            <h2 class="text-lg font-semibold mb-4 border-b border-pumpkin-500 inline-block pb-1">Statistik Pengunjung</h2>
            <div class="space-y-2 text-gray-300 text-sm">
                <p>Pengunjung Hari Ini : <span class="font-bold" x-text="today"></span></p>
                <p>Pengunjung Bulan Ini : <span class="font-bold" x-text="month"></span></p>
                <p>Pengunjung Tahun Ini : <span class="font-bold" x-text="year"></span></p>
                <p>Total Pengunjung : <span class="font-bold" x-text="total"></span></p>
            </div>
        </div>
    </div>

    <!-- Copyright -->
    <div class="bg-[#111111] py-4 text-center text-gray-400 text-sm">
        Copyright © 2022 - 2025 ❤️
        <a href="<?=base_url()?>" class="text-pumpkin-400 hover:underline">Perpustakaan Adyatama</a>. All rights reserved.
        Dev by <a href="https://www.sinmat.my.id" class="text-pumpkin-400 hover:underline">Sinau Matematika V.1</a> - ICT Team.
    </div>
</footer>
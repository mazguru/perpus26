<section id="berita" class="bg-white py-16">
    <div class="max-w-screen-xl mx-auto px-4">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-bold text-gray-800 mb-2">Berita Terbaru</h2>
            <div class="w-24 h-1 bg-indigo-600 mx-auto mb-4"></div>
            <p class="text-gray-600 max-w-2xl mx-auto">Ikuti perkembangan terbaru dari perpustakaan kami, termasuk acara, koleksi baru, dan informasi penting lainnya.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <!-- Berita 1 -->
            <?php
            if (! empty($postquery)) {
                foreach ($postquery as $berita) {
            ?>
                    <div class="news-card bg-white rounded-lg overflow-hidden shadow-md transition duration-300">
                        <div class="relative overflow-hidden">
                            <a href="/post/<?= $berita['post_slug'] ?>">
                                <?php if ($berita['post_image']): ?>
                                    <img
                                        src="<?= base_url() ?>/media_library/posts/thumbs/<?= $berita['post_image'] ?>"
                                        class="w-full transition delay-150 duration-300 ease-in-out aspect-[16/9] object-cover mb-2 hover:scale-110"
                                        alt="<?= $berita['post_title'] ?>"
                                        loading="lazy"
                                        onerror="this.onerror=null; this.src='<?= base_url('assets/images/noimage.svg') ?>'">
                                <?php else : ?>
                                    <div class="aspect-[16/9] object-cover">
                                        <svg class="w-full h-full bg-gray dark:bg-boxdark text-gray-300 p-2" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" fill="currentColor" viewBox="0 0 640 512">
                                            <path d="M480 80C480 35.82 515.8 0 560 0C604.2 0 640 35.82 640 80C640 124.2 604.2 160 560 160C515.8 160 480 124.2 480 80zM0 456.1C0 445.6 2.964 435.3 8.551 426.4L225.3 81.01C231.9 70.42 243.5 64 256 64C268.5 64 280.1 70.42 286.8 81.01L412.7 281.7L460.9 202.7C464.1 196.1 472.2 192 480 192C487.8 192 495 196.1 499.1 202.7L631.1 419.1C636.9 428.6 640 439.7 640 450.9C640 484.6 612.6 512 578.9 512H55.91C25.03 512 .0006 486.1 .0006 456.1L0 456.1z"></path>
                                        </svg>
                                    </div>
                                <?php endif ?>
                            </a>
                            <div class="bg-primary text-white py-1.5 px-3 rounded absolute top-2.5 left-2.5 text-sm"><?= esc($berita['category_name']) ?></div>
                        </div>

                        <div class="p-6">
                            <span class="text-xs font-semibold text-indigo-600 uppercase tracking-wider">Acara</span>
                            <h3 class="text-xl font-semibold text-gray-800 mt-2"><?= esc($berita['post_title']) ?></h3>
                            <p class="text-gray-600 mt-3"><?= strip_tags_truncate($berita['post_content']) ?></p>
                            <div class="mt-4 flex items-center">
                                <span class="text-sm text-gray-500">12 Mei 2023</span>
                                <a href="/post/<?= $berita['post_slug'] ?>" class="ml-auto text-indigo-600 hover:text-indigo-800 font-medium">Baca selengkapnya</a>
                            </div>
                        </div>
                    </div>

            <?php }
            } ?>


        </div>


        <div class="text-center mt-10">
            <a href="<?= base_url('categories/berita')?>" class="inline-block bg-indigo-50 hover:bg-indigo-100 text-indigo-600 font-medium py-3 px-6 rounded-lg transition duration-300">Lihat Semua Berita</a>
        </div>
    </div>
</section>

<section class="bg-gray-50 py-16">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="grid md:grid-cols-2 gap-12">
      
      <!-- Info Sekolah -->
      <div>
        <h2 class="text-2xl font-semibold text-slate-800">Info Sekolah</h2>
        <h3 class="text-lg font-bold text-sky-600 mt-1 border-l-4 border-sky-600 pl-4">
          Agenda & Pengumuman
        </h3>

        <div class="mt-6 space-y-6">
          <!-- Card 1 -->
          <div class="bg-white p-6 rounded-2xl shadow-md">
            <div class="text-sm text-sky-600 font-semibold flex items-center gap-2 mb-2">
              <!-- Icon -->
              <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3M16 7V3M4 11h16M4 19h16M4 15h16" />
              </svg>
              Pengumuman
            </div>
            <h4 class="text-base font-bold leading-snug mb-1">
              PENGUMUMAN KELULUSAN SMKN 1 TEMON TAHUN PELAJARAN 2024/2025
            </h4>
            <p class="text-sm text-gray-700 line-clamp-2 mb-3">
              Berdasarkan Hasil Rapat Pleno Dewan Guru SMK……
            </p>
            <a href="#" class="text-sm font-medium text-sky-600 inline-flex items-center">
              READ MORE
              <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
              </svg>
            </a>
          </div>

          <!-- Card 2 -->
          <div class="bg-white p-6 rounded-2xl shadow-md">
            <div class="text-sm text-sky-600 font-semibold flex items-center gap-2 mb-2">
              <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3M16 7V3M4 11h16M4 19h16M4 15h16" />
              </svg>
              Pengumuman
            </div>
            <h4 class="text-base font-bold leading-snug mb-1">
              Edaran Pelaksanaan Pembelajaran Selama Ramadan
            </h4>
            <p class="text-sm text-gray-700 line-clamp-2 mb-3">
              Berdasarkan surat edaran Kepala Dinas Pemuda dan……
            </p>
            <a href="#" class="text-sm font-medium text-sky-600 inline-flex items-center">
              READ MORE
              <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
              </svg>
            </a>
          </div>

          <!-- Card 3 -->
          <div class="bg-white p-6 rounded-2xl shadow-md">
            <div class="text-sm text-sky-600 font-semibold flex items-center gap-2 mb-2">
              <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3M16 7V3M4 11h16M4 19h16M4 15h16" />
              </svg>
              Agenda
            </div>
            <h4 class="text-base font-bold leading-snug mb-1">
              Ujian Sekolah SMKN 1 Temon TA 2023/2024
            </h4>
            <p class="text-sm text-gray-700 line-clamp-2 mb-3">
              Tdk terasa sudah hampir 3...
            </p>
            <a href="#" class="text-sm font-medium text-sky-600 inline-flex items-center">
              READ MORE
              <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
              </svg>
            </a>
          </div>
        </div>
      </div>

      <!-- Konten Edukasi -->
      <div>
        <h2 class="text-2xl font-semibold text-slate-800">Konten Edukasi</h2>
        <h3 class="text-lg font-bold text-sky-600 mt-1 border-l-4 border-sky-600 pl-4">
          Artikel & Jurnal Pendidikan
        </h3>

        <div class="mt-6 space-y-6">
          <!-- Artikel 1 -->
          <div class="flex items-start gap-4">
            <img src="https://via.placeholder.com/100x100.png?text=IMG1" alt="thumb" class="w-24 h-24 object-cover rounded-lg shrink-0" />
            <div>
              <h4 class="text-base font-semibold leading-tight">
                Apel Pagi Taruna Taruni SMK Negeri 1 Temon, Persiapan Menjelang Ujian Kenaikan Tingkat
              </h4>
              <p class="text-sm text-gray-700 mt-1 line-clamp-2">
                Temon, 19 Juni 2025 – Pada hari Kamis sekitar pukul 07.00 WIB...
              </p>
              <a href="#" class="mt-2 inline-flex items-center text-sm font-semibold text-sky-600">
                selengkapnya
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
              </a>
            </div>
          </div>

          <!-- Artikel 2 -->
          <div class="flex items-start gap-4">
            <img src="https://via.placeholder.com/100x100.png?text=IMG2" alt="thumb" class="w-24 h-24 object-cover rounded-lg shrink-0" />
            <div>
              <h4 class="text-base font-semibold leading-tight">
                Bangkit Bersama, Wujudkan Indonesia Kuat: Peran Kritis Generasi Muda SMKN 1 Temon
              </h4>
              <p class="text-sm text-gray-700 mt-1 line-clamp-2">
                Hari Kebangkitan Nasional, yang kita peringati setiap tanggal 20 Mei...
              </p>
              <a href="#" class="mt-2 inline-flex items-center text-sm font-semibold text-sky-600">
                selengkapnya
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

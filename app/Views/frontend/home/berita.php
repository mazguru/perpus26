<section id="berita" class="bg-white py-16">
  <div class="max-w-screen-xl mx-auto px-4">
    <div class="text-center mb-12">
      <h2 class="text-3xl font-bold text-gray-800 mb-2">Latest Post</h2>
      <div class="w-24 h-1 bg-pumpkin-600 mx-auto mb-4"></div>
      <p class="text-gray-600 max-w-2xl mx-auto">Ikuti perkembangan terbaru dari perpustakaan kami, termasuk acara, koleksi baru, dan informasi penting lainnya.</p>
    </div>
    <?php
    $postquery = get_latest_posts(6);
    if (! empty($postquery)) { ?>
      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        <!-- Berita 1 -->

        <?php foreach ($postquery as $berita) {
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
                    <div class="bg-pumpkin-200 h-48 flex items-center justify-center">
                      <svg xmlns="http://www.w3.org/2000/svg" class="h-20 w-20 text-pumpkin-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                      </svg>
                    </div>
                  </div>
                <?php endif ?>
              </a>
              <div class="bg-primary text-white py-1.5 px-3 rounded absolute top-2.5 left-2.5 text-sm"><?= esc($berita['category_name']) ?></div>
            </div>

            <div class="px-6 pb-6">
              <h3 class="text-xl font-semibold text-gray-800 mt-2"><?= esc($berita['post_title']) ?></h3>
              <p class="text-gray-600 mt-3"><?= strip_tags_truncate($berita['post_content']) ?></p>
              <div class="mt-4 flex items-center">
                <span class="text-sm text-gray-500"><?= _date($berita['created_at']) ?></span>
                <a href="/post/<?= $berita['post_slug'] ?>" class="ml-auto text-pumpkin-600 hover:text-pumpkin-800  font-medium">Baca selengkapnya</a>
              </div>
            </div>
          </div>


        <?php } ?>

      </div>
      <div class="text-center mt-10">
        <a href="<?= base_url('categories/berita') ?>" class="inline-block bg-pumpkin-50 hover:bg-pumpkin-100 text-pumpkin-600 font-medium py-3 px-6 rounded-lg transition duration-300 border border-pumpkin-200">Lihat Semua Berita</a>
      </div>
    <?php } else { ?>
      <p class="text-center text-gray-500">Belum ada berita tersedia.</p>
    <?php } ?>



  </div>
</section>

<section class="bg-abbey-50 py-16">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="grid md:grid-cols-2 gap-12">

      <!-- Info Sekolah -->
      <div>
        <h2 class="text-2xl font-semibold text-slate-800">Info Perpustakaan</h2>
        <h3 class="text-lg font-bold text-pumpkin-600 mt-1 border-l-4 border-pumpkin-600 pl-4">
          Agenda & Pengumuman
        </h3>


        <div class="mt-6 space-y-6">
          <?php $pengumuman = get_post_categories('pengumuman', 2);
          if (! empty($pengumuman)) { ?>
            <?php foreach ($pengumuman as $row) { ?>
              <div class="bg-white rounded-lg overflow-hidden shadow-md p-6 flex flex-col md:flex-row">
                <div class="md:w-1/4 mb-4 md:mb-0 flex flex-col items-center justify-center bg-pumpkin-100 rounded-lg p-4 md:mr-6">
                  <span class="text-3xl font-bold text-pumpkin-600"><?= date('j', strtotime($row['created_at'])) ?></span>
                  <span class="text-pumpkin-600 font-medium"><?= date('F', strtotime($row['created_at'])) ?></span>
                  <span class="text-pumpkin-600"><?= date('Y', strtotime($row['created_at'])) ?></span>
                </div>
                <div class="md:w-3/4">
                  <h3 class="text-xl font-bold text-gray-800 mb-2"><?= $row['post_title'] ?></h3>
                  <p class="text-gray-600 text-sm mb-4"><?= strip_tags_truncate($row['post_content']) ?></p>

                  <div class="flex justify-between items-center">
                    <span class="text-xs font-medium text-green-600 bg-green-50 px-2 py-1 rounded">pengumuman</span>
                    <a href="<?= base_url('post/' . $row['post_slug']) ?>" class="text-pumpkin-600 border-pumpkin-200 hover:text-pumpkin-800 text-sm font-medium ">Selengkapnya</a>
                  </div>
                </div>
              </div>
            <?php } ?>

          <?php } ?>
          <?php $agenda = get_post_categories('agenda', 2);
          if (! empty($agenda)) { ?>
            <?php foreach ($agenda as $row) { ?>
              <div class="bg-white rounded-lg overflow-hidden shadow-md p-6 flex flex-col md:flex-row">
                <div class="md:w-1/4 mb-4 md:mb-0 flex flex-col items-center justify-center bg-pumpkin-100 rounded-lg p-4 md:mr-6">
                  <span class="text-3xl font-bold text-pumpkin-600"><?= date('j', strtotime($row['created_at'])) ?></span>
                  <span class="text-pumpkin-600 font-medium"><?= date('F', strtotime($row['created_at'])) ?></span>
                  <span class="text-pumpkin-600"><?= date('Y', strtotime($row['created_at'])) ?></span>
                </div>
                <div class="md:w-3/4">
                  <h3 class="text-xl font-bold text-gray-800 mb-2"><?= $row['post_title'] ?></h3>
                  <p class="text-gray-600 text-sm mb-4"><?= strip_tags_truncate($row['post_content']) ?></p>

                  <div class="flex justify-between items-center">
                    <span class="text-xs font-medium text-amber-600 bg-amber-50 px-2 py-1 rounded">agenda</span>
                    <a href="<?= base_url('post/' . $row['post_slug']) ?>" class="text-pumpkin-600 hover:text-pumpkin-800 text-sm font-medium border border-pumpkin-200">Selengkapnya</a>
                  </div>
                </div>
              </div>
            <?php } ?>

          <?php } ?>
        </div>
        <div class="text-center mt-10">
          <a href="<?= base_url('categories/pengumuman') ?>" class="inline-block bg-pumpkin-50 border border-pumpkin-200 hover:bg-pumpkin-100 text-pumpkin-600 font-medium py-3 px-6 rounded-lg transition duration-300">Lihat Semua Pengumuman</a>
        </div>
      </div>

      <!-- Konten Edukasi -->
      <div>
        <h2 class="text-2xl font-semibold text-slate-800">Konten Edukasi</h2>
        <h3 class="text-lg font-bold text-pumpkin-600 mt-1 border-l-4 border-pumpkin-600 pl-4">
          Artikel & Jurnal Pendidikan
        </h3>
        <?php $jurnal = get_post_categories('artikel', 5);
        if (! empty($jurnal)) { ?>

          <div class="mt-6 space-y-6">
            <!-- Artikel 1 -->
            <?php foreach ($jurnal as $row) { ?>

              <div class="bg-white shadow p-2 flex items-start gap-4">
                <a href="<?= base_url('post/' . $row['post_slug']) ?>">
                  <?php if ($row['post_image']): ?>

                    <img
                      src="<?= base_url() ?>/media_library/posts/thumbs/<?= $row['post_image'] ?>"
                      class="h-24 object-cover rounded-lg shrink-0 transition delay-150 duration-300 ease-in-out mb-2 hover:scale-110"
                      alt="<?= $row['post_title'] ?>"
                      loading="lazy"
                      onerror="this.onerror=null; this.src='<?= base_url('assets/images/noimage.svg') ?>'">

                  <?php else : ?>
                    <div class="h-24 flex items-center justify-center object-cover rounded shrink-0 transition delay-150 duration-300 ease-in-out mb-2 hover:scale-110">
                      <svg xmlns="http://www.w3.org/2000/svg" class="h-24 w-24 text-pumpkin-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                      </svg>
                    </div>
                  <?php endif ?>
                </a>
                <div>
                  <h4 class="text-base font-semibold leading-tight">
                    <?= $row['post_title'] ?>
                  </h4>
                  <p class="text-sm text-gray-700 mt-1 line-clamp-2">
                    <?= strip_tags_truncate($row['post_content'], 100) ?>
                  </p>
                  <a href="<?= base_url('post/' . $row['post_slug']) ?>" class="mt-2 inline-flex items-center text-sm font-semibold text-pumpkin-600">
                    selengkapnya
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                  </a>
                </div>
              </div>
            <?php } ?>
          </div>
        <?php } ?>
        <div class="text-center mt-10">
              <a href="<?= base_url('categories/artikel') ?>" class="inline-block bg-pumpkin-50 hover:bg-pumpkin-100 text-pumpkin-600 font-medium py-3 px-6 rounded-lg transition duration-300 border border-pumpkin-200">Lihat Semua Jurnal</a>
            </div>
      </div>
    </div>
  </div>
</section>
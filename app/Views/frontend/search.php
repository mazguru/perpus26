<!-- Hero Section -->
<section class="hero-pattern2 text-white py-16">
  <div class="container mx-auto px-4">
    <div class="max-w-3xl mx-auto text-center">
      <h2 class="text-4xl font-bold mb-4">Jelajahi Dunia Pengetahuan</h2>
      <p class="text-lg mb-8">Temukan berbagai artikel, berita, jurnal, dan sumber belajar digital untuk menambah wawasan Anda</p>
      <form method="get" action="<?= site_url('search'); ?>" class="bg-white rounded-lg p-2 flex items-center shadow-lg">
        <input name="q" type="text" placeholder="Cari artikel berita atau informasi..." class="w-full px-4 py-2 outline-none text-gray-700" value=<?= esc($q) ?>>
        <button class="bg-blue-600 text-white px-6 py-2 rounded-md hover:bg-blue-700 transition">Cari</button>
      </form>
    </div>
  </div>
</section>
<!-- app/Views/search/index.php -->
<section class="max-w-3xl mx-auto p-4">
  <?php if (empty($q) && empty($results)): ?>
    <div class="text-center py-8">
      <img class="mx-auto" src="<?= base_url('assets/images/search-image.svg') ?>" alt="Searching..." width="200">
      <p class="my-4">Apa yang ingin kamu cari</p>
    </div>
  <?php elseif (! empty($results)): ?>
    <p class="text-sm mb-3">Hasil untuk: <strong><?= esc($q) ?></strong></p>
    <ul class="space-y-4">
      <?php foreach ($results as $row): ?>
        <li class="bg-white shadow border rounded p-4 flex items-start gap-4">
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
                <svg xmlns="http://www.w3.org/2000/svg" class="h-24 w-24 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                </svg>
              </div>
            <?php endif ?>
          </a>
          <div>
            <a href="<?= site_url('posts/' . $row['post_slug']); ?>" class="font-semibold hover:underline " >
              <?= esc($row['post_title']) ?>
            </a>
            <p class="text-sm mt-1"><?= strip_tags_truncate($row['post_content']) ?></p>
            <p class="text-xs mt-2 opacity-70">
              <?= esc(date('d M Y', strtotime($row['created_at']))) ?>
            </p>
          </div>
        </li>
      <?php endforeach; ?>
    </ul>

    <div class="mt-6">
      <?= $pager->makeLinks(
        $pager->getCurrentPage(),
        $pager->getPerPage(),
        $pager->getTotal(),
        'tw_full' // atau 'tw_simple'
      ) ?>

    </div>
  <?php else: ?>
    <div class="text-center py-8">
      <img class="mx-auto" src="<?= base_url('assets/images/search-image.svg') ?>" alt="Searching..." width="200">
      <p class="my-4">Tidak ditemukan untuk pencarian <strong><?= esc($q) ?></strong> coba dengan kata kunci lain!</p>
    </div>
  <?php endif; ?>
</section>
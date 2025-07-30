<div class="mb-12 text-center">
  <h2 class="text-4xl font-bold text-gray-800 mb-4">Latest Articles</h2>
  <p class="text-gray-600 max-w-2xl mx-auto">Discover our collection of insightful articles covering various topics from technology to lifestyle.</p>
</div>

<!-- CSRF (jika aktif di CI4) -->
<meta name="csrf-token-name" content="<?= esc(csrf_token()) ?>">
<meta name="csrf-token" content="<?= esc(csrf_hash()) ?>">

<div class="mx-auto max-w-6xl px-4 py-6">
  <!-- Header -->
  <div class="mb-6 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
    <h1 class="text-2xl font-semibold tracking-tight">Artikel</h1>

    <div class="flex items-center gap-2">
      <label class="text-sm">Kategori: <?= $title ?></label>
    </div>
  </div>
  <?php if (! empty($results)): ?>
    <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3">
      <?php foreach ($results as $row): ?>
        <article class="flex flex-col overflow-hidden rounded-xl border border-gray-200 bg-white shadow-sm">
          <div class="aspect-[16/9] w-full bg-gray-100">
            <img
              src="<?= base_url($row['post_image']) ?>"
              alt="<?= $row['post_title'] ?>"
              class="h-full w-full object-cover"
              loading="lazy"
              onerror="this.onerror=null; this.src='<?=base_url('assets/images/noimage.svg')?>'">
          </div>
          <div class="flex flex-1 flex-col p-4">
            <h3 class="line-clamp-2 text-lg font-semibold"><?= $row['post_title'] ?></h3>
            <p class="mt-1 text-xs text-gray-500">
              <span><?= $row['post_author'] ?></span>
              ·
              <span><?= date_indo($row['created_at']) ?></span>
            </p>
            <p class="mt-3 line-clamp-3 text-sm text-gray-700"><?= strip_tags_truncate($row['post_content']) ?></p>

            <div class="mt-auto pt-4">
              <a href="<?= base_url('post/'.$row['post_slug']) ?>"
                class="inline-flex items-center rounded-lg border border-indigo-200 bg-indigo-50 px-3 py-2 text-sm font-medium text-indigo-700 hover:bg-indigo-100">
                Baca selengkapnya
              </a>
            </div>
          </div>
        </article>
      <?php endforeach ?>
    </div>
    <div class="mt-6">
        <?= $pager->makeLinks(
          $pager->getCurrentPage(),
          $pager->getPerPage(),
          $pager->getTotal(),
          'tw_full' // atau 'tw_simple'
        ) ?>
      </div>
  <?php else : ?>
    <div class="rounded-xl border border-gray-200 bg-white p-8 text-center text-gray-600">
      Tidak ada artikel pada halaman ini.
    </div>
<?php endif ?>
</div>

<!-- CSRF (jika aktif di CI4) -->
<meta name="csrf-token-name" content="<?= esc(csrf_token()) ?>">
<meta name="csrf-token" content="<?= esc(csrf_hash()) ?>">

<div class="mx-auto max-w-6xl px-4 py-6">
  <!-- Header -->
  <div class="mb-6 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
    <h1 class="text-2xl font-semibold tracking-tight"><?= $title ?></h1>

    <div class="flex items-center gap-2">
      <label class="text-sm"><?= $title ?></label>
    </div>
  </div>
  <?php if (! empty($results)): ?>
    <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3">
      <?php foreach ($results as $row): ?>
        <article class="flex flex-col overflow-hidden rounded-xl border border-gray-200 bg-white shadow-sm">

          <a class="relative bg-saddle-200 flex items-center overflow-hidden aspect-[16/9] my-auto" href="<?= base_url('post/' . $row['post_slug']) ?>">
            <?php if ($row['post_image']): ?>
              <img
                src="<?= base_url() ?>/media_library/posts/thumbs/<?= $row['post_image'] ?>"
                class="w-full object-cover rounded-lg shrink-0 transition delay-150 duration-300 ease-in-out mb-2 hover:scale-110"
                alt="<?= $row['post_title'] ?>"
                loading="lazy"
                onerror="this.onerror=null; this.src='<?= base_url('assets/images/noimage.svg') ?>'">

            <?php else : ?>
              <div class="w-full  flex items-center justify-center object-cover rounded shrink-0 transition delay-150 duration-300 ease-in-out mb-2 hover:scale-110">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-24 w-24 text-pumpkin-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                </svg>
              </div>
            <?php endif ?>
          </a>

          <div class="flex flex-1 flex-col p-4">
            <h3 class="line-clamp-2 text-lg font-semibold"><?= $row['post_title'] ?></h3>
            <p class="mt-1 text-xs flex justify-between w-full text-gray-500">
              <span><i class="bi bi-person h-4 w-4 mr-1"></i><?= $row['post_author'] ?></span>
              <span><i class="bi bi-calendar h-4 w-4 mr-1"></i><?= date_indo($row['created_at']) ?></span>
            </p>

            <p class="mt-3 line-clamp-3 text-sm text-gray-700"><?= strip_tags_truncate($row['post_content']) ?></p>

            <div class="w-full flex justify-between mt-auto pt-4">
              <a href="<?= base_url('post/' . $row['post_slug']) ?>"
                class="inline-flex items-center rounded-lg border border-pumpkin-200 bg-pumpkin-50 px-3 py-2 text-sm font-medium text-pumpkin-700 hover:bg-pumpkin-100">
                Baca selengkapnya
              </a>
              <span class="text-xs text-gray-500">
                <i class="bi bi-eye h-4 w-4 mr-1"></i>
      Dibaca <?= number_format($row['post_counter'])?> kali
              </span>
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
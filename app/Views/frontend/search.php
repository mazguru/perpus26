<!-- app/Views/search/index.php -->
<section class="max-w-3xl mx-auto p-4">
  <form method="get" action="<?= site_url('search'); ?>" class="flex gap-2 mb-4" x-data="{q:'<?= esc($q) ?>'}">
    <input type="search" name="q" x-model="q" placeholder="Cari artikel…"
      class="flex-1 border rounded px-3 py-2" required>
    <button type="submit" class="px-4 py-2 border rounded">Cari</button>
  </form>

  <?php if (!empty($q)): ?>
    <p class="text-sm mb-3">Hasil untuk: <strong><?= esc($q) ?></strong></p>
  <?php endif; ?>

  <?php if (! empty($results)): ?>
    <ul class="space-y-4">
      <?php foreach ($results as $row): ?>
        <li class="border rounded p-4">
          <a href="<?= site_url('posts/' . $row['post_slug']); ?>" class="font-semibold hover:underline">
            <?= esc($row['post_title']) ?>
          </a>
          <p class="text-sm mt-1"><?= strip_tags_truncate($row['post_content']) ?></p>
          <p class="text-xs mt-2 opacity-70">
            <?= esc(date('d M Y', strtotime($row['created_at']))) ?>
          </p>
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
    <p>Tidak ada hasil.</p>
  <?php endif; ?>
</section>
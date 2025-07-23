<?= $this->extend('layouts/master') ?>

<?= $this->section('content') ?>

<h2 class="text-xl font-semibold mb-4">Daftar Artikel</h2>

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
  <?php foreach ($artikel as $a): ?>
    <div class="bg-white p-4 shadow rounded">
      <?php if ($a['post_image']): ?>
        <img src="<?= base_url()?>/media_library/posts/thumbs/<?= $a['post_image'] ?>" class="w-full h-40 object-cover mb-2">
      <?php endif ?>
      <h3 class="text-lg font-bold"><?= esc($a['post_title']) ?></h3>
      <p class="text-sm text-gray-600 mb-2">by <?= esc($a['post_author']) ?></p>
      <a href="/post/<?= $a['post_slug'] ?>" class="text-blue-600 hover:underline">Baca Selengkapnya</a>
    </div>
  <?php endforeach ?>
</div>

<?= $this->endSection() ?>

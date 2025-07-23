<?= $this->extend('layouts/master') ?>

<?= $this->section('content') ?>

<article class="bg-white p-6 rounded shadow">
  <h2 class="text-2xl font-bold mb-2"><?= esc($artikel['post_title']) ?></h2>
  <p class="text-sm text-gray-600 mb-4">Ditulis oleh: <?= esc($artikel['post_author']) ?></p>

  <?php if ($artikel['post_image']): ?>
    <img src="/writable/uploads/artikel/original/<?= $artikel['post_image'] ?>" class="w-full mb-4 rounded">
  <?php endif ?>

  <?= $artikel['post_content'] ?>
</article>

<a href="/" class="inline-block mt-4 text-blue-700 hover:underline">&larr; Kembali</a>

<?= $this->endSection() ?>
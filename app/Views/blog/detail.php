<?= $this->extend('layouts/master') ?>

<?= $this->section('content') ?>

<article class="bg-white p-6 rounded shadow">
  <h2 class="text-2xl font-bold mb-2"><?= esc($artikel['judul']) ?></h2>
  <p class="text-sm text-gray-600 mb-4">Ditulis oleh: <?= esc($artikel['penulis']) ?></p>

  <?php if ($artikel['gambar']): ?>
    <img src="/writable/uploads/artikel/original/<?= $artikel['gambar'] ?>" class="w-full mb-4 rounded">
  <?php endif ?>

  <p><?= nl2br(esc($artikel['isi'])) ?></p>
</article>

<a href="/" class="inline-block mt-4 text-blue-700 hover:underline">&larr; Kembali</a>

<?= $this->endSection() ?>

<?= $this->extend('layouts/master_admin') ?>

<?= $this->section('content') ?>

<h2>Kelola Artikel</h2>
<p>Selamat datang, <?= session('nama') ?> | <a href="/admin/logout">Logout</a></p>
<a href="/admin/artikel/tambah">+ Tambah Artikel</a>
<ul>
<?php foreach ($artikel as $a): ?>
    <li>
        <strong><?= esc($a['judul']) ?></strong>
        [<a href="/admin/artikel/edit/<?= $a['id'] ?>">Edit</a>] 
        [<a href="/admin/artikel/delete/<?= $a['id'] ?>" onclick="return confirm('Yakin?')">Hapus</a>]
    </li>
<?php endforeach; ?>
</ul>

<?= $this->endSection() ?>
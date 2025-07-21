<?= $this->extend('layouts/master_admin') ?>

<?= $this->section('content') ?>

<div class="container mx-auto p-6">
    <h1 class="text-3xl font-bold mb-4">Halo, <?= esc($username) ?> 👋</h1>
    <p class="text-gray-700">Selamat datang di dashboard perpustakaan. Berikut informasi singkat:</p>

    <div class="grid md:grid-cols-3 gap-6 mt-6">
        <div class="bg-white shadow p-4 rounded-lg">
            <h2 class="text-xl font-semibold">Karya Siswa</h2>
            <p class="text-gray-600">Lihat dan kelola karya kreatif siswa</p>
        </div>

        <div class="bg-white shadow p-4 rounded-lg">
            <h2 class="text-xl font-semibold">Berita</h2>
            <p class="text-gray-600">Update terbaru dari perpustakaan</p>
        </div>

        <div class="bg-white shadow p-4 rounded-lg">
            <h2 class="text-xl font-semibold">Pengaturan</h2>
            <p class="text-gray-600">Kelola akun dan preferensi</p>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
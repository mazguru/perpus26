<section class="">
  <div class="container hero-pattern2 text-white py-16 shadow-xl rounded-b-xl mx-auto px-4 text-center">
    <h2 class="text-4xl font-bold mb-4"><?= esc($title) ?></h2>
    <p class="text-xl text-center">
      apa yang akan kamu baca hari ini?
    </p>
    <p class="m-0 p-0 text-sm md:text-base text-center text-slate-200">
      Yuk, baca artikelnya agar tambah pengetahuan.
    </p>

  </div>
</section>

<?= $this->include('frontend/list-card') ?>
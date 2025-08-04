<section class="relative">
    <!-- Background image -->
    <div class="absolute inset-0">
      <img
        src="<?=base_url('assets/images/banner.jpg')?>"
        alt="Hero"
        class="w-full h-full object-cover">
      <div class="absolute inset-0 bg-slate-900/70"></div>
    </div>

    <!-- Content -->
    <div class="relative">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="h-[340px] sm:h-[380px] flex flex-col items-center justify-center text-center text-white">
          <h1 class="text-4xl sm:text-5xl md:text-6xl font-extrabold tracking-wide drop-shadow">
            <?= esc($title) ?>
          </h1>
          <p class="mt-4 text-base md:text-2xl text-slate-200">
            apa yang akan kamu baca hari ini?
          </p>
          <p class="m-0 p-0 text-sm md:text-base text-slate-200">
            Yuk, baca artikelnya agar tambah pengetahuan.
          </p>

          <!-- Breadcrumb / Button group -->
          <div class="mt-8">
            <div class="inline-flex bg-white text-slate-800 rounded-lg shadow-lg overflow-hidden">
              <a href="<?= base_url() ?>" class="px-5 py-3 text-sm font-semibold hover:bg-slate-50 flex items-center gap-2">
                HOME
                <!-- arrow -->
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5l7 7-7 7"/>
                </svg>
              </a>
              <span class="px-5 py-3 text-sm font-semibold bg-pumpkin-600 text-white"><?= esc($title) ?></span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
<?= $this->include('frontend/list-card')?>
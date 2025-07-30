<section class="relative">
    <!-- Background image -->
    <div class="absolute inset-0">
      <img
        src="https://images.unsplash.com/photo-1517466787929-bc90951d0974?q=80&w=1974&auto=format&fit=crop"
        alt="Hero"
        class="w-full h-full object-cover">
      <div class="absolute inset-0 bg-slate-900/60"></div>
    </div>

    <!-- Content -->
    <div class="relative">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="h-[340px] sm:h-[380px] flex flex-col items-center justify-center text-center text-white">
          <h1 class="text-4xl sm:text-5xl md:text-6xl font-extrabold tracking-wide drop-shadow">
            ARTIKEL
          </h1>
          <p class="mt-4 text-sm sm:text-base text-slate-200">
            Menampilkan <span class="font-semibold">13</span> tulisan dari <span class="font-semibold">2</span> Halaman artikel
          </p>

          <!-- Breadcrumb / Button group -->
          <div class="mt-8">
            <div class="inline-flex bg-white text-slate-800 rounded-lg shadow-lg overflow-hidden">
              <a href="#" class="px-5 py-3 text-sm font-semibold hover:bg-slate-50 flex items-center gap-2">
                HOME
                <!-- arrow -->
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5l7 7-7 7"/>
                </svg>
              </a>
              <span class="px-5 py-3 text-sm font-semibold bg-sky-600 text-white">ARTIKEL</span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
<?= $this->include('frontend/list-card')?>
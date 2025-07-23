<div x-data="{ isVisible: true }" 
     x-init="setTimeout(() => isVisible = false, 3000)" 
     x-show="isVisible" 
     x-transition:enter="transition ease-out duration-300"
     x-transition:enter-start="translate-y-8 opacity-0"
     x-transition:enter-end="translate-y-0 opacity-100"
     x-transition:leave="transition ease-in duration-300"
     x-transition:leave-start="opacity-100"
     x-transition:leave-end="opacity-0 -translate-x-24"
     class="pointer-events-auto relative flex items-center gap-3 rounded-lg border border-green-700 bg-green-100 text-green-700 p-4 shadow-lg max-w-xs">

  <!-- Icon -->
  <div class="rounded-full bg-green-200 bg-opacity-25 p-1 text-green-700" aria-hidden="true">
    <i class="bi bi-check-circle-fill"></i>
  </div>

  <!-- Teks -->
  <div class="flex flex-col gap-1">
    <h3 class="text-sm font-semibold">Berhasil!</h3>
    <p class="text-sm">Data berhasil disimpan.</p>
  </div>

  <!-- Tombol tutup -->
  <button type="button" class="ml-auto text-gray-500 hover:text-gray-700" x-on:click="isVisible = false">
    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
      <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
    </svg>
  </button>
</div>

<div x-data="{ isVisible: true }" 
     x-init="setTimeout(() => isVisible = false, 3000)" 
     x-show="isVisible" 
     x-transition:enter="transition ease-out duration-300"
     x-transition:enter-start="translate-y-8 opacity-0"
     x-transition:enter-end="translate-y-0 opacity-100"
     x-transition:leave="transition ease-in duration-300"
     x-transition:leave-start="opacity-100"
     x-transition:leave-end="opacity-0 -translate-x-24"
     class="pointer-events-auto relative flex items-center gap-3 rounded-lg border border-red-700 bg-red-100 text-red-700 p-4 shadow-lg max-w-xs">

  <!-- Icon -->
  <div class="rounded-full bg-red-200 bg-opacity-25 p-1 text-red-700" aria-hidden="true">
    <i class="bi bi-x-circle-fill"></i>
  </div>

  <!-- Teks -->
  <div class="flex flex-col gap-1">
    <h3 class="text-sm font-semibold">Gagal!</h3>
    <p class="text-sm">Terjadi kesalahan saat menyimpan data.</p>
  </div>

  <!-- Tombol tutup -->
  <button type="button" class="ml-auto text-gray-500 hover:text-gray-700" x-on:click="isVisible = false">
    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
      <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
    </svg>
  </button>
</div>

<div x-data="{ isVisible: true }" 
     x-init="setTimeout(() => isVisible = false, 3000)" 
     x-show="isVisible" 
     x-transition:enter="transition ease-out duration-300"
     x-transition:enter-start="translate-y-8 opacity-0"
     x-transition:enter-end="translate-y-0 opacity-100"
     x-transition:leave="transition ease-in duration-300"
     x-transition:leave-start="opacity-100"
     x-transition:leave-end="opacity-0 -translate-x-24"
     class="pointer-events-auto relative flex items-center gap-3 rounded-lg border border-yellow-700 bg-yellow-100 text-yellow-700 p-4 shadow-lg max-w-xs">

  <!-- Icon -->
  <div class="rounded-full bg-yellow-200 bg-opacity-25 p-1 text-yellow-700" aria-hidden="true">
    <i class="bi bi-exclamation-triangle-fill"></i>
  </div>

  <!-- Teks -->
  <div class="flex flex-col gap-1">
    <h3 class="text-sm font-semibold">Peringatan!</h3>
    <p class="text-sm">Mohon periksa kembali isian formulir Anda.</p>
  </div>

  <!-- Tombol tutup -->
  <button type="button" class="ml-auto text-gray-500 hover:text-gray-700" x-on:click="isVisible = false">
    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
      <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
    </svg>
  </button>
</div>

<div x-data="{ isVisible: true }" 
     x-init="setTimeout(() => isVisible = false, 3000)" 
     x-show="isVisible" 
     x-transition:enter="transition ease-out duration-300"
     x-transition:enter-start="translate-y-8 opacity-0"
     x-transition:enter-end="translate-y-0 opacity-100"
     x-transition:leave="transition ease-in duration-300"
     x-transition:leave-start="opacity-100"
     x-transition:leave-end="opacity-0 -translate-x-24"
     class="pointer-events-auto relative flex items-center gap-3 rounded-lg border border-blue-700 bg-blue-100 text-blue-700 p-4 shadow-lg max-w-xs">

  <!-- Icon -->
  <div class="rounded-full bg-blue-200 bg-opacity-25 p-1 text-blue-700" aria-hidden="true">
    <i class="bi bi-info-circle-fill"></i>
  </div>

  <!-- Teks -->
  <div class="flex flex-col gap-1">
    <h3 class="text-sm font-semibold">Info</h3>
    <p class="text-sm">Data berhasil dimuat.</p>
  </div>

  <!-- Tombol tutup -->
  <button type="button" class="ml-auto text-gray-500 hover:text-gray-700" x-on:click="isVisible = false">
    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
      <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
    </svg>
  </button>
</div>

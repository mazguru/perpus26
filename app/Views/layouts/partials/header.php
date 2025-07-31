<header class="bg-white shadow z-50 border-b" x-data="{ open: false, submenu: null }">
    <!-- Logo dan Search -->
    <div class="max-w-screen-xl mx-auto flex flex-wrap justify-between items-center px-4 pt-2">
        <div class="hidden md:flex items-center space-x-3">
            <?php
            $logoPath = FCPATH . 'assets/images/' . session('logo'); // Absolute path
            if (is_file($logoPath)) {?>
                <img src="<?= base_url('assets/images/'. session('logo'))?>" alt="Logo" class="w-10 h-10">';
            <?php } else {?>
                 <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                </svg>
            <?php } ?>
    
            <div>
                <h1 class="text-base md:text-lg font-bold text-gray-800 my-0 py-0">PERPUSTAKAAN ADYATAMA</h1>
                <p class="text-xs text-gray-600 my-0 py-0">SMP Islam Al Azhar 26 Yogyakarta<br>NPP. 3404061D0100001</p>
            </div>
        </div>
        <!-- Desktop -->
        <form action="/search" method="get" class="hidden md:flex items-center justify-center">
            <input
                type="text"
                name="q"
                placeholder="Cari sesuatu..."
                class="mr-2 border border-gray-300 rounded px-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-green-500" />
            <button
                type="submit"
                class="bg-green-600 text-white text-sm px-4 py-2 rounded hover:bg-green-700 transition duration-200">
                🔍 Cari
            </button>
        </form>
        <!-- Form Pencarian (Desktop & Mobile Responsive) -->
        <div class="w-full max-w-screen-xl mx-auto px-4 py-2">


            <!-- Mobile -->
            <form action="/search" method="get" class="md:hidden mt-2">
                <div class="flex items-center space-x-2">
                    <input
                        type="text"
                        name="q"
                        placeholder="Cari..."
                        class="w-full border border-gray-300 rounded px-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-green-500" />
                    <button
                        type="submit"
                        class="bg-green-600 text-white text-sm px-3 py-2 rounded hover:bg-green-700 transition duration-200">
                        🔍
                    </button>
                </div>
            </form>
        </div>
    </div>
</header>
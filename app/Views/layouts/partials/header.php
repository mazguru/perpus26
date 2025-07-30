<header class="bg-white shadow z-50 border-b" x-data="{ open: false, submenu: null }">
    <!-- Logo dan Search -->
    <div class="max-w-screen-xl mx-auto flex flex-wrap justify-between items-center px-4 pt-2">
        <div class="hidden md:flex items-center space-x-3">
            <img src="/upload/images/<?= session('logo')?>" alt="Logo" class="w-10 h-10" />
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
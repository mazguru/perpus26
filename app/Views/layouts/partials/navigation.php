<nav id="navbar" class="sticky top-0 w-full z-20" x-data="{ open: false }">
    <div class="max-w-screen-xl px-4 flex flex-wrap items-center justify-between mx-auto p-4">
        <a href="<?= base_url() ?>" class="flex items-center space-x-3 rtl:space-x-reverse">
            <img src="<?= base_url('assets/images/logo.png') ?>" class="h-10" alt="Logo Siapndan">
        </a>
        <div class="flex md:order-2 space-x-3 md:space-x-0 rtl:space-x-reverse">
            <a href="<?= base_url('login') ?>" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Login </a>
            <button @click="open = !open" type="button" class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600" aria-controls="navbar-sticky" :aria-expanded="open.toString()">
                <span class="sr-only">Open main menu</span>
                <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 17 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1h15M1 7h15M1 13h15" />
                </svg>
            </button>
        </div>
        <div class="items-center justify-between hidden w-full md:flex md:w-auto md:order-1" id="navbar-sticky" :class="{'block': open, 'hidden': !open}">
            <ul class="flex flex-col p-4 md:p-0 mt-4 font-bold text-xl border md:space-x-8 rtl:space-x-reverse md:flex-row md:mt-0 md:border-0" :class="{'bg-white': open, '': !open}">
                <li>
                    <a href="<?= base_url() ?>"
                        :class="{'text-blue-700 md:dark:text-blue-500': page === 'home', 'text-gray-900 hover:bg-transparent hover:text-blue-700': page !== 'home'}"
                        class="block py-2 px-3 md:bg-transparent md:p-0 md:dark:text-blue-500"
                        aria-current="page"
                        @click="page = 'home'">Home</a>
                </li>
                <li>
                    <a href="<?= base_url('about_us') ?>"
                        :class="{'text-blue-700 md:dark:text-blue-500': page === 'about_us', 'text-gray-900 hover:bg-transparent hover:text-blue-700': page !== 'about_us'}"
                        class="block py-2 px-3 md:bg-transparent md:p-0 md:dark:text-blue-500"
                        @click="page = 'about_us'">About</a>
                </li>
                <li x-data="{ openl: false }" class="relative">
                    <!-- Menu Utama -->
                    <a href="javascript:void(0);"
                        :class="{'text-blue-700 md:dark:text-blue-500': page === 'reports', 'text-gray-900 dark:text-gray-300': page !== 'reports' }"
                        class="block py-2 px-3 md:bg-transparent md:p-0 md:dark:text-blue-500 hover:bg-gray-100 hover:text-blue-700 dark:hover:bg-gray-700"
                        @click="openl = !openl">Laporan</a>

                    <!-- Submenu -->
                    <ul
                        x-show="openl"
                        @click.away="openl = false"
                        class="absolute left-0 z-10 w-48 bg-white border font-medium text-sm border-gray-200 rounded-md shadow-lg md:dark:bg-gray-800"
                        x-transition>
                        <li>
                            <a href="<?= base_url('reports') ?>"
                                :class="{'text-blue-700 dark:text-blue-400': page === 'daily', 'text-gray-900 hover:bg-gray-100 dark:hover:bg-gray-700 dark:text-gray-300': page !== 'daily'}"
                                class="block px-4 py-2"
                                @click="page = 'daily'; open = false">Laporan Presensi Hari Ini</a>
                        </li>
                        <li>
                            <a href="<?= base_url('reports/monthly') ?>"
                                :class="{'text-blue-700 dark:text-blue-400': page === 'monthly', 'text-gray-900 hover:bg-gray-100 dark:hover:bg-gray-700 dark:text-gray-300': page !== 'monthly'}"
                                class="block px-4 py-2"
                                @click="page = 'monthly'; open = false">Laporan Presensi Bulanan</a>
                        </li>
                        <li>
                            <a href="<?= base_url('reports/violations') ?>"
                                :class="{'text-blue-700 dark:text-blue-400': page === 'violations', 'text-gray-900 hover:bg-gray-100 dark:hover:bg-gray-700 dark:text-gray-300': page !== 'monthly'}"
                                class="block px-4 py-2"
                                @click="page = 'violations'; open = false">Laporan Pelanggaran</a>
                        </li>
                    </ul>
                </li>

                <li>
                    <a href="<?= base_url('kontak') ?>"
                        :class="{'text-blue-700 md:dark:text-blue-500': page === 'kontak', 'text-gray-900 hover:bg-transparent hover:text-blue-700': page !== 'kontak'}"
                        class="block py-2 px-3 md:bg-transparent md:p-0 md:dark:text-blue-500"
                        @click="page = 'kontak'">Contact</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
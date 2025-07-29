<nav x-data="menuPublic()" x-init="fetchMenu()" id="navbar" class="backdrop-blur-xl transition-colors duration-500 bg-white/75 sticky top-0 z-40 font-semibold leading-6 shadow-md w-full">
    <div class="max-w-screen-xl mx-auto px-4 flex justify-between items-center h-16">
        <!-- Logo -->
        <a href="/" class="flex items-center space-x-3 md:hidden">
            <img src="/assets/images/logo/logo.svg" class="h-10" alt="Logo Adyatama">
            <div>
                <h1 class="text-base md:text-lg font-bold text-gray-800">PERPUSTAKAAN ADYATAMA</h1>
                <p class="text-xs text-gray-600">SMP Islam Al Azhar 26 Yogyakarta<br>NPP. 3404061D0100001</p>
            </div>
        </a>


        <!-- Burger Icon -->
        <button @click="openmenu = !openmenu" class="md:hidden focus:outline-none">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path x-show="!openmenu" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M4 6h16M4 12h16M4 18h16" />
                <path x-show="openmenu" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>

        <!-- Menu utama (desktop) -->
        <div class="hidden md:flex space-x-6 items-center text-sm font-medium">
            <template x-for="menu in menus" :key="menu.id">
                <div class="relative group" x-data="{ hover: false }">
                    <!-- Menu tanpa submenu -->
                    <template x-if="menu.submenus.length === 0">
                        <a :href="_BASEURL + menu.url" class="hover:text-green-600 text-md" x-text="menu.title"></a>
                    </template>

                    <!-- Menu dengan submenu -->
                    <template x-if="menu.submenus.length > 0">
                        <div @mouseenter="hover = true" @mouseleave="hover = false">
                            <button class="hover:text-green-600 flex items-center space-x-1">
                                <span x-text="menu.title"></span>
                                <!-- Chevron down icon -->
                                <svg class="w-4 h-4 transition-transform duration-200"
                                    :class="hover ? 'rotate-180' : ''"
                                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 9l-7 7-7-7" />
                                </svg>
                            </button>
                            <div
                                class="absolute left-0 mt-2 w-40 bg-white shadow-lg z-50 rounded-md"
                                x-show="hover"
                                x-transition>
                                <template x-for="sub in menu.submenus" :key="sub.id">
                                    <a :href="_BASEURL + sub.url" class="block px-4 py-2 hover:bg-gray-100" x-text="sub.title"></a>
                                </template>
                            </div>
                        </div>
                    </template>
                </div>
            </template>
        </div>
    </div>

    <!-- Menu mobile dropdown -->
    <div class="md:hidden" x-show="openmenu" x-transition>
        <div class="px-4 py-2 space-y-2">
            <template x-for="menu in menus" :key="menu.id">
                <div x-data="{ subOpen: false }">
                    <!-- Menu tanpa submenu -->
                    <template x-if="menu.submenus.length === 0">
                        <a :href="menu.url" class="block py-2 text-gray-700 hover:text-green-600 font-medium" x-text="menu.title"></a>
                    </template>

                    <!-- Menu dengan submenu -->
                    <template x-if="menu.submenus.length > 0">
                        <div>
                            <button @click="subOpen = !subOpen" class="w-full flex justify-between py-2 text-gray-700 hover:text-green-600 font-medium">
                                <span x-text="menu.title"></span>
                                <svg class="w-4 h-4 transform" :class="subOpen ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 9l-7 7-7-7" />
                                </svg>
                            </button>
                            <div x-show="subOpen" x-transition class="pl-4">
                                <template x-for="sub in menu.submenus" :key="sub.id">
                                    <a :href="sub.url" class="block py-1 text-gray-600 hover:text-green-600" x-text="sub.title"></a>
                                </template>
                            </div>
                        </div>
                    </template>
                </div>
            </template>
        </div>
    </div>
</nav>

<script>
    function menuPublic() {
        return {
            menus: [],
            openmenu: false,
            currentPath: window.location.pathname,
            base_url: _BASEURL,
            async fetchMenu() {
                try {
                    const res = await fetch(this.base_url + 'menupublic', {
                        method: 'GET',
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest',
                        },
                    });
                    const data = await res.json();
                    console.log(data);

                    this.menus = data.map(menu => {
                        const fullMenuPath = this.base_url.replace(location.origin, '') + menu.route;
                        let menuActive = this.currentPath === fullMenuPath;

                        if (!menu.submenu) {
                            return {
                                ...menu,
                                active: menuActive
                            };
                        }

                        const submenu = menu.submenu.map(sub => {
                            const fullSubPath = this.base_url.replace(location.origin, '') + sub.route;
                            const isActive = this.currentPath === fullSubPath;
                            if (isActive) menuActive = true;
                            return {
                                ...sub,
                                active: isActive
                            };
                        });

                        return {
                            ...menu,
                            active: menuActive,
                            submenu
                        };
                    });

                } catch (error) {
                    console.error('Gagal memuat menu:', error);
                }
            }
        }
    }
</script>
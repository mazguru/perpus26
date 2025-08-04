<header x-data="menuPublic()" x-init="fetchMenu()" id="navbar" class="backdrop-blur-xl transition-colors duration-500 bg-abbey-900/85 text-white sticky top-0 z-40 font-semibold leading-6 shadow-md w-full">
    <div class="container px-4 md:px-0">
        <nav class="w-full py-2 flex justify-between">
            <!-- Logo -->
            <a href="<?= base_url() ?>" class="flex items-center space-x-3 md:hidden">
                <?php
                $logoPath = FCPATH . 'assets/images/' . session('logo'); // Absolute path
                if (is_file($logoPath)) { ?>
                    <img src="<?= base_url('assets/images/' . session('logo')) ?>" alt="Logo" class="w-10 h-10">
                <?php } else { ?>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-pumpkin-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                    </svg>
                <?php } ?>
                <div>
                    <h1 class="text-base md:text-lg font-bold  uppercase"><?= session('nama_perpus') ?></h1>
                    <p class="text-xs text-white"><?= session('school_name') ?><br>NPP. <?= session('npp') ?></p>
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
            <div class="hidden md:flex items-center text-sm font-medium">

                <template x-for="menu in menus" :key="menu.id">
                    <div class="relative group" x-data="{ hover: false }">
                        <!-- Menu tanpa submenu -->
                        <template x-if="menu.children.length === 0">
                            <a
                                :href="menu.menu_type === 'link' ? menu.menu_url : base_url + menu.menu_url"
                                :target="menu.menu_target"
                                class="inline-flex items-center px-4 py-2 text-sm font-medium  hover:text-pumpkin-600"
                                :class="menu.active ? 'text-pumpkin-600 font-semibold ' : 'text-white'">
                                <span x-text="menu.menu_title"></span>
                            </a>
                        </template>

                        <!-- Menu dengan submenu -->
                        <template x-if="menu.children.length > 0">
                            <div @mouseenter="hover = true" @mouseleave="hover = false">
                                <button
                                    type="button"
                                    @click="menu.open = !menu.open"
                                    class="inline-flex items-center px-4 py-2 text-sm font-medium  hover:text-pumpkin-600 focus:outline-none"
                                    :class="menu.active ? 'text-pumpkin-600 font-semibold' : 'text-white'">
                                    <span x-text="menu.menu_title"></span>
                                    <i class="bi bi-chevron-down ml-2 transform transition-transform duration-300"
                                        :class="hover ? 'rotate-180' : 'rotate-0'"></i>
                                </button>

                                <div
                                    class="absolute left-0 mt-2 w-40 bg-abbey-900/85 shadow-lg z-50 rounded-b-md"
                                    x-show="hover"
                                    x-transition>
                                    <template x-for="child in menu.children" :key="child.id">
                                        <a
                                            class="block px-4 py-2 text-sm  hover:bg-gray-800"
                                            :href="child.menu_type === 'link' ? child.menu_url : base_url + child.menu_url"
                                            :target="child.menu_target"
                                            x-text="child.menu_title"
                                            :class="child.active ? 'text-pumpkin-600 font-semibold' : 'text-white'"></a>
                                    </template>
                                </div>
                            </div>
                        </template>
                    </div>
                </template>
            </div>

            <div class="hidden md:block py-2">
                <a href="<?= base_url('login') ?>" class="p-2 font-medium text-sm bg-primary text-white border border-primary rounded duration-700">Login</a>
            </div>

        </nav>
        <!-- Menu mobile dropdown -->
        <div class="md:hidden border-t" x-show="openmenu" x-transition>
            <div class="px-4 py-2 space-y-2">
                <template x-for="menu in menus" :key="menu.id">
                    <div x-data="{ subOpen: false }">
                        <!-- Menu tanpa submenu -->
                        <template x-if="menu.children.length === 0">
                            <a
                                :href="menu.menu_type === 'link' ? menu.menu_url : base_url + menu.menu_url"
                                :target="menu.menu_target"
                                class="inline-flex text-sm font-medium text-white hover:text-pumpkin-600"
                                :class="menu.active ? 'text-pumpkin-600 font-semibold' : ''">
                                <span x-text="menu.menu_title"></span>
                            </a>
                        </template>

                        <!-- Menu dengan submenu -->
                        <template x-if="menu.children.length > 0">
                            <div>
                                <button @click="subOpen = !subOpen" class="w-full flex justify-between py-2 text-white hover:text-pumpkin-600 font-medium">
                                    <span x-text="menu.menu_title"></span>
                                    <i class="bi bi-chevron-down ml-1 transform transition-transform duration-300"
                                        :class="subOpen ? 'rotate-180' : 'rotate-0'"></i>
                                </button>
                                <div x-show="subOpen" x-transition class="pl-4">
                                    <template x-for="child in menu.children" :key="child.id">
                                        <a
                                            class="block px-4 py-2 text-sm text-white hover:bg-gray-100"
                                            :href="child.menu_type === 'link' ? child.menu_url : base_url + child.menu_url"
                                            :target="child.menu_target"
                                            x-text="child.menu_title"
                                            :class="child.active ? 'text-pumpkin-600 font-semibold' : ''"></a>
                                    </template>
                                </div>
                            </div>
                        </template>
                    </div>
                </template>
            </div>
        </div>
    </div>
</header>

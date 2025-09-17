<header id="navbar" class="backdrop-blur-xl transition-colors duration-500 bg-abbey-900/85 text-white sticky top-0 z-40 font-semibold leading-6 shadow-md w-full">
    <div class="container px-4 md:px-0" x-data="{ mobileOpen: false }">
        <nav class="w-full py-2 flex justify-between items-center">
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
            <!-- Hamburger Menu Button (Mobile) -->
            <button @click="mobileOpen = !mobileOpen" class="md:hidden focus:outline-none">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path x-show="!mobileOpen" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M4 6h16M4 12h16M4 18h16" />
                    <path x-show="mobileOpen" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M6 18L18 6M6 6l12 12" />
                </svg>
                
            </button>

            <!-- Menu Desktop -->
            <div class="hidden md:flex items-center text-sm font-medium space-x-2">
                <?php foreach ($site_menus as $menu): ?>
                    <div class="relative group" x-data="{ hover: false }">
                        <?php if (empty($menu['children'])): ?>
                            <!-- Menu tanpa submenu -->
                            <a href="<?= $menu['menu_type'] === 'link' ? $menu['menu_url'] : base_url($menu['menu_url']) ?>"
                                target="<?= esc($menu['menu_target']) ?>"
                                class="inline-flex items-center px-4 py-2 hover:text-pumpkin-600
                               <?= $menu['active'] ? 'text-pumpkin-600 font-semibold' : 'text-white' ?>">
                                <?= esc($menu['menu_title']) ?>
                            </a>
                        <?php else: ?>
                            <!-- Menu dengan submenu -->
                            <button type="button"
                                @mouseenter="hover = true"
                                @mouseleave="hover = false"
                                class="inline-flex items-center px-4 py-2 hover:text-pumpkin-600 focus:outline-none
                                    <?= isset($menu['active']) && $menu['active'] ? 'text-pumpkin-600 font-semibold' : 'text-white' ?>">
                                <?= esc($menu['menu_title']) ?>
                                <i class="bi bi-chevron-down ml-2 transition-transform duration-300"
                                    :class="hover ? 'rotate-180' : 'rotate-0'"></i>
                            </button>

                            <!-- Submenu Desktop -->
                            <div class="absolute left-0 mt-2 w-40 bg-abbey-900/85 shadow-lg rounded-b-md z-50"
                                x-show="hover"
                                x-transition
                                @mouseenter="hover = true"
                                @mouseleave="hover = false"
                                style="display: none;">
                                <?php foreach ($menu['children'] as $child): ?>
                                    <a href="<?= $child['menu_type'] === 'link' ? $child['menu_url'] : base_url($child['menu_url']) ?>"
                                        target="<?= esc($child['menu_target']) ?>"
                                        class="block px-4 py-2 text-sm hover:bg-gray-800
                                       <?= $child['active'] ? 'text-pumpkin-600 font-semibold' : 'text-white' ?>">
                                        <?= esc($child['menu_title']) ?>
                                    </a>
                                <?php endforeach; ?>
                            </div>
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>
            </div>

            <!-- Login Button Desktop -->
            <div class="hidden md:block py-2">
                <a href="<?= base_url('login') ?>" class="p-2 font-medium text-sm bg-primary text-white border border-primary rounded duration-700">
                    Login
                </a>
            </div>
        </nav>

        <!-- Mobile Menu -->
        <div class="md:hidden" x-show="mobileOpen" x-transition>
            <div class="bg-abbey-900/95 rounded-b-md shadow-md mt-2 px-4 py-3 space-y-2">
                <?php foreach ($site_menus as $menu): ?>
                    <div x-data="{ open: false }" class="border-b border-gray-700 pb-2">
                        <?php if (empty($menu['children'])): ?>
                            <!-- Menu tanpa submenu -->
                            <a href="<?= $menu['menu_type'] === 'link' ? $menu['menu_url'] : base_url($menu['menu_url']) ?>"
                                target="<?= esc($menu['menu_target']) ?>"
                                class="block px-2 py-2 rounded hover:bg-gray-800
                               <?= $menu['active'] ? 'text-pumpkin-600 font-semibold' : 'text-white' ?>">
                                <?= esc($menu['menu_title']) ?>
                            </a>
                        <?php else: ?>
                            <!-- Menu dengan submenu -->
                            <button @click="open = !open" class="w-full flex justify-between items-center px-2 py-2 rounded hover:bg-gray-800 focus:outline-none
                                    <?= isset($menu['active']) && $menu['active'] ? 'text-pumpkin-600 font-semibold' : 'text-white' ?>">
                                <?= esc($menu['menu_title']) ?>
                                <i class="bi bi-chevron-down transition-transform duration-300"
                                    :class="open ? 'rotate-180' : 'rotate-0'"></i>
                            </button>

                            <div x-show="open" x-transition class="mt-2 pl-4 space-y-2" style="display: none;">
                                <?php foreach ($menu['children'] as $child): ?>
                                    <a href="<?= $child['menu_type'] === 'link' ? $child['menu_url'] : base_url($child['menu_url']) ?>"
                                        target="<?= esc($child['menu_target']) ?>"
                                        class="block px-2 py-1 text-sm rounded hover:bg-gray-800
                                       <?= $child['active'] ? 'text-pumpkin-600 font-semibold' : 'text-white' ?>">
                                        <?= esc($child['menu_title']) ?>
                                    </a>
                                <?php endforeach; ?>
                            </div>
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>

                <!-- Login Button Mobile -->
                <div class="pt-3">
                    <a href="<?= base_url('login') ?>" class="block w-full text-center px-2 py-2 bg-primary text-white rounded">
                        Login
                    </a>
                </div>
            </div>
        </div>
    </div>
</header>
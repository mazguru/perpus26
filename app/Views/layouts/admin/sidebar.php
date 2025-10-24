<aside x-data="menuManager()" x-init="fetchMenu()"
    :class="sidebarToggle ? 'translate-x-0 lg:w-[90px]' : '-translate-x-full'"
    class="sidebar fixed left-0 top-0 z-99 flex h-screen w-[290px] flex-col overflow-y-hidden border-r border-gray-200 bg-blue-800 text-white px-5 duration-300 ease-linear dark:border-gray-800 dark:bg-black lg:static lg:translate-x-0"
    @click.outside="sidebarToggle = false">

    <!-- Logo -->
    <div :class="sidebarToggle ? 'justify-center' : 'justify-between'" class="sidebar-header flex items-center gap-2 pt-8 pb-7">
        <a href="<?= base_url('dashboard') ?>">
            <div class="flex items-center gap-2">
                <img class="h-10" src="<?= base_url('/assets/images/' . session('logo')) ?>" alt="Logo">
                <div x-show="!sidebarToggle">
                    <h1 class="text-base md:text-lg font-bold uppercase"><?= session('nama_perpus') ?? '' ?></h1>
                    <p class="text-xs"><?= session('school_name') ?><br>NPP. <?= session('npp') ?></p>
                </div>
            </div>
        </a>
    </div>

    <?= session('user_role') ?>

    <!-- Menu -->


    <div class="border-b no-scrollbar flex flex-col overflow-y-auto duration-300 ease-linear">
        <nav>
            <ul class="mb-6 flex flex-col gap-1">
                <template x-for="menu in menus" :key="menu.title">
                    <li>
                        <button
                            @click="menu.submenu ? menu.active = !menu.active : (menu.blank ? window.open(base_url + menu.route, '_blank') : window.location.href = base_url + menu.route)"
                            class="menu-item group w-full text-left flex items-center justify-between hover:bg-gray-100 hover:text-blue-600"
                            :class="menu.active ? 'bg-gray-100 text-blue-600 dark:bg-gray-800 dark:text-white' : ''">
                            <div class="flex items-center gap-2">
                                <i :class="menu.icon"></i>
                                <span class="menu-item-text" x-text="menu.title" :class="sidebarToggle ? 'lg:hidden' : ''"></span>
                            </div>
                            <template x-if="menu.submenu">
                                <i class="menu-item-arrow bi bi-chevron-down text-sm" :class="sidebarToggle ? 'lg:hidden' : '' "></i>
                            </template>
                        </button>
                        <template x-if="menu.submenu && menu.active">
                            <ul class="pl-8 space-y-1 menu-dropdown mt-2 flex flex-col gap-1" :class="sidebarToggle ? 'lg:hidden' : 'flex'">
                                <template x-for="sub in menu.submenu" :key="sub.title">
                                    <li>
                                        <a
                                            :href="base_url + sub.route"
                                            class="block hover:bg-gray-200 hover:text-blue-600 text-sm menu-dropdown-item group menu-dropdown-item-active"
                                            :class="sub.active ? 'bg-gray-100 text-blue-600 font-semibold dark:text-white menu-dropdown-item-active' : 'menu-dropdown-item-inactive'"
                                            x-text="sub.title"></a>
                                    </li>
                                </template>
                            </ul>
                        </template>
                    </li>
                </template>
            </ul>
        </nav>
    </div>

</aside>

<script>
    function menuManager() {
        return {
            menus: [],
            base_url: '<?= base_url() ?>',
            currentPath: window.location.pathname,

            async fetchMenu() {
                try {
                    const res = await fetch(this.base_url + 'menu/menuadmin');
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
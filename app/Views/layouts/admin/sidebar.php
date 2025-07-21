<aside x-data="menuManager()" x-init="fetchMenu()" class="sidebar fixed top-0 left-0 z-9999 flex h-screen w-[290px] flex-col overflow-y-auto border-r border-gray-200 bg-white px-5 transition-all duration-300 lg:static lg:translate-x-0 dark:border-gray-800 dark:bg-black -translate-x-full">
    <div :class="sidebarToggle ? 'justify-center' : 'justify-between'" class="sidebar-header flex items-center gap-2 pt-8 pb-7 justify-between">
        <a href="index.html">
            <span class="logo" :class="sidebarToggle ? 'hidden' : ''">
                <img class="dark:hidden" src="src/images/logo/logo.svg" alt="Logo">
                <img class="hidden dark:block" src="src/images/logo/logo-dark.svg" alt="Logo">
            </span>
            <img class="logo-icon hidden" :class="sidebarToggle ? 'lg:block' : 'hidden'" src="src/images/logo/logo-icon.svg" alt="Logo">
        </a>
    </div>
    <template x-for="menu in menus" :key="menu.title">
        <div class="border-b no-scrollbar flex flex-col overflow-y-auto duration-300 ease-linear">
            <button
                @click="menu.active = !menu.active"
                class="w-full px-4 py-2 text-left flex items-center justify-between hover:bg-gray-100">
                <div class="flex items-center gap-2">
                    <i :class="menu.icon"></i>
                    <span x-text="menu.title"></span>
                </div>
                <template x-if="menu.submenu">
                    <i class="bi bi-chevron-down text-sm"></i>
                </template>
            </button>
            <template x-if="menu.submenu && menu.active">
                <ul class="pl-8 py-2 space-y-1">
                    <template x-for="sub in menu.submenu" :key="sub.title">
                        <li>
                            <a
                                :href="base_url + sub.route"
                                class="block px-2 py-1 hover:bg-gray-200 text-sm"
                                x-text="sub.title"></a>
                        </li>
                    </template>
                </ul>
            </template>
        </div>
    </template>
</aside>

<script>
    function menuManager() {
        return {
            menus: [],
            base_url: '<?= base_url() ?>',

            async fetchMenu() {
                try {
                    const res = await fetch(this.base_url + '/admin/menu');
                    this.menus = await res.json();
                    console.log(this.menus);
                    // Add active state for dropdowns
                    this.menus = this.menus.map(menu => ({
                        ...menu,
                        active: false
                    }));
                } catch (e) {
                    console.error('Gagal memuat menu:', e);
                }
            }
        };
    }
</script>
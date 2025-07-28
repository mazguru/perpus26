<aside x-data="menuManager()" x-init="fetchMenu()" 
    :class="sidebarToggle ? 'translate-x-0 lg:w-[90px]' : '-translate-x-full'"
    class="sidebar fixed left-0 top-0 z-99 flex h-screen w-[290px] flex-col overflow-y-hidden border-r border-gray-200 bg-white px-5 duration-300 ease-linear dark:border-gray-800 dark:bg-black lg:static lg:translate-x-0"
    @click.outside="sidebarToggle = false">

    <!-- Logo -->
    <div :class="sidebarToggle ? 'justify-center' : 'justify-between'" class="sidebar-header flex items-center gap-2 pt-8 pb-7">
        <a href="/">
            <template x-if="!sidebarToggle">
                <div class="flex items-center gap-2">
                    <img class="h-8 dark:hidden" src="/assets/images/logo/logo.svg" alt="Logo">
                    <img class="h-8 hidden dark:block" src="/assets/images/logo/logo-dark.svg" alt="Logo Dark">
                    <img class="h-8 dark:hidden" src="/assets/images/logo/logo-text.png" alt="Logo Text">
                    <img class="h-8 hidden dark:block" src="/assets/images/logo/logo-text-dark.png" alt="Logo Text Dark">
                </div>
            </template>
            <template x-if="sidebarToggle">
                <div>
                    <img class="h-8 dark:hidden" src="/assets/images/logo/logo.svg" alt="Logo Icon">
                    <img class="h-8 hidden dark:block" src="/assets/images/logo/logo-dark.svg" alt="Logo Icon Dark">
                </div>
            </template>
        </a>
    </div>

    <!-- Menu -->
    <template x-for="menu in menus" :key="menu.title">
        <div class="border-b no-scrollbar flex flex-col overflow-y-auto duration-300 ease-linear">
            <button
                @click="menu.submenu ? menu.active = !menu.active : window.location.href = base_url + menu.route"
                class="w-full px-4 py-2 text-left flex items-center justify-between hover:bg-gray-100"
                :class="menu.active ? 'bg-gray-100 text-blue-600 dark:bg-gray-800 dark:text-white' : ''">
                <div class="flex items-center gap-2">
                    <i :class="menu.icon"></i>
                    <span x-text="menu.title" :class="sidebarToggle ? 'lg:hidden' : ''"></span>
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
                                :class="sub.active ? 'text-blue-600 font-semibold dark:text-white' : ''"
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
        currentPath: window.location.pathname,

        async fetchMenu() {
            try {
                const res = await fetch(this.base_url + 'menu/menuadmin');
                const data = await res.json();

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

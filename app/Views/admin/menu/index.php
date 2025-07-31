<div x-data="menuMg()" x-init="init()">
    <!-- Header -->
    <div class="p-4 bg-white dark:bg-boxdark shadow-md border-b border-gray-200">
        <div class="mb-4">
            <h1 class="text-xl sm:text-2xl font-semibold"><?= $title ?></h1>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-6 gap-4">
            <div class="col-span-5">
                <p class="text-sm text-gray-600">Menampilkan data menu</p>
            </div>
            <div>
                <button @click="openModal('create-menu')" class="text-white bg-cyan-600 hover:bg-cyan-700 px-4 py-2 rounded text-sm w-full sm:w-auto">
                    <i class="bi bi-plus-lg mr-2"></i> Tambah Menu
                </button>
            </div>
        </div>
    </div>

    <!-- Konten -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-4">
        <!-- Daftar Halaman -->
        <div class="space-y-2">
            
            <div class="bg-white border rounded-md" x-data="{ hover: false }">
                <div @mouseenter="hover = true" @mouseleave="hover = false" class="border-b">
                    <button @click="btnLoadPage = !btnLoadPage" class="w-full px-4 py-2 text-left flex items-center justify-between hover:bg-gray-100 text-blue-600 dark:bg-gray-800 dark:text-white">
                        <span class="font-bold">Load Halaman Page</span>
                        <!-- Chevron down icon -->
                        <svg class="w-4 h-4 transition-transform duration-200"
                            :class="btnLoadPage ? 'rotate-180' : ''"
                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                </div>
                <div x-show="btnLoadPage">
                    <template x-for="page in pageData" :key="page.id">
                        <div class="border-x p-4 bg-white">
                            <div class="font-bold text-gray-800" x-text="page.title"></div>
                            <div class="text-sm text-gray-600" x-text="'URL: ' + page.url"></div>
                            <button @click="openModal('from-page'); setFromPage(page.id)" class="text-blue-600 text-sm mt-2 hover:underline">
                                + Tambahkan ke Menu
                            </button>
                        </div>
                    </template>
                </div>
            </div>
        </div>

        <!-- Daftar Menu & Submenu -->
        <div class="col-span-2">
            <template x-for="menu in menuData" :key="menu.id">
                <div class="border p-4 bg-white rounded shadow-sm mb-4">
                    <div class="font-bold text-gray-800" x-text="menu.order_num + '. ' + menu.title"></div>
                    <div class="text-sm text-gray-600" x-text="'URL: ' + menu.url"></div>
                    <div class="mt-2">
                        <a :href="_BASEURL + menu.url" class="text-blue-600 text-sm hover:underline" target="_blank">Lihat</a>
                        <button @click="openModal('create-submenu', menu.id)" class="text-blue-500 text-sm ml-2">+ Submenu</button>
                        <button @click="editMenu(menu.id)" class="text-yellow-500 text-sm ml-2">Edit</button>
                        <button @click="deleteMenu(menu.id, 'menu')" class="text-red-500 text-sm ml-2">Hapus</button>
                    </div>

                    <!-- Submenu -->
                    <template x-for="submenu in submenuData.filter(s => s.menu_id === menu.id)" :key="submenu.id">
                        <div class="ml-4 mt-2 border-l-2 pl-2">
                            <div class="text-sm text-gray-700" x-text="submenu.title + ' (' + submenu.url + ')' "></div>
                            <div>
                                <a :href="_BASEURL + submenu.url" class="text-blue-600 text-sm hover:underline" target="_blank">Lihat</a>
                                <button @click="editsubMenu(submenu.id)" class="text-yellow-500 text-sm ml-2">Edit</button>
                                <button @click="deleteMenu(submenu.id, 'submenu')" class="text-red-500 text-sm ml-2">Hapus</button>
                            </div>
                        </div>
                    </template>
                </div>
            </template>
        </div>
    </div>

    <!-- Modal -->
    <template x-if="showModal">
        <div class="fixed inset-0 z-50 flex items-center justify-center bg-black/50">
            <div class="bg-white rounded-lg shadow-lg w-full max-w-md p-6">
                <h2 class="text-lg font-semibold mb-4"
                    x-text="modalType === 'create-menu' ? 'Tambah Menu Utama' :
                             (modalType === 'create-submenu' ? 'Tambah Submenu' :
                             (modalType === 'edit-submenu' ? 'Edit Submenu' :
                             (modalType === 'from-page' ? 'Tambahkan Halaman ke Menu' : 'Edit Menu')))">
                </h2>

                <form @submit.prevent="submitMenu">

                    <!-- Input Nama Menu -->
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">Nama Menu</label>
                        <input type="text" class="w-full border p-2 rounded" x-model="formData.title" required>
                    </div>

                    <!-- Input URL -->
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">URL</label>
                        <input type="text" class="w-full border p-2 rounded" x-model="formData.url" required>
                    </div>

                    <!-- Pilih Menu Induk -->
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">Menu Induk (jika sebagai submenu)</label>
                        <select class="w-full border p-2 rounded" x-model="formData.menu_id">
                            <option value="">-- Sebagai Menu Utama --</option>
                            <template x-for="menu in menuData" :key="menu.id">
                                <option :value="menu.id" x-text="menu.title"></option>
                            </template>
                        </select>
                    </div>

                    <!-- Urutan -->
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">Urutan</label>
                        <input type="number" class="w-full border p-2 rounded" x-model="formData.order_num" required>
                    </div>

                    <!-- Aktif -->
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">Aktif</label>
                        <select class="w-full border p-2 rounded" x-model="formData.is_active">
                            <option value="">--Pilih--</option>
                            <option value="1">Ya</option>
                            <option value="0">Tidak</option>
                        </select>
                    </div>

                    <!-- Tombol -->
                    <div class="flex justify-end space-x-2">
                        <button type="button" @click="closeModal" class="bg-gray-400 text-white px-4 py-2 rounded">Batal</button>
                        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </template>
</div>

<script>
    function menuMg() {
        return {
            _BASEURL: '<?= base_url() ?>',
            showModal: false,
            modalType: '',
            formData: {
                id: null,
                title: '',
                url: '',
                order_num: 99,
                menu_id: '',
            },
            menuData: [],
            pageData: [],
            profilData: [],
            layananData: [],
            submenuData: [],
            btnLoadPage: false,
            btnLoadprofil: false,
            btnLoadlayanan: false,

            openModal(type, parentId = null) {
                this.modalType = type;
                this.showModal = true;
                this.formData = {
                    id: null,
                    title: '',
                    url: '',
                    order_num: 99,
                    menu_id: parentId,
                    is_active: 1
                };
            },

            closeModal() {
                this.showModal = false;
                this.form={};
            },

            setFromPage(id) {
                const page = this.pageData.find(p => p.id == id);
                if (page) {
                    this.formData.title = page.title;
                    this.formData.url = 'page/' + page.url;
                }
            },

            async submitMenu() {
                const response = await this.fetchData('/admin/menu/save', 'POST', this.formData);
                if (response && response.status === 'success') {
                    Notifier.show('Berhasil!', response.message, 'success');
                    this.loadMenus();
                    this.closeModal();
                } else {
                    Notifier.show('Gagal!', response?.message || 'Terjadi kesalahan.', 'error');
                }
            },

            editMenu(id) {
                const item = this.menuData.find(m => m.id === id);
                if (item) {
                    this.modalType = 'edit';
                    this.showModal = true;
                    this.formData = {
                        ...item,
                        
                    };
                }
            },

            editsubMenu(id) {
                const item = this.submenuData.find(m => m.id === id);
                if (item) {
                    
                    this.formData = {
                        ...item
                    };
                    this.modalType = 'edit-submenu';
                    this.showModal = true;
                }
            },

            deleteMenu(id, type) {
                if (confirm('Hapus ' + type + ' ini?')) {
                    fetch(`/admin/menu/deleted/${id}?type=${type}`, {
                            method: 'GET',
                            headers: {
                                'X-Requested-With': 'XMLHttpRequest'
                            }
                        })
                        .then(res => res.json())
                        .then(data => {
                            if (data.success) this.loadMenus();
                            else alert('Gagal menghapus ' + type);
                        })
                        .catch(() => alert('Terjadi kesalahan'));
                }
            },

            async fetchData(url, method = 'GET', body = null) {
                try {
                    const response = await fetch(url, {
                        method,
                        headers: {
                            'Content-Type': 'application/json',
                            'X-Requested-With': 'XMLHttpRequest'
                        },
                        body: body ? JSON.stringify(body) : null
                    });
                    if (!response.ok) throw new Error('Network error');
                    return await response.json();
                } catch (error) {
                    console.error('Fetch error:', error);
                    return null;
                }
            },

            async loadMenus() {
                const res = await this.fetchData('/admin/menu/list');
                console.log(res);
                if (res) {
                    this.menuData = res.menus || [];
                    this.submenuData = res.submenus || [];
                }
            },

            async loadPages() {
                const res = await this.fetchData('/blog/page/list');
                if (res) this.pageData = res.data || [];
                console.log(res);
            },

            init() {
                this.loadMenus();
                this.loadPages();
            }
        }
    }
</script>
<div x-data="menuMg()" x-init="init()">
    <div class="p-4 bg-white dark:bg-boxdark shadow-md block sm:flex items-center justify-between border-b border-gray-200">
        <div class="mb-1 w-full">

            <div class="mb-4">
                <h1 class="text-xl sm:text-2xl font-semibold"><?= $title ?></h1>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-6 gap-4 md:justify-between">
                <div class="sm:flex items-center sm:divide-x sm:divide-gray-100 mb-3 sm:mb-0 col-span-5">
                    <p>Menampilkan data menu</p>
                </div>

                <div class="grid grid-cols-1 md:justify-end gap-4">
                    <button @click="openModal('create-menu')" class="w-1/2 text-white bg-cyan-600 hover:bg-cyan-700 focus:ring-4 focus:ring-cyan-200 font-medium inline-flex items-center justify-center rounded-lg text-sm px-3 py-2 text-center sm:w-auto">
                        <i class="bi bi-plus-lg font-bold text-[14pt] mr-2"></i>
                        Tambah Menu
                    </button>


                </div>
            </div>
        </div>
    </div>
    <!-- Daftar Menu & Submenu -->
    <template x-for="menu in menuData" :key="menu.id">
        <div class="border p-4 my-2 bg-white rounded">
            <div class="font-bold" x-text="menu.order_num + '. ' + menu.title "></div>
            <div class="flex">
                <div class="text-sm text-gray-600 mr-2" x-text="'url (' + menu.url + ')'"></div>
                <a :href="_BASEURL + menu.url" class="text-sm text-primary hover:text-blue-500" target="_blank">Lihat</a>
            </div>
            <div class="mt-1">
                <button @click="openModal('create-submenu', menu.id)" class="text-blue-500 text-sm">+ Tambah Submenu</button>
                <button @click="editMenu(menu.id)" class="text-yellow-500 text-sm ml-2">Edit</button>
                <button @click="deleteMenu(menu.id, 'menu')" class="text-red-500 text-sm ml-2">Hapus</button>
            </div>

            <!-- Submenu -->
            <template x-for="submenu in submenuData.filter(s => s.menu_id === menu.id)" :key="submenu.id">
                <div class="ml-4 mt-2 border-l-2 pl-2">
                    <div class="flex">
                        <div class="text-sm mr-2" x-text="submenu.title + ' (' + submenu.url + ')' "></div>
                        <a :href="_BASEURL + submenu.url" class="text-sm text-primary hover:text-blue-500" target="_blank">Lihat</a>
                    </div>
                    <div class="mt-1">
                        <button @click="editsubMenu(submenu.id)" class="text-yellow-500 text-sm ml-2">Edit</button>
                        <button @click="deleteMenu(submenu.id, 'submenu')" class="text-red-500 text-sm ml-2">Hapus</button>
                    </div>
                </div>
            </template>
        </div>
    </template>

    <!-- Modal Tambah/Edit Menu/Submenu -->
    <template x-if="showModal">
        <div class="fixed inset-0 z-50 flex items-center justify-center bg-black/50">
            <div class="bg-white rounded-lg shadow-lg w-full max-w-md p-6">
                <h2 class="text-lg font-bold mb-4" x-text="modalType === 'create-menu' ? 'Tambah Menu Utama' : (modalType === 'create-submenu' ? 'Tambah Submenu' : 'Edit Menu')"></h2>
                <form @submit.prevent="submitMenu">
                    <!-- Nama Menu -->
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">Nama</label>
                        <input type="text" class="w-full border p-2 rounded" x-model="formData.title" required>
                    </div>

                    <!-- URL -->
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">URL</label>
                        <input type="text" class="w-full border p-2 rounded" x-model="formData.url" required>
                    </div>
                    <!-- URL -->
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">Urutan</label>
                        <input type="number" class="w-full border p-2 rounded" x-model="formData.order_num" required>
                    </div>

                    <!-- Tampilkan Parent ID (hidden) -->
                    <input type="hidden" x-model="formData.id">

                    <!-- Aktif -->
                    <div class="mb-4">
                        <label class="inline-flex items-center">
                            <input type="checkbox" class="form-checkbox" x-model="formData.is_active" :checked="formData.is_active == 1"
                                @change="formData.is_active = $event.target.checked ? 1 : 0" :true-value="1" :false-value="0">
                            <span class="ml-2 text-sm text-gray-700">Aktif</span>
                        </label>
                    </div>

                    <!-- Tombol -->
                    <div class="flex justify-end space-x-2">
                        <button type="button" @click="closeModal" class="px-4 py-2 text-sm bg-gray-400 text-white rounded">Batal</button>
                        <button type="submit" class="px-4 py-2 text-sm bg-blue-600 text-white rounded">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </template>
</div>

<script>
    function menuMg() {
        return {
            showModal: false,
            modalType: '',
            formData: {
                id: null,
                title: '',
                url: '',
                menu_id: null, // NULL = menu utama, isi = submenu
                is_active: true
            },
            menuData: [],
            submenuData: [],

            openModal(type, parentId = null) {
                this.modalType = type;
                this.showModal = true;
                this.formData = {
                    id: null,
                    title: '',
                    url: '',
                    menu_id: parentId,
                    is_active: true
                };
            },

            closeModal() {
                this.showModal = false;
            },
            submitSMenu() {
                alert(JSON.stringify(this.formData))
            },
            async submitMenu() {
                const url = '/admin/menu/save';
                const method = 'POST';

                const response = await this.fetchData(url, method, this.formData);
                if (response && response.status === 'success') {
                    Notifier.show('Berhasil!', response.message, 'success');
                    this.loadMenus();
                    this.closeModal();
                } else {
                    this.errors = response.errors ? response.errors : [];
                    Notifier.show('Gagal!', response ? response.message : 'Terjadi kesalahan.', 'error');
                }
            },

            editMenu(id) {
                const item = this.menuData.find(m => m.id === id);
                if (item) {
                    this.modalType = 'edit';
                    this.showModal = true;
                    this.formData = {
                        ...item
                    };
                }
            },
            editsubMenu(id) {
                const item = this.submenuData.find(m => m.id === id);
                if (item) {
                    this.modalType = 'edit';
                    this.showModal = true;
                    this.formData = {
                        ...item
                    };
                }
            },

            deleteMenu(id, type) {
                if (confirm('Hapus ' + type + ' ini?')) {
                    fetch(`/admin/menu/delete/${id}?type=${type}`, {
                            method: 'GET',
                            headers: {
                                'X-Requested-With': 'XMLHttpRequest',
                            }
                        })
                        .then(res => res.json())
                        .then(data => {
                            if (data.success) {
                                this.loadMenus();
                            } else {
                                alert('Gagal menghapus ' + type);
                            }
                        })
                        .catch(err => {
                            console.error(err);
                            alert('Terjadi kesalahan');
                        });
                }
            },


            async fetchData(url, method = 'GET', body = null) {
                try {
                    const response = await fetch(url, {
                        method,
                        headers: {
                            'Content-Type': 'application/json',
                            'X-Requested-With': 'XMLHttpRequest',
                        },
                        body: body ? JSON.stringify(body) : null,
                    });

                    if (!response.ok) throw new Error('Network error');
                    return await response.json();
                } catch (error) {
                    console.error('Fetch error:', error);
                    return null;
                }
            },

            async loadMenus() {
                const response = await this.fetchData('/admin/menu/list');
                console.log(response);
                if (response) {
                    this.menuData = response.menus || [];
                    this.submenuData = response.submenus || [];
                }
            },

            init() {
                this.loadMenus();
            }
        }
    }
</script>
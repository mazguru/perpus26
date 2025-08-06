function showLoading() {
    document.getElementById('isLoading').style.display = 'flex';
}

function hideLoading() {
    setTimeout(() => {
        document.getElementById('isLoading').style.display = 'none';
    }, 100);
}
function settingsApp(config) {
    return {
        data: '',
        isModalOpen: false,
        editIndex: null,
        editItem: {
            setting_description: '',
            setting_variable: '',
            setting_value: ''
        },
        previewFile: null,
        selectedFile: null,
        errorData: '',
        async fetchData(url, method = 'GET', body = null) {
            try {
                const headers = {
                    'X-Requested-With': 'XMLHttpRequest'
                };
                const isFormData = body instanceof FormData;

                if (!isFormData) headers['Content-Type'] = 'application/json';

                const response = await fetch(url, {
                    method,
                    headers,
                    body: body ? (isFormData ? body : JSON.stringify(body)) : null
                });

                // Handle status error
                if (!response.ok) {
                    const errorText = await response.text();
                    console.error('HTTP Error', response.status, errorText);
                    return null; // fetchData akan return null => tangani di pemanggil
                }

                return await response.json();
            } catch (error) {
                console.error('Fetch error:', error);
                return null;
            }
        },
        async loadSettings() {
            const response = await this.fetchData(_BASEURL + `${config.controller}/list`);
            if (response) {
                this.data = response.data;
            } else {
                Notifier.show('Error', 'Gagal memuat data.', 'error');
            }
        },
        getFieldType(variable) {
            if (this.isDateField(variable)) return "date";
            if (this.isNumberField(variable)) return "number";
            return "text";
        },
        isDateField(variable) {
            return ["site_maintenance_end_date", "decree_operating_permit_date", "date_of_birth"].includes(variable);
        },
        isNumberField(variable) {
            return ["age", "price", "quantity"].includes(variable);
        },
        isUploadField(settingVariable) {
            return ['favicon', 'logo', 'header'].includes(settingVariable);
        },
        isTextArea(settingVariable) {
            return ['meta_description', 'meta_keywords'].includes(settingVariable);
        },
        isOptions(settingVariable) {
            return ['site_maintenance', 'cooming_soon', 'timezone', 'recaptcha_status', 'site_cache', 'default_post_status', 'default_post_visibility', 'default_post_discussion', 'comment_order', 'comment_registration', 'comment_moderation'].includes(settingVariable);
        },
        optionSources: {
            default_post_status: { publish: "Diterbitkan", draft: "Konsep" },
            default_post_visibility: { public: "Publik", private: "Private" },
            default_post_discussion: { open: "Dibuka", close: "Ditutup" },
            comment_order: { asc: "Ascending", desc: "Descending" },
            site_maintenance: { true: 'Ya', false: 'Tidak' },
            comment_moderation: { true: 'Ya', false: 'Tidak' },
            comment_registration: { true: 'Ya', false: 'Tidak' },
            site_cache: { true: 'Ya', false: 'Tidak' },
            timezone: {
                'Asia/Jakarta': 'Asia/Jakarta',
                'Asia/Makassar': 'Asia/Makassar',
                'Asia/Jayapura': 'Asia/Jayapura'
            },
            recaptcha_status: {
                'enable': 'Enable',
                'disable': 'Disable'
            }
        },
        getOptions(key) {
            return this.optionSources[key] || {};
        },
        openEditModal(index) {
            this.editIndex = index;
            this.editItem = {
                ...this.data[index]
            };
            this.isModalOpen = true;
        },
        closeModal() {
            this.isModalOpen = false;
            this.editItem = {
                setting_description: '',
                setting_variable: '',
                setting_value: ''
            };
            this.errorData = '';
            this.selectedFile = null;
        },
        async saveEdit() {

            if (this.isUploadField(this.editItem.setting_variable) && !this.selectedFile) {
                Notifier.show('Error', 'File harus diunggah untuk pengaturan ini.', 'error');
                return;
            }
            this.updateSettingValue();
            if (this.selectedFile) await this.uploadFile();
        },
        async updateSettingValue() {
            const url = _BASEURL + `${config.controller}/save`;
            const response = await this.fetchData(url, 'POST', this.editItem);
            console.log(response);
            if (response.status == 'success') {
                Notifier.show('Berhasil', response.message, response.status);
                this.loadSettings();
                this.closeModal();
            } else {
                this.errorData = response.errors;
                Notifier.show('Gagal', response.message, response.status);
            }

        },
        handleFileChange(event) {
            const file = event.target.files[0];
            const allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];
            if (file && allowedExtensions.includes(file.name.split('.').pop().toLowerCase())) {
                this.selectedFile = file; // Simpan file jika valid
                this.previewFile = URL.createObjectURL(file);
            } else {
                this.selectedFile = null; // Reset jika file tidak valid
                Notifier.show('Error', 'File harus berupa JPG, JPEG, PNG, atau GIF.', 'error');
            }
        },

        async uploadFile() {
            const formData = new FormData();
            formData.append('file', this.selectedFile);
            formData.append('setting_variable', this.editItem.setting_variable);
            formData.append('id', this.editItem.id);

            const response = await this.fetchData(_BASEURL + `${config.controller}/upload`, 'POST', formData);
            if (response && response.status) {
                Notifier.show('Berhasil', response.message, response.status);
                this.loadSettings();
                this.closeModal();
            } else {
                Notifier.show('Gagal', response.message, response.status);
            }
        },

    };
}

function DM(config) {
    return {

        modalType: 'create',
        tableData: [],
        form: {},
        errors: {},
        dataTableInstance: null,
        showModal: false,
        //option
        optionsData: [],

        selectedId: [],

        deleteUrl: _BASEURL + `${config.controller}/delete`,
        editUrl: _BASEURL + `${config.controller}/edit`,
        createUrl: _BASEURL + `${config.controller}/create`,
        restoreUrl: _BASEURL + `${config.controller}/restore`,
        optionsUrl: _BASEURL + `${config.controller}/options`,
        deletePermanentlyUrl: _BASEURL + `${config.controller}/delete_permanently`,

        apiUrl: _BASEURL + `${config.controller}/list/`,

        async fetchData(url, method = 'GET', body = null) {
            showLoading();
            try {
                const response = await fetch(url, {
                    method,
                    headers: { 'Content-Type': 'application/json', 'X-Requested-With': 'XMLHttpRequest', },
                    body: body ? JSON.stringify(body) : null,
                });

                if (!response.ok) throw new Error('Network error');

                return await response.json();
            } catch (error) {
                console.error('Fetch error:', error);
                return null;
            } finally {
                hideLoading();
            }
        },

        async loadData() {
            const response = await this.fetchData(this.apiUrl);
            console.log(response);
            if (response && response.alldata) {
                this.tableData = response.alldata || [];
                this.renderDataTable();
            }
        },

        async loadOptions() {
            const response = await this.fetchData(this.optionsUrl);
            console.log('options', response);
            if (response) {
                this.optionsData = response;
            }
        },

        renderDataTable() {
            const table = document.querySelector('#table-data');

            if (this.dataTableInstance) {
                this.dataTableInstance.clear().rows.add(this.tableData).draw();
            } else {
                this.dataTableInstance = new DataTable(table, {
                    data: this.tableData,
                    columns: [
                        {
                            title: 'No',
                            data: 'id',
                            render: (_, __, row, meta) => meta.row + 1
                        },
                        {
                            data: 'id',
                            orderable: false,
                            title: `<input type="checkbox" @click="selectAll($event)" />`,
                            responsivePriority: 1,
                            render: (data, type, row) =>
                                `<input :value="${row.id}" x-model="selectedId" type="checkbox" />`,
                        },
                        ...config.columns.map(col => ({
                            data: col.key,
                            title: col.label,
                            render: col.render || ((data) => data)
                        })),
                        { // Tambahkan kolom aksi secara otomatis
                            data: null,
                            title: 'Aksi',
                            orderable: false,
                            responsivePriority: 3,
                            render: (data, type, row) => {
                                return `
                                <div x-data="{ isOpen: false }" class="relative inline-block text-left ">
                                        <button @click.prevent="isOpen = !isOpen" class="flex items-center gap-1.5 rounded-md px-3 py-1.5 text-sm bg-blue-200 hover:text-primary dark:bg-meta-4 dark:shadow-none shadow-md hover:bg-blue-400 transition">
                                            Action
                                            <svg class="fill-current" width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M8.00039 11.4C7.85039 11.4 7.72539 11.35 7.60039 11.25L1.85039 5.60005C1.62539 5.37505 1.62539 5.02505 1.85039 4.80005C2.07539 4.57505 2.42539 4.57505 2.65039 4.80005L8.00039 10.025L13.3504 4.75005C13.5754 4.52505 13.9254 4.52505 14.1504 4.75005C14.3754 4.97505 14.3754 5.32505 14.1504 5.55005L8.40039 11.2C8.27539 11.325 8.15039 11.4 8.00039 11.4Z" fill=""></path>
                                            </svg>
                                        </button>
                                        <div
                                            x-show="isOpen"
                                            @click.outside="isOpen = false"
                                            class="absolute right-0 mt-1 w-32 bg-white shadow-lg rounded-md border dark:bg-gray-800 z-50"
                                            style="display: none;">
                                            
                                    ${row.is_deleted == 'true'
                                        ? `<button
                                                class="w-full px-4 py-2 text-left text-black dark:text-white hover:bg-gray-100 flex items-center"
                                                @click="confirmRestore(${row.id})">
                                                <i class="bi mr-2 bi-database-up"></i>
                                                <span>Restore</span>
                                            </button>`
                                        : `<button
                                                class="w-full px-4 py-2 text-left hover:bg-gray-100 flex items-center"
                                                @click="openModal('edit', ${row.id})">
                                                <i class="bi mr-2 bi-pencil-square"></i>
                                                <span>Edit</span>
                                            </button>
                                            <button
                                                class="w-full px-4 py-2 text-left text-sm hover:bg-gray-100 flex items-center"
                                                @click="confirmDelete(${row.id})">
                                                <i class="bi bi-trash3-fill mr-2"></i>
                                                <span>Delete</span>
                                            </button>`
                                    }
                                            
                                        </div>
                                    </div>
                                `;
                            }
                        }
                    ],
                    pageLength: 25,
                    language: {
                        search: '_INPUT_',
                        searchPlaceholder: 'Cari...'
                    },
                    responsive: true,
                    dom: '<"md:flex justify-between mb-2"<"search-box mb-2"f><"info-box"l>>t<"md:flex justify-between mt-2"<"info-box mb-2"i><"pagination"p>>',
                    rowCallback: function (row, data) {
                        if (data.is_deleted == 'true') {
                            row.classList.add("text-red-700"); // Warna merah untuk baris
                            row.style.textDecoration = "line-through";
                        }
                    },
                });
            }
        },


        openModal(type, id = null) {
            this.modalType = type;
            this.showModal = true;

            if (type === 'edit' && id) {
                // Konversi id ke Number jika perlu
                const parsedId = Number(id);
                const dataModal = this.tableData.find(item => Number(item.id) === parsedId);

                if (dataModal) {
                    this.form = { ...dataModal };
                } else {
                    Notifier.show('Error', `Data dengan ID ${id} tidak ditemukan.`, 'error');
                }
            } else {
                this.resetForm();
            }
        },


        closeModal() {
            this.showModal = false;
            this.resetForm();
        },

        resetForm() {
            this.form = {};
        },

        async submitForm() {
            const url = this.modalType === 'create' ? this.createUrl : `${this.editUrl}/${this.form.id}`;
            const method = this.modalType === 'create' ? 'POST' : 'PUT';

            const response = await this.fetchData(url, method, this.form);
            if (response && response.status === 'success') {
                Notifier.show('Berhasil!', response.message, 'success');
                this.loadData();
                this.closeModal();
            } else {
                this.errors = response.errors ? response.errors : [];
                Notifier.show('Gagal!', response ? response.message : 'Terjadi kesalahan.', 'error');
            }
        },
        selectAll(event) {
            const checkboxes = document.querySelectorAll('tbody input[type="checkbox"]');
            this.selectedId = event.target.checked ?
                Array.from(checkboxes).map((checkbox) => checkbox.value) : [];
            checkboxes.forEach((checkbox) => (checkbox.checked = event.target.checked));
        },
        confirmDelete(id) {
            const confirmDelete = confirm('Apakah Anda yakin ingin menghapus data ini?');
            if (!confirmDelete) return;
            this.deleteData([id]);
        },

        confirmDeleteMultiple() {
            const confirmDelete = confirm('Apakah Anda yakin ingin menghapus data ini?');
            if (!confirmDelete) return;
            this.deleteData(this.selectedId);
        },
        async deleteData(ids) {

            const response = await this.fetchData(_BASEURL + `${config.controller}/delete`, 'POST', {
                id: ids
            });

            if (response && response.status === 'success') {
                Notifier.show('Berhasil!', response.message, 'success');
                this.loadData();
                this.selectedId = [];
                document.querySelectorAll('input[type="checkbox"]').forEach(checkbox => {
                    checkbox.checked = false;
                });
            } else {
                Notifier.show('Gagal!', response ? response.message : 'Terjadi kesalahan.', 'error');
            }
        },

        confirmDeletepermanent(id) {
            const confirmDelete = confirm('Apakah Anda yakin ingin menghapus data ini?');
            if (!confirmDelete) return;
            this.deleteDataPermanent([id]);
        },
        async deleteDataPermanent(ids) {
            const response = await this.fetchData(_BASEURL + `${config.controller}/deletepermanent`, 'POST', {
                id: ids
            });

            if (response && response.status === 'success') {
                Notifier.show('Berhasil!', response.message, 'success');
                this.loadData();
                this.selectedId = [];
                document.querySelectorAll('input[type="checkbox"]').forEach(checkbox => {
                    checkbox.checked = false;
                });
            } else {
                Notifier.show('Gagal!', response ? response.message : 'Terjadi kesalahan.', 'error');
            }
        },
        confirmRestore(id) {
            const confirmDelete = confirm('Apakah Anda yakin ingin mengembalikan data ini?');
            if (!confirmDelete) return;
            this.restoreData([id]);
        },
        confirmRestoreMultiple() {
            const confirmDelete = confirm('Apakah Anda yakin ingin mengembalikan data ini?');
            if (!confirmDelete) return;
            this.restoreData(this.selectedId);
        },
        async restoreData(ids) {
            const response = await this.fetchData(_BASEURL + `${config.controller}/restore`, 'POST', {
                id: ids
            });
            if (response && response.status === 'success') {
                Notifier.show('Berhasil!', response.message, 'success');
                this.loadData();
                this.selectedId = [];
                document.querySelectorAll('input[type="checkbox"]').forEach(checkbox => {
                    checkbox.checked = false;
                });
            } else {
                Notifier.show('Gagal!', response ? response.message : 'Terjadi kesalahan.', 'error');
            }
        },

    };
}

function mgrData(config) {
    return {
        showModal: false,
        modalTitle: 'Tambah Album',
        modalType: 'create',
        form: {},
        tableData: [],
        previewFile: null,
        dataTableInstance: null,
        errorData: {},
        selectedId: [],

        errors: {},


        deleteUrl: _BASEURL + `${config.controller}/delete`,
        editUrl: _BASEURL + `${config.controller}/edit`,
        createUrl: _BASEURL + `${config.controller}/create`,
        restoreUrl: _BASEURL + `${config.controller}/restore`,

        async fetchData(url, method = 'GET', body = null) {
            try {
                const headers = {
                    'X-Requested-With': 'XMLHttpRequest'
                };
                const isFormData = body instanceof FormData;

                if (!isFormData) headers['Content-Type'] = 'application/json';

                const response = await fetch(url, {
                    method,
                    headers,
                    body: body ? (isFormData ? body : JSON.stringify(body)) : null
                });

                const responseText = await response.text(); // baca hanya sekali

                if (!response.ok) {
                    console.error('HTTP Error', response.status, responseText);
                    // coba parse jika mungkin JSON
                    try {
                        const errorJson = JSON.parse(responseText);
                        return errorJson;
                    } catch (e) {
                        return {
                            status: 'error',
                            message: 'Terjadi kesalahan pada server.',
                            debug: responseText
                        };
                    }
                }

                // parse jika response OK
                return JSON.parse(responseText);
            } catch (error) {
                console.error('Fetch error:', error);
                return null;
            }
        },
        async loadData() {
            const response = await this.fetchData(_BASEURL + `${config.controller}/list`);
            console.log(response);
            if (response) {
                this.tableData = response.alldata;
                this.renderDataTable();
            } else {
                Notifier.show('Error', 'Gagal memuat data.', 'error');
            }
        },

        renderDataTable() {
            const table = document.querySelector('#table-data');
            if (this.dataTableInstance) {
                this.dataTableInstance.clear().rows.add(this.tableData).draw();
            } else {
                this.dataTableInstance = new DataTable(table, {
                    data: this.tableData,
                    columns: [{
                        title: 'No',
                        data: 'id',
                        render: (_, __, row, meta) => meta.row + 1
                    },
                    {
                        data: 'id',
                        orderable: false,
                        title: `<input type="checkbox" @click="selectAll($event)" />`,
                        responsivePriority: 1,
                        render: (data, type, row) =>
                            `<input :value="${row.id}" x-model="selectedId" type="checkbox" />`,
                    },
                    ...config.columns.map(col => ({
                        data: col.key,
                        title: col.label,
                        orderable: col.orderable ?? true,
                        responsivePriority: col.priority ?? 10,
                        render: col.render || ((data) => data)
                    })),
                    ],
                    pageLength: 25,
                    language: {
                        search: '_INPUT_',
                        searchPlaceholder: 'Cari...'
                    },
                    responsive: true,
                    dom: '<"md:flex justify-between mb-2"<"search-box mb-2"f><"info-box"l>>t<"md:flex justify-between mt-2"<"info-box mb-2"i><"pagination"p>>',
                    rowCallback: function (row, data) {
                        if (data.is_deleted == 'true') {
                            row.classList.add("text-red-700"); // Warna merah untuk baris
                            row.style.textDecoration = "line-through";
                        }
                    },
                });
            }
        },
        openModal(type, id = null) {
            this.modalType = type;
            this.showModal = true;
            this.errorData = {};
        },

        closeModal() {
            this.showModal = false;
            this.resetForm();
            this.errorData = {};
        },

        resetForm() {
            this.form = {};
        },

        generateSlug(str) {
            return str
                .toLowerCase()
                .replace(/[^a-z0-9\s-]/g, '')
                .replace(/\s+/g, '-')
                .replace(/-+/g, '-');
        },

        handleCoverUpload(event) {
            const file = event.target.files[0];
            if (file) {
                this.form.image_cover = file;
                this.previewFile = URL.createObjectURL(file);
            }
        },

        editData(id) {
            const item = this.tableData.find(m => m.id == id); // gunakan == agar type fleksibel

            if (item) {
                this.form = {
                    ...item
                };
                this.previewFile = item.image_cover ?
                    _BASEURL + `media_library/images/${item.image_cover}` :
                    null;

                this.modalType = 'edit';
                this.showModal = true;
            } else {
                Notifier.show('Error', 'Data tidak ditemukan', 'error');
            }
        },

        confirmDelete(id) {
            const confirmDelete = confirm('Apakah Anda yakin ingin menghapus data ini?');
            if (!confirmDelete) return;
            this.deleteData([id]);
        },

        confirmDeleteMultiple() {
            const confirmDelete = confirm('Apakah Anda yakin ingin menghapus data ini?');
            if (!confirmDelete) return;
            this.deleteData(this.selectedId);
        },
        async deleteData(ids) {

            const response = await this.fetchData(_BASEURL + `${config.controller}/delete`, 'POST', {
                id: ids
            });

            if (response && response.status === 'success') {
                Notifier.show('Berhasil!', response.message, 'success');
                this.loadData();
                this.selectedId = [];
                document.querySelectorAll('input[type="checkbox"]').forEach(checkbox => {
                    checkbox.checked = false;
                });
            } else {
                Notifier.show('Gagal!', response ? response.message : 'Terjadi kesalahan.', 'error');
            }
        },

        confirmDeletepermanent() {
            const confirmDelete = confirm('Apakah Anda yakin ingin menghapus data ini?');
            if (!confirmDelete) return;
            this.deleteDataPermanent(this.selectedId);
        },
        async deleteDataPermanent(ids) {
            const response = await this.fetchData(_BASEURL + `${config.controller}/deletepermanent`, 'POST', {
                id: ids
            });
            console.log(response);
            if (response && response.status === 'success') {
                Notifier.show('Berhasil!', response.message, 'success');
                this.loadData();
                this.selectedId = [];
                document.querySelectorAll('input[type="checkbox"]').forEach(checkbox => {
                    checkbox.checked = false;
                });
            } else {
                Notifier.show('Gagal!', response ? response.message : 'Terjadi kesalahan.', 'error');
            }
        },
        confirmRestore(id) {
            const confirmDelete = confirm('Apakah Anda yakin ingin mengembalikan data ini?');
            if (!confirmDelete) return;
            this.restoreData([id]);
        },
        confirmRestoreMultiple() {
            const confirmDelete = confirm('Apakah Anda yakin ingin mengembalikan data ini?');
            if (!confirmDelete) return;
            this.restoreData(this.selectedId);
        },
        async restoreData(ids) {
            const response = await this.fetchData(_BASEURL + `${config.controller}/restore`, 'POST', {
                id: ids
            });
            if (response && response.status === 'success') {
                Notifier.show('Berhasil!', response.message, 'success');
                this.loadData();
                this.selectedId = [];
                document.querySelectorAll('input[type="checkbox"]').forEach(checkbox => {
                    checkbox.checked = false;
                });
            } else {
                Notifier.show('Gagal!', response ? response.message : 'Terjadi kesalahan.', 'error');
            }
        },

        selectAll(event) {
            const checkboxes = document.querySelectorAll('tbody input[type="checkbox"]');
            this.selectedId = event.target.checked ?
                Array.from(checkboxes).map((checkbox) => checkbox.value) : [];
            checkboxes.forEach((checkbox) => (checkbox.checked = event.target.checked));
        },

        async submitForm() {
            let url = this.form.id ?
                _BASEURL + `${config.controller}/update/${this.form.id}` :
                _BASEURL + `${config.controller}/create`;

            const formData = new FormData();
            for (const key in this.form) {
                formData.append(key, this.form[key]);
            }

            // Pastikan elemen file dimasukkan (gunakan ref atau cara lain)
            const imageInput = document.querySelector('input[name="image_cover"]');
            if (imageInput && imageInput.files.length > 0) {
                formData.append('image_cover', imageInput.files[0]);
            }

            const res = await this.fetchData(url, 'POST', formData);
            if (res && res.status === 'success') {
                this.showModal = false;
                Notifier.show('Berhasil', res.message, 'success');
                this.loadData();
                this.resetForm();
            } else {
                this.errorData = res.errors ?? {};
                Notifier.show('Error', res?.message || 'Gagal memproses data.', 'error');
            }
        },

        goLink(url) {
            window.location.href = url;
        },
        addContent() {
            window.location.href = this.createUrl;
        },
        editContent(id) {
            window.location.href = this.editUrl + '/' + id;
        }

    };
}

function postingan(config) {
    return {
        baseUrl: _BASEURL + config.dirUpload,
        tableData: '',
        isModalOpen: false,
        editIndex: null,
        editItem: {
            setting_description: '',
            setting_variable: '',
            setting_value: ''
        },
        selectedFile: null,
        errorData: '',
        async fetchData(url, method = 'GET', body = null) {
            try {
                const headers = {
                    'X-Requested-With': 'XMLHttpRequest'
                };
                const isFormData = body instanceof FormData;

                if (!isFormData) headers['Content-Type'] = 'application/json';

                const response = await fetch(url, {
                    method,
                    headers,
                    body: body ? (isFormData ? body : JSON.stringify(body)) : null
                });

                // Handle status error
                if (!response.ok) {
                    const errorText = await response.text();
                    console.error('HTTP Error', response.status, errorText);
                    return null; // fetchData akan return null => tangani di pemanggil
                }

                return await response.json();
            } catch (error) {
                console.error('Fetch error:', error);
                return null;
            }
        },
        async loadPosts() {
            const response = await this.fetchData(_BASEURL + `${config.controller}/list`);
            console.log(response);
            if (response) {
                this.tableData = response;
                this.renderDataTable();
            } else {
                Notifier.show('Error', 'Gagal memuat data.', 'error');
            }
        },

        renderDataTable() {
            const table = document.querySelector('#table-posts');
            if (this.dataTableInstance) {
                this.dataTableInstance.clear().rows.add(this.tableData).draw();
            } else {
                this.dataTableInstance = new DataTable(table, {
                    data: this.tableData,
                    columns: [{
                        title: 'No',
                        data: 'id',
                        responsivePriority: 1,
                        render: (_, __, row, meta) => meta.row + 1
                    },
                    ...config.columns.map(col => ({
                        data: col.key,
                        title: col.label,
                        orderable: col.orderable ?? true,
                        responsivePriority: col.priority ?? 10,
                        render: col.render || ((data) => data)
                    })),
                    ],
                    pageLength: 25,
                    language: {
                        search: '_INPUT_',
                        searchPlaceholder: 'Cari...'
                    },
                    responsive: true,
                    dom: '<"md:flex justify-between mb-2"<"search-box mb-2"f><"info-box"l>>t<"md:flex justify-between mt-2"<"info-box mb-2"i><"pagination"p>>',
                    rowCallback: function (row, data) {
                        if (data.is_deleted == 'true') {
                            row.classList.add("text-red-700"); // Warna merah untuk baris
                            row.style.textDecoration = "line-through";
                        }
                    },
                });
            }
        },
        editPost(id) {
            window.location.href = _BASEURL + config.controller + '/create/' + id
        },
        addPost() {
            window.location.href = _BASEURL + config.controller + '/create'
        }

    };
}

function dashboardData() {
    return {
        app: {},
        visitor: {},
        stats: {},
        latest: {},
        categories: {},
        comments: {},
        async fetchData(url, method = 'GET', body = null) {
            try {
                const headers = {
                    'X-Requested-With': 'XMLHttpRequest'
                };
                const isFormData = body instanceof FormData;

                if (!isFormData) headers['Content-Type'] = 'application/json';

                const response = await fetch(url, {
                    method,
                    headers,
                    body: body ? (isFormData ? body : JSON.stringify(body)) : null
                });

                // Handle status error
                if (!response.ok) {
                    const errorText = await response.text();
                    console.error('HTTP Error', response.status, errorText);
                    return null; // fetchData akan return null => tangani di pemanggil
                }

                return await response.json();
            } catch (error) {
                console.error('Fetch error:', error);
                return null;
            }
        },
        async loadDashboard() {
            const response = await this.fetchData(_BASEURL + `dashboard/stats`);
            console.log(response);
            if (response) {
                this.stats = response.stats;
                this.visitor = response.visitor;
                this.app = response.app;
                this.latest = response.post;
                this.categories = response.categories;
                this.comments = response.comment;
                this.renderChart();
                this.renderCategoriesChart();
            } else {
                Notifier.show('Error', 'Gagal memuat data.', 'error');
            }
        },
        renderChart() {
            if (!this.visitor || !this.visitor.label) return;

            const ctx = this.$refs.canvas.getContext('2d');

            if (this.chart) {
                this.chart.destroy(); // Hancurkan jika sudah ada chart sebelumnya
            }

            this.chart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: this.visitor.label,
                    datasets: [{
                        label: 'Jumlah Pengunjung',
                        data: this.visitor.data,
                        backgroundColor: 'rgba(79, 70, 229, 0.1)',
                        borderColor: 'rgba(79, 70, 229, 1)',
                        borderWidth: 2,
                        tension: 0.3,
                        fill: true
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: false
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            grid: {
                                display: true,
                                color: 'rgba(0, 0, 0, 0.05)'
                            }
                        },
                        x: {
                            grid: {
                                display: false
                            }
                        }
                    }
                }
            });
        },
        renderCategoriesChart() {
            if (!this.categories || !this.categories.label) return;

            const ctx = this.$refs.categoriesCanvas.getContext('2d');

            if (this.categoriesChart) {
                this.categoriesChart.destroy();
            }

            this.categoriesChart = new Chart(ctx, {
                type: 'doughnut',
                data: {
                    labels: this.categories.label,
                    datasets: [{
                        data: this.categories.data,
                        backgroundColor: [
                            'rgba(59, 130, 246, 0.8)',
                            'rgba(16, 185, 129, 0.8)',
                            'rgba(245, 158, 11, 0.8)',
                            'rgba(239, 68, 68, 0.8)'
                        ],
                        borderWidth: 0
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            position: 'bottom',
                            labels: {
                                color: '#4B5563', // teks abu
                                font: { size: 12 }
                            }
                        }
                    },
                    cutout: '70%'
                }
            });
        }

    }
}
function stripTagsTruncate(str, length = 150) {
    // Hapus tag HTML
    const stripped = str.replace(/<\/?[^>]+(>|$)/g, '');

    if (stripped.length <= length) {
        return stripped;
    }

    // Potong string
    let truncated = stripped.substring(0, length);

    // Potong di spasi terakhir agar tidak memotong kata
    const lastSpace = truncated.lastIndexOf(' ');
    if (lastSpace !== -1) {
        truncated = truncated.substring(0, lastSpace);
    }

    return truncated.trim() + '...';
}


function timeAgo(datetime) {
    const now = new Date();
    const past = new Date(datetime.replace(' ', 'T')); // ISO-compatible
    const seconds = Math.floor((now - past) / 1000);

    const intervals = [
        { label: 'tahun', seconds: 31536000 },
        { label: 'bulan', seconds: 2592000 },
        { label: 'hari', seconds: 86400 },
        { label: 'jam', seconds: 3600 },
        { label: 'menit', seconds: 60 },
        { label: 'detik', seconds: 1 }
    ];

    for (const interval of intervals) {
        const count = Math.floor(seconds / interval.seconds);
        if (count > 0) {
            return `${count} ${interval.label}${count > 1 ? '' : ''} yang lalu`;
        }
    }

    return 'baru saja';
}

function postForm(config) {
    return {
        form: {
            post_title: '',
            post_slug: '',
            post_content: '',
            post_categories: [],
            post_status: 'publish',
            post_type: 'post',
            post_visibility: 'public',
            post_comment_status: 'open',
            created_at: new Date().toLocaleString("sv-SE", {
                timeZone: "Asia/Jakarta",
                hour12: false,
            }).replace(" ", "T").slice(0, 16),
            post_tags: ''
        },

        previewFile: null,
        curent_tumb: '',

        postId: config.post_id,
        type: config.type_crud,

        categories: '',
        errors: [],

        errorMessage: '',
        generateSlug() {
            this.form.post_slug = this.form.post_title
                .toLowerCase()
                .replace(/[^\w\s-]/g, '')
                .replace(/\s+/g, '-')
                .replace(/--+/g, '-');
        },
        validateForm() {
            if (!this.form.post_title.trim()) {
                this.errorMessage = 'Judul tidak boleh kosong.';
                return;
            }
            if (!this.form.post_content.trim()) {
                this.errorMessage = 'Isi post tidak boleh kosong.';
                return;
            }
            if (!this.form.post_categories) {
                this.errorMessage = 'Kategori harus dipilih.';
                return;
            }
            this.errorMessage = '';
            this.submitForm();
            console.log(this.form)
        },

        async submitForm() {
            const url = _BASEURL + config.controller + '/store';
            const method = 'POST';

            const formData = new FormData();
            for (const key in this.form) {
                formData.append(key, this.form[key]);
            }

            // Pastikan elemen file dimasukkan (gunakan ref atau cara lain)
            const imageInput = document.querySelector('input[name="post_image"]');
            if (imageInput && imageInput.files.length > 0) {
                formData.append('post_image', imageInput.files[0]);
            }

            const response = await this.fetchData(url, method, formData);

            console.log(response);

            if (response && response.status === 'success') {
                Notifier.show('Berhasil!', response.message, 'success');
                this.form.id = response.id;
            } else {
                this.errors = response.errors ? response.errors : [];
                Notifier.show('Gagal!', response ? response.message : 'Terjadi kesalahan.', 'error');
            }
        },
        init() {
            this.loadCategories();
            this.initTinymce()
            if (this.type === 'edit' && this.postId) {
                this.loadPostById(this.postId);
            }
        },

        async fetchData(url, method = 'GET', body = null) {
            try {
                const headers = {
                    'X-Requested-With': 'XMLHttpRequest'
                };

                // Jangan set Content-Type jika pakai FormData, browser akan otomatis menambahkan boundary
                const isFormData = body instanceof FormData;
                if (!isFormData) headers['Content-Type'] = 'application/json';

                const response = await fetch(url, {
                    method,
                    headers,
                    body: body ? (isFormData ? body : JSON.stringify(body)) : null
                });

                if (!response.ok) {
                    const errorText = await response.text();
                    console.error('HTTP Error', response.status, errorText);
                    return null;
                }

                return await response.json();
            } catch (error) {
                console.error('Fetch error:', error);
                return null;
            }
        },
        async loadCategories() {
            const response = await this.fetchData(_BASEURL + `${config.controller}/categories`);
            console.log(response);
            if (response) {
                this.categories = response.categories;
            } else {
                Notifier.show('Error', 'Gagal memuat data.', 'error');
            }
        },

        async loadPostById(id) {
            const response = await this.fetchData(_BASEURL + `${config.controller}/postid/${this.postId}`);
            console.log(response);
            if (response) {
                this.form = response;
                const date = new Date(response.created_at.replace(' ', 'T')); // '2025-07-31T22:23:07'
                this.form.created_at = date.toLocaleString("sv-SE", {
                    timeZone: "Asia/Jakarta",
                    hour12: false,
                }).replace(" ", "T").slice(0, 16);
                this.form.post_tags = response.post_tags ? response.post_tags : '';
            } else {
                Notifier.show('Error', 'Gagal memuat data.', 'error');
            }
        },

        resetForm() {
            this.form = {
                post_title: '',
                post_content: '',
                category_id: '',
                post_status: 'publish',
                post_image: '',
                post_type: 'post',
            };
        },
        selectCategory(id) {
            this.form.post_categories = this.form.post_categories === id ? null : id;
        },
        handleFile(event) {
            const file = event.target.files[0];
            const allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];
            const imageFile = this.$refs.post_image?.files[0];

            if (file && allowedExtensions.includes(file.name.split('.').pop().toLowerCase())) {
                if (imageFile) {
                    this.form.post_image = imageFile;
                }
                this.previewFile = URL.createObjectURL(file);
            } else {
                this.form.post_image = null; // Reset jika file tidak valid
                Notifier.show('Error', 'File harus berupa JPG, JPEG, PNG, atau GIF.', 'error');
            }
        },

        initTinymce() {
            tinymce.init({
                selector: "#post_content",
                theme: 'modern',
                paste_data_images: true,
                relative_urls: false,
                remove_script_host: false,
                toolbar1: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image",
                toolbar2: "print preview forecolor backcolor emoticons",
                image_advtab: true,
                plugins: [
                    "advlist autolink lists link image charmap print preview hr anchor pagebreak",
                    "searchreplace wordcount visualblocks visualchars code fullscreen",
                    "insertdatetime nonbreaking save table contextmenu directionality",
                    "emoticons template paste textcolor colorpicker textpattern"
                ],
                automatic_uploads: true,
                file_picker_types: 'image',
                file_picker_callback: function (cb, value, meta) {
                    var input = document.createElement('input');
                    input.setAttribute('type', 'file');
                    input.setAttribute('accept', 'image/*');
                    input.onchange = function () {
                        var file = this.files[0];
                        var reader = new FileReader();
                        reader.readAsDataURL(file);
                        reader.onload = function () {
                            var id = 'post-image-' + (new Date()).getTime();
                            var blobCache = tinymce.activeEditor.editorUpload.blobCache;
                            var blobInfo = blobCache.create(id, file, reader.result);
                            blobCache.add(blobInfo);
                            cb(blobInfo.blobUri(), {
                                title: file.name
                            });
                        };
                    };
                    input.click();
                },
                images_upload_handler: function (blobInfo, success, failure) {
                    var xhr, formData;
                    xhr = new XMLHttpRequest();
                    xhr.withCredentials = false;
                    xhr.open('POST', _BASEURL + 'blog/posts/uploadimageeditor');
                    xhr.onload = function () {
                        if (xhr.status != 200) {
                            failure('HTTP Error: ' + xhr.status);
                            return;
                        }
                        var res = JSON.parse(xhr.responseText);
                        console.log(res.location);
                        if (res.status == 'error') {
                            failure(res.message);
                            return;
                        }
                        success(res.location);
                    };
                    formData = new FormData();
                    formData.append('file', blobInfo.blob(), blobInfo.filename());
                    xhr.send(formData);
                },

                setup: (editor) => {
                    editor.on('init', () => {
                        editor.setContent(this.form.post_content); // Set initial content
                    });
                    editor.on('change input', () => {
                        this.form.post_content = editor.getContent(); // Sync with Alpine.js state
                    });
                }
            });
        }
    }
}

function photoManager(config) {
    return {
      showModal: false,
      albumId: config.id,
      photos: {},

      init() {
        this.loadPhotos()
      },

      openModal() {
        this.showModal = true;
      },
      closeModal() {
        this.showModal = false;
      },

      async loadPhotos() {
        try {
          const res = await fetch(_BASEURL + "media/albums/photos/" + this.albumId, {
            method: 'GET',
            headers: {
              'X-Requested-With': 'XMLHttpRequest'
            }
          });

          if (res.ok) {
            const data = await res.json(); // Ambil JSON dari response
            this.photos = data.photos || []; // Pastikan bentuk responsnya { photos: [...] }
          } else {
            console.error('HTTP Error:', res.status);
            alert('Gagal memuat foto');
          }
        } catch (error) {
          console.error('Fetch Error:', error);
          alert('Terjadi kesalahan saat memuat data');
        }
      },


      async submitUpload() {
        const form = new FormData();
        const input = document.querySelector('input[type=file]');
        const files = input.files;

        if (files.length === 0) return;

        for (let i = 0; i < files.length; i++) {
          form.append('photos[]', files[i]);
        }
        form.append('photo_album_id', this.albumId);

        try {
          const res = await fetch(_BASEURL + "media/albums/upload-image", {
            method: 'POST',
            body: form
          });

          const data = await res.json(); // pastikan response server berupa JSON

          if (res.ok && data.status === 'success') {
            Notifier.show(data.message || 'Foto berhasil diunggah', 'success');
            this.loadPhotos();
            this.closeModal();
          } else {
            Notifier.show(data.message || 'Gagal mengunggah foto', 'error');
          }
        } catch (error) {
          console.error(error);
          Notifier.show('Terjadi kesalahan saat mengunggah foto', 'error');
        }
      },


      async deletePhoto(id) {
        if (!confirm('Yakin ingin menghapus foto ini?')) return;

        try {
          const res = await fetch(_BASEURL + 'media/albums/delete-photos/' + id, {
            method: 'POST'
          });

          const data = await res.json();

          if (res.ok && data.status === 'success') {
            this.photos = this.photos.filter(p => p.id !== id);
            Notifier.show(data.message || 'Foto berhasil dihapus', 'success');
          } else {
            Notifier.show(data.message || 'Gagal menghapus foto', 'error');
          }
        } catch (error) {
          console.error(error);
          Notifier.show('Terjadi kesalahan saat menghapus foto', 'error');
        }
      }

    }
  }

  function videoModal() {
        return {
            videoOpen: false,
            videoSrc: '',
            openVideo(id) {
                this.videoSrc = `https://www.youtube.com/embed/${id}?autoplay=1`;
                this.videoOpen = true;
            },
            closeVideo() {
                this.videoOpen = false;
                this.videoSrc = '';
            }
        }
    }
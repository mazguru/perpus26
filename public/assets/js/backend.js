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
        baseUrl: _BASEURL + config.dirUpload,
        data: '',
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
        async loadSettings() {
            const response = await this.fetchData(_BASEURL + `${config.controller}/get_settings`);
            if (response) {
                this.data = response;
            } else {
                Swal.fire('Error', 'Gagal memuat data.', 'error');
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
            return ['site_maintenance', 'cooming_soon', 'timezone', 'recaptcha_status', 'site_cache'].includes(settingVariable);
        },
        optionSources: {
            site_maintenance: { true: 'Ya', false: 'Tidak' },
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
                Swal.fire('Error', 'File harus diunggah untuk pengaturan ini.', 'error');
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
            } else {
                this.selectedFile = null; // Reset jika file tidak valid
                Swal.fire('Error', 'File harus berupa JPG, JPEG, PNG, atau GIF.', 'error');
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
        isModalOpen: false,
        isMove: config.is_move ?? false,
        isAddUser: config.is_add_user ?? false,
        modalType: 'create',
        tableData: [],
        form: {},
        errors: {},
        dataTableInstance: null,

        //option
        optionsData: [],

        selectedId: [],

        deleteUrl: _BASEURL + `${config.controller}/delete`,
        editUrl: _BASEURL + `${config.controller}/edit`,
        createUrl: _BASEURL + `${config.controller}/create`,
        restoreUrl: _BASEURL + `${config.controller}/restore`,
        optionsUrl: _BASEURL + `${config.controller}/options`,
        deletePermanentlyUrl: _BASEURL + `${config.controller}/delete_permanently`,

        apiUrl : _BASEURL + `${config.controller}/list/`,
        get formattedDateLahir() {
            if (!this.tableData.tanggal_lahir) return '';
            let [year, month, day] = this.tableData.tanggal_lahir.split('-');
            let months = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
            return `${parseInt(day)} ${months[parseInt(month) - 1]} ${year}`;
        },

        //button
        add_button: config.add_button ?? false,

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

        async loadDataTable() {
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
            const table = document.querySelector('#table-reference');

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
                                            
                                    ${row.is_deleted == 1
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
                        if (data.is_deleted == 1) {
                            row.classList.add("text-red-700"); // Warna merah untuk baris
                            row.style.textDecoration = "line-through";
                        }
                    },
                });
            }
        },


        openModal(type, id = null) {
            this.modalType = type;
            this.isModalOpen = true;

            if (type === 'edit' && id) {
                // Konversi id ke Number jika perlu
                const parsedId = Number(id);
                const dataModal = this.tableData.find(item => Number(item.id) === parsedId);

                if (dataModal) {
                    this.form = { ...dataModal };
                } else {
                    Swal.fire('Error', `Data dengan ID ${id} tidak ditemukan.`, 'error');
                }
            } else {
                this.resetForm();
            }
        },


        closeModal() {
            this.isModalOpen = false;
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
                Swal.fire('Berhasil!', response.message, 'success');
                this.loadDataTable();
                this.closeModal();
            } else {
                this.errors = response.errors ? response.errors : [];
                Swal.fire('Gagal!', response ? response.message : 'Terjadi kesalahan.', 'error');
            }
        },

        async deleteData(ids) {
            const response = await this.fetchData(`${this.deleteUrl}`, 'DELETE', { id: ids });
            if (response && response.status === 'success') {
                Swal.fire('Berhasil!', response.message, 'success');
                this.loadDataTable();
                this.selectedId = [];
                document.querySelectorAll('input[type="checkbox"]').forEach(checkbox => {
                    checkbox.checked = false;
                });
            } else {
                Swal.fire('Gagal!', response ? response.message : 'Terjadi kesalahan.', 'error');
            }
        },
        async deletePermanently(ids) {
            const response = await this.fetchData(`${this.deletePermanentlyUrl}`, 'DELETE', { id: ids });
            if (response && response.status === 'success') {
                Swal.fire('Berhasil!', response.message, 'success');
                this.loadDataTable();
                this.selectedId = [];
                document.querySelectorAll('input[type="checkbox"]').forEach(checkbox => {
                    checkbox.checked = false;
                });
            } else {
                Swal.fire('Gagal!', response ? response.message : 'Terjadi kesalahan.', 'error');
            }
        },

        confirmDelete(id) {
            Swal.fire({
                title: 'Yakin ingin menghapus?',
                text: 'Data yang dihapus tidak dapat dikembalikan!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ya, hapus!',
            }).then((result) => {
                if (result.isConfirmed) this.deleteData([id]);
                this.loadDataTable();
            });
        },
        confirmDeleteMultiple() {
            Swal.fire({
                title: 'Yakin ingin menghapus?',
                text: 'Data yang dihapus kemungkinan tidak dapat dikembalikan!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ya, hapus!',
            }).then((result) => {
                if (result.isConfirmed) this.deleteData(this.selectedId);
            });
        },
        confirmDeletePermanently() {
            Swal.fire({
                title: 'Yakin ingin menghapus?',
                text: 'Data yang dihapus kemungkinan tidak dapat dikembalikan!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ya, hapus!',
            }).then((result) => {
                if (result.isConfirmed) this.deletePermanently(this.selectedId);
            });
        },
        async restoreData(ids) {
            const response = await this.fetchData(`${this.restoreUrl}`, 'POST', { id: ids });
            if (response && response.status === 'success') {
                Swal.fire('Berhasil!', response.message, 'success');
                this.loadDataTable();
                this.selectedId = [];
                document.querySelectorAll('input[type="checkbox"]').forEach(checkbox => {
                    checkbox.checked = false;
                });
            } else {
                Swal.fire('Gagal!', response ? response.message : 'Terjadi kesalahan.', 'error');
            }
        },
        confirmRestore(id) {
            Swal.fire({
                title: 'Yakin ingin mengembalikan?',
                text: 'Data ini akan didikembalikan.',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ya, Kembalikan!',
                cancelButtonText: 'Batal',
            }).then((result) => {
                if (result.isConfirmed) this.restoreData([id]);
                this.loadDataTable();
            });
        },
        confirmRestoreMultiple() {
            Swal.fire({
                title: 'Yakin ingin mengembalikan?',
                text: 'Data ini akan didikembalikan.',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ya, Kembalikan!',
                cancelButtonText: 'Batal',
            }).then((result) => {
                if (result.isConfirmed) this.restoreData(this.selectedId);
            });
        },
        selectAll(event) {
            const checkboxes = document.querySelectorAll('tbody input[type="checkbox"]');
            this.selectedId = event.target.checked ?
                Array.from(checkboxes).map((checkbox) => checkbox.value) : [];
            checkboxes.forEach((checkbox) => (checkbox.checked = event.target.checked));
        },
        //Untuk pindah students//
        classId: '',
        academicYearsMove: null,
        isModalMoveStudents: false,
        classes: [],
        openMoveModal() {
            if (!this.selectedId.length) {
                Swal.fire('Warning', 'Silakan pilih setidaknya satu siswa.', 'warning');
                return;
            }
            this.loadOptions();
            this.openModalMoveStudents();

        },

        openModalMoveStudents() {
            this.isModalMoveStudents = true;
        },

        closeModalMoveStudents() {
            this.isModalMoveStudents = false;
            this.selectedId = [];
        },

        filterClasses() {
            const allClasses = this.optionsData.classes;
            this.classes = allClasses.filter(
                (cls) => cls.academic_year_id == this.academicYearsMove
            );

            console.log('Tahun ajaran yang dipilih:', this.academicYearsMove);
            console.log('Semua kelas tersedia:', allClasses);
            console.log('Kelas setelah difilter:', this.classes);
        },
        async submitMoveStudent() {
            if (!this.academicYearsMove || !this.classId) {
                Swal.fire('Warning', 'Silakan pilih tahun ajaran dan kelas.', 'warning');
                return;
            }

            const response = await this.fetchData(_BASEURL + `${config.controller}/move_to_class`,
                'POST', {
                student_ids: this.selectedId,
                academic_year: this.academicYearsMove,
                class_id: this.classId
            });

            if (response?.status === 'success') {
                Notifier.show('Berhasil!', response.message, 'success');

                this.closeModalMoveStudents(); // Harus pakai ()
                this.loadDataTable(); // Harus pakai ()
            } else {
                Notifier.show('Gagal!', response?.message || 'Kesalahan tidak diketahui.', 'red');
            }
        },


        //end pindah students

        async addUsersData(sIds) {
            const response = await this.fetchData(_BASEURL + `${config.controller}/add_users`,
                'POST', {
                ids: sIds
            }
            );

            if (response?.status === 'success') {
                Swal.fire('Berhasil!', response.message, 'success').then(() => location.reload());
            } else {
                Swal.fire('Gagal!', response?.message || 'Kesalahan tidak diketahui.', 'error');
            }
        },

        // Fungsi untuk konversi data siswa terpilih menjadi pengguna
        confirmAddUsersMultiple() {
            if (this.selectedId.length === 0) {
                SwalUtils.warning('Silakan pilih setidaknya satu siswa.', 'Tidak Ada Siswa Dipilih');
                return;
            }

            SwalUtils.confirm(
                'Yakin ingin mengonversi data siswa terpilih menjadi pengguna?', 'Konfirmasi',
                () => {
                    this.addUsersData(this.selectedId); // Mengirimkan array ID siswa terpilih
                }
            );
        },
    };
}


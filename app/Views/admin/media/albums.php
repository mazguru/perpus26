<div x-data="mgrData(config)" x-init="loadData()">
    <div class="p-4 bg-white shadow-md border-b border-gray-200">
        <div class="mb-4">
            <h1 class="text-2xl font-semibold"><?= $title ?></h1>
        </div>
        <div class="flex justify-between items-center mb-4">
            <p class="text-sm">Menampilkan daftar album foto dan video</p>
            <button @click="openModal('create')" class="bg-cyan-600 hover:bg-cyan-700 text-white px-3 py-2 rounded text-sm">
                <i class="bi bi-plus-lg mr-2"></i> Tambah Album
            </button>
        </div>
    </div>
    <div class="bg-white dark:bg-boxdark shadow-md rounded-b border-b p-4 table-striped table-hover">
        <table id="table-data" class="table-auto w-full border-collapse border">
        </table>
    </div>
    <!-- Modal -->
    <template x-if="showModal">
        <div class="fixed inset-0 bg-black/50 z-99 flex items-center justify-center">
            <div class="bg-white rounded-xl p-6 w-full max-w-lg">
                <h2 class="text-xl font-semibold mb-4" x-text="modalType === 'create' ? 'Tambah Album' : 'Edit Album'"></h2>
                <form @submit.prevent="submitForm" enctype="multipart/form-data">
                    <div class="mb-4">
                        <label class="block text-sm font-semibold mb-1">Judul</label>
                        <input type="text" x-model="form.album_title" @input="generateSlug"
                            class="w-full border rounded px-3 py-2" required>
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-semibold mb-1">Slug</label>
                        <input type="text" x-model="form.album_slug" class="w-full border rounded px-3 py-2 bg-gray-100" readonly>
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-semibold mb-1">Deskripsi</label>
                        <textarea x-model="form.album_description" class="w-full border rounded px-3 py-2"></textarea>
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-semibold mb-1">Cover</label>
                        <input name="image_cover" type="file" @change="handleCoverUpload" accept="image/*"
                            class="w-full border rounded px-3 py-2">
                        <template x-if="previewFile">
                            <img :src="previewFile" class="mt-2 w-32 h-32 object-cover rounded">
                        </template>
                    </div>

                    <div class="flex justify-end space-x-2">
                        <button type="button" class="bg-gray-500 text-white px-4 py-2 rounded" @click="closeModal">
                            Batal
                        </button>
                        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                            Simpan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </template>
</div>
<script>
    const config = {
        controller: 'media/albums',
        dirUpload: 'upload/image/',
        columns: [{
                key: 'album_title',
                label: 'Judul'
            },
            {
                key: 'album_description',
                label: 'Keterangan'
            },
            {
                label: 'Aksi',
                orderable: false,
                key: null,
                priority: 2,
                render: (data, type, row) => {
                    return `
                <button class="text-sm bg-yellow-400 px-2 py-1 rounded mr-2 text-white"
                    @click="editData(${row.id})">Edit</button>
                <a href="${_BASEURL}admin/gallery/upload/${row.id}"
                    class="text-sm bg-blue-600 px-2 py-1 rounded text-white">Upload</a>`;
                }
            }
        ],
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
            async loadData() {
                const response = await this.fetchData(_BASEURL + `${config.controller}/list`);
                console.log(response);
                if (response) {
                    this.tableData = response.data;
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
                        rowCallback: function(row, data) {
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
                this.showModal = true;
            },

            closeModal() {
                this.showModal = false;
                this.resetForm();
            },

            resetForm() {
                this.form = {
                    id: '',
                    album_title: '',
                    album_description: ''
                };
            },

            generateSlug() {
                this.form.album_slug = this.form.album_title
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
                        id: item.id,
                        album_title: item.album_title,
                        album_slug: item.album_slug,
                        album_description: item.album_description,
                    };
                    this.previewFile = item.image_cover ?
                        _BASEURL + `upload/image/${item.image_cover}` :
                        null;

                    this.modalType = 'edit';
                    this.showModal = true;
                } else {
                    Notifier.show('Error', 'Data tidak ditemukan', 'error');
                }
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
                } else {
                    Notifier.show('Error', res?.message || 'Gagal menyimpan data', 'error');
                }
            },

        };
    }
</script>
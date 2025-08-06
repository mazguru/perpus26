<div x-data="mgrData(config)" x-init="loadData()">
    <div class="p-4 bg-white dark:bg-boxdark shadow-md border-b border-gray-200">
        <div class="flex justify-between items-center mb-4">
            <p>Menampilkan daftar kategori</p>
            <button @click="openModal('create')" class="bg-cyan-600 hover:bg-cyan-700 text-white px-3 py-2 rounded text-sm">
                <i class="bi bi-plus-lg mr-2"></i> Tambah Kategori
            </button>
        </div>
    </div>
    <?= $this->include('admin/list-data') ?>
    <!-- Modal -->
    <template x-if="showModal">
        <div class="fixed inset-0 bg-black/50 z-99 flex items-center justify-center">
            <div class="bg-white rounded-xl p-6 w-full max-w-lg">
                <h2 class="text-xl font-semibold mb-4" x-text="modalType === 'create' ? 'Tambah Album' : 'Edit Album'"></h2>
                <form @submit.prevent="submitForm" enctype="multipart/form-data">
                    <div class="mb-4">
                        <label class="block text-xs font-semibold mb-1">Nama</label>
                        <input type="text" x-model="form.category_name" @input="modalType === 'create' && (form[config.field.slug] = generateSlug(form[config.field.name]))"
                            class="w-full border rounded px-3 py-2" required>
                    </div>

                    <div class="mb-4">
                        <label class="block text-xs font-semibold mb-1">Slug</label>
                        <input type="text" x-model="form.category_slug" class="w-full border rounded px-3 py-2 bg-gray-100" readonly>
                    </div>

                    <div class="mb-4">
                        <label class="block text-xs font-semibold mb-1">Deskripsi</label>
                        <textarea x-model="form.category_description" class="w-full border rounded px-3 py-2"></textarea>
                    </div>
                    <div class="mb-4">
                        <label class="block text-xs font-semibold mb-1">Tipe</label>
                        <select id="role" name="role" x-model="form.category_type" class="mt-1 block w-full p-2 border border-gray-300 rounded-md" required>
                            <option>Pilih</option>
                            <option value="post">Post</option>
                            <option value="page">Page</option>
                        </select>
                        <p class="text-sm text-red-500" x-text="errorData.category_type"></p>
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
        controller: 'blog/category',
        field: {
            name: 'category_name',
            slug: 'category_slug',
        },
        dirUpload: 'upload/image/',
        columns: [{
                key: 'category_name',
                label: 'Nama',
                priority: 1,
            },
            {
                key: 'category_description',
                label: 'Keterangan'
            },
            {
                key: 'category_type',
                label: 'Tipe Kategori'
            },
            {
                label: 'Aksi',
                orderable: false,
                key: null,
                priority: 2,
                render: (data, type, row) => {
                    return `
                    ${row.is_deleted == 'true'
                    ? `<div class="flex">
                        <button
                            class="text-xs bg-orange-400 px-2 py-1 rounded mr-2 text-white dark:text-white hover:bg-orange-300 flex items-center"
                            @click="confirmRestore(${row.id})">
                            <i class="bi bi-database-up mr-2"></i>
                            <span>Restore</span>
                        </button>
                        </div>`
                    : `<div class="flex"><button class="text-xs bg-yellow-400 px-2 py-1 rounded mr-2 text-white" @click="editData(${row.id})">Edit</button>
                        <button class="text-xs bg-red-400 px-2 py-1 rounded mr-2 text-white" @click="confirmDelete(${row.id})">Hapus</button></div>`
                                    }
                `;
                }
            }
        ],
    }
</script>
<div x-data="mgrData(config)" x-init="loadData()">
    <div class="p-4 bg-white shadow-md border-b border-gray-200">
        <div class="mb-4">
            <h1 class="text-2xl font-semibold"><?= $title ?></h1>
        </div>
        <div class="flex justify-between items-center mb-4">
            <p class="text-sm">Menampilkan daftar kategori</p>
            <button @click="openModal('create')" class="bg-cyan-600 hover:bg-cyan-700 text-white px-3 py-2 rounded text-sm">
                <i class="bi bi-plus-lg mr-2"></i> Tambah Kategori
            </button>
        </div>
    </div>
    <div class="bg-white dark:bg-boxdark shadow-md rounded-b border-b p-4 table-striped table-hover">
        <table id="table-data" class="table-auto w-full border-collapse border">
        </table>
        <div class="mb-4">
            <p class="text-gray-600">
                <strong x-text="selectedId.length"></strong> data dipilih
            </p>
        </div>
        <div class="md:flex space-x-1 space-y-1 pl-0 sm:pl-2 mt-3 sm:mt-0 gap-4">
            <button @click="confirmDeleteMultiple()"
                :disabled="selectedId.length === 0" class="px-3 py-2 text-xs font-medium text-center focus:ring-4 focus:outline-none focus:ring-red-300 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800 text-white hover:bg-red-600 rounded-md inline-flex justify-center bg-red-500"
                :class="{'opacity-50 cursor-not-allowed': selectedId.length === 0}">
                <i class="bi bi-trash3-fill mr-2"></i>
                Hapus
            </button>
            <button @click="confirmDeletepermanent()"
                :disabled="selectedId.length === 0" class="px-3 py-2 text-xs font-medium text-center focus:ring-4 focus:outline-none focus:ring-red-300 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800 text-white hover:bg-red-600 rounded-md inline-flex justify-center bg-red-500"
                :class="{'opacity-50 cursor-not-allowed': selectedId.length === 0}">
                <i class="bi bi-trash3-fill mr-2"></i>
                Hapus Permanen
            </button>
            <button @click="confirmRestoreMultiple()"
                :disabled="selectedId.length === 0" class="px-3 py-2 text-xs font-medium text-center focus:ring-4 focus:outline-none focus:ring-gray-300 dark:bg-gray-600 dark:hover:bg-gray-700 dark:focus:ring-gray-800 text-white hover:bg-gray-600 rounded-md inline-flex justify-center bg-gray-500"
                :class="{'opacity-50 cursor-not-allowed': selectedId.length === 0}">
                <i class="bi bi-database-up mr-2"></i>
                Restore
            </button>
        </div>
    </div>
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
                        <select id="role" name="role" x-model="form.category_type" class="mt-1 block w-full p-2 border border-gray-300 rounded-md">
                            <option value="post">Post</option>
                            <option value="page">Page</option>
                            <option value="file">File</option>
                        </select>
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
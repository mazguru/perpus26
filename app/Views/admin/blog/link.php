<div x-data="mgrData(config)" x-init="loadData()">
    <div class="p-4 bg-white shadow-md border-b border-gray-200">
        <div class="mb-4">
            <h1 class="text-2xl font-semibold"><?= $title ?></h1>
        </div>
        <div class="flex justify-between items-center mb-4">
            <p class="text-xs">Menampilkan daftar post foto dan video</p>
            <button @click="openModal('create')" class="bg-cyan-600 hover:bg-cyan-700 text-white px-3 py-2 rounded text-xs">
                <i class="bi bi-plus-lg mr-2"></i> Tambah post
            </button>
        </div>
    </div>
    <?= $this->include('admin/list-data') ?>
    <!-- Modal -->
    <template x-if="showModal">
        <div class="fixed inset-0 bg-black/50 z-99 flex items-center justify-center">
            <div class="bg-white rounded-xl p-6 w-full max-w-lg">
                <h2 class="text-xl font-semibold mb-4" x-text="modalType === 'create' ? 'Tambah post' : 'Edit post'"></h2>
                <form @submit.prevent="submitForm" enctype="multipart/form-data">
                    <input type="hidden" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>">

                    <!-- Judul -->
                    <div>
                        <label class="block font-medium text-gray-700">Judul Link</label>
                        <input type="text" name="link_title" x-model="form.link_title" required
                            class="mt-1 px-3 py-2 border w-full rounded-md border-gray-300 shadow-sm focus:ring-orange-500 focus:border-orange-500">
                    </div>

                    <!-- URL -->
                    <div>
                        <label class="block font-medium text-gray-700">URL</label>
                        <input type="url" name="link_url" x-model="form.link_url" required
                            class="mt-1 w-full rounded-md px-3 py-2 border border-gray-300 shadow-sm focus:ring-orange-500 focus:border-orange-500">
                    </div>

                    <!-- Target -->
                    <div class="mb-4">
                        <label class="block font-medium text-gray-700">Target</label>
                        <select required name="link_target" x-model="form.link_target"
                            class="mt-1 px-3 py-2 border w-full rounded-md border-gray-300 shadow-sm focus:ring-orange-500 focus:border-orange-500">
                            <option>Pilih</option>
                            <option value="_self">Buka di Tab Sama</option>
                            <option value="_blank">Buka di Tab Baru</option>
                        </select>
                    </div>

                    <!-- Gambar -->

                    <!-- Tipe -->
                    <div class="mb-4">
                        <label class="block text-xs font-semibold mb-1">Cover</label>
                        <input name="image_cover" type="file" @change="handleCoverUpload" accept="image/*"
                            class="w-full border rounded px-3 py-2">
                        <template x-if="previewFile">
                            <img :src="previewFile" class="mt-2 w-32 h-32 object-cover rounded">
                        </template>
                    </div>

                    <!-- Tombol -->
                    <div class="pt-4 flex justify-end gap-2">
                        <button @click="closeModal()"
                            class="px-4 py-2 bg-gray-100 hover:bg-gray-200 rounded-md text-sm text-gray-700 shadow">
                            Batal
                        </button>
                        <button type="submit"
                            class="bg-orange-600 hover:bg-orange-700 text-white font-semibold px-6 py-2 rounded-lg shadow">
                            <span>SImpan</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </template>
</div>
<script>
    const config = {
        controller: 'blog/links',
        dirUpload: 'media_library/images/',
        columns: [{
                key: 'link_title',
                label: 'Judul',
                priority: 1,
            },
            {
                key: 'link_url',
                label: 'Link URL'
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
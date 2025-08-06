<div x-data="mgrData(config)" x-init="loadData()">
    <div class="p-4 bg-white shadow-md border-b border-gray-200">
        <div class="bg-yellow-100 border-l-4 border-yellow-500 text-yellow-800 p-4 rounded mb-4" role="alert">
            <div class="flex items-start space-x-3">
                <!-- Icon -->
                 <i class="w-6 h-6 flex-shrink-0 text-yellow-600 mt-0.5 bi bi-exclamation-triangle"></i>

                <!-- Content -->
                <div>
                    <p class="font-semibold">Perhatian:</p>
                    <p class="text-sm mt-1">
                        Untuk menambahkan video, Anda perlu menyalin <strong>ID video YouTube</strong> seperti contoh berikut:
                    </p>

                    <div class="bg-white border rounded p-3 mt-3 text-sm">
                        <p class="mb-1">Contoh URL YouTube:</p>
                        <p class="text-gray-700 font-mono">https://www.youtube.com/watch?v=<span class="text-blue-600 font-semibold">dQw4w9WgXcQ</span></p>
                        <p class="mt-2">Maka ID videonya adalah: <code class="bg-gray-200 text-red-600 px-2 py-1 rounded">dQw4w9WgXcQ</code></p>
                    </div>

                    <p class="text-xs mt-3 text-gray-600">Salin hanya bagian setelah <code class="bg-gray-100 px-1 rounded">?v=</code>, lalu tempelkan ke kolom input.</p>
                </div>
            </div>
        </div>
        <div class="flex justify-between items-center mb-4">
            <p>Menampilkan daftar Video</p>
            <button @click="openModal('create')" class="bg-cyan-600 hover:bg-cyan-700 text-white px-3 py-2 rounded">
                <i class="bi bi-plus-lg mr-2"></i> Tambah Video
            </button>
        </div>


    </div>
    <div x-data="videoModal" class="bg-white dark:bg-boxdark shadow-md rounded-b border-b p-4 table-striped table-hover">
        <table id="table-data" class="table-auto w-full border-collapse border">
        </table>
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
        <div>
            <template x-if="videoOpen">
                <div class="fixed inset-0 z-[100] bg-black/80 flex items-center justify-center">
                    <div class="bg-white rounded-lg overflow-hidden w-full max-w-3xl aspect-[16/9] relative">
                        <button @click="closeVideo()" class="absolute top-2 right-2 z-10 bg-white rounded-full p-1 shadow">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                        <iframe
                            :src="videoSrc"
                            class="w-full h-full"
                            frameborder="0"
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                            allowfullscreen>
                        </iframe>
                    </div>
                </div>
            </template>
        </div>
    </div>
    <!-- Modal -->
    <template x-if="showModal">
        <div class="fixed inset-0 bg-black/50 z-99 flex items-center justify-center">
            <div class="bg-white rounded-xl p-6 w-full max-w-lg">
                <h2 class="text-xl font-semibold mb-4" x-text="modalType === 'create' ? 'Tambah post' : 'Edit post'"></h2>
                <form @submit.prevent="submitForm" enctype="multipart/form-data">
                    <div class="mb-4">
                        <label class="block text-xs font-semibold mb-1">Judul</label>
                        <input type="text" x-model="form.post_title"
                            class="w-full border rounded px-3 py-2" required>
                    </div>
                    <div class="mb-4">
                        <label class="block text-xs font-semibold mb-1">ID Video Youtube</label>
                        <textarea x-model="form.post_content" class="w-full border rounded px-3 py-2"></textarea>
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
        controller: 'media/video',
        dirUpload: 'media_library/images/',
        columns: [{
                key: 'post_title',
                label: 'Judul',
                priority: 1,
            },
            {
                key: 'post_content',
                label: 'ID Youtube'
            },
            {
                key: 'post_content',
                label: 'Preview',
                render: function(data, type, row) {
                    if (type === 'display') {
                        return `
                <div @click="openVideo('${row.post_content}')">
                    <img 
                        class='cursor-pointer h-28 aspect-[16/9] object-cover rounded shadow transition hover:scale-105' 
                        src="https://img.youtube.com/vi/${row.post_content}/hqdefault.jpg"
                        alt="Preview">
                </div>
            `;
                    }
                    return data;
                }
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
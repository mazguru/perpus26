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
    <div x-data="videoModal" class="bg-white dark:bg-boxdark shadow-md rounded-b border-b p-4 table-striped table-hover">
        <table id="table-data" class="table-auto w-full border-collapse border">
        </table>
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
                    <div class="mb-4">
                        <label class="block text-xs font-semibold mb-1">Cover</label>
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


<script>
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
</script>
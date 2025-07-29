<div x-data="mgrData(config)" x-init="loadData()">

    <?= $this->include('admin/comments/list') ?>
    <!-- Modal -->
    <template x-if="showModal">
        <div class="fixed inset-0 bg-black/50 z-99 flex items-center justify-center">
            <div class="bg-white rounded-xl p-6 w-full max-w-lg">
                <h2 class="text-xl font-semibold mb-4" x-text="modalType === 'create' ? 'Tambah Album' : 'Edit Album'"></h2>
                <form @submit.prevent="submitForm" enctype="multipart/form-data">
                   
                    <div class="mb-4">
                        <label class="block text-xs font-semibold mb-1">Komentar Masuk</label>
                        <textarea x-model="form.comment_content" class="w-full border rounded px-3 py-2" readonly></textarea>
                    </div>
                    <div class="mb-4">
                        <label class="block text-xs font-semibold mb-1">Balas Komentar</label>
                        <textarea x-model="form.comment_reply" class="w-full border rounded px-3 py-2"></textarea>
                    </div>

                    <div class="mb-4">
                        <label class="block text-xs font-semibold mb-1">Cover</label>
                        <select class="w-full border p-2 rounded" x-model="form.comment_status">
                            <option value="">-- status --</option>
                            <option value="approved">Setujui</option>
                            <option value="unapproved">Tolak</option>
                            <option value="spam">Spam</option>
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
        controller: 'blog/message',
        dirUpload: 'upload/image/',
        columns: [{
                key: 'comment_author',
                label: 'Penulis'
            },
            {
                key: 'comment_email',
                label: 'Email'
            },
            {
                key: 'comment_url',
                label: 'Url'
            },
            {
                key: 'comment_status',
                label: 'Status'
            },
            {
                key: 'comment_post_id',
                label: 'Komentar Untuk'
            },
            {
                key: 'created_at',
                label: 'Tanggal Kirim'
            },
            {
                label: 'Aksi',
                orderable: false,
                key: null,
                priority: 2,
                render: (data, type, row) => {
                    const ds = row.date === null ? 'pointer-events-none opacity-25' : '';
                    return `
                        <button @click="editData(${row.id})"
                        class="bg-cyan-600 hover:bg-cyan-700 focus:ring-4 focus:ring-cyan-200 text-white px-2 py-1 rounded ${ds}">
                            Lihat
                        </button>
                    
                    `;
                }
            }
        ],
    }
</script>
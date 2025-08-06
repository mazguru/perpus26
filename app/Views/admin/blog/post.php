<div x-data="mgrData(config)" x-init="loadData()">

    <div class="p-4 bg-white dark:bg-boxdark shadow-md block sm:flex items-center justify-between border-b border-gray-200">
        <div class="mb-1 w-full">
            <div class="grid grid-cols-1 md:grid-cols-6 gap-4 md:justify-between">
                <div class="sm:flex items-center sm:divide-x sm:divide-gray-100 mb-3 sm:mb-0 col-span-5">
                    <p>Menampilkan data Postingan</p>
                </div>
                <div class="grid grid-cols-1 md:justify-end gap-4">
                    <button @click="addContent()" class="w-1/2 text-white bg-cyan-600 hover:bg-cyan-700 focus:ring-4 focus:ring-cyan-200 font-medium inline-flex items-center justify-center rounded-lg text-sm px-3 py-2 text-center sm:w-auto">
                        <i class="bi bi-plus-lg font-bold text-[14pt] mr-2"></i>
                        Tambah Postingan
                    </button>
                </div>
            </div>
        </div>
    </div>
    <?= $this->include('admin/list-data') ?>

</div>
<script>
    const config = {
        controller: 'blog/posts',
        dirUpload: 'upload/image/',
        columns: [{
                key: 'post_title',
                label: 'Judul'
            },
            {
                key: 'post_author',
                label: 'Author'
            },
            {
                key: 'post_status',
                label: 'Status'
            },
            {
                key: 'category_name',
                label: 'Kategori'
            },
            {
                key: 'created_at',
                label: 'Tanggal Pembuatan'
            },
            {
                label: 'Aksi',
                orderable: false,
                key: null,
                priority: 2,
                render: (data, type, row) => {
                    const ds = row.date === null ? 'pointer-events-none opacity-25' : '';
                    return `
                        <button @click="editContent(${row.id})"
                        class="bg-cyan-600 hover:bg-cyan-700 focus:ring-4 focus:ring-cyan-200 text-white px-2 py-1 rounded ${ds}">
                            Edit
                        </button>
                    
                    `;
                }
            }
        ],
    }
</script>
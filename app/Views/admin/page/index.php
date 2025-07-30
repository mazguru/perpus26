<div x-data="mgrData(config)" x-init="loadData()">

    <?= $this->include('admin/posts/list') ?>

</div>
<script>
    const config = {
        controller: 'blog/page',
        dirUpload: 'upload/image/',
        columns: [{
                key: 'title',
                label: 'Judul'
            },
            {
                key: 'author',
                label: 'Author'
            },
            {
                key: 'status',
                label: 'Status'
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
                    return `
                    ${row.is_deleted == 'true'
                    ? `<div class="flex">
                        <button
                            class="text-xs bg-orange-400 px-2 py-1 rounded mr-2 text-white dark:text-white hover:bg-orange-300 flex items-center"
                            @click="confirmRestore(${row.id})">
                            <i class="bi bi-database-up mr-2"></i>
                            <span>Restore</span>
                        </button>
                        <button
                            class="text-xs bg-red-400 px-2 py-1 rounded mr-2 text-white dark:text-white hover:bg-red-300 flex items-center"
                            @click="confirmDeletepermanent(${row.id})">
                            <i class="bi bi-trash mr-2"></i>
                            <span>Hapus</span>
                        </button>
                        </div>`
                    : `<div class="flex"><button class="text-xs bg-yellow-400 px-2 py-1 rounded mr-2 text-white" @click="editContent(${row.id})">Edit</button>
                        <button class="text-xs bg-red-400 px-2 py-1 rounded mr-2 text-white" @click="deleteData(${row.id})">Hapus</button>
                        `
                    }
                `;

                }
            }
        ],
    }
</script>
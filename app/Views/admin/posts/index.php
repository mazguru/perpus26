

<h2>Kelola Artikel</h2>
<p>Selamat datang, <?= session('nama') ?> | <a href="/admin/logout">Logout</a></p>
<a href="/admin/artikel/tambah">+ Tambah Artikel</a>
<div x-data="postingan(config)" x-init="loadPosts()">

    <?= $this->include('admin/posts/list') ?>

</div>
<script>
    const config = {
        controller: 'blog/posts',
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
                    const ds = row.date === null ? 'pointer-events-none opacity-25' : '';
                    return `
                        <button @click="editPost(${row.id})"
                        class="bg-cyan-600 hover:bg-cyan-700 focus:ring-4 focus:ring-cyan-200 text-white px-2 py-1 rounded ${ds}">
                            Edit
                        </button>
                    
                    `;
                }
            }
        ],
    }

    
</script>
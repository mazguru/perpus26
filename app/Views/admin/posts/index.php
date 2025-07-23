<?= $this->extend('layouts/master_admin') ?>

<?= $this->section('content') ?>

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
                        <a href="${_BASEURL}blog/posts/edit/${row.id}"
                        class="bg-cyan-600 hover:bg-cyan-700 focus:ring-4 focus:ring-cyan-200 text-white px-2 py-1 rounded ${ds}">
                            Detail
                        </a>
                    
                    `;
                }
            }
        ],
    }

    function postingan(config) {
        return {
            baseUrl: _BASEURL + config.dirUpload,
            tableData: '',
            isModalOpen: false,
            editIndex: null,
            editItem: {
                setting_description: '',
                setting_variable: '',
                setting_value: ''
            },
            selectedFile: null,
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
            async loadPosts() {
                const response = await this.fetchData(_BASEURL + `${config.controller}/getposts`);
                console.log(response);
                if (response) {
                    this.tableData = response;
                    this.renderDataTable();
                } else {
                    Swal.fire('Error', 'Gagal memuat data.', 'error');
                }
            },

            renderDataTable() {
                const table = document.querySelector('#table-posts');
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


        };
    }
</script>
<?= $this->endSection() ?>
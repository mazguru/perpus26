<?= $this->extend('layouts/master_admin') ?>

<?= $this->section('content') ?>

<h2>Kelola Artikel</h2>
<p>Selamat datang, <?= session('nama') ?> | <a href="/admin/logout">Logout</a></p>
<a href="/admin/artikel/tambah">+ Tambah Artikel</a>
<div x-data="postingan(config)" x-init="loadPosts()">
<ul>
    
</ul>
<script>
     const config = {
        controller: 'blog/posts',
        dirUpload: 'upload/image/'
    }
    function postingan(config) {
        return {
            baseUrl: _BASEURL + config.dirUpload,
            data: '',
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
                if (response) {
                    this.data = response;
                } else {
                    Swal.fire('Error', 'Gagal memuat data.', 'error');
                }
            },
            

        };
    }
</script>
<?= $this->endSection() ?>
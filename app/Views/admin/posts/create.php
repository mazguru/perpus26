<?= $this->extend('layouts/master_admin') ?>

<?= $this->section('content') ?>

<h2 class="text-2xl font-bold mb-4">Buat Post Baru</h2>

<form action="<?= site_url('posts/store') ?>" method="post">
    <?= csrf_field() ?>

    <div class="mb-4">
        <label for="post_title" class="block font-semibold">Judul Post</label>
        <input type="text" name="post_title" id="post_title" value="<?= old('post_title') ?>" required
            class="w-full p-2 border border-gray-300 rounded">
    </div>

    <div class="mb-4">
        <label for="post_slug" class="block font-semibold">Slug</label>
        <input type="text" name="post_slug" id="post_slug" value="<?= old('post_slug') ?>"
            class="w-full p-2 border border-gray-300 rounded">
    </div>

    <div class="mb-4">
        <label for="post_content" class="block font-semibold">Isi Post</label>
        <textarea name="post_content" id="post_content" rows="6"
            class="w-full p-2 border border-gray-300 rounded"><?= old('post_content') ?></textarea>
    </div>

    <div class="mb-4">
        <label for="category_id" class="block font-semibold">Kategori</label>
        <select name="category_id" id="category_id" class="w-full p-2 border border-gray-300 rounded">
            <option value="">-- Pilih Kategori --</option>
            <?php foreach ($option_categories as $category): ?>
                <option value="<?= $category['id'] ?>" <?= old('category_id') == $category['id'] ? 'selected' : '' ?>>
                    <?= esc($category['category_name']) ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>

    <div class="mb-4">
        <label for="post_status" class="block font-semibold">Status</label>
        <select name="post_status" id="post_status" class="w-full p-2 border border-gray-300 rounded">
            <option value="publish" <?= old('post_status') == 'publish' ? 'selected' : '' ?>>Publish</option>
            <option value="draft" <?= old('post_status') == 'draft' ? 'selected' : '' ?>>Draft</option>
        </select>
    </div>

    <div class="mb-4">
        <label for="post_type" class="block font-semibold">Tipe Post</label>
        <input type="text" name="post_type" id="post_type" value="<?= old('post_type') ?? 'post' ?>"
            class="w-full p-2 border border-gray-300 rounded">
    </div>

    <button type="submit"
        class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
        Simpan
    </button>
</form>

<!-- TinyMCE -->
<script src="<?= base_url('assets/plugins/tinymce/tinymce.min.js') ?>"></script>
<script>
    tinymce.init({
        selector: '#post_content',
        plugins: 'preview importcss searchreplace autolink autosave save directionality code visualblocks visualchars fullscreen image link media codesample table charmap pagebreak nonbreaking anchor insertdatetime advlist lists wordcount help charmap emoticons',
        editimage_cors_hosts: ['picsum.photos'],
        menubar: 'file edit view insert format tools table help',
        toolbar: "undo redo | accordion accordionremove | blocks fontfamily fontsize | bold italic underline strikethrough | align numlist bullist | link image | table media | lineheight outdent indent| forecolor backcolor removeformat | charmap emoticons | code fullscreen preview | save print | pagebreak anchor codesample | ltr rtl",
        autosave_ask_before_unload: true,
        autosave_interval: '30s',
        autosave_prefix: '{path}{query}-{id}-',
        autosave_restore_when_empty: false,
        autosave_retention: '2m',
        image_advtab: true,
        automatic_uploads: true,
        file_picker_types: 'image',
        file_picker_callback: function(cb, value, meta) {
            var input = document.createElement('input');
            input.setAttribute('type', 'file');
            input.setAttribute('accept', 'image/*');
            input.onchange = function() {
                var file = this.files[0];
                var reader = new FileReader();
                reader.readAsDataURL(file);
                reader.onload = function() {
                    var id = 'post-image-' + (new Date()).getTime();
                    var blobCache = tinymce.activeEditor.editorUpload.blobCache;
                    var blobInfo = blobCache.create(id, file, reader.result);
                    blobCache.add(blobInfo);
                    cb(blobInfo.blobUri(), {
                        title: file.name
                    });
                };
            };
            input.click();
        },
        images_upload_handler: function(blobInfo, success, failure) {
            var xhr, formData;
            xhr = new XMLHttpRequest();
            xhr.withCredentials = false;
            xhr.open('POST', _BASEURL + 'blog/posts/upload_image');
            xhr.onload = function() {
                if (xhr.status != 200) {
                    failure('HTTP Error: ' + xhr.status);
                    return;
                }
                var res = _H.StrToObject(xhr.responseText);
                if (res.status == 'error') {
                    failure(res.message);
                    return;
                }
                success(res.location);
            };
            formData = new FormData();
            formData.append('file', blobInfo.blob(), blobInfo.filename());
            xhr.send(formData);
        }
    });
</script>

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
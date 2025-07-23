<?= $this->extend('layouts/master_admin') ?>

<?= $this->section('content') ?>

<h2 class="text-2xl font-bold mb-4">Buat Post Baru</h2>

<form
    method="post"
    x-data="postForm(config)"
    x-init="loadCategories(); initTinymce() "
    @submit.prevent="validateForm">
    <?= csrf_field() ?>
    <template x-if="errorMessage">
        <div class="mb-4 text-red-600 font-semibold" x-text="errorMessage"></div>
    </template>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <!-- Kolom Kiri -->
        <div class="md:col-span-2 space-y-4">
            <input type="text" x-model="form.post_title" @input="generateSlug" placeholder="Add Title"
                class="w-full border border-gray-300 p-3 text-xl font-bold rounded" />

            <textarea x-model="form.post_content" rows="20" id='post_content' x-model="form.post_content"
                class="w-full border border-gray-300 p-3 rounded resize-y"
                placeholder="Tulis isi artikel di sini..."></textarea>
        </div>

        <!-- Kolom Kanan -->
        <div class="space-y-4">
            <!-- Kategori -->
            <div class="border rounded bg-gray-50 p-2">
                <label class="block font-semibold">Slug</label>
                <input type="text" x-model="form.post_slug"
                    class="w-full text-sm p-2 border border-gray-300 rounded">
            </div>
            <!-- Kategori -->
            <div class="border rounded bg-gray-50 p-4">
                <h3 class="font-semibold mb-2">🗂️ KATEGORI</h3>
                <template x-for="cat in categories" :key="cat.id">
                    <label class="block">
                        <input type="checkbox"
                            :value="cat.id"
                            :checked="form.post_categories === cat.id"
                            @change="selectCategory(cat.id)"
                            class="mr-2">
                        <span x-text="cat.category_name"></span>
                    </label>
                </template>
                <button class="mt-2 text-sm text-blue-500 hover:underline">+ Tambah Kategori</button>
            </div>

            <!-- Publikasi -->
            <div class="border rounded bg-gray-50 p-4 space-y-3">
                <h3 class="font-semibold mb-2">📤 PUBLIKASI</h3>
                <div>
                    <label class="block text-sm font-medium">Status</label>
                    <select x-model="form.post_status"
                        class="w-full p-2 border border-gray-300 rounded">
                        <option value="publish">Publish</option>
                        <option value="draft">Draft</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium">Akses</label>
                    <select x-model="form.post_visibility" class="w-full p-2 border rounded">
                        <option value="public">Publik</option>
                        <option value="privat">Privat</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium">Komentar</label>
                    <select x-model="form.post_comment_status" class="w-full p-2 border rounded">
                        <option value="open">Diizinkan</option>
                        <option value="close">Tidak Diizinkan</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium">Gambar</label>
                    <input type="file" @change="handleFile($event)" name='post_image' x-ref="post_image" class="w-full text-sm border rounded">
                </div>
            </div>



            <!-- Tombol -->
            <div class="flex justify-between">
                <button @click="resetForm"
                    class="bg-yellow-500 text-white px-4 py-2 rounded hover:bg-yellow-600">
                    ATUR ULANG
                </button>
                <button @click="validateForm"
                    class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                    SIMPAN
                </button>
            </div>
</form>

<script>
    const config = {
        controller: 'blog/posts',
    }

    function postForm(config) {
        return {
            form: {
                post_title: '',
                post_slug: '',
                post_content: '',
                post_categories: '',
                post_status: 'publish',
                post_type: 'post',
                post_visibility: 'public',
                post_comment_status: 'open',
            },

            categories: '',

            errorMessage: '',
            generateSlug() {
                this.form.post_slug = this.form.post_title
                    .toLowerCase()
                    .replace(/[^\w\s-]/g, '')
                    .replace(/\s+/g, '-')
                    .replace(/--+/g, '-');
            },
            validateForm() {
                if (!this.form.post_title.trim()) {
                    this.errorMessage = 'Judul tidak boleh kosong.';
                    return;
                }
                if (!this.form.post_content.trim()) {
                    this.errorMessage = 'Isi post tidak boleh kosong.';
                    return;
                }
                if (!this.form.post_categories) {
                    this.errorMessage = 'Kategori harus dipilih.';
                    return;
                }
                this.errorMessage = '';
                alert('Form valid dan siap dikirim:\n' + JSON.stringify(this.form, null, 2));
            },

            async submitForm() {
                const url = _BASEURL + config.controller + '/store';
                const method = 'POST';
                const response = await this.fetchData(url, method, this.form);
                console.log(response);
                if (response && response.status === 'success') {
                    Notifier.show('Berhasil!', response.message, 'success');
                } else {
                    this.errors = response.errors ? response.errors : [];
                    Notifier.show('Gagal!', response ? response.message : 'Terjadi kesalahan.', 'error');
                }
            },

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
            async loadCategories() {
                const response = await this.fetchData(_BASEURL + `${config.controller}/getcategories`);
                console.log(response);
                if (response) {
                    this.categories = response.categories;
                } else {
                    Notifier.show('Error', 'Gagal memuat data.', 'error');
                }
            },

            resetForm() {
                this.form = {
                    post_title: '',
                    post_slug: '',
                    post_content: '',
                    category_id: '',
                    post_status: 'publish',
                    post_image: '',
                    post_type: 'post',
                };
            },
            selectCategory(id) {
                this.form.post_categories = this.form.post_categories === id ? null : id;
            },
            handleFile(event) {
                const file = event.target.files[0];
                const allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];
                const imageFile = this.$refs.post_image?.files[0];

                if (file && allowedExtensions.includes(file.name.split('.').pop().toLowerCase())) {
                    if (imageFile) {
                        this.form.post_image = imageFile;
                    }
                } else {
                    this.form.post_image = null; // Reset jika file tidak valid
                    Notifier.show('Error', 'File harus berupa JPG, JPEG, PNG, atau GIF.', 'error');
                }
            },

            initTinymce() {
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
                    },

                    setup: (editor) => {
                        editor.on('init', () => {
                            editor.setContent(this.form.post_content); // Set initial content
                        });
                        editor.on('change input', () => {
                            this.form.post_content = editor.getContent(); // Sync with Alpine.js state
                        });
                    }
                });
            }
        }
    }
</script>

<!-- TinyMCE -->
<script src="<?= base_url('assets/plugins/tinymce/tinymce.min.js') ?>"></script>


<?= $this->endSection() ?>
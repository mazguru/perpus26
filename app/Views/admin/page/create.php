<form
    method="post"
    x-data="postForm(config)"
    x-init="init()"
    @submit.prevent="validateForm"
    enctype="multipart/form-data">
    <?= csrf_field() ?>
    <template x-if="errorMessage">
        <div class="mb-4 text-red-600 font-semibold" x-text="errorMessage"></div>
    </template>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <!-- Kolom Kiri -->
        <div class="md:col-span-2 space-y-4">
            <div class="border rounded bg-gray-50 p-2">
                <label class="block font-semibold">Judul</label>
                <input type="text" x-model="form.post_title" @input="type === 'create' && generateSlug()" placeholder="Add Title"
                    class="w-full border border-gray-300 p-3 text-xl font-bold rounded" />
                <span class="text-xs italic text-red-600" x-text='errors.post_title'></span>
            </div>
            <div class="border rounded bg-gray-50 p-2">
                <label class="block font-semibold">Isi Konten</label>
                <textarea x-model="form.post_content" rows="20" id='post_content' x-model="form.post_content"
                    class="w-full border border-gray-300 p-3 rounded resize-y"
                    placeholder="Tulis isi artikel di sini..."></textarea>
            </div>
        </div>

        <!-- Kolom Kanan -->
        <div class="space-y-4">
            <!-- Kategori -->
            <div class="border rounded bg-gray-50 p-2">
                <label class="block font-semibold">Slug</label>
                <input type="text" x-model="form.post_slug"
                    class="w-full text-sm p-2 border border-gray-300 rounded" :readonly="type === 'edit'">
            </div>
            <!-- Kategori -->
            <div class="border rounded bg-gray-50 p-4">
                <h3 class="font-semibold mb-2">🗂️ KATEGORI</h3>
                <template x-for="cat in categories" :key="cat.id">
                    <label class="block">
                        <input
                            type="radio"
                            class="form-radio text-indigo-600"
                            x-model="form.post_categories"
                            :value="cat.id">
                        <span x-text="cat.category_name"></span>
                    </label>
                </template>
                <span class="text-xs italic text-red-600" x-text='errors.post_categories'></span>
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
                        <option value="private">Privat</option>
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
                    <!-- Dengan x-if -->
                    <template x-if="typeof form.post_image === 'string' && form.post_image !== '' && form.post_image !== 'null'">
                        <div class="mb-2">
                            <label class="block text-sm font-medium text-gray-600">Gambar Aktif:</label>
                            <img :src="_BASEURL + 'media_library/posts/thumbs/' + form.post_image" alt="Current Image" class="h-20 object-cover rounded border">
                        </div>
                    </template>
                    <template x-if="previewFile">
                        <div class="mb-2">
                            <label class="block text-sm font-medium text-gray-600">Gambar Baru:</label>
                            <img :src="previewFile" class="h-20 object-cover rounded border">
                        </div>
                    </template>
                </div>
            </div>



            <!-- Tombol -->
            <div class="flex justify-between">
                <button @click="resetForm"
                    class="bg-yellow-500 text-white px-4 py-2 rounded hover:bg-yellow-600">
                    ATUR ULANG
                </button>
                <button type="submit"
                    class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                    SIMPAN
                </button>
            </div>
</form>

<script>
    const config = {
        controller: 'blog/page',
        post_id: '<?= $post_id ?? null ?>',
        type_crud: '<?= $type ?? 'edit' ?>',
    }

    function postForm(config) {
        return {
            form: {
                post_title: '',
                post_slug: '',
                post_content: '',
                post_categories: [],
                post_status: 'publish',
                post_type: 'post',
                post_visibility: 'public',
                post_comment_status: 'open',
            },

            previewFile: null,
            curent_tumb: '',

            postId: config.post_id,
            type: config.type_crud,

            categories: '',
            errors: [],

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
                this.errorMessage = '';
                this.submitForm();
                console.log(this.form)
            },

            async submitForm() {
                const url = _BASEURL + config.controller + '/store';
                const method = 'POST';

                const formData = new FormData();
                for (const key in this.form) {
                    formData.append(key, this.form[key]);
                }

                // Pastikan elemen file dimasukkan (gunakan ref atau cara lain)
                const imageInput = document.querySelector('input[name="post_image"]');
                if (imageInput && imageInput.files.length > 0) {
                    formData.append('post_image', imageInput.files[0]);
                }

                const response = await this.fetchData(url, method, formData);

                console.log(response);

                if (response && response.status === 'success') {
                    Notifier.show('Berhasil!', response.message, 'success');
                    this.form.id = response.id;
                } else {
                    this.errors = response.errors ? response.errors : [];
                    Notifier.show('Gagal!', response ? response.message : 'Terjadi kesalahan.', 'error');
                }
            },
            init() {
                this.loadCategories();
                this.initTinymce()
                if (this.type === 'edit' && this.postId) {
                    this.loadPostById(this.postId);
                }
            },

            async fetchData(url, method = 'GET', body = null) {
                try {
                    const headers = {
                        'X-Requested-With': 'XMLHttpRequest'
                    };

                    // Jangan set Content-Type jika pakai FormData, browser akan otomatis menambahkan boundary
                    const isFormData = body instanceof FormData;
                    if (!isFormData) headers['Content-Type'] = 'application/json';

                    const response = await fetch(url, {
                        method,
                        headers,
                        body: body ? (isFormData ? body : JSON.stringify(body)) : null
                    });

                    if (!response.ok) {
                        const errorText = await response.text();
                        console.error('HTTP Error', response.status, errorText);
                        return null;
                    }

                    return await response.json();
                } catch (error) {
                    console.error('Fetch error:', error);
                    return null;
                }
            },
            async loadCategories() {
                const response = await this.fetchData(_BASEURL + `${config.controller}/categories`);
                console.log(response);
                if (response) {
                    this.categories = response.categories;
                } else {
                    Notifier.show('Error', 'Gagal memuat data.', 'error');
                }
            },

            async loadPostById(id) {
                const response = await this.fetchData(_BASEURL + `${config.controller}/postid/${this.postId}`);
                console.log(response);
                if (response) {
                    this.form = response;
                } else {
                    Notifier.show('Error', 'Gagal memuat data.', 'error');
                }
            },

            resetForm() {
                this.form = {
                    post_title: '',
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
                    this.previewFile = URL.createObjectURL(file);
                } else {
                    this.form.post_image = null; // Reset jika file tidak valid
                    Notifier.show('Error', 'File harus berupa JPG, JPEG, PNG, atau GIF.', 'error');
                }
            },

            initTinymce() {
                tinymce.init({
                    selector: "#post_content",
                    theme: 'modern',
                    paste_data_images: true,
                    relative_urls: false,
                    remove_script_host: false,
                    toolbar1: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image",
                    toolbar2: "print preview forecolor backcolor emoticons",
                    image_advtab: true,
                    plugins: [
                        "advlist autolink lists link image charmap print preview hr anchor pagebreak",
                        "searchreplace wordcount visualblocks visualchars code fullscreen",
                        "insertdatetime nonbreaking save table contextmenu directionality",
                        "emoticons template paste textcolor colorpicker textpattern"
                    ],
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
                        xhr.open('POST', _BASEURL + 'blog/posts/uploadimageeditor');
                        xhr.onload = function() {
                            if (xhr.status != 200) {
                                failure('HTTP Error: ' + xhr.status);
                                return;
                            }
                            var res = JSON.parse(xhr.responseText);
                            console.log(res.location);
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
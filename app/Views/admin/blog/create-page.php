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
                <textarea x-model="form.post_content" rows="25" id='post_content' x-model="form.post_content"
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
            <div class="border rounded bg-gray-50 p-2">
                <label class="block font-semibold">Publish Date</label>
                <input
                    type="datetime-local"
                    x-model="form.created_at"
                    class="block w-full rounded-md border border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50 px-3 py-2 text-gray-700" />
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
            <div class="border rounded bg-gray-50 p-4 space-y-3">
                <h3 class="font-semibold mb-2">🏷️ TAGS</h3>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Tags (pisahkan dengan koma)</label>
                    <input
                        type="text"
                        x-model="form.post_tags"
                        name="tags"
                        class="border rounded w-full p-2 focus:ring focus:ring-blue-200"
                        placeholder="contoh: teknologi, literasi, coding">

                    <!-- Optional: Tampilkan preview tag -->
                    <div class="mt-2">
                        <template x-for="tag in form.post_tags.split(',')" :key="tag.trim()">
                            <span class="inline-block bg-blue-100 text-blue-700 text-xs px-2 py-1 rounded mr-1 mb-1" x-text="tag.trim()"></span>
                        </template>
                    </div>
                </div>
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
                    <span class="text-xs italic text-red-600" x-text='errors.post_image'></span>
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
</script>
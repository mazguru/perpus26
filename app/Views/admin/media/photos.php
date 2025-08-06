<div x-data="photoManager(config)" x-init="init()">
  <div class="flex justify-between items-center mb-4">
    <h2 class="text-2xl font-bold">Foto Album: <?= esc($album['album_title']) ?></h2>
    <button @click="openModal" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
      + Unggah Foto
    </button>
  </div>
  <!-- Jika kosong -->
  <template x-if="photos.length === 0">
    <div class="text-center text-gray-500 p-6">
      <p>Belum ada foto di galeri ini.</p>
    </div>
  </template>

  <!-- Jika ada foto -->
  <!-- Galeri Foto -->
  <div x-show="photos.length > 0" class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-4">
    <template x-for="photo in photos" :key="photo.id">
      <div class="relative group">
        <img :src="_BASEURL+'/media_library/photos/' + photo.photo_name" class="rounded shadow w-full h-48 object-cover" />
        <button @click="deletePhoto(photo.id)"
          class="absolute top-2 right-2 bg-red-600 text-white p-1 rounded opacity-0 group-hover:opacity-100 transition">
          <span class="bi bi-trash">Hapus</span>
        </button>
      </div>
    </template>
  </div>

  <!-- Modal Upload -->
  <div x-show="showModal" class="fixed inset-0 bg-black/50 flex items-center justify-center z-50">
    <div class="bg-white p-6 rounded shadow-xl w-full max-w-lg" @click.outside="showModal = false">
      <h3 class="text-xl font-semibold mb-4">Unggah Foto</h3>
      <form @submit.prevent="submitUpload">
        <input type="hidden" name="photo_album_id" :value="albumId" />
        <input type="file" name="photos[]" multiple required accept="image/*"
          class="block w-full mb-4 border rounded px-3 py-2" />
        <div class="text-right">
          <button type="button" @click="showModal = false" class="mr-2 px-4 py-2 bg-gray-300 rounded">Batal</button>
          <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Unggah</button>
        </div>
      </form>
    </div>
  </div>
</div>

<script>
  const config = {
    id: <?= $album['id'] ?>
  }
</script>
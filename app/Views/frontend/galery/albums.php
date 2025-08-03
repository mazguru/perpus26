<style>
    .album-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px rgba(30, 64, 175, 0.2);
    }

    .album-card {
        transition: all 0.3s ease;
    }

    .gallery-container {
        background: linear-gradient(135deg, #1e40af 0%, #3b82f6 100%);
    }
</style>
<!-- Hero Section -->
<section class="gallery-container text-white py-16">
    <div class="container mx-auto px-4 text-center">
        <h2 class="text-4xl font-bold mb-4">Galeri Album Foto</h2>
        <p class="text-xl max-w-2xl mx-auto mb-8">Jelajahi koleksi foto kegiatan dan momen berharga di perpustakaan kami</p>

    </div>
</section>
<section class="py-12">
    <div class="container mx-auto px-4" x-data="galleryApp()" x-init="init()" >
        <h3 class="text-2xl font-semibold mb-4 text-center">Daftar Album</h3>
        <?php $albums = get_albums();
        if (!empty($albums)): ?>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
                <?php foreach ($albums as $album): ?>
                    <div class="album-card bg-white rounded-xl overflow-hidden shadow-lg">
                        <div class="relative">
                            <div class="h-48 bg-blue-100 overflow-hidden">
                                <img src="<?= base_url('upload/image/' . $album['image_cover']) ?>" alt="<?= esc($album['album_title']) ?>"
                                    class="rounded shadow cursor-pointer w-full aspect-[1/1] object-cover   hover:opacity-80"
                                    @click="open(<?= $album['id'] ?>)">
                            </div>
                            <div class="absolute top-4 right-4 bg-blue-600 text-white text-xs font-bold px-2 py-1 rounded-full"><?= $album['total_photos'] ?> Foto</div>
                        </div>
                        <div class="p-5">
                            <h3 class="text-xl font-semibold text-gray-800 mb-2"><?= esc($album['album_title']) ?></h3>
                            <p class="text-gray-600 mb-4"><?= esc($album['album_description']) ?></p>
                            <div class="flex justify-between items-center">
                                <span class="text-sm text-gray-500"><?= _date($album['created_at']) ?></span>
                                <button @click="open(<?= $album['id'] ?>)" class="text-blue-600 hover:text-blue-800 font-medium flex items-center">
                                    Lihat Album
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div id="album-<?= $album['id'] ?>" class="hidden">
                        <?= json_encode(array_map(function ($photo) {
                            return base_url('uploads/photos/' . $photo['photo_name']);
                        }, $album['photos'])) ?>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <p class="text-gray-500">Belum ada album tersedia.</p>
        <?php endif; ?>

        <!-- Modal Foto -->
        <div class="fixed inset-0 bg-black/80 z-50 flex items-center justify-center px-4" x-show="showModal" x-cloak>
            <div class="relative w-full max-w-4xl">
                <button class="absolute top-2 right-2 text-white text-2xl z-50" @click="close">&times;</button>
                <div class="swiper photo-swiper" x-ref="swiperContainer">
                    <div class="swiper-wrapper">
                        <template x-for="img in currentPhotos" :key="img">
                            <div class="swiper-slide px-4">
                                <img :src="img" class="w-full h-[70vh] object-contain rounded-lg" />
                            </div>
                        </template>
                    </div>
                    <div class="swiper-pagination"></div>
                    <div class="swiper-button-next text-white"></div>
                    <div class="swiper-button-prev text-white"></div>
                </div>
            </div>
        </div>
    </div>

</section>
<!-- Galeri -->
<section class="py-12 bg-white">
    <div class="container mx-auto px-4">
        <h2 class="text-3xl font-bold text-center">Galeri Kegiatan</h2>
        <p class="text-gray-600 max-w-2xl mx-auto text-center mb-6">
            Lihat koleksi foto dan video kegiatan momen-momen menarik di perpustakaan kami
        </p>

        <!-- Grid Video dan Album -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Galeri Foto -->
            <div x-data="galleryApp()" x-init="init()">
                <h3 class="text-2xl font-semibold mb-4">Galeri Foto</h3>
                <?php $albums = get_albums(4);
                if (!empty($albums)): ?>
                    <div class="grid grid-cols-2 gap-4">
                        <?php foreach ($albums as $album): ?>
                            <div class="text-center">
                                <img src="<?= base_url('media_library/images/' . $album['image_cover']) ?>" alt="<?= esc($album['album_title']) ?>"
                                    class="rounded shadow cursor-pointer w-full aspect-[1/1] object-cover hover:opacity-80"
                                    @click="open(<?= $album['id'] ?>)">
                                <h4 class="mt-2 text-base font-medium"><?= esc($album['album_title']) ?></h4>
                            </div>
                            <div id="album-<?= $album['id'] ?>" class="hidden">
                                <?= json_encode(array_map(function ($photo) {
                                    return base_url('media_library/photos/' . $photo['photo_name']);
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
            <!-- Galeri Video -->
            <div x-data="videoSwiper()" x-init="initSwiper()">
                <h3 class="text-2xl font-semibold mb-4">Galeri Video</h3>
                <?php $videos = get_videos(4);
                if (!empty($videos)): ?>
                    <div class="swiper video-swiper">
                        <div class="swiper-wrapper">
                            <?php foreach ($videos as $video): ?>
                                <div class="swiper-slide">
                                    <div class="cursor-pointer group" @click="openModal('<?= esc($video['post_content']) ?>')">
                                        <div class="aspect-video relative bg-black">
                                            <img src="https://img.youtube.com/vi/<?= esc($video['post_content']) ?>/hqdefault.jpg"
                                                class="w-full h-full object-cover">
                                            <div class="absolute inset-0 bg-black/40 flex items-center justify-center">
                                                <svg class="w-20 h-20 text-white group-hover:scale-110 transition" fill="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path d="M10 8.64v6.72L15.27 12 10 8.64z" />
                                                </svg>
                                            </div>
                                        </div>
                                        <h3 class="text-center mt-2 text-lg font-semibold"><?= esc($video['post_title']) ?></h3>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                <?php else: ?>
                    <p class="text-gray-500">Belum ada video tersedia.</p>
                <?php endif; ?>
                <!-- Modal Video -->
                <div x-show="showModal" x-transition x-cloak
                    class="fixed inset-0 z-50 bg-black/80 flex items-center justify-center p-4">
                    <div class="relative w-full max-w-4xl bg-transparent">
                        <button @click="closeModal()" class="absolute -top-6 right-0 text-white text-3xl">&times;</button>
                        <div class="w-full aspect-[16/9] rounded overflow-hidden shadow-lg">
                            <iframe class="w-full h-full" :src="videoUrl" frameborder="0" allow="autoplay; encrypted-media"
                                allowfullscreen></iframe>
                        </div>
                    </div>
                </div>
            </div>


        </div>
    </div>

    <!-- Alpine Components -->
    <script>
        
    </script>
</section>
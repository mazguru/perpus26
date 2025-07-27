<!-- Galeri -->
<section class="py-12 bg-gray-50" x-data="galleryApp()" x-init="init()">
    <div class="container mx-auto px-4">
        <h2 class="text-3xl font-bold text-center mb-10">Galeri Kegiatan</h2>

        <?php if (!empty($albums)): ?>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-8">
                <?php foreach ($albums as $album): ?>
                    <div class="text-center">
                        <img
                            src="<?= base_url('upload/image/' . $album['image_cover']) ?>"
                            alt="<?= esc($album['album_title']) ?>"
                            class="rounded shadow cursor-pointer w-full h-48 object-cover hover:opacity-80"
                            @click="open(<?= $album['id'] ?>)">
                        <h2 class="mt-2 text-lg font-semibold"><?= esc($album['album_title']) ?></h2>
                    </div>

                    <!-- JSON Photos per Album -->
                    <div id="album-<?= $album['id'] ?>" class="hidden">
                        <?= json_encode(array_map(function ($photo) {
                            return base_url('uploads/photos/' . $photo['photo_name']);
                        }, $album['photos'])) ?>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <p class="text-center text-gray-500">Belum ada album tersedia.</p>
        <?php endif ?>
    </div>

    <!-- Modal Swiper -->
    <div
        class="fixed inset-0 bg-black bg-opacity-80 z-50 flex items-center justify-center px-4"
        x-show="showModal"
        x-transition
        x-cloak>
        <div class="relative w-full max-w-4xl">
            <button
                class="absolute top-2 right-2 text-white text-2xl z-50"
                @click="close">&times;</button>

            <div class="swiper-container" x-ref="swiperContainer">
                <div class="swiper-wrapper">
                    <template x-for="img in currentPhotos" :key="img">
                        <div class="swiper-slide mx-4">
                            <img :src="img" class="w-full h-[70vh] object-contain rounded-lg" />
                        </div>
                    </template>
                </div>

                <!-- Pagination & Navigation -->
                <div class="swiper-pagination"></div>
                <div class="swiper-button-next text-white"></div>
                <div class="swiper-button-prev text-white"></div>
            </div>
        </div>
    </div>

    <!-- Swiper JS & Alpine Component -->
    <script>
        function galleryApp() {
            return {
                showModal: false,
                currentPhotos: [],
                swiper: null,
                open(albumId) {
                    const photoContainer = document.getElementById('album-' + albumId);
                    if (photoContainer) {
                        this.currentPhotos = JSON.parse(photoContainer.textContent);
                        photos = this.currentPhotos;
                        if (!photos || photos.length === 0) {
                            Notifier.show('info', 'Tidak ada Foto', 'info');
                            return
                        };

                        this.$nextTick(() => {
                            this.showModal = true;

                            // Hancurkan swiper lama (jika ada)
                            if (this.swiper) {
                                this.swiper.destroy(true, true);
                            }

                            // Inisialisasi Swiper
                            this.swiper = new Swiper(this.$refs.swiperContainer, {

                                spaceBetween: 30,
                                centeredSlides: true,
                                autoplay: {
                                    delay: 2500,
                                    disableOnInteraction: false,
                                },
                                pagination: {
                                    el: ".swiper-pagination",
                                    clickable: true,
                                },
                                navigation: {
                                    nextEl: ".swiper-button-next",
                                    prevEl: ".swiper-button-prev",
                                },

                            });
                        });
                    }
                },

                close() {
                    if (this.swiper) {
                        this.swiper.destroy(true, true);
                        this.swiper = null;
                    }
                    this.showModal = false;
                },
                init() {
                    // Optional preload
                }
            };
        }
    </script>

</section>
<style>
    .album-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px rgba(30, 64, 175, 0.2);
    }

    .album-card {
        transition: all 0.3s ease;
    }

    .gallery-container {
        background: linear-gradient(135deg, #f97316 0%, #fb923c 100%);
    }
</style>
<!-- Hero Section -->
<section class="gallery-container text-white py-16">
    <div class="container mx-auto px-4 text-center">
        <h2 class="text-4xl font-bold mb-4">Galeri Video Perpustakaan</h2>
        <p class="text-xl max-w-2xl mx-auto mb-8">Jelajahi koleksi video kegiatan, tutorial, dan konten edukatif dari perpustakaan kami</p>

    </div>
</section>
<section class="py-12">
    <div class="container mx-auto px-4" x-data="videoSwiper()">
        <h3 class="text-2xl font-semibold mb-4 text-center">Daftar Album</h3>
        <?php $videos = get_videos();
        if (!empty($videos)): ?>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
                <?php foreach ($videos as $video): ?>
                    <div class="album-card bg-white rounded-xl overflow-hidden shadow-lg">
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
                        </div>
                        <a href="<?= base_url('video/' . $video['post_slug']) ?>">
                            <h3 class="text-center mt-2 text-lg p-4 font-semibold"><?= esc($video['post_title']) ?></h3>
                        </a>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <p class="text-gray-500">Belum ada Video tersedia.</p>
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

</section>
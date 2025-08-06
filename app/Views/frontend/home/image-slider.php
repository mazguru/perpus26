<!-- Hero Section -->
<?php $banners = get_banners();
if (!empty($banners)): ?>
    <section x-data="swiperSlide()" x-init="initSwiper()" class="banner-one relative w-full overflow-hidden">
        <div class="swiper banner w-full relative">
            <div class="swiper-wrapper">
                <?php foreach ($banners as $banner): ?>
                    <div class="swiper-slide">
                        <div class="relative w-full min-h-[80vh] bg-center bg-cover">
                            <!-- Overlay -->
                            <div class="absolute inset-0 w-full h-full z-[-1]">
                                <!-- Fallback background image -->
                                <img
                                    class="w-full h-full object-cover"
                                    src="<?= base_url('media_library/images/' . $banner['image_cover']) ?>"
                                    alt="<?=$banner['title']?>" />
                            </div>
                            <div class="dark-overlay absolute inset-0 bg-[#000] bg-opacity-60"></div>
                            <div class="container relative z-10 flex flex-col items-center justify-center min-h-[80vh] text-white text-center px-4 py-16">
                                <h2 class="text-4xl md:text-5xl font-bold mb-4"><?= esc($banner['title']) ?></h2>
                                <p class="text-sm md:text-lg mb-8"><?= esc($banner['caption']) ?></p>
                                <?php if (!empty($banner['link']) || $banner['link'] != null): ?>
                                    <a href="<?= esc($banner['link']) ?>" class="bg-pumpkin-600 hover:bg-pumpkin-700 text-white font-medium py-3 px-6 rounded-lg transition duration-300 text-center">
                                        <span>selengkapnya →<span></i>
                                    </a>
                                <?php endif ?>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>

            <!-- Pagination -->
            <div class="swiper-pagination"></div>
        </div>

    </section>
<?php endif ?>


<!-- Hero Section -->
<section id='jelajah' class="text-white z-20 my-4">
    <div class="container mx-auto hero-pattern2 px-4 py-16 mb-4 rounded-2xl shadow-md">
        <div class="max-w-3xl  mx-auto text-center">
            <h2 class="text-4xl font-bold mb-4">Jelajahi Dunia Pengetahuan</h2>
            <p class="text-lg mb-8">Temukan berbagai artikel, berita, jurnal, dan sumber belajar digital untuk menambah wawasan Anda</p>
            <form action="/search" class="bg-white rounded-lg p-2 flex items-center shadow-lg">
                <input name="q" type="text" placeholder="Cari artikel berita atau informasi..." class="w-full px-4 py-2 outline-none text-gray-700">
                <button class="bg-pumpkin-600 text-white px-6 py-2 rounded-md hover:bg-pumpkin-700 transition">Cari</button>
            </form>
        </div>
    </div>
</section>
<section id="berita" class="bg-white py-16">
    <div class="max-w-screen-xl mx-auto px-4">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-bold text-gray-800 mb-2">Berita Terbaru</h2>
            <div class="w-24 h-1 bg-indigo-600 mx-auto mb-4"></div>
            <p class="text-gray-600 max-w-2xl mx-auto">Ikuti perkembangan terbaru dari perpustakaan kami, termasuk acara, koleksi baru, dan informasi penting lainnya.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <!-- Berita 1 -->
            <?php $postquery = get_latest_posts(6);
            if (! empty($postquery)) {
                foreach ($postquery as $berita) {
            ?>
                    <div class="news-card bg-white rounded-lg overflow-hidden shadow-md transition duration-300">
                        <div class="relative overflow-hidden">
                            <a href="/post/<?= $berita['post_slug'] ?>">
                                <?php if ($berita['post_image']): ?>
                                    <img src="<?= base_url() ?>/media_library/posts/thumbs/<?= $berita['post_image'] ?>" class="w-full transition delay-150 duration-300 ease-in-out aspect-[16/9] object-cover mb-2 hover:scale-110">
                                <?php else : ?>
                                    <div class="aspect-[16/9] object-cover">
                                        <svg class="w-full h-full bg-gray dark:bg-boxdark text-gray-300 p-2" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" fill="currentColor" viewBox="0 0 640 512">
                                            <path d="M480 80C480 35.82 515.8 0 560 0C604.2 0 640 35.82 640 80C640 124.2 604.2 160 560 160C515.8 160 480 124.2 480 80zM0 456.1C0 445.6 2.964 435.3 8.551 426.4L225.3 81.01C231.9 70.42 243.5 64 256 64C268.5 64 280.1 70.42 286.8 81.01L412.7 281.7L460.9 202.7C464.1 196.1 472.2 192 480 192C487.8 192 495 196.1 499.1 202.7L631.1 419.1C636.9 428.6 640 439.7 640 450.9C640 484.6 612.6 512 578.9 512H55.91C25.03 512 .0006 486.1 .0006 456.1L0 456.1z"></path>
                                        </svg>
                                    </div>
                                <?php endif ?>
                            </a>
                            <div class="bg-primary text-white py-1.5 px-3 rounded absolute top-2.5 left-2.5 text-sm"><?= esc($berita['category_name']) ?></div>
                        </div>

                        <div class="p-6">
                            <span class="text-xs font-semibold text-indigo-600 uppercase tracking-wider">Acara</span>
                            <h3 class="text-xl font-semibold text-gray-800 mt-2"><?= esc($berita['post_title']) ?></h3>
                            <p class="text-gray-600 mt-3"><?= strip_tags_truncate($berita['post_content']) ?></p>
                            <div class="mt-4 flex items-center">
                                <span class="text-sm text-gray-500">12 Mei 2023</span>
                                <a href="/post/<?= $berita['post_slug'] ?>" class="ml-auto text-indigo-600 hover:text-indigo-800 font-medium">Baca selengkapnya</a>
                            </div>
                        </div>
                    </div>

            <?php }
            } ?>


            <div class="relative bg-primarylight rounded-lg mb-7.5">
                <div class="relative overflow-hidden">
                    <a href="blog-details-1.html"><img src="assets/images/blog/blog-grid/pic7.png" alt=""></a>
                    <div class="bg-primary text-white py-1.5 px-3 rounded absolute top-2.5 left-2.5 text-sm">14 jan 2024</div>
                </div>
                <div class="py-[25px] px-7.5 max-xl:py-5 max-xl:px-4">
                    <div class="mb-[5px]">
                        <ul class="flex flex-wrap">
                            <li class="uppercase text-sm ltr:mr-5 rtl:ml-5 text-black flex items-center gap-x-[0.3rem]"><i class="las la-user-circle text-primary"></i> By <a class="text-primary ltr:ml-[3px] rtl:mr-[3px]" href="javascript:void(0);">Johne Doe</a></li>
                            <li class="uppercase text-sm ltr:mr-5 rtl:ml-5 text-black flex items-center gap-x-[0.3rem]"><i class="las la-comment text-primary"></i> <a class="text-primary ltr:ml-[3px] rtl:mr-[3px]" href="javascript:void(0);">15 Comments</a></li>
                        </ul>
                    </div>
                    <h4 class="mb-[5px] leading-[1.3]"><a href="blog-details-1.html">Fusce mollis felis quis tristique.</a></h4>
                    <p class="mb-5">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
                    <a href="javascript:void(0);" class="py-5 px-[35px] max-xl:py-3 max-xl:px-[25px] text-[15px] max-xl:text-sm inline-block font-medium leading-[1.2] uppercase bg-primary hover:bg-primaryhover text-white rounded duration-700">VIEW POST
                    </a>
                </div>
            </div>
        </div>


        <div class="text-center mt-10">
            <a href="#" class="inline-block bg-indigo-50 hover:bg-indigo-100 text-indigo-600 font-medium py-3 px-6 rounded-lg transition duration-300">Lihat Semua Berita</a>
        </div>
    </div>
</section>
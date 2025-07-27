<section id="berita" class="bg-white py-16">
    <div class="max-w-screen-xl mx-auto px-4">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-bold text-gray-800 mb-2">Berita Terbaru</h2>
            <div class="w-24 h-1 bg-indigo-600 mx-auto mb-4"></div>
            <p class="text-gray-600 max-w-2xl mx-auto">Ikuti perkembangan terbaru dari perpustakaan kami, termasuk acara, koleksi baru, dan informasi penting lainnya.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <!-- Berita 1 -->
            <?php foreach ($artikel as $a): ?>
                <div class="news-card bg-white rounded-lg overflow-hidden shadow-md transition duration-300">
                    <div class="relative overflow-hidden">
                        <a href="/post/<?= $a['post_slug'] ?>">
                            <?php if ($a['post_image']): ?>
                                <img src="<?= base_url() ?>/media_library/posts/thumbs/<?= $a['post_image'] ?>" class="w-full transition delay-150 duration-300 ease-in-out aspect-[16/9] object-cover mb-2 hover:scale-110">
                            <?php else : ?>
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-24 w-24 text-indigo-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>

                            <?php endif ?>
                        </a>
                        <div class="bg-primary text-white py-1.5 px-3 rounded absolute top-2.5 left-2.5 text-sm"><?= esc($a['category_name']) ?></div>
                    </div>
                    
                    <div class="p-6">
                        <span class="text-xs font-semibold text-indigo-600 uppercase tracking-wider">Acara</span>
                        <h3 class="text-xl font-semibold text-gray-800 mt-2"><?= esc($a['post_title']) ?></h3>
                        <p class="text-gray-600 mt-3"><?= strip_tags_truncate($a['post_content'])?></p>
                        <div class="mt-4 flex items-center">
                            <span class="text-sm text-gray-500">12 Mei 2023</span>
                            <a href="/post/<?= $a['post_slug'] ?>" class="ml-auto text-indigo-600 hover:text-indigo-800 font-medium">Baca selengkapnya</a>
                        </div>
                    </div>
                </div>

            <?php endforeach ?>
            

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
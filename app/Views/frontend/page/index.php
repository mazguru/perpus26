<main class="mb-4"><!-- Blog Header -->
    <header class="hero-pattern2 text-white py-16">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <div class="mb-4 flex justify-center">
                <span class="inline-block bg-white bg-opacity-20 rounded-full px-4 py-1 text-sm font-semibold"><?= $artikel['category_name'] ?></span>
            </div>
            <h1 class="text-3xl md:text-4xl lg:text-5xl font-bold mb-4"><?= $artikel['post_title'] ?></h1>
            <div class="flex items-center justify-center space-x-4">
                <div class="flex items-center">
                    <div class="h-10 w-10 rounded-full bg-white overflow-hidden">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-full w-full text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
                        </svg>
                    </div>
                    <span class="ml-2"><?= $artikel['post_author'] ?></span>
                </div>
                <span>•</span>
                <span><?= date_indo($artikel['created_at']) ?></span>
                <span class="hidden md:block">•</span>
                <span class="hidden md:block"><?= read_time($artikel['post_content']) ?></span>
            </div>
        </div>
    </header>

    <!-- Blog Content -->
    <main class="container bg-white shadow-lg -mt-10 rounded-lg py-8">

        <article class="prose max-w-none">
            <?= $artikel['post_content'] ?>
        </article>

        <!-- Author Bio -->
        <div class="mt-12 pt-8 border-t border-gray-200">
            <div class="flex items-center">
                <div class="h-16 w-16 rounded-full bg-gray-100 overflow-hidden">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-full w-full text-pumpkin-400" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
                    </svg>
                </div>
                <div class="ml-4">
                    <h3 class="text-xl font-bold"><?= $artikel['post_author'] ?></h3>
                    <p class="text-gray-600"><?= $artikel['author_jabatan'] ?></p>
                    <p class="mt-2"><?= $artikel['author_bio'] ?></p>
                </div>
            </div>
        </div>

        <!-- Share Buttons -->
        <div class="mt-8 flex items-center">
            <span class="mr-4 font-semibold">Share this article:</span>
            <div class="flex space-x-3">
                <button class="p-2 bg-pumpkin-600 text-white rounded-full hover:bg-pumpkin-700 transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M9 8h-3v4h3v12h5v-12h3.642l.358-4h-4v-1.667c0-.955.192-1.333 1.115-1.333h2.885v-5h-3.808c-3.596 0-5.192 1.583-5.192 4.615v3.385z" />
                    </svg>
                </button>
                <button class="p-2 bg-pumpkin-400 text-white rounded-full hover:bg-pumpkin-500 transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z" />
                    </svg>
                </button>
                <button class="p-2 bg-pumpkin-700 text-white rounded-full hover:bg-pumpkin-800 transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M4.98 3.5c0 1.381-1.11 2.5-2.48 2.5s-2.48-1.119-2.48-2.5c0-1.38 1.11-2.5 2.48-2.5s2.48 1.12 2.48 2.5zm.02 4.5h-5v16h5v-16zm7.982 0h-4.968v16h4.969v-8.399c0-4.67 6.029-5.052 6.029 0v8.399h4.988v-10.131c0-7.88-8.922-7.593-11.018-3.714v-2.155z" />
                    </svg>
                </button>
            </div>
        </div>

        <!-- Related Posts -->
        <?php $otherpage = get_another_pages($artikel['id'], 3) ?>
        <div class="mt-12 pt-8 border-t border-gray-200">
            <h3 class="text-2xl font-bold mb-6">Related Articles</h3>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <?php foreach ($otherpage as $page) : ?>
                    <div class="border shadow-md rounded">
                    <a href="<?= base_url('page/' . $artikel['post_slug']) ?>" class="block group">
                        <div class="min-h-40 bg-abbey-200 relative">
                            <a href="<?= base_url('page/' . $page['post_slug']) ?>" class="h-40">
                                <?php if ($page['post_image']): ?>
                                    <img class="w-full object-cover hover:scale-110 transition" src="<?= base_url('media_library/posts/thumbs/' . $page['post_image']) ?>">
                                <?php else: ?>

                                    <svg class="text-gray-400 object-cover hover:scale-110 transition h-40 mx-auto " xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                    </svg>
                                <?php endif ?>
                            </a>
                        </div>
                        <div class="p-4">
                            <a href="<?= base_url('page/' . $page['post_slug']) ?>">
                                <h4 class="font-bold text-gray-800 mb-2 hover:text-pumpkin-600 transition"><?= $page['post_title'] ?></h4>
                            </a>
                            <p class="text-gray-600 text-sm mb-3 line-clamp-2"><?= strip_tags_truncate($page['post_content'], 100) ?></p>
                            <div class="flex justify-between items-center text-xs text-gray-500">
                                <span><?= _date($page['created_at']) ?></span>
                                <span><?= reading_time($artikel['post_content']) ?></span>
                            </div>
                        </div>
                    </a>
                    </div>
                <?php endforeach ?>
            </div>
        </div>

        <?= $this->include('frontend/page/comment') ?>


    </main>
</main>
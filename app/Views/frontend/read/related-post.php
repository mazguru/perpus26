<!-- Related Posts Section -->
<div class="bg-white rounded-lg shadow-md p-6 mb-8">
    <h3 class="text-xl font-bold mb-6 text-gray-800">Related Posts</h3>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <!-- Related Post 1 -->
        <?php $relatedPost = get_related_posts($artikel['post_categories'], $artikel['id']);
        if (!empty($relatedPost)) {
            foreach ($relatedPost as $rp) { ?>
                <div class="bg-white border border-gray-200 rounded-lg overflow-hidden hover:shadow-md transition">
                    <div class="h-40  bg-gray-200 relative">
                        <a href="<?= base_url('post/' . $rp['post_slug']) ?>" class="h-40">
                            <?php if ($rp['post_image']): ?>
                                <img class="w-full object-cover hover:scale-110 transition" src="<?= base_url('media_library/posts/thumbs/' . $rp['post_image']) ?>">
                            <?php else: ?>

                                <svg class="text-gray-400 object-cover hover:scale-110 transition h-40 mx-auto " xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                            <?php endif ?>
                        </a>
                        <div class="absolute top-2 left-2 bg-blue-600 text-white text-xs font-bold px-2 py-1 rounded"><?= $rp['category_name'] ?></div>
                    </div>
                    <div class="p-4">
                        <a href="<?= base_url('post/' . $rp['post_slug']) ?>">
                            <h4 class="font-bold text-gray-800 mb-2 hover:text-blue-600 transition"><?= $rp['post_title'] ?></h4>
                        </a>
                        <p class="text-gray-600 text-sm mb-3 line-clamp-2"><?= strip_tags_truncate($rp['post_title'], 100) ?></p>
                        <div class="flex justify-between items-center text-xs text-gray-500">
                            <span><?= _date($rp['created_at']) ?></span>
                            <span><?= reading_time($artikel['post_content']) ?></span>
                        </div>
                    </div>
                </div>
        <?php }
        } ?>
    </div>
</div>
<!-- Related Posts -->
<?php $otherpage = get_another_pages($artikel['id'], 3);
if (!empty($otherpage)): ?>
<section class="mx-auto space-y-6 mb-4">
    <div class="mt-12 pt-8 border-t border-gray-200">
        <h3 class="text-2xl font-bold mb-6">Related Articles</h3>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <?php foreach ($otherpage as $page) : ?>
                <div class="border bg-white shadow-md rounded">
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
</section>
<?php endif ?>
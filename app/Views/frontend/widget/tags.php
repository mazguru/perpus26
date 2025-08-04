<!-- Tags Widget -->
<div class="bg-white rounded-lg shadow-md p-6 mb-6">
    <h3 class="text-xl font-bold mb-4 text-gray-800">Tags</h3>
    <div class="flex flex-wrap gap-2">
        <?php $tags = get_tags(10);
        if (!empty($tags)):
            foreach ($tags as $tag) : ?>
                <a href="<?= base_url('tags/' . $tag['slug']) ?>" class="px-3 py-1 bg-abbey-100 text-gray-700 rounded-full text-sm hover:bg-pumpkin-100 hover:text-pumpkin-700 transition"><?= $tag['tag'] ?></a>
            <?php endforeach ?>
        <?php endif ?>
    </div>
</div>
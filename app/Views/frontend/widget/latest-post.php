<!-- Recent Posts Widget -->
  <?php $recent = get_latest_posts(5);
  if (!empty($recent)): ?>
    <div class="bg-white rounded-lg shadow-md p-6 mb-6">
      <h3 class="text-xl font-bold mb-4 text-gray-800">Recent Posts</h3>
      <div class="space-y-4">
        <?php foreach ($recent as $rc) : ?>
          <a href="<?= base_url($rc['post_type'] . '/' . $rc['post_slug']) ?>" class="block group">
            <div class="flex items-start">
              <div class="w-16 h-16 bg-abbey-200 rounded flex-shrink-0">
                <?php if ($rc['post_image']): ?>

                  <img
                    src="<?= base_url() ?>/media_library/posts/thumbs/<?= $rc['post_image'] ?>"
                    class="w-full h-full object-cover rounded-lg shrink-0 transition delay-150 duration-300 ease-in-out mb-2 hover:scale-110"
                    alt="<?= $rc['post_title'] ?>"
                    loading="lazy"
                    onerror="this.onerror=null; this.src='<?= base_url('assets/images/noimage.svg') ?>'">

                <?php else : ?>

                  <svg xmlns="http://www.w3.org/2000/svg" class="w-full h-full text-gray-400 hover:scale-110 hover:transition-all" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                  </svg>

                <?php endif ?>
              </div>
              <div class="ml-4">
                <h4 class="font-medium text-gray-800 group-hover:text-pumpkin-600 transition"><?= $rc['post_title'] ?></h4>
                <span class="text-sm text-gray-500"><?= _date($rc['created_at']) ?></span>
              </div>
            </div>
          </a>
        <?php endforeach ?>
      </div>
    </div>
  <?php endif ?>
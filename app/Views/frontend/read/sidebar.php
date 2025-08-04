<!-- Sidebar -->
<aside class="w-full md:w-1/3">
  <!-- About Widget -->
  

  <!-- Search Widget -->
  <div class="bg-white rounded-lg shadow-md p-6 mb-6">
    <h3 class="text-xl font-bold mb-4 text-gray-800">Search</h3>
    <form action="<?= base_url('search') ?>" class="relative" methode="GET">
      <input type="text" name="q" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-pumpkin-500" placeholder="Search posts...">
      <button type="submit" class="absolute right-2 top-2 text-gray-500 hover:text-gray-700">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
        </svg>
      </button>
    </form>
  </div>

  <!-- Categories Widget -->
  <div class="bg-white rounded-lg shadow-md p-6 mb-6">
    <h3 class="text-xl font-bold mb-4 text-gray-800">Categories</h3>
    <ul class="space-y-2">
      <?php $catCount = count_post_categories();
      foreach ($catCount as $cc) : ?>
        <li>
          <a href="<?= base_url('categories/' . $cc['category_slug']) ?>" class="flex items-center justify-between text-gray-700 hover:text-pumpkin-600 transition">
            <span><?= $cc['category_name'] ?></span>
            <span class="bg-abbey-100 text-gray-600 text-xs font-medium px-2 py-1 rounded-full"><?= $cc['post_count'] ?></span>
          </a>
        </li>
      <?php endforeach ?>
    </ul>
  </div>

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

</aside>
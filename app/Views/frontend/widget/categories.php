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
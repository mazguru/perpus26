<div class="max-w-7xl mx-auto p-6 grid grid-cols-1 md:grid-cols-3 gap-8">
  <article class="md:col-span-2 shadow-md p-4 md:p-6 lg:p-8 xl:p-16 relative bg-white dark:bg-slate-800 rounded-xl prose max-w-none lg:prose-md prose-p:text-justify prose-p:text-black dark:prose-invert prose-headings:font-sans prose-headings:tracking-tight prose-ul:text-justify prose-ol:text-justify prose-pre:dark:border prose-pre:dark:border-slate-700 prose-table:w-max prose-table:mx-auto prose-td:py-0 prose-td:px-2 prose-th:px-2">
    <h1 class="text-2xl md:text-3xl font-bold text-gray-900 leading-snug mb-4">
      <?= esc($artikel['post_title']) ?>
    </h1>
    <div class="flex items-center space-x-4 text-sm text-gray-500 mb-4">
      <div class="flex items-center space-x-1">
        <svg class="w-4 h-4 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            d="M8 7V3m8 4V3M5 11h14M5 19h14M5 15h14" />
        </svg>
        <span>7 March, 2024</span>
      </div>
      <div class="flex items-center space-x-1">
        <svg class="w-4 h-4 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            d="M5.121 17.804A7.5 7.5 0 0117.803 5.121M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
        </svg>
        <span><?= esc($artikel['post_author']) ?></span>
      </div>
    </div>
    <?= $artikel['post_content'] ?>
  </article>

  <!-- Sidebar -->
  <aside class="md:col-span-1">
    <div class="top-32 sticky max-lg:static">
      <!-- Search -->
      <div class="mb-8 ">
        <label class="block relative">
          <input type="text" placeholder="Search" class="w-full pl-4 pr-12 py-2 border rounded-lg focus:outline-none shadow-sm" />
          <button class="absolute top-1/2 right-2 transform -translate-y-1/2 bg-purple-600 hover:bg-purple-700 text-white px-3 py-1 rounded-lg">
            →
          </button>
        </label>
      </div>

      <!-- Category -->
      <div class="mb-8">
        <h2 class="text-xl font-bold text-purple-700 mb-4">CATEGORY</h2>
        <ul class="space-y-2 text-gray-700">
          <li>› Audio <span class="text-gray-400">(3)</span></li>
          <li>› Beauty <span class="text-gray-400">(4)</span></li>
          <li>› Fashion <span class="text-gray-400">(3)</span></li>
          <li>› Images <span class="text-gray-400">(1)</span></li>
          <li>› Lifestyle <span class="text-gray-400">(3)</span></li>
        </ul>
      </div>

      <!-- Recent Posts -->
      <div>
        <h2 class="text-xl font-bold text-purple-700 mb-4">RECENT POSTS</h2>
        <div class="space-y-4">
          <div class="flex items-start space-x-3">
            <img src="thumb1.jpg" class="w-16 h-16 object-cover rounded" alt="">
            <div>
              <p class="font-semibold text-black leading-tight">Fusce mollis felis quis tristique</p>
              <p class="text-sm text-purple-600">7 March, 2024</p>
            </div>
          </div>
          <div class="flex items-start space-x-3">
            <img src="thumb2.jpg" class="w-16 h-16 object-cover rounded" alt="">
            <div>
              <p class="font-semibold text-black leading-tight">Fusce mollis felis quis tristique</p>
              <p class="text-sm text-purple-600">7 March, 2024</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </aside>
</div>
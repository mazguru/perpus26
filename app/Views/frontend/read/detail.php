<article class="bg-white rounded-lg shadow-md p-6 mb-8">
  <h1 class="text-3xl font-bold text-gray-800 mb-4"><?= $artikel['post_title'] ?></h1>
  <div class="flex items-center text-gray-500 text-sm mb-6 pb-4 border-b">
    <span class="mr-4">
      <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 inline mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
      </svg>
      <?= _date($artikel['created_at']) ?>
    </span>
    <span class="mr-4">
      <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 inline mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
      </svg>
      By <?= $artikel['post_author'] ?>
    </span>
    <?php if (!empty($artikel['post_tags'])) { ?>
      <span class="mr-4">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 inline mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
        </svg>
        <?= generate_tags_links($artikel['post_tags']) ?>
      </span>
    <?php } ?>
    <span>
      <i class="bi bi-eye h-4 w-4 mr-1"></i>
      Dibaca <?= number_format($artikel['post_counter']) ?> kali
    </span>
  </div>

  <div class="mb-6 rounded-lg overflow-hidden bg-gray-100">
    <?php
    $imagePath = FCPATH . 'media_library/posts/headers/' . $artikel['post_image']; // Absolute path
    if (is_file($imagePath)) { ?>
      <img src="<?= base_url('media_library/posts/headers/' . $artikel['post_image']) ?>" alt="<?= $artikel['post_title'] ?>" class="w-full">
    <?php } ?>

  </div>

  <div class="prose max-w-none text-gray-700">
    <?php if ($artikel['post_type'] == 'video'): ?>
      <div class="overflow-hidden relative rounded-md shadow-[0_0.5rem_1rem_rgba(0,0,0,0.15)]">
        <iframe class="h-[450px] max-md:h-[300px] max-sm:h-[200px]" src="https://www.youtube.com/embed/<?= $artikel['post_content'] ?>" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen style="width: 100%; vertical-align: middle;"></iframe>
      </div>
    <?php else : ?>
      <?= $artikel['post_content'] ?>
    <?php endif ?>
  </div>

  <!-- Share Buttons - Bottom -->
  <div class="flex items-center mt-8 pt-6 border-t border-gray-200">
    <span class="mr-3 font-medium text-gray-700">Share this post:</span>
    <div class="flex space-x-2">
      <button onclick="shareOnFacebook()" class="p-2 bg-blue-600 text-white rounded-full hover:bg-blue-700 transition">
        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
          <path d="M9 8h-3v4h3v12h5v-12h3.642l.358-4h-4v-1.667c0-.955.192-1.333 1.115-1.333h2.885v-5h-3.808c-3.596 0-5.192 1.583-5.192 4.615v3.385z" />
        </svg>
      </button>
      <button onclick="shareOnTwitter()" class="p-2 bg-sky-500 text-white rounded-full hover:bg-sky-600 transition">
        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
          <path d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z" />
        </svg>
      </button>
      <button onclick="shareOnLinkedIn()" class="p-2 bg-blue-700 text-white rounded-full hover:bg-blue-800 transition">
        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
          <path d="M4.98 3.5c0 1.381-1.11 2.5-2.48 2.5s-2.48-1.119-2.48-2.5c0-1.38 1.11-2.5 2.48-2.5s2.48 1.12 2.48 2.5zm.02 4.5h-5v16h5v-16zm7.982 0h-4.968v16h4.969v-8.399c0-4.67 6.029-5.052 6.029 0v8.399h4.988v-10.131c0-7.88-8.922-7.593-11.018-3.714v-2.155z" />
        </svg>
      </button>
      <button onclick="shareOnPinterest()" class="p-2 bg-red-600 text-white rounded-full hover:bg-red-700 transition">
        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
          <path d="M12 0c-6.627 0-12 5.372-12 12 0 5.084 3.163 9.426 7.627 11.174-.105-.949-.2-2.405.042-3.441.218-.937 1.407-5.965 1.407-5.965s-.359-.719-.359-1.782c0-1.668.967-2.914 2.171-2.914 1.023 0 1.518.769 1.518 1.69 0 1.029-.655 2.568-.994 3.995-.283 1.194.599 2.169 1.777 2.169 2.133 0 3.772-2.249 3.772-5.495 0-2.873-2.064-4.882-5.012-4.882-3.414 0-5.418 2.561-5.418 5.207 0 1.031.397 2.138.893 2.738.098.119.112.224.083.345l-.333 1.36c-.053.22-.174.267-.402.161-1.499-.698-2.436-2.889-2.436-4.649 0-3.785 2.75-7.262 7.929-7.262 4.163 0 7.398 2.967 7.398 6.931 0 4.136-2.607 7.464-6.227 7.464-1.216 0-2.359-.631-2.75-1.378l-.748 2.853c-.271 1.043-1.002 2.35-1.492 3.146 1.124.347 2.317.535 3.554.535 6.627 0 12-5.373 12-12 0-6.628-5.373-12-12-12z" />
        </svg>
      </button>
      <button onclick="shareByEmail()" class="p-2 bg-gray-600 text-white rounded-full hover:bg-gray-700 transition">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
        </svg>
      </button>
      <button onclick="copyLink()" class="p-2 bg-green-600 text-white rounded-full hover:bg-green-700 transition">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"></path>
        </svg>
      </button>
    </div>
  </div>

  <!-- Author Bio -->
  <div class="mt-8 pt-6 border-t border-gray-200">
    <div class="flex items-center">
      <div class="w-12 h-12 rounded-full bg-gray-300 flex-shrink-0 overflow-hidden">
        <svg class="w-full h-full text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
          <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"></path>
        </svg>
      </div>
      <div class="ml-4">
        <h3 class="text-lg font-medium text-gray-800"><?= $artikel['post_author'] ?></h3>
        <p class="text-gray-600"><?= $artikel['author_bio'] ?></p>
      </div>
    </div>
  </div>
</article>
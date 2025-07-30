<div class="mb-12 text-center">
    <h2 class="text-4xl font-bold text-gray-800 mb-4">Latest Articles</h2>
    <p class="text-gray-600 max-w-2xl mx-auto">Discover our collection of insightful articles covering various topics from technology to lifestyle.</p>
</div>

<div class="flex flex-wrap justify-center mb-8">
    <button class="category-badge bg-indigo-600 text-white px-4 py-2 rounded-full m-1 text-sm font-medium">All</button>
    <button class="category-badge bg-white text-gray-700 px-4 py-2 rounded-full m-1 text-sm font-medium hover:bg-indigo-100">Technology</button>
    <button class="category-badge bg-white text-gray-700 px-4 py-2 rounded-full m-1 text-sm font-medium hover:bg-indigo-100">Travel</button>
    <button class="category-badge bg-white text-gray-700 px-4 py-2 rounded-full m-1 text-sm font-medium hover:bg-indigo-100">Food</button>
    <button class="category-badge bg-white text-gray-700 px-4 py-2 rounded-full m-1 text-sm font-medium hover:bg-indigo-100">Lifestyle</button>
    <button class="category-badge bg-white text-gray-700 px-4 py-2 rounded-full m-1 text-sm font-medium hover:bg-indigo-100">Health</button>
</div>

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
    <!-- Blog Card 1 -->
    <div class="card bg-white rounded-xl overflow-hidden shadow-md">
        <div class="relative">
            <div class="h-48 bg-indigo-400 flex items-center justify-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-20 w-20 text-white opacity-80" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                </svg>
            </div>
            <span class="absolute top-4 left-4 bg-indigo-600 text-white text-xs font-semibold px-3 py-1 rounded-full">Technology</span>
        </div>
        <div class="p-6">
            <div class="flex items-center mb-2">
                <div class="w-8 h-8 rounded-full bg-gray-300 flex items-center justify-center mr-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                </div>
                <span class="text-sm text-gray-600">John Doe</span>
                <span class="mx-2 text-gray-400">•</span>
                <span class="text-sm text-gray-600">May 15, 2023</span>
            </div>
            <h3 class="text-xl font-semibold mb-2 text-gray-800">The Future of Artificial Intelligence</h3>
            <p class="text-gray-600 mb-4">Exploring how AI is transforming industries and what we can expect in the coming years.</p>
            <div class="flex justify-between items-center">
                <a href="#" class="text-indigo-600 font-medium hover:text-indigo-800 transition-colors">Read More</a>
                <div class="flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-500 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                    </svg>
                    <span class="text-sm text-gray-500">1.2k</span>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- CSRF (jika aktif di CI4) -->
<meta name="csrf-token-name" content="<?= esc(csrf_token()) ?>">
<meta name="csrf-token" content="<?= esc(csrf_hash()) ?>">

<div
  x-data="postsByCategory({
    baseUrl: '<?= rtrim(base_url('/'), '/') ?>/',
    endpoint: 'categories/list',            // endpoint AJAX
    categorySlug: '<?= esc($categorySlug ?? '') ?>',
    perPage: <?= (int) (session('post_per_page') ?? 10) ?>
  })"
  x-init="fetchPosts()"
  class="mx-auto max-w-6xl px-4 py-6"
>
  <!-- Header -->
  <div class="mb-6 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
    <h1 class="text-2xl font-semibold tracking-tight">Artikel</h1>

    <div class="flex items-center gap-2">
      <label class="text-sm">Kategori:</label>
      <input
        type="text"
        x-model.debounce.500ms="categorySlug"
        @change="page = 1; fetchPosts()"
        placeholder="slug-kategori"
        class="w-56 rounded-lg border border-gray-300 px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500"
      >
    </div>
  </div>

  <!-- Error -->
  <template x-if="error">
    <div class="mb-4 rounded-lg border border-red-200 bg-red-50 p-3 text-sm text-red-700" x-text="error"></div>
  </template>

  <!-- Skeleton -->
  <template x-if="loading">
    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-3">
      <template x-for="i in 6" :key="i">
        <div class="rounded-xl border border-gray-200 p-4">
          <div class="h-40 w-full animate-pulse rounded-lg bg-gray-200"></div>
          <div class="mt-4 h-5 w-3/4 animate-pulse rounded bg-gray-200"></div>
          <div class="mt-2 h-4 w-1/2 animate-pulse rounded bg-gray-200"></div>
          <div class="mt-3 h-10 w-24 animate-pulse rounded bg-gray-200"></div>
        </div>
      </template>
    </div>
  </template>

  <!-- Grid posts -->
  <template x-if="!loading && rows.length">
    <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3">
      <template x-for="post in rows" :key="post.id">
        <article class="flex flex-col overflow-hidden rounded-xl border border-gray-200 bg-white shadow-sm">
          <div class="aspect-[16/9] w-full bg-gray-100">
            <img
              :src="post.post_image ? (baseUrl + 'uploads/posts/' + post.post_image) : (baseUrl + 'assets/img/placeholder.png')"
              :alt="post.post_title"
              class="h-full w-full object-cover"
              loading="lazy"
            >
          </div>
          <div class="flex flex-1 flex-col p-4">
            <h3 class="line-clamp-2 text-lg font-semibold" x-text="post.post_title"></h3>
            <p class="mt-1 text-xs text-gray-500">
              <span x-text="post.post_author"></span>
              ·
              <span x-text="formatDate(post.created_at)"></span>
            </p>
            <p class="mt-3 line-clamp-3 text-sm text-gray-700" x-html="excerpt(post.post_content)"></p>

            <div class="mt-auto pt-4">
              <a :href="baseUrl + 'blog/detail/' + post.post_slug"
                 class="inline-flex items-center rounded-lg border border-indigo-200 bg-indigo-50 px-3 py-2 text-sm font-medium text-indigo-700 hover:bg-indigo-100">
                Baca selengkapnya
              </a>
            </div>
          </div>
        </article>
      </template>
    </div>
  </template>

  <!-- Empty -->
  <template x-if="!loading && !rows.length">
    <div class="rounded-xl border border-gray-200 bg-white p-8 text-center text-gray-600">
      Tidak ada artikel pada halaman ini.
    </div>
  </template>

  <!-- Pagination -->
  <div class="mt-8 flex items-center justify-between">
    <button
      @click="prev()"
      :disabled="page <= 1"
      class="rounded-lg border px-3 py-2 text-sm disabled:cursor-not-allowed disabled:opacity-50"
    >Sebelumnya</button>

    <!-- Page numbers jika totalPages tersedia -->
    <template x-if="totalPages">
      <div class="flex items-center gap-1">
        <template x-for="n in pageRange()" :key="n">
          <button
            @click="go(n)"
            class="min-w-[2.25rem] rounded-lg border px-3 py-2 text-sm"
            :class="n === page ? 'border-indigo-500 bg-indigo-50 text-indigo-700' : 'hover:bg-gray-50'"
            x-text="n"
          ></button>
        </template>
      </div>
    </template>

    <!-- Jika tidak ada totalPages, tampilkan posisi halaman saja -->
    <template x-if="!totalPages">
      <div class="text-sm text-gray-600">Halaman <span x-text="page"></span></div>
    </template>

    <button
      @click="next()"
      :disabled="!canNext()"
      class="rounded-lg border px-3 py-2 text-sm disabled:cursor-not-allowed disabled:opacity-50"
    >Berikutnya</button>
  </div>
</div>

<script>
document.addEventListener('alpine:init', () => {
  Alpine.data('postsByCategory', (cfg) => ({
    baseUrl: cfg.baseUrl,
    endpoint: cfg.endpoint,
    categorySlug: cfg.categorySlug || '',
    perPage: cfg.perPage || 10,

    page: 1,
    rows: [],
    loading: false,
    error: null,

    // opsional jika backend mengembalikan total
    total: null,
    totalPages: null,

    // CSRF (jika aktif)
    csrfName: document.querySelector('meta[name="csrf-token-name"]')?.getAttribute('content'),
    csrfHash: document.querySelector('meta[name="csrf-token"]')?.getAttribute('content'),

    async fetchPosts() {
      try {
        this.loading = true;
        this.error = null;

        const url = new URL(this.endpoint, this.baseUrl).toString();
        const body = new URLSearchParams({
          category_slug: this.categorySlug,
          page_number: this.page
        });

        if (this.csrfName && this.csrfHash) {
          body.append(this.csrfName, this.csrfHash);
        }

        const res = await fetch(url, {
          method: 'POST',
          headers: {
            'X-Requested-With': 'XMLHttpRequest', // agar $this->request->isAJAX() true
            'Accept': 'application/json',
            'Content-Type': 'application/x-www-form-urlencoded;charset=UTF-8'
          },
          credentials: 'same-origin',
          body
        });

        if (!res.ok) throw new Error(`HTTP ${res.status}`);

        const data = await res.json();
        console.log(data);

        // Minimal: { rows: [...] }
        this.rows = Array.isArray(data.rows) ? data.rows : [];

        // Opsional: { total: 123, perPage: 10 }
        if (typeof data.total === 'number') {
          this.total = data.total;
          this.totalPages = Math.max(1, Math.ceil(this.total / (data.perPage || this.perPage)));
        } else {
          this.total = null;
          this.totalPages = null;
        }

        // Refresh CSRF jika backend kirim hash baru
        if (data.csrfToken && this.csrfName) {
          this.csrfHash = data.csrfToken;
        }
      } catch (e) {
        console.error(e);
        this.error = 'Gagal memuat artikel. Coba lagi.';
        this.rows = [];
      } finally {
        this.loading = false;
      }
    },

    prev() {
      if (this.page > 1) {
        this.page--;
        this.fetchPosts();
        this.scrollTop();
      }
    },

    next() {
      if (this.canNext()) {
        this.page++;
        this.fetchPosts();
        this.scrollTop();
      }
    },

    go(n) {
      if (n !== this.page) {
        this.page = n;
        this.fetchPosts();
        this.scrollTop();
      }
    },

    canNext() {
      // Jika totalPages diketahui → patokan total
      if (this.totalPages) return this.page < this.totalPages;
      // Tanpa total → jika jumlah rows < perPage, anggap habis
      return this.rows.length >= this.perPage;
    },

    pageRange() {
      // tampilkan range kecil di sekitar current page (mis. 1..N atau sliding window)
      if (!this.totalPages) return [];
      const window = 2; // current ±2
      const start = Math.max(1, this.page - window);
      const end = Math.min(this.totalPages, this.page + window);
      const arr = [];
      for (let i = start; i <= end; i++) arr.push(i);
      return arr;
    },

    formatDate(iso) {
      if (!iso) return '';
      const d = new Date(iso);
      if (isNaN(d)) return iso;
      return d.toLocaleDateString('id-ID', { year: 'numeric', month: 'long', day: 'numeric' });
    },

    excerpt(html, len = 150) {
      const tmp = document.createElement('div');
      tmp.innerHTML = html || '';
      const text = tmp.textContent || tmp.innerText || '';
      return text.length > len ? text.slice(0, len) + '…' : text;
    },

    scrollTop() {
      window.scrollTo({ top: 0, behavior: 'smooth' });
    }
  }));
});
</script>
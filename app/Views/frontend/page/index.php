<main class="mb-4"><!-- Blog Header -->
    <header class="bg-gradient-to-r from-indigo-500 to-purple-600 text-white py-16">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <div class="mb-4 flex justify-center">
                <span class="inline-block bg-white bg-opacity-20 rounded-full px-4 py-1 text-sm font-semibold">Technology</span>
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
                <span>•</span>
                <span><?= read_time($artikel['post_content']) ?></span>
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
                <div class="h-16 w-16 rounded-full bg-indigo-100 overflow-hidden">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-full w-full text-indigo-400" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
                    </svg>
                </div>
                <div class="ml-4">
                    <h3 class="text-xl font-bold"><?= $artikel['post_author'] ?></h3>
                    <p class="text-gray-600">Senior Web Developer & Tech Enthusiast</p>
                    <p class="mt-2">John has been developing web applications for over a decade and loves sharing insights about emerging technologies.</p>
                </div>
            </div>
        </div>

        <!-- Share Buttons -->
        <div class="mt-8 flex items-center">
            <span class="mr-4 font-semibold">Share this article:</span>
            <div class="flex space-x-3">
                <button class="p-2 bg-blue-600 text-white rounded-full hover:bg-blue-700 transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M9 8h-3v4h3v12h5v-12h3.642l.358-4h-4v-1.667c0-.955.192-1.333 1.115-1.333h2.885v-5h-3.808c-3.596 0-5.192 1.583-5.192 4.615v3.385z" />
                    </svg>
                </button>
                <button class="p-2 bg-blue-400 text-white rounded-full hover:bg-blue-500 transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z" />
                    </svg>
                </button>
                <button class="p-2 bg-blue-700 text-white rounded-full hover:bg-blue-800 transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M4.98 3.5c0 1.381-1.11 2.5-2.48 2.5s-2.48-1.119-2.48-2.5c0-1.38 1.11-2.5 2.48-2.5s2.48 1.12 2.48 2.5zm.02 4.5h-5v16h5v-16zm7.982 0h-4.968v16h4.969v-8.399c0-4.67 6.029-5.052 6.029 0v8.399h4.988v-10.131c0-7.88-8.922-7.593-11.018-3.714v-2.155z" />
                    </svg>
                </button>
            </div>
        </div>

        <!-- Related Posts -->
        <div class="mt-12 pt-8 border-t border-gray-200">
            <h3 class="text-2xl font-bold mb-6">Related Articles</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <a href="#" class="block group">
                    <div class="bg-gray-100 rounded-lg overflow-hidden">
                        <div class="h-48 bg-gray-200 group-hover:opacity-90 transition">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-full w-full text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        <div class="p-4">
                            <span class="text-sm text-indigo-600 font-semibold">Development</span>
                            <h4 class="text-lg font-bold mt-1 group-hover:text-indigo-600 transition">Modern CSS Techniques Every Developer Should Know</h4>
                            <p class="text-gray-600 mt-2">Explore the latest CSS features that are changing how we style web applications.</p>
                        </div>
                    </div>
                </a>
                <a href="#" class="block group">
                    <div class="bg-gray-100 rounded-lg overflow-hidden">
                        <div class="h-48 bg-gray-200 group-hover:opacity-90 transition">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-full w-full text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        <div class="p-4">
                            <span class="text-sm text-indigo-600 font-semibold">Performance</span>
                            <h4 class="text-lg font-bold mt-1 group-hover:text-indigo-600 transition">Optimizing Web Performance: A Practical Guide</h4>
                            <p class="text-gray-600 mt-2">Learn how to measure and improve your website's performance for better user experience.</p>
                        </div>
                    </div>
                </a>
            </div>
        </div>

        <!-- Comments Section -->

        <div x-data="commentSection()" class="mx-auto p-4 space-y-6 border-t-2">
            <h3 class="text-2xl font-bold mb-6">Comments</h3>
            <!-- Form Komentar -->
            <div class="space-y-2">
                <h2 class="text-xl font-semibold">Leave a comment</h2>
                <textarea x-model="form.content" rows="4" placeholder="Your thoughts..." class="w-full border rounded-lg p-3 focus:outline-none focus:ring" :class="{'border-red-500': formErrors.content}"></textarea>
                <p class="text-red-500 text-sm mt-1" x-show="formErrors.content">Komentar tidak boleh kosong</p>
                <div class="flex space-x-2">
                    <input type="text" x-model="form.name" placeholder="Name" class="w-1/2 border rounded p-2" :class="{'border-red-500': formErrors.name}" />
                    <p class="text-red-500 text-sm mt-1" x-show="formErrors.name">Nama wajib diisi</p>
                    <input type="email" x-model="form.email" placeholder="Email" class="w-1/2 border rounded p-2" :class="{'border-red-500': formErrors.email}" />
                    <p class="text-red-500 text-sm mt-1" x-show="formErrors.email">Email tidak valid</p>
                </div>
                <button @click="submitComment()" class="bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700">
                    Post Comment
                </button>
            </div>

            <!-- Daftar Komentar -->
            <template x-for="comment in comments" :key="comment.id">
                <div class="bg-gray-50 p-4 rounded-lg mb-4 border-b">
                    <!-- Komentar Utama -->

                    <div class="flex justify-between items-center mb-2">
                        <div class="flex items-center">
                            <div class="h-5 w-5 rounded-full bg-indigo-100 overflow-hidden mr-3">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-full w-full text-indigo-400" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
                                </svg>
                            </div>
                            <p class="inline-flex items-center mr-3 text-md text-gray-900 dark:text-white font-semibold"><span x-text="comment.comment_author"></span></p>
                            <p class="text-xs text-gray-600 dark:text-gray-400"><time pubdate="" x-text="comment.created_at">Feb. 8, 2022</time></p>
                        </div>
                    </div>
                    <p class="text-sm text-gray-500 dark:text-gray-400" x-text="comment.comment_content"></p>
                    <div @click="toggleReplyForm(comment.id)" class="flex items-center mt-4 space-x-4">
                        <button type="button" class="flex items-center text-sm text-gray-500 hover:underline dark:text-gray-400 font-medium">
                            <svg class="mr-1.5 w-3.5 h-3.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 18">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 5h5M5 8h2m6-3h2m-5 3h6m2-7H2a1 1 0 0 0-1 1v9a1 1 0 0 0 1 1h3v5l5-5h8a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1Z"></path>
                            </svg>
                            Reply
                        </button>
                    </div>

                    <!-- Balasan -->
                    <div class="ml-4 mt-2 border-l pl-4 space-y-1">

                        <template x-for="reply in replies[comment.id] ?? []" :key="reply.id">
                            <div>
                                <div class="flex justify-between items-center mb-2">
                                    <div class="flex items-center">
                                        <div class="h-5 w-5 rounded-full bg-indigo-100 overflow-hidden mr-3">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-full w-full text-indigo-400" viewBox="0 0 20 20" fill="currentColor">
                                                <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
                                            </svg>
                                        </div>
                                        <p class="inline-flex items-center mr-3 text-md text-gray-900 dark:text-white font-semibold"><span x-text="reply.comment_author"></span></p>
                                        <p class="text-xs text-gray-600 dark:text-gray-400"><time pubdate="" x-text="reply.created_at">Feb. 8, 2022</time></p>
                                    </div>
                                </div>
                                <p class="text-sm text-gray-500 dark:text-gray-400" x-text="reply.comment_content"></p>
                            </div>
                        </template>
                    </div>


                    <!-- Form Balas -->
                    <div x-show="activeReply === comment.id" class="mt-2">
                        <textarea x-model="replyText" class="w-full border rounded p-2 text-sm" rows="2"></textarea>
                        <button @click="submitReply(comment.id)" class="mt-2 px-3 py-1 bg-green-600 text-white rounded text-sm">Kirim</button>
                    </div>
                </div>
            </template>

            <!-- Tombol Load More -->
            <div class="text-center">
                <button @click="loadMore()" x-show="hasMore" class="border border-indigo-600 text-indigo-600 px-4 py-2 rounded hover:bg-indigo-100">
                    Load More Comments
                </button>
            </div>

        </div>


        <script>
            function commentSection() {
                return {
                    comments: [],
                    form: {
                        name: '',
                        email: '',
                        content: ''
                    },
                    postId: <?= $artikel['id'] ?? 0 ?>,
                    page: 1,
                    hasMore: false,
                    replies: [],
                    activeReply: null,
                    replyText: '',
                    formErrors: {
                        name: false,
                        email: false,
                        content: false
                    },

                    init() {
                        this.loadComments();
                    },

                    formatDate(dateString) {
                        const options = {
                            year: 'numeric',
                            month: 'long',
                            day: 'numeric',
                            hour: '2-digit',
                            minute: '2-digit'
                        };
                        return new Date(dateString).toLocaleDateString(undefined, options);
                    },

                    async loadComments() {
                        const res = await fetch(`/comment/list/${this.postId}?page=${this.page}`);
                        const data = await res.json();
                        console.log(data);
                        this.comments.push(...data.comments);
                        // Group replies by parent ID
                        data.replies.forEach(reply => {
                            if (!this.replies[reply.comment_parent_id]) {
                                this.replies[reply.comment_parent_id] = [];
                            }
                            this.replies[reply.comment_parent_id].push(reply);
                        });

                        this.hasMore = data.more;
                        this.page++;
                    },

                    loadMore() {
                        this.loadComments();
                    },

                    submitComment() {
                        this.formErrors = {
                            name: false,
                            email: false,
                            content: false
                        };

                        let valid = true;

                        if (!this.form.name.trim()) {
                            this.formErrors.name = true;
                            valid = false;
                        }

                        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                        if (!emailRegex.test(this.form.email)) {
                            this.formErrors.email = true;
                            valid = false;
                        }

                        if (!this.form.content.trim()) {
                            this.formErrors.content = true;
                            valid = false;
                        }

                        if (!valid) return;
                        fetch(`/comment/save`, {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'X-Requested-With': 'XMLHttpRequest'
                                },
                                body: JSON.stringify({
                                    comment_post_id: this.postId,
                                    comment_author: this.form.name,
                                    comment_email: this.form.email,
                                    comment_content: this.form.content
                                })
                            })
                            .then(res => res.json())
                            .then(data => {
                                if (data.status == 'success') {
                                    this.loadComments()
                                } else {
                                    alert(data.message || "Gagal mengirim komentar");
                                }
                            });
                    },

                    toggleReplyForm(commentId) {
                        this.activeReply = this.activeReply === commentId ? null : commentId;
                        this.replyText = '';
                    },

                    async submitReply(parentId) {
                        const payload = {
                            comment_post_id: this.postId,
                            comment_content: this.replyText,
                            comment_author: 'Guest',
                            comment_email: 'guest@example.com',
                            comment_parent_id: parentId,
                        };

                        const res = await fetch('/comment/save', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-Requested-With': 'XMLHttpRequest'
                            },
                            body: JSON.stringify(payload)
                        });

                        const result = await res.json();
                        if (result.status === 'success') {
                            if (!this.replies[parentId]) this.replies[parentId] = [];
                            this.replies[parentId].push(result.comment);
                            this.replyText = '';
                            this.activeReply = null;
                        }
                    }
                }
            }
        </script>


    </main>
</main>
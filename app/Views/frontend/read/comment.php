<!-- Comments Section -->
<div x-data="commentSection(config)" class="bg-white shadow-md rounded-lg mx-auto p-4 space-y-6">
    <h3 class="text-2xl font-bold mb-6 border-b-2">Comments</h3>
    <!-- Form Komentar -->
    <div class="space-y-2">
        <h2 class="text-xl font-semibold">Leave a comment</h2>
        <textarea x-model="form.content" rows="4" placeholder="Your thoughts..." class="w-full border rounded-lg p-3 focus:outline-none focus:ring" :class="{'border-red-500': formErrors.content}"></textarea>
        <p class="text-red-500 text-sm mt-1" x-show="formErrors.content">Komentar tidak boleh kosong</p>

        <div class="flex space-x-2">
            <div class="w-1/2">
                <input type="text" x-model="form.name" placeholder="Name" class="w-full border rounded p-2" :class="{'border-red-500': formErrors.name}" />
                <p class="text-red-500 text-sm mt-1" x-show="formErrors.name">Nama wajib diisi</p>
            </div>
            <div class="w-1/2">
                <input type="email" x-model="form.email" placeholder="Email" class="w-full border rounded p-2" :class="{'border-red-500': formErrors.email}" />
                <p class="text-red-500 text-sm mt-1" x-show="formErrors.email">Email tidak valid</p>
            </div>
        </div>

        <button @click="submitComment()" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
            Post Comment
        </button>
    </div>

    <!-- Daftar Komentar -->
    <template x-for="comment in comments" :key="comment.id">
        <div class="bg-gray-50 p-4 rounded-lg mb-4 border-b">
            <!-- Komentar Utama -->
            <div class="flex justify-between items-center mb-2">
                <div class="flex items-center">
                    <div class="h-5 w-5 rounded-full bg-blue-100 overflow-hidden mr-3">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-full w-full text-blue-400" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
                        </svg>
                    </div>
                    <p class="inline-flex items-center mr-3 text-md font-semibold" x-text="comment.comment_author"></p>
                    <p class="text-xs text-gray-600" x-text="comment.created_at"></p>
                </div>
                <!-- Status komentar -->
                <span
                    x-text="comment.comment_status === 'approved' ? 'Disetujui' : 'Menunggu Persetujuan'"
                    :class="{
          'bg-green-100 text-green-800': comment.comment_status === 'approved',
          'bg-yellow-100 text-yellow-800': comment.comment_status === 'unapproved'
        }"
                    class="text-xs font-medium px-2 py-1 rounded-full"></span>
            </div>
            <p class="text-sm text-gray-500" x-text="comment.comment_status === 'approved' ? comment.comment_content : '*******'"></p>

            <!-- Balasan Admin (via field comment_reply) -->
            <template x-if="comment.comment_reply">
                <div class="ml-4 mt-2 border-l-2 pl-4 bg-white shadow-sm p-3 rounded">
                    <div class="flex items-center mb-2">
                        <div class="h-5 w-5 rounded-full bg-green-100 overflow-hidden mr-3">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-full w-full text-green-500" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        <p class="text-sm font-semibold text-green-600">Admin</p>
                    </div>
                    <p class="text-sm text-gray-600" x-text="comment.comment_reply"></p>
                </div>
            </template>
            <template x-if="comment.comment_status === 'approved'">
                <div @click="toggleReplyForm(comment.id)" class="flex items-center mt-4 space-x-4">
                    <button type="button" class="flex items-center text-sm text-gray-500 hover:underline font-medium">
                        <svg class="mr-1.5 w-3.5 h-3.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 18">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 5h5M5 8h2m6-3h2m-5 3h6m2-7H2a1 1 0 0 0-1 1v9a1 1 0 0 0 1 1h3v5l5-5h8a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1Z" />
                        </svg>
                        Reply
                    </button>
                </div>
            </template>
            <!-- Balasan dari pengguna lain -->
            <div class="ml-4 mt-2 border-l pl-4 space-y-1">
                <template x-if="replies && replies[comment.id] && replies[comment.id].length">
                    <template x-for="reply in replies[comment.id] ?? []" :key="reply.id">
                        <div>
                            <div class="flex justify-between items-center mb-2">
                                <div class="flex items-center">
                                    <div class="h-5 w-5 rounded-full bg-blue-100 overflow-hidden mr-3">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-full w-full text-blue-400" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                    <p class="inline-flex items-center mr-3 text-md font-semibold" x-text="reply.comment_author"></p>
                                    <p class="text-xs text-gray-600" x-text="reply.created_at"></p>
                                </div>

                            </div>
                            <p class="text-sm text-gray-500" x-text="reply.comment_status === 'approved' ? reply.comment_content : '*******'"></p>
                        </div>
                    </template>
                </template>
            </div>

            <!-- Form Balas -->
            <div x-show="activeReply === comment.id" class="mt-2">
                <div class="flex gap-4 mb-2">
                    <div>
                        <label>Nama</label>
                        <input type="text" x-model="replyName" class="w-full border rounded p-2 text-sm">
                    </div>
                    <div>
                        <label>Email</label>
                        <input type="email" x-model="replyName" class="w-full border rounded p-2 text-sm">
                    </div>
                </div>
                <div>
                    <label>Balasan</label>
                    <textarea x-model="replyText" class="w-full border rounded p-2 text-sm" rows="2"></textarea>
                </div>
                <button @click="submitReply(comment.id)" class="mt-2 px-3 py-1 bg-green-600 text-white rounded text-sm">Kirim</button>
            </div>
        </div>
    </template>

    <!-- Tombol Load More -->
    <div class="text-center">
        <button @click="loadMore()" x-show="hasMore" class="border border-blue-600 text-blue-600 px-4 py-2 rounded hover:bg-blue-100">
            Load More Comments
        </button>
    </div>
</div>

<script>
    const config = {
        postid: <?= $artikel['id'] ?? 0 ?>
    }
</script>
 <style>
     @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap');

     body {
         font-family: 'Inter', sans-serif;
     }

     .gradient-bg {
         background: linear-gradient(135deg, #ff7e5f 0%, #feb47b 100%);
     }

     .glass-effect {
         background: rgba(255, 255, 255, 0.95);
         backdrop-filter: blur(10px);
         border: 1px solid rgba(255, 255, 255, 0.2);
     }

     .comment-card {
         background: rgba(255, 126, 95, 0.05);
         border-left: 3px solid #ff7e5f;
     }

     .reply-card {
         background: rgba(254, 180, 123, 0.05);
         border-left: 3px solid #feb47b;
     }

     .fade-in {
         animation: fadeIn 0.5s ease-in;
     }

     @keyframes fadeIn {
         from {
             opacity: 0;
             transform: translateY(20px);
         }

         to {
             opacity: 1;
             transform: translateY(0);
         }
     }

     .emoji-reaction {
         transition: all 0.2s ease;
     }

     .emoji-reaction:hover {
         transform: scale(1.2);
     }

     .like-button.liked {
         color: #ff7e5f;
     }
 </style>




 <!-- Comments Section -->
 <section x-data="commentSection(config)" class="glass-effect rounded-2xl p-8 shadow-xl">
     <div class="flex items-center justify-between mb-6">
         <h2 class="text-2xl font-bold text-gray-800">Comments (<span id="comment-count" x-text="comments.length"></span>)</h2>

     </div>

     <!-- Comment Form -->
     <div class="mb-8">
         <div class="flex flex-col sm:flex-row items-start sm:space-x-4 space-y-4 sm:space-y-0">
             <!-- Avatar -->
             <div class="flex-shrink-0">
                 <div class="h-10 w-10 rounded-full bg-pink-100 flex items-center justify-center">
                     <span class="text-sm font-medium text-pink-800 uppercase">You</span>
                 </div>
             </div>

             <!-- Form -->
             <div class="space-y-3 flex-1">
                 <!-- Textarea -->
                 <textarea id="comment-input"
                     placeholder="Share your thoughts about this article..."
                     class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent resize-none"
                     rows="3"
                     x-model="form.content"
                     :class="{'border-red-500': formErrors.content}"></textarea>
                 <p class="text-red-500 text-sm" x-show="formErrors.content" x-transition>Isi komentar wajib diisi</p>

                 <!-- Name & Email -->
                 <div class="flex flex-col sm:flex-row sm:space-x-3 space-y-3 sm:space-y-0">
                     <div class="w-full sm:w-1/2">
                         <input type="text" x-model="form.name" placeholder="Name"
                             class="w-full border rounded p-2 focus:outline-none focus:ring-1 focus:ring-orange-500"
                             :class="{'border-red-500': formErrors.name}">
                         <p class="text-red-500 text-sm" x-show="formErrors.name" x-transition>Nama wajib diisi</p>
                     </div>
                     <div class="w-full sm:w-1/2">
                         <input type="email" x-model="form.email" placeholder="Email"
                             class="w-full border rounded p-2 focus:outline-none focus:ring-1 focus:ring-orange-500"
                             :class="{'border-red-500': formErrors.email}">
                         <p class="text-red-500 text-sm" x-show="formErrors.email" x-transition>Email tidak valid</p>
                     </div>
                 </div>

                 <!-- Reactions & Submit -->
                 <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between space-y-3 sm:space-y-0 mt-2">
                     <div class="flex items-center space-x-2">
                         <span class="text-sm text-gray-500">Add reaction:</span>
                         <button @click="addReaction('👍')" class="text-lg hover:bg-gray-100 p-1 rounded">👍</button>
                         <button @click="addReaction('❤️')" class="text-lg hover:bg-gray-100 p-1 rounded">❤️</button>
                         <button @click="addReaction('🔥')" class="text-lg hover:bg-gray-100 p-1 rounded">🔥</button>
                         <button @click="addReaction('🎉')" class="text-lg hover:bg-gray-100 p-1 rounded">🎉</button>
                     </div>
                     <button @click="submitComment()"
                         class="bg-orange-500 text-white px-4 py-2 rounded-lg hover:bg-orange-600 transition-colors font-medium w-full sm:w-auto text-center">
                         Post Comment
                     </button>
                 </div>
             </div>
         </div>
     </div>

     <!-- Daftar Komentar -->
     <template x-for="comment in comments" :key="comment.id">
         <div class="comment-card p-4 rounded-lg mb-4 bg-white shadow-sm">
             <!-- Komentar Utama -->
             <div class="flex items-start space-x-3">
                 <div class="flex-shrink-0">
                     <div class="h-10 w-10 rounded-full bg-pink-100 flex items-center justify-center">
                         <span class="text-sm font-medium text-pink-800 uppercase" x-text="comment.comment_author.substring(0, 2)">TE</span>
                     </div>
                 </div>
                 <div class="flex-1">
                     <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
                         <h3 class="text-sm font-medium text-gray-900" x-text="comment.comment_author">User</h3>
                         <div class="flex items-center text-xs text-gray-500 mt-1 sm:mt-0 space-x-2">
                             <span x-text="timeAgo(comment.created_at)">beberapa menit lalu</span>
                             <span x-show="comment.comment_status == 'approved'" class="px-2 py-0.5 rounded-full bg-green-100 text-green-800 font-semibold">Disetujui</span>
                             <span x-show="comment.comment_status != 'approved'" class="px-2 py-0.5 rounded-full bg-red-100 text-red-800 font-semibold">Menunggu</span>
                         </div>
                     </div>
                     <p class="text-sm text-gray-600 mt-2" x-text="comment.comment_content">Isi komentar</p>

                     <!-- Tombol Reply -->
                     <template x-if="comment.comment_status === 'approved'">
                         <div @click="toggleReplyForm(comment.id)" class="mt-3">
                             <button type="button" class="text-sm text-gray-500 hover:underline flex items-center">
                                 <svg class="mr-1.5 w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 18">
                                     <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                         d="M5 5h5M5 8h2m6-3h2m-5 3h6m2-7H2a1 1 0 0 0-1 1v9a1 1 0 0 0 1 1h3v5l5-5h8a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1Z" />
                                 </svg>
                                 Reply
                             </button>
                         </div>
                     </template>

                     <!-- Form Reply -->
                     <div x-show="activeReply === comment.id" class="mt-4 space-y-2">
                         <div class="flex flex-col sm:flex-row sm:space-x-3 space-y-3 sm:space-y-0">
                             <input type="text" x-model="replyName" placeholder="Nama" class="w-full border rounded p-2 text-sm">
                             <input type="email" x-model="replyEmail" placeholder="Email" class="w-full border rounded p-2 text-sm">
                         </div>
                         <textarea x-model="replyText" rows="2" placeholder="Tulis balasan..." class="w-full border rounded p-2 text-sm resize-none"></textarea>
                         <button @click="submitReply(comment.id)" class="bg-green-600 text-white px-3 py-1 rounded text-sm hover:bg-green-700">Kirim</button>
                     </div>

                     <!-- Balasan Admin -->
                     <template x-if="comment.comment_reply">
                         <div class="mt-4 border-l-2 border-green-500 pl-4 py-3 bg-gray-50 rounded-md">
                             <div class="flex items-start space-x-3">
                                 <div class="h-10 w-10 rounded-full bg-green-100 flex items-center justify-center">
                                     <span class="text-sm font-medium text-green-800 uppercase">AD</span>
                                 </div>
                                 <div>
                                     <div class="flex items-center text-sm font-medium text-gray-900">Administrator</div>
                                     <div class="text-xs text-gray-500 mb-1" x-text="timeAgo(comment.updated_at)">Beberapa waktu lalu</div>
                                     <p class="text-sm text-gray-600" x-text="comment.comment_reply">Balasan dari admin</p>
                                 </div>
                             </div>
                         </div>
                     </template>

                     <!-- Balasan Pengguna -->
                     <template x-if="replies && replies[comment.id] && replies[comment.id].length">
                         <template x-for="reply in replies[comment.id]" :key="reply.id">
                             <div class="mt-4 bg-gray-50 p-3 rounded-md ml-4">
                                 <div class="flex items-start space-x-3">
                                     <div class="h-10 w-10 rounded-full bg-pink-100 flex items-center justify-center">
                                         <span class="text-sm font-medium text-pink-800 uppercase" x-text="reply.comment_author.substring(0, 2)">US</span>
                                     </div>
                                     <div>
                                         <div class="flex items-center text-sm font-medium text-gray-900" x-text="reply.comment_author">User</div>
                                         <div class="text-xs text-gray-500" x-text="timeAgo(reply.created_at)">barusan</div>
                                         <div class="mt-1 text-sm text-gray-600" x-text="reply.comment_status === 'approved' ? reply.comment_content : '*******'"></div>
                                     </div>
                                 </div>
                             </div>
                         </template>
                     </template>
                 </div>
             </div>
         </div>
     </template>

 </section>


 <script>
     const config = {
         postid: <?= $artikel['id'] ?? 0 ?>
     }
 </script>
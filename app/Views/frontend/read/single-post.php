 <!-- Main Content with Sidebar -->
 <div class="container mx-auto px-4 py-8">
   <div class="flex flex-col md:flex-row gap-8">
     <!-- Main Content -->
     <main class="w-full md:w-2/3">
       <!-- Artikel -->
       <?= $this->include('frontend/read/detail') ?>
       <?php if ($artikel['post_type'] != 'video'): ?>
         <!-- Related Post -->
         <?= $this->include('frontend/widget/related-post') ?>
       <?php endif ?>
       <!-- Comments Section -->
       <?= $this->include('frontend/widget/comment') ?>
     </main>

     <aside class="w-full md:w-1/3">
       <!-- Search Widget -->
       <?= $this->include('frontend/widget/search') ?>
       <!-- Category Widget -->
       <?= $this->include('frontend/widget/categories') ?>
       <!-- Latest Post -->
       <?= $this->include('frontend/widget/latest-post') ?>
       <!-- Tags Post -->
       <?= $this->include('frontend/widget/tags') ?>
     </aside>
   </div>
 </div>
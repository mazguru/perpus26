 <!-- Main Content with Sidebar -->
 <div class="container mx-auto px-4 py-8">
   <div class="flex flex-col md:flex-row gap-8">
     <!-- Main Content -->
     <main class="w-full md:w-2/3">
       

       <!-- Artikel -->
       <?= $this->include('frontend/read/detail') ?>
       <!-- Related Post -->
       <?= $this->include('frontend/read/related-post') ?>
       <!-- Comments Section -->
       <?= $this->include('frontend/read/comment') ?>
     </main>

     <?= $this->include('frontend/read/sidebar') ?>
   </div>
 </div>
<!-- Hero Section -->
<?= $this->include('frontend/home/hero') ?>



<!-- Berita Section -->
 <?= $this->include('frontend/home/berita') ?>


<?= $this->include('frontend/home/galery') ?>
<!-- Layanan Section -->
<?= $this->include('frontend/home/layanan') ?>


<!-- Kontak Section -->
 <?= $this->include('frontend/home/contact')?>

<section class=" bg-pumpkin-500 px-4 py-12">
    <div class="container">
    <h1 class="text-2xl font-bold text-orange-700 mb-6 text-center">Tautan Penting Perpustakaan</h1>

    <div class="flex gap-4">
        <?php $links = get_links();
        foreach ($links as $link): ?>
        <a href="<?= esc($link['link_url']) ?>"
           target="<?= esc($link['link_target'] ?? '_self') ?>"
           class=" transition-all duration-200 p-4 text-center hover:scale-110">
            
            <?php if (!empty($link['image_cover'])): ?>
                <img src="<?= base_url('upload/image/' . $link['image_cover']) ?>"
                     alt="<?= esc($link['link_title']) ?>"
                     class="max-w-full h-12 object-fit rounded-md mb-3 mx-auto group-hover:scale-105 transition-transform duration-200">
            <?php else: ?>
                <div class="max-w-full h-12 text-3xl font-bold flex items-center justify-center">
                    <span class="bi bi-link"></span>
                </div>
            <?php endif; ?>

            <h2 class="text-lg font-semibold text-gray-800 group-hover:text-orange-700">
                <?= esc($link['link_title']) ?>
            </h2>
        </a>
        <?php endforeach; ?>
    </div>
    </div>
</section>

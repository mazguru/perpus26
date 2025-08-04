<!-- Hero Section -->

<section class="banner-one relative w-full h-screen overflow-hidden">
    <!-- YouTube Video as background -->
    <div class="video-background absolute inset-0 w-full h-full z-[-1]">
        <!-- Fallback background image -->
        <img
            class="w-full h-full object-cover"
            src="<?= base_url('assets/images/banner.jpg') ?>"
            alt="Background Image" />

        <!-- YouTube Embed -->
        <div class="video-foreground absolute inset-0">
            <iframe class="w-full h-full" loading="lazy" src="https://www.youtube.com/embed/C8MkesphsDY?controls=0&showinfo=0&rel=0&autoplay=1&loop=1&mute=1" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
        </div>
    </div>

    <!-- Overlay -->
    <div class="dark-overlay absolute inset-0 bg-black bg-opacity-60"></div>

    <!-- Hero Content -->
    <div class="container relative z-10 flex flex-col items-center justify-center h-full text-white text-center px-4">
        <?php
            $logoPath = FCPATH . 'assets/images/' . session('logo'); // Absolute path
            if (is_file($logoPath)) {?>
                <img src="<?= base_url('assets/images/'. session('logo'))?>" alt="Logo" class="w-24 md:w-48">
            <?php }?>
        <h1 class="text-4xl md:text-5xl font-bold mb-4">Selamat Datang di <?= session('nama_perpus') ?></h1>
        <p class="text-sm md:text-lg mb-8"><?= session('meta_description') ?></p>
        <div class="flex flex-col sm:flex-row space-y-4 sm:space-y-0 sm:space-x-4">
            <a href="#jelajah" class="bg-pumpkin-600 hover:bg-pumpkin-700 text-white font-medium py-3 px-6 rounded-lg transition duration-300 text-center">Jelajahi Layanan</a>
            <a href="#katalog" class="bg-white hover:bg-saddle-100 text-pumpkin-600 font-medium py-3 px-6 rounded-lg border border-pumpkin-600 transition duration-300 text-center">Katalog Buku</a>
        </div>
    </div>
</section>


<style>
    .dark-overlay {
        background-color: #000;
        opacity: .6;
        transition: background 0.3s, border-radius 0.3s, opacity 0.3s;
        height: 100%;
        width: 100%;
        top: 0;
        left: 0;
        position: absolute;
    }

    .video-background {
        background: #000;
        position: absolute;
        top: 0;
        right: 0;
        bottom: 0;
        left: 0;
        z-index: -99;
    }

    .video-foreground,
    .video-background iframe {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        pointer-events: none;
    }

    @media (min-aspect-ratio: 16/9) {
        .video-foreground {
            height: 300%;
            top: -100%;
        }
    }

    @media (max-aspect-ratio: 16/9) {
        .video-foreground {
            width: 300%;
            left: -100%;
        }
    }

    @media all and (max-width: 600px) {
        .vid-info {
            width: 50%;
            padding: .5rem;
        }

        .vid-info h1 {
            margin-bottom: .2rem;
        }
    }

    @media all and (max-width: 500px) {
        .vid-info .acronym {
            display: none;
        }
    }
</style>
<!-- Hero Section -->
<section id='jelajah' class="hero-pattern2 text-white py-16">
    <div class="container mx-auto px-4">
        <div class="max-w-3xl mx-auto text-center">
            <h2 class="text-4xl font-bold mb-4">Jelajahi Dunia Pengetahuan</h2>
            <p class="text-lg mb-8">Temukan berbagai artikel, berita, jurnal, dan sumber belajar digital untuk menambah wawasan Anda</p>
            <form action="/search" class="bg-white rounded-lg p-2 flex items-center shadow-lg">
                <input name="q" type="text" placeholder="Cari artikel berita atau informasi..." class="w-full px-4 py-2 outline-none text-gray-700">
                <button class="bg-pumpkin-600 text-white px-6 py-2 rounded-md hover:bg-pumpkin-700 transition">Cari</button>
            </form>
        </div>
    </div>
</section>
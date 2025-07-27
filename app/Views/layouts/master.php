<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />

  <!-- SEO Meta Tags -->
  <meta name="title" content="<?= isset($title) ? $title : 'Publik' ?> | SIAPNDAN SMKN 1 Temon" />
  <meta name="description" content="SMKN 1 Temon adalah sekolah berbasis ketarunaan yang menyediakan informasi absensi, pelaporan pelanggaran taruna, dan layanan lainnya melalui aplikasi SIAPNDAN." />
  <meta name="keywords" content="SMKN 1 Temon, ketarunaan, SIAPNDAN, absensi taruna, pelaporan pelanggaran, sekolah terbaik Temon" />
  <meta name="author" content="SMKN 1 Temon" />
  <meta name="robots" content="index, follow" />
  <meta name="language" content="id" />

  <!-- Open Graph / Facebook Meta Tags -->
  <meta property="og:type" content="website" />
  <meta property="og:title" content="<?= $title ?> | SIAPNDAN SMKN 1 Temon" />
  <meta property="og:description" content="SMKN 1 Temon adalah sekolah berbasis ketarunaan yang menyediakan informasi absensi, pelaporan pelanggaran taruna, dan layanan lainnya melalui aplikasi SIAPNDAN." />
  <meta property="og:image" content="<?= base_url('assets/images/logo.png') ?>" />
  <meta property="og:url" content="<?= current_url() ?>" />
  <meta property="og:site_name" content="SMKN 1 Temon" />

  <!-- Twitter Meta Tags -->
  <meta name="twitter:card" content="summary_large_image" />
  <meta name="twitter:title" content="<?= $title ?> | SIAPNDAN SMKN 1 Temon" />
  <meta name="twitter:description" content="SMKN 1 Temon adalah sekolah berbasis ketarunaan yang menyediakan informasi absensi, pelaporan pelanggaran taruna, dan layanan lainnya melalui aplikasi SIAPNDAN." />
  <meta name="twitter:image" content="<?= base_url('assets/images/logo.png') ?>" />


  <title><?= esc($title ?? 'Blog Perpustakaan') ?></title>

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap"
    rel="stylesheet">

  <!-- STYLESHEETS -->
  <link rel="stylesheet" type="text/css" href="<?= base_url('assets/plugins/swiper/swiper-bundle.min.css') ?>">
  <link href="<?= base_url('assets/plugins/owl-carousel/owl.carousel.css') ?>" rel="stylesheet">
  <link href="<?= base_url('assets/plugins/lightgallery/css/lightgallery.css') ?>" rel="stylesheet">
  
  <link href="<?= base_url('assets/plugins/animate/animate.css') ?>" rel="stylesheet">
  <link href="<?= base_url('assets/plugins/swiper/swiper-bundle.min.css') ?>" rel="stylesheet">

  <link rel="stylesheet" href="<?= base_url('assets/css/styles.css'); ?>">
  <link rel="stylesheet" href="<?= base_url('assets/css/bootstrap-icons.css'); ?>">
  <style>
    body {
      font-family: 'Poppins', sans-serif;
      scroll-behavior: smooth;
    }

    .hero-pattern {
      background-color: #f0f4f8;
      background-image: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23a0aec0' fill-opacity='0.1'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
    }

    .news-card:hover {
      transform: translateY(-5px);
      box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
    }

    .service-card:hover {
      transform: translateY(-5px);
      box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
    }
  </style>
  <script>
    const _BASEURL = '<?= base_url() ?>';
  </script>
</head>

<body class="bg-gray-100 text-gray-800" x-data="{ mobileMenuOpen: false, openDropdown: null }">
  <?= $this->include('layouts/partials/header') ?>
  <?= $this->include('layouts/partials/navigation') ?>

  <?= $this->include($content) ?>


  <?= $this->include('layouts/partials/footer') ?>
  <script src="<?= base_url('assets/js/frontend.js') ?>"></script>

  <script src="<?= base_url('assets/js/notif.min.js') ?>"></script>
  <script src="<?= base_url('assets/js/datatables.min.js') ?>"></script>
  <script src="<?= base_url('assets/js/app.min.js') ?>"></script>

  <!-- LIGHTGALLERY -->
  <script src="<?= base_url('assets/plugins/jquery/jquery.min.js') ?>"></script>
  <script src="<?= base_url('assets/plugins/lightgallery/js/lightgallery-all.min.js') ?>"></script>
  <script src="<?= base_url('assets/plugins/swiper/swiper-bundle.min.js') ?>"></script><!-- swiper -->

</body>

</html>
<!DOCTYPE html>
<html>

<head>
  <title><?= isset($page_title) ? $page_title . ' | ' : '' ?><?= __session('school_name') ?></title>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="keywords" content="<?= __session('meta_keywords'); ?>" />
  <meta name="description" content="<?= __session('meta_description'); ?>" />
  <meta name="subject" content="Situs Pendidikan">
  <meta name="copyright" content="<?= __session('school_name') ?>">
  <meta name="language" content="Indonesia">
  <meta name="robots" content="index,follow" />
  <meta name="revised" content="Friday, August 1th, 2025, 5:15 pm" />
  <meta name="Classification" content="Education">
  <meta name="author" content="Bakhtiar Rifai, bakhtiarsma@gmail.com">
  <meta name="designer" content="Bakhtiar Rifai, bakhtiarsma@gmail.com">
  <meta name="reply-to" content="bakhtiarsma@gmail.com">
  <meta name="owner" content="Bakhtiar Rifai">
  <meta name="url" content="https://sinmat.my.id">
  <meta name="identifier-URL" content="https://sinmat.my.id">
  <meta name="category" content="Admission, Education">
  <meta name="coverage" content="Worldwide">
  <meta name="distribution" content="Global">
  <meta name="rating" content="General">
  <meta name="revisit-after" content="7 days">
  <meta http-equiv="Expires" content="0">
  <meta http-equiv="Pragma" content="no-cache">
  <meta http-equiv="Cache-Control" content="no-cache">
  <meta http-equiv="Copyright" content="<?= __session('school_name'); ?>" />
  <meta http-equiv="imagetoolbar" content="no" />
  <meta name="revisit-after" content="7" />
  <meta name="webcrawlers" content="all" />
  <meta name="rating" content="general" />
  <meta name="spiders" content="all" />
  <meta itemprop="name" content="<?= __session('school_name'); ?>" />
  <meta itemprop="description" content="<?= __session('meta_description'); ?>" />
  <meta itemprop="image" content="<?= base_url('assets/images/' . __session('logo')); ?>" />
  <meta name="csrf-token" content="<?= __session('csrf_token') ?>">
  <?php if (isset($post_type) && $post_type == 'post') { ?>
    <meta property="og:url" content="<?= current_url() ?>" />
    <meta property="og:type" content="article" />
    <meta property="og:title" content="<?= $query->post_title ?>" />
    <meta property="og:description" content="<?= word_limiter(strip_tags($query->post_content), 30) ?>" />
    <meta property="og:image" content="<?= base_url('media_library/posts/large/' . $query->post_image) ?>" />
    <!-- Twitter Meta Tags -->
    <meta name="twitter:card" content="summary_large_image" />
    <meta name="twitter:title" content="<?= $query->post_title ?>" />
    <meta name="twitter:description" content="<?= word_limiter(strip_tags($query->post_content), 30) ?>" />
    <meta name="twitter:image" content="<?= base_url('media_library/posts/large/' . $query->post_image) ?>" />

  <?php } ?>
  <link rel="icon" href="<?= base_url('assets/images/' . __session('favicon')); ?>">
  <link rel="alternate" type="application/rss+xml" title="<?= __session('school_name'); ?> Feed" href="<?= base_url('feed') ?>" />


  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap"
    rel="stylesheet">

  <!-- STYLESHEETS -->
  <link rel="stylesheet" type="text/css" href="<?= base_url('assets/plugins/swiper/swiper-bundle.min.css') ?>">

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
  <noscript>
      You need to enable javaScript to run this app.
   </noscript>
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
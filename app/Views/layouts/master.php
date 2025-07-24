<!DOCTYPE html>
<html>

<head>
  <title><?= esc($title ?? 'Blog Perpustakaan') ?></title>

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap"
    rel="stylesheet">
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

<body class="bg-gray-100 text-gray-800">
  <div class="bg-gray-500 text-white font-bold !text-[.75rem] mb-2 !relative" style="z-index: 1;">
    <div class="max-w-screen-xl px-4 mx-auto py-2 !text-center">
      <p class="!mb-0">✨ Aplikasi dalam pengembangan</p>
    </div>
    <!-- /.max-w-screen-xl px-4 mx-auto -->
  </div>
  <?= $this->include('layouts/partials/header') ?>
  <?= $this->include('layouts/partials/navigation') ?>
  <header class="bg-blue-700 text-white p-4">
    <div class="container mx-auto">
      <h1 class="text-xl font-bold">Blog Perpustakaan</h1>
    </div>
  </header>


  <?= $this->include($content) ?>


  <?= $this->include('layouts/partials/footer') ?>

</body>

</html>
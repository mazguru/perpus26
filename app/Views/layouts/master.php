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

    <script>
        const _BASEURL = '<?= base_url() ?>';
    </script>
</head>

<body class="bg-gray-100 text-gray-800">
  <?= $this->include('layouts/partials/navigation') ?>
  <header class="bg-blue-700 text-white p-4">
    <div class="container mx-auto">
      <h1 class="text-xl font-bold">Blog Perpustakaan</h1>
    </div>
  </header>

  <main class="container mx-auto mt-6">
    <?= $this->renderSection('content') ?>
  </main>

  <footer class="bg-gray-800 text-white text-center p-4 mt-10">
    &copy; <?= date('Y') ?> SMKN 1 Temon
  </footer>

</body>

</html>
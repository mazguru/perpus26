<!doctype html>
<html lang="id">

<head>


    <title><?= isset($title) ? $title . ' | ' : '' ?><?= __session('nama_perpus') ?></title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="keywords" content="<?= __session('meta_keywords'); ?>" />
    <meta name="description" content="<?= __session('meta_description'); ?>" />
    <meta name="subject" content="Situs Pendidikan">
    <meta name="copyright" content="<?= __session('nama_perpus') ?>">
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
    <meta http-equiv="Copyright" content="<?= __session('nama_perpus'); ?>" />
    <meta http-equiv="imagetoolbar" content="no" />
    <meta name="revisit-after" content="7" />
    <meta name="webcrawlers" content="all" />
    <meta name="rating" content="general" />
    <meta name="spiders" content="all" />
    <meta itemprop="name" content="<?= __session('nama_perpus'); ?>" />
    <meta itemprop="description" content="<?= __session('meta_description'); ?>" />
    <meta itemprop="image" content="<?= base_url('assets/images/' . __session('logo')); ?>" />
    <meta name="csrf-token" content="<?= __session('csrf_token') ?>">

    <!-- Favicon -->
    <link rel="icon" href="<?= base_url('assets/images/' . __session('favicon')); ?>">
    <link rel="alternate" type="application/rss+xml" title="<?= __session('nama_perpus'); ?> Feed" href="<?= base_url('feed') ?>" />

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="<?= base_url('assets/css/custom.css'); ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/styles.css'); ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/bootstrap-icons.css'); ?>">

    <script>
        const _BASEURL = '<?= base_url() ?>';
    </script>


</head>

<body class="text-black font-sans font-poppins dark:text-bodydark dark:bg-boxdark-2 antialiased" x-data="{page: '<?= isset($halaman) ? $halaman : '' ?>', 'loaded': true, 'darkMode': true, 'sidebarToggle': false, 'scrollTop': false }"
    x-init="
         darkMode = JSON.parse(localStorage.getItem('darkMode'));
         $watch('darkMode', value => localStorage.setItem('darkMode', JSON.stringify(value)))"
    :class="{'dark text-bodydark bg-boxdark-2': darkMode === true}">
    <div
        x-show="loaded"
        x-init="window.addEventListener('DOMContentLoaded', () => {setTimeout(() => loaded = false, 100)})"
        class="fixed left-0 top-0 z-999999 flex h-screen w-screen items-center justify-center bg-white/90 dark:bg-black">
        <div
            class="h-16 w-16 animate-spin rounded-full border-4 border-solid border-primary border-t-transparent"></div>
    </div>
    <?= $this->include('layouts/admin/navbar') ?>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <!-- Main Content -->
    <div class="flex h-screen overflow-hidden dark:bg-boxdark-2">

        <?= $this->include('layouts/admin/sidebar') ?>

        <div id="main-content" class="relative flex flex-1 flex-col overflow-x-hidden overflow-y-auto min-h-screen dark:bg-boxdark-2">
            <main>
                <?= $this->include('layouts/admin/header') ?>
                <div
                    id="isLoading"
                    class="fixed left-0 top-0 z-999999 flex w-screen h-screen items-center justify-center space-x-2 bg-gray-900 bg-opacity-90"
                    style="display: none;">

                    <span class="sr-only">Loading...</span>
                    <div class="h-5 w-5 bg-red-500 rounded-full animate-bounce [animation-delay:-0.3s]"></div>
                    <div class="h-8 w-8 bg-green-500 rounded-full animate-bounce [animation-delay:-0.15s]"></div>
                    <div class="h-5 w-5 bg-blue-500 rounded-full animate-bounce"></div>
                </div>
                <div class="mx-auto max-w-(--breakpoint-2xl) p-4 md:p-6">
                    <?= $this->include('layouts/admin/breadcrumb') ?>
                    <?= $this->renderSection('content') ?>
                    <?php if (isset($content)) { ?>
                        <?= $this->include($content) ?>
                    <?php } ?>
                </div>

            </main>

            <?= $this->include('layouts/admin/footer') ?>
        </div>

    </div>

    <script src="<?= base_url('assets/js/backend.js') ?>"></script>

    <script src="<?= base_url('assets/js/notif.min.js') ?>"></script>
    <script src="<?= base_url('assets/js/datatables.min.js') ?>"></script>
    <script src="<?= base_url('assets/js/app.min.js') ?>"></script>



</body>

</html>
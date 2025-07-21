<!doctype html>
<html lang="en">

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

    <title>
        <?php if (current_url() == base_url()) : ?>
            SIAPNDAN SMKN 1 Temon
        <?php else : ?>
            <?= isset($title) ? $title . " | SIAPNDAN SMKN 1 Temon" : "SIAPNDAN SMKN 1 Temon" ?>
        <?php endif; ?>
    </title>
    <!-- Favicon -->
    <link rel="icon" href="<?= base_url('assets/images/favicon.jpg') ?>" type="image/x-icon" />

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="<?= base_url('assets/css/styles.css'); ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/custom.css'); ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/bootstrap-icons.css'); ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/sweetalert2.min.css'); ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/main.min.css'); ?>">

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
            <main class='p-4'>
                <div
                    id="isLoading"
                    class="fixed left-0 top-0 z-999999 flex w-screen h-screen items-center justify-center space-x-2 bg-gray-900 bg-opacity-90"
                    style="display: none;">

                    <span class="sr-only">Loading...</span>
                    <div class="h-5 w-5 bg-red-500 rounded-full animate-bounce [animation-delay:-0.3s]"></div>
                    <div class="h-8 w-8 bg-green-500 rounded-full animate-bounce [animation-delay:-0.15s]"></div>
                    <div class="h-5 w-5 bg-blue-500 rounded-full animate-bounce"></div>
                </div>

                <?= $this->renderSection('content') ?>


            </main>
            <?= $this->include('layouts/partials/footer') ?>

        </div>

    </div>


    <script src="<?= base_url('assets/js/backend.min.js') ?>"></script>
    <script src="<?= base_url('assets/js/app.min.js') ?>"></script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="<?= base_url('assets/js/SwalUtils.js') ?>"></script>


</body>

</html>
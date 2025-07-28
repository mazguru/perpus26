<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <title><?= esc($page_title) ?></title>
  <!-- Favicon -->
  <link rel="icon" href="<?= base_url('assets/images/favicon.jpg') ?>" type="image/x-icon" />

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap"
    rel="stylesheet">
  <link rel="stylesheet" href="<?= base_url('assets/css/styles.css'); ?>">
  <link rel="stylesheet" href="<?= base_url('assets/css/bootstrap-icons.css'); ?>">

  <script>
    const _BASEURL = '<?= base_url() ?>';
  </script>


<body class="bg-gray-100 flex items-center justify-center h-screen">

  <div class="bg-white p-8 rounded shadow-md w-full max-w-sm" x-data="loginForm()">
    <h2 class="text-xl font-bold mb-2 text-center"><?= esc($page_title) ?></h2>
    <p class="text-sm text-gray-600 mb-4 text-center"><?= esc($login_info) ?></p>

    <?php if (!$ip_banned): ?>
      <form @submit.prevent="login">
        <div class="mb-3">
          <label class="block text-sm font-medium mb-1">Username</label>
          <input type="text" x-model="form.user_name" class="w-full px-3 py-2 border rounded" required>
        </div>

        <div class="mb-3" x-data="{ show: false }">
          <label class="block text-sm font-medium mb-1">Password</label>
          <div class="relative">
            <input :type="show ? 'text' : 'password'" x-model="form.user_password" class="w-full px-3 py-2 border rounded pr-10" required>
            <button type="button" @click="show = !show" class="absolute top-1/2 right-3 transform -translate-y-1/2 text-sm text-blue-500">
              <span x-text="show ? '🙈' : '👁️'"></span>
            </button>
          </div>
        </div>

        <template x-if="errorMessage">
          <div class="mt-2 text-sm text-red-500" x-text="errorMessage"></div>
        </template>

        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white w-full py-2 rounded mt-4" x-bind:disabled="isLoading">
          <span x-show="!isLoading">Login</span>
          <span x-show="isLoading">Memproses...</span>
        </button>
      </form>

    <?php else: ?>
      <div class="text-red-600 text-center font-semibold">
        IP kamu diblokir sementara karena terlalu banyak percobaan login.
      </div>
    <?php endif ?>
  </div>


  <script>
    function loginForm() {
      return {
        form: {
          user_name: '',
          user_password: '',
        },
        errorMessage: '',
        isLoading: false,
        async fetchData(url, method = 'GET', body = null) {
          this.isLoading = true;
          const headers = {
            'Content-Type': 'application/json',
            'X-Requested-With': 'XMLHttpRequest',
          };

          try {
            const response = await fetch(url, {
              method,
              headers,
              body: body ? JSON.stringify(body) : null,
            });

            if (!response.ok) throw new Error('Network response was not ok');
            data = await response.json();
            this.isLoading = false;
            return data;
          } catch (error) {
            console.error('Fetch error:', error);
            return null;
          }
        },
        async login() {
          this.errorMessage = '';
          const url = _BASEURL + '/login/verify';
          const method = 'POST';
          const response = await this.fetchData(url, method, this.form);
          console.log(response);
          if (response && response.status === 'success') {
            Notifier.show('Berhasil!', response.message, 'success');
            setTimeout(() => {
              window.location.href = response.redirect;
            }, 1500); // delay 1.5 detik (1500 ms)
          } else {
            this.errorMessage = response.message;
            Notifier.show('Gagal!', response ? response.message : 'Terjadi kesalahan.', 'error')
          }

        }

      }
    }
  </script>
  <script src="<?= base_url('assets/js/backend.js') ?>"></script>

  <script src="<?= base_url('assets/js/notif.min.js') ?>"></script>
  <script src="<?= base_url('assets/js/app.min.js') ?>"></script>
</body>

</html>
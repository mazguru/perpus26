<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= esc($page_title) ?></title>
  <!-- Favicon -->
  <link rel="icon" href="<?= base_url('assets/images/' . session('favicon')) ?>" type="image/x-icon" />

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap"
    rel="stylesheet">
  <link rel="stylesheet" href="<?= base_url('assets/css/styles.css'); ?>">
  <link rel="stylesheet" href="<?= base_url('assets/css/bootstrap-icons.css'); ?>">

  <script>
    const _BASEURL = '<?= base_url() ?>';
  </script>

  <style>
    .gradient-bg {
      background: linear-gradient(135deg, #ff7e5f 0%, #feb47b 100%);
    }

    .glass-effect {
      background: rgba(255, 255, 255, 1);
      backdrop-filter: blur(15px);
      border: 1px solid rgba(255, 255, 255, 0.2);
    }

    .float-animation {
      animation: float 6s ease-in-out infinite;
    }

    @keyframes float {

      0%,
      100% {
        transform: translateY(0px) rotate(0deg);
      }

      33% {
        transform: translateY(-20px) rotate(1deg);
      }

      66% {
        transform: translateY(-10px) rotate(-1deg);
      }
    }

    .slide-in {
      animation: slideIn 0.8s ease-out;
    }

    @keyframes slideIn {
      from {
        opacity: 0;
        transform: translateY(30px);
      }

      to {
        opacity: 1;
        transform: translateY(0);
      }
    }

    .input-focus {
      transition: all 0.3s ease;
    }

    .input-focus:focus {
      transform: translateY(-2px);
      box-shadow: 0 10px 25px rgba(255, 126, 95, 0.2);
    }

    .social-button {
      transition: all 0.3s ease;
    }

    .social-button:hover {
      transform: translateY(-2px);
      box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
    }

    .login-button {
      background: linear-gradient(135deg, #ff7e5f 0%, #feb47b 100%);
      transition: all 0.3s ease;
    }

    .login-button:hover {
      transform: translateY(-2px);
      box-shadow: 0 10px 25px rgba(255, 126, 95, 0.4);
    }

    .floating-shapes {
      position: absolute;
      width: 100%;
      height: 100%;
      overflow: hidden;
      pointer-events: none;
    }

    .shape {
      position: absolute;
      opacity: 0.1;
      animation: floatShapes 20s infinite linear;
    }

    @keyframes floatShapes {
      0% {
        transform: translateY(100vh) rotate(0deg);
      }

      100% {
        transform: translateY(-100px) rotate(360deg);
      }
    }
  </style>
</head>

<body class="bg-orange-300 min-h-screen flex items-center justify-center p-4 relative">
  <!-- Floating Background Shapes -->
  <div class="floating-shapes">
    <div class="shape w-20 h-20 bg-white rounded-full" style="left: 10%; animation-delay: 0s; animation-duration: 25s;"></div>
    <div class="shape w-16 h-16 bg-white rounded-full" style="left: 20%; animation-delay: 5s; animation-duration: 20s;"></div>
    <div class="shape w-12 h-12 bg-white rounded-full" style="left: 70%; animation-delay: 10s; animation-duration: 30s;"></div>
    <div class="shape w-8 h-8 bg-white rounded-full" style="left: 80%; animation-delay: 15s; animation-duration: 18s;"></div>
    <div class="shape w-24 h-24 bg-white rounded-full" style="left: 90%; animation-delay: 20s; animation-duration: 22s;"></div>
  </div>

  <div class="w-full max-w-md" x-data="loginForm()">
    <!-- Logo/Brand Section -->
    <div class="text-center mb-8 slide-in">
      <div class="float-animation inline-block">
        <div class="w-20 h-20 bg-white rounded-2xl shadow-2xl flex items-center justify-center mb-4 mx-auto">
          <svg class="w-10 h-10 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
          </svg>
        </div>
      </div>
      <h1 class="text-3xl font-bold text-white mb-2"><?= esc($page_title) ?></h1>
      <p class="text-white/80" x-text="login_info"><?= esc($login_info) ?></p>
    </div>

    <!-- Login Form -->

    <div class="glass-effect rounded-3xl p-8 shadow-2xl slide-in">
      <?php if (!$ip_banned): ?>
        <template x-if="!ip_banned">
          <form @submit.prevent="login">
            <!-- Email Field -->
            <div>
              <label for="username" class="block text-sm font-medium text-gray-700 mb-2">
                Username
              </label>
              <div class="relative">
                <input
                  type="user_name"
                  id="user_name"
                  name="user_name"
                  x-model="form.user_name"
                  required
                  class="input-focus w-full px-4 py-3 pl-12 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent"
                  placeholder="Enter your user_name">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                  <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207"></path>
                  </svg>
                </div>
              </div>
            </div>

            <!-- Password Field -->
            <div>
              <label for="user_password" class="block text-sm font-medium text-gray-700 mb-2">
                Password
              </label>
              <div class="relative">
                <input
                  type="password"
                  id="user_password"
                  name="user_password"
                  x-model="form.user_password"
                  required
                  class="input-focus w-full px-4 py-3 pl-12 pr-12 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent"
                  placeholder="Enter your password">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                  <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                  </svg>
                </div>
                <button
                  type="button"
                  onclick="togglePassword()"
                  class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-400 hover:text-gray-600">
                  <svg id="eyeIcon" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                  </svg>
                </button>
              </div>
              <template x-if="errorMessage">
                <div class="mt-2 text-sm text-red-500" x-text="errorMessage"></div>
              </template>
            </div>


            <!-- Login Button -->
            <button
              type="submit"
              class="bg-orange-800 w-full text-white font-semibold py-3 px-4 mt-4 rounded-xl shadow-lg" x-bind:disabled="isLoading">
              <span x-show="!isLoading">Login</span>
              <span x-show="isLoading">Memproses...</span>
            </button>
          </form>
        </template>
      <?php else : ?>
        <template x-if="ip_banned">
          <div class="text-red-600 text-center font-semibold">
            IP kamu diblokir sementara karena terlalu banyak percobaan login.
          </div>
        </template>
      <?php endif ?>
    </div>

    <!-- Footer -->
    <div class="mt-8 text-center">
      <p class="text-white/60 text-sm">
        © <?= date('Y') ?> <?= session('nama_perpus') ?>. All rights reserved.
      </p>
    </div>
  </div>

  <script>
    // Toggle password visibility
    function togglePassword() {
      const passwordInput = document.getElementById('user_password');
      const eyeIcon = document.getElementById('eyeIcon');

      if (passwordInput.type === 'password') {
        passwordInput.type = 'text';
        eyeIcon.innerHTML = `
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.878 9.878L3 3m6.878 6.878L21 21"></path>
                `;
      } else {
        passwordInput.type = 'password';
        eyeIcon.innerHTML = `
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                `;
      }
    }

    // Add floating animation to input fields on focus
    document.querySelectorAll('input').forEach(input => {
      input.addEventListener('focus', function() {
        this.parentElement.style.transform = 'translateY(-2px)';
      });

      input.addEventListener('blur', function() {
        this.parentElement.style.transform = 'translateY(0)';
      });
    });

    // Create additional floating shapes dynamically
    function createFloatingShape() {
      const shape = document.createElement('div');
      shape.className = 'shape bg-white rounded-full';
      shape.style.width = Math.random() * 20 + 10 + 'px';
      shape.style.height = shape.style.width;
      shape.style.left = Math.random() * 100 + '%';
      shape.style.animationDelay = Math.random() * 20 + 's';
      shape.style.animationDuration = Math.random() * 10 + 15 + 's';

      document.querySelector('.floating-shapes').appendChild(shape);

      setTimeout(() => {
        shape.remove();
      }, 30000);
    }

    // Create new floating shapes periodically
    setInterval(createFloatingShape, 5000);
  </script>


  <script>
    function loginForm() {
      return {
        form: {
          user_name: '',
          user_password: '',
        },

        ip_banned: <?= $ip_banned ?>,
        login_info: "Enter your username and password to log on",

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
          const url = _BASEURL + 'login/verify';
          const method = 'POST';
          const response = await this.fetchData(url, method, this.form);
          console.log(response);
          if (response) {
            this.ip_banned = response.ip_banned;
            this.login_info = response.login_info;
          }
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
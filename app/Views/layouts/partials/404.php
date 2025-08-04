<style>
    body {
        background: linear-gradient(135deg, #fff7ed, #ffffff);
        min-height: 100vh;
    }

    .illustration {
        animation: float 6s ease-in-out infinite;
    }

    @keyframes float {
        0% { transform: translateY(0px); }
        50% { transform: translateY(-15px); }
        100% { transform: translateY(0px); }
    }

    .wave {
        position: absolute;
        bottom: 0;
        left: 0;
        width: 100%;
        height: 15vh;
        background: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 1440 320'%3E%3Cpath fill='%23f97316' fill-opacity='0.2' d='M0,192L48,197.3C96,203,192,213,288,229.3C384,245,480,267,576,250.7C672,235,768,181,864,181.3C960,181,1056,235,1152,234.7C1248,235,1344,181,1392,154.7L1440,128L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z'%3E%3C/path%3E%3C/svg%3E");
        background-size: cover;
        background-repeat: no-repeat;
        z-index: 0;
    }
    .wave-2 {
        position: absolute;
        bottom: 0;
        left: 0;
        width: 100%;
        height: 10vh;
        background: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 1440 320'%3E%3Cpath fill='%23ea580c' fill-opacity='0.3' d='M0,256L48,240C96,224,192,192,288,197.3C384,203,480,245,576,261.3C672,277,768,267,864,234.7C960,203,1056,149,1152,138.7C1248,128,1344,160,1392,176L1440,192L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z'%3E%3C/path%3E%3C/svg%3E");
        background-size: cover;
        background-repeat: no-repeat;
        z-index: 0;
    }
    .particle {
        position: absolute;
        border-radius: 50%;
        background-color: rgba(249, 115, 22, 0.2);
        animation: float-particle var(--duration) ease-in-out infinite;
        z-index: 0;
    }

    @keyframes float-particle {
        0% { transform: translateY(0) translateX(0); }
        50% { transform: translateY(var(--y)) translateX(var(--x)); }
        100% { transform: translateY(0) translateX(0); }
    }
</style>

<div id="particles"></div>
<div class="wave"></div>
<div class="wave-2"></div>

<div class="relative z-10 flex flex-col items-center justify-center min-h-screen px-4 text-center">
    <div class="illustration mb-8">
        <svg width="200" height="200" viewBox="0 0 24 24" fill="none">
            <circle cx="12" cy="12" r="10" fill="#f97316" fill-opacity="0.1" />
            <path d="M8.5 9C8.5 9 8.5 7 10.5 7C12.5 7 12.5 9 12.5 9" stroke="#ea580c" stroke-width="1.5" stroke-linecap="round" />
            <path d="M15.5 9C15.5 9 15.5 7 13.5 7" stroke="#ea580c" stroke-width="1.5" stroke-linecap="round" />
            <path d="M9 16C9 16 10 14 12 14C14 14 15 16 15 16" stroke="#ea580c" stroke-width="1.5" stroke-linecap="round" />
            <path d="M12 22C17.5228 22 22 17.5228 22 12C22 6.47715 17.5228 2 12 2C6.47715 2 2 6.47715 2 12C2 17.5228 6.47715 22 12 22Z" stroke="#ea580c" stroke-width="1.5" />
            <path d="M2 12H4" stroke="#ea580c" stroke-width="1.5" stroke-linecap="round" />
            <path d="M20 12H22" stroke="#ea580c" stroke-width="1.5" stroke-linecap="round" />
            <path d="M12 4V2" stroke="#ea580c" stroke-width="1.5" stroke-linecap="round" />
            <path d="M12 22V20" stroke="#ea580c" stroke-width="1.5" stroke-linecap="round" />
        </svg>
    </div>

    <h1 class="text-8xl font-bold text-orange-500 mb-2">404</h1>
    <h2 class="text-2xl font-medium text-orange-700 mb-6">Page Not Found</h2>
    <p class="text-slate-600 mb-8 max-w-md">The page you are looking for might have been removed, had its name changed, or is temporarily unavailable.</p>

    <a href="/" class="px-8 py-3 bg-orange-500 text-white font-medium rounded-lg shadow-lg hover:bg-orange-600 transition-all duration-300 flex items-center">
        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
        </svg>
        Return to Homepage
    </a>
</div>

<script>
    const particlesContainer = document.getElementById('particles');
    const particlesCount = 15;

    for (let i = 0; i < particlesCount; i++) {
        const particle = document.createElement('div');
        particle.classList.add('particle');

        const x = Math.random() * 100;
        const y = Math.random() * 100;
        const size = 10 + Math.random() * 30;
        const moveX = (Math.random() - 0.5) * 50;
        const moveY = (Math.random() - 0.5) * 50;
        const duration = 5 + Math.random() * 10;

        particle.style.left = `${x}%`;
        particle.style.top = `${y}%`;
        particle.style.width = `${size}px`;
        particle.style.height = `${size}px`;
        particle.style.setProperty('--x', `${moveX}px`);
        particle.style.setProperty('--y', `${moveY}px`);
        particle.style.setProperty('--duration', `${duration}s`);

        particlesContainer.appendChild(particle);
    }
</script>

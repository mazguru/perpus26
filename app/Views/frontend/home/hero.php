<!-- Hero Section -->
<section id="beranda" class="hero-pattern min-h-[80vh] flex items-center">
    <div class="container mx-auto px-4 py-16">
        <div class="flex flex-col md:flex-row items-center">
            <div class="md:w-1/2 mb-10 md:mb-0">
                <h1 class="text-4xl md:text-5xl font-bold text-indigo-900 mb-4">Selamat Datang di <?=session('nama_perpus')?></h1>
                <p class="text-lg text-gray-700 mb-8"><?= session('meta_description')?></p>
                <div class="flex flex-col sm:flex-row space-y-4 sm:space-y-0 sm:space-x-4">
                    <a href="#layanan" class="bg-indigo-600 hover:bg-indigo-700 text-white font-medium py-3 px-6 rounded-lg transition duration-300 text-center">Jelajahi Layanan</a>
                    <a href="#katalog" class="bg-white hover:bg-gray-100 text-indigo-600 font-medium py-3 px-6 rounded-lg border border-indigo-600 transition duration-300 text-center">Katalog Buku</a>
                </div>
            </div>
            <div class="md:w-1/2 flex justify-center">
                <svg class="w-full max-w-lg" viewBox="0 0 500 400" xmlns="http://www.w3.org/2000/svg">
                    <rect x="70" y="50" width="360" height="300" rx="10" fill="#e2e8f0" />
                    <rect x="90" y="70" width="320" height="260" rx="5" fill="#fff" />
                    <rect x="110" y="90" width="60" height="220" rx="2" fill="#4c1d95" />
                    <rect x="180" y="90" width="60" height="220" rx="2" fill="#5b21b6" />
                    <rect x="250" y="90" width="60" height="220" rx="2" fill="#6d28d9" />
                    <rect x="320" y="90" width="60" height="220" rx="2" fill="#7c3aed" />
                    <circle cx="140" cy="60" r="15" fill="#fcd34d" />
                    <path d="M50,180 C20,150 20,250 50,220 L50,180" fill="#4f46e5" />
                    <path d="M450,180 C480,150 480,250 450,220 L450,180" fill="#4f46e5" />
                    <circle cx="50" cy="200" r="20" fill="#4f46e5" />
                    <circle cx="450" cy="200" r="20" fill="#4f46e5" />
                </svg>
            </div>
        </div>
    </div>
</section>
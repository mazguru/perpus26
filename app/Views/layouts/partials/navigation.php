<!-- Navigation -->
<nav class="bg-white shadow-md sticky top-0 z-50">
    <div class="container mx-auto px-4 py-3">
        <div class="flex justify-between items-center">
            <div class="flex items-center space-x-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                </svg>
                <h1 class="text-xl font-bold text-gray-800">Pustaka Ilmu</h1>
            </div>
            <div class="hidden md:flex space-x-8">
                <a href="#" class="text-blue-600 font-medium">Home</a>
                <a href="#catalog" class="text-gray-600 hover:text-blue-600 transition">Catalog</a>
                <a href="#blog" class="text-gray-600 hover:text-blue-600 transition">Blog</a>
                <a href="#events" class="text-gray-600 hover:text-blue-600 transition">Events</a>
                <a href="#about" class="text-gray-600 hover:text-blue-600 transition">About</a>
            </div>
            <div class="flex items-center space-x-4">
                <div class="relative hidden md:block">
                    <input type="text" placeholder="Search books..." class="bg-gray-100 rounded-full py-2 px-4 pl-10 text-sm focus:outline-none focus:ring-2 focus:ring-blue-400 w-64">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-500 absolute left-3 top-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </div>
                <button class="md:hidden text-gray-600" id="mobile-menu-button">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>
            </div>
        </div>

        <!-- Mobile Menu -->
        <div class="md:hidden hidden mt-3 pb-2" id="mobile-menu">
            <div class="flex flex-col space-y-3">
                <a href="#" class="text-blue-600 font-medium">Home</a>
                <a href="#catalog" class="text-gray-600">Catalog</a>
                <a href="#blog" class="text-gray-600">Blog</a>
                <a href="#events" class="text-gray-600">Events</a>
                <a href="#about" class="text-gray-600">About</a>
                <div class="relative">
                    <input type="text" placeholder="Search books..." class="bg-gray-100 rounded-full py-2 px-4 pl-10 text-sm focus:outline-none focus:ring-2 focus:ring-blue-400 w-full">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-500 absolute left-3 top-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </div>
            </div>
        </div>
    </div>
</nav>
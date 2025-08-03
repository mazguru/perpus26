<style>
    .card-stats {
        transition: all 0.3s ease;
    }

    .card-stats:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
    }

    .table-container {
        overflow-x: auto;
    }

    .chart-container {
        height: 250px;
        position: relative;
    }
</style>
<div class="container mx-auto p-6" x-data='dashboardData' x-init="loadDashboard">
    <h1 class="text-3xl font-bold mb-4">Halo, <?= esc($username) ?> 👋</h1>
    <p class="text-gray-700 mb-4">Selamat datang di dashboard perpustakaan. Berikut informasi singkat:</p>
    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
        <div class="card-stats bg-white rounded-lg shadow p-6 border-l-4 border-blue-500">
            <div class="flex items-center justify-between">
                <div>
                    <h3 class="text-gray-500 text-sm font-medium">Today's Visits</h3>
                    <p class="text-3xl font-bold text-gray-800" x-text='visitor.today'>247</p>
                </div>
                <div class="bg-blue-100 p-3 rounded-full">
                    <i class="bi bi-eye text-blue-500 text-xl"></i>
                </div>
            </div>
        </div>

        <div class="card-stats bg-white rounded-lg shadow p-6 border-l-4 border-green-500">
            <div class="flex items-center justify-between">
                <div>
                    <h3 class="text-gray-500 text-sm font-medium">Total Posts</h3>
                    <p class="text-3xl font-bold text-gray-800" x-text='stats.articles'>1,358</p>
                </div>
                <div class="bg-green-100 p-3 rounded-full">
                    <i class="bi bi-newspaper text-green-500 text-xl"></i>
                </div>
            </div>
        </div>

        <div class="card-stats bg-white rounded-lg shadow p-6 border-l-4 border-yellow-500">
            <div class="flex items-center justify-between">
                <div>
                    <h3 class="text-gray-500 text-sm font-medium">Messages</h3>
                    <p class="text-3xl font-bold text-gray-800" x-text="stats.messages">42</p>
                </div>
                <div class="bg-yellow-100 p-3 rounded-full">
                    <i class="bi bi-envelope text-yellow-500 text-xl"></i>
                </div>
            </div>
        </div>

        <div class="card-stats bg-white rounded-lg shadow p-6 border-l-4 border-purple-500">
            <div class="flex items-center justify-between">
                <div>
                    <h3 class="text-gray-500 text-sm font-medium">Comments</h3>
                    <p class="text-3xl font-bold text-gray-800" x-text="stats.comments">876</p>
                </div>
                <div class="bg-purple-100 p-3 rounded-full">
                    <i class="bi bi-comments text-purple-500 text-xl"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Charts and Tables Section -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-6">
        <!-- Visit Statistics Chart -->
        <div class="bg-white rounded-lg shadow p-6 lg:col-span-2">
            <div class="flex items-center justify-between mb-4">
                <h2 class="text-lg font-semibold text-gray-800">Visit Statistics</h2>
            </div>
            <div class="chart-container">
                <canvas x-ref="canvas"></canvas>
            </div>
        </div>

        <!-- Content Distribution -->
        <div class="bg-white rounded-lg shadow p-6">
            <h2 class="text-lg font-semibold text-gray-800 mb-4">Content Distribution</h2>
            <div class="chart-container">
                <canvas x-ref="categoriesCanvas"></canvas>
            </div>
        </div>
    </div>

    <!-- Recent Posts and Activity -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Latest Posts -->
        <div class="bg-white rounded-lg shadow overflow-hidden">
            <div class="p-6 bg-white border-b border-gray-200">
                <div class="flex justify-between items-center">
                    <h2 class="text-lg font-semibold text-gray-800">Latest Posts</h2>
                    <a href="#" class="text-sm text-indigo-600 hover:text-indigo-800">View All</a>
                </div>
            </div>
            <div class="p-6">
                <ul class="divide-y divide-gray-200">
                    <template x-for="latpost in latest" :key="latpost.id">
                        <li class="py-4">
                            <div class="flex items-start">
                                <div class="flex-shrink-0">
                                    <div class="h-10 w-10 rounded bg-indigo-100 flex items-center justify-center text-indigo-500">
                                        <i class="bi bi-newspaper"></i>
                                    </div>
                                </div>
                                <div class="ml-4 flex-1">
                                    <div class="flex items-center justify-between">
                                        <h3 class="text-sm font-medium text-gray-900" x-text="latpost.post_title">New Books Arrival: Fall Collection 2023</h3>
                                        <span class="text-xs text-gray-500" x-text="timeAgo(latpost.created_at)">2 hours ago</span>
                                    </div>
                                    <p class="mt-1 text-sm text-gray-500 line-clamp-2" x-text="stripTagsTruncate(latpost.post_content, 100)">Discover our latest collection of books for the fall season, featuring bestsellers and award-winning titles across all genres.</p>
                                    <div class="mt-2 flex items-center">
                                        <span class="inline-flex items-center text-xs text-gray-500">
                                            <i class="bi bi-eye mr-1"></i> <span x-text="latpost.post_counter"></span>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </li>
                    </template>
                </ul>
            </div>
        </div>

        <!-- Recent Comments -->
        <div class="bg-white rounded-lg shadow overflow-hidden">
            <div class="p-6 bg-white border-b border-gray-200">
                <div class="flex justify-between items-center">
                    <h2 class="text-lg font-semibold text-gray-800">Recent Comments</h2>
                    <a href="#" class="text-sm text-indigo-600 hover:text-indigo-800">View All</a>
                </div>
            </div>
            <div class="p-6">
                <ul class="divide-y divide-gray-200">
                    <template x-for="cm in comments" :key="cm.id">
                        <li class="py-4">
                            <div class="flex">
                                <div class="flex-shrink-0">
                                    <div class="h-10 w-10 rounded-full bg-pink-100 flex items-center justify-center">
                                        <span class="text-sm font-medium text-pink-800 uppercase" x-text="cm.comment_author.substring(0, 2)">EM</span>
                                    </div>
                                </div>
                                <div class="ml-3">
                                    <div class="flex items-center">
                                        <h3 class="text-sm font-medium text-gray-900" x-text="cm.comment_author">Emma Martinez</h3>
                                        <span class="ml-2 text-xs text-gray-500">on <span class="text-indigo-600 hover:text-indigo-900" x-text="cm.comment_type"></span> <span x-text="cm.post_title">"New Books Arrival"</span></span>
                                    </div>
                                    <p class="text-sm text-gray-500 mt-1" x-text="cm.comment_content">I'm excited to check out the new mystery novels! Will they be available for reservation online?</p>
                                    <div class="mt-2 flex items-center text-xs text-gray-500">
                                        <span x-text="timeAgo(cm.created_at)">1 hour ago</span>
                                        <span
                                            x-show="cm.comment_status == 'approved'"
                                            class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                            Approved
                                        </span>
                                        <span
                                            x-show="cm.comment_status != 'approved'"
                                            class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                            Unread
                                        </span>

                                    </div>
                                </div>
                            </div>
                        </li>
                    </template>

                </ul>
            </div>
        </div>
    </div>

    
</div>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
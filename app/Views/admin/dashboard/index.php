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

<div class="container mx-auto p-6">
    <h1 class="text-3xl font-bold mb-4">Halo, <?= esc($username) ?></h1>
    <p class="text-gray-700 mb-4">Selamat datang di dashboard perpustakaan. Berikut informasi singkat:</p>

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
        <div class="card-stats bg-white rounded-lg shadow p-6 border-l-4 border-blue-500">
            <div class="flex items-center justify-between">
                <div>
                    <h3 class="text-gray-500 text-sm font-medium">Today's Visits</h3>
                    <p class="text-3xl font-bold text-gray-800"><?= $summary['today']['total'] ?></p>
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
                    <p class="text-3xl font-bold text-gray-800"><?= $stats['articles'] ?></p>
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
                    <p class="text-3xl font-bold text-gray-800"><?= $stats['messages'] ?></p>
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
                    <p class="text-3xl font-bold text-gray-800"><?= $stats['comments'] ?></p>
                </div>
                <div class="bg-purple-100 p-3 rounded-full">
                    <i class="bi bi-comments text-purple-500 text-xl"></i>
                </div>
            </div>
        </div>
    </div>


    <!-- Charts Section -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
        <div class="bg-white rounded-lg shadow p-6">
            <h2>Statistik Harian (7 Hari Terakhir)</h2>
            <div class="chart-container">
                <canvas id="dailyChart"></canvas>
            </div>
        </div>
        <div class="bg-white rounded-lg shadow p-6">
            <h2>Statistik Mingguan (4 Minggu Terakhir)</h2>
            <div class="chart-container">
                <canvas id="weeklyChart"></canvas>
            </div>
        </div>
        <div class="bg-white rounded-lg shadow p-6">
            <h2>Statistik Bulanan (12 Bulan Terakhir)</h2>
            <div class="chart-container">
                <canvas id="monthlyChart"></canvas>
            </div>
        </div>
        <div class="bg-white rounded-lg shadow p-6">
            <h2>Statistik Tahunan (5 Tahun Terakhir)</h2>
            <div class="chart-container">
                <canvas id="yearlyChart"></canvas>
            </div>
        </div>

        <!-- Content Distribution -->
        <div class="bg-white rounded-lg shadow p-6">
            <h2 class="text-lg font-semibold text-gray-800 mb-4">Content Distribution</h2>
            <div class="chart-container">
                <canvas id="categoriesChart"></canvas>
            </div>
        </div>
    </div>

    <!-- Latest Posts -->
    <div class="bg-white rounded-lg shadow overflow-hidden mb-6">
        <div class="p-6 border-b border-gray-200 flex justify-between">
            <h2 class="text-lg font-semibold text-gray-800">Latest Posts</h2>
            <a href="<?= base_url('blog/post') ?>" class="text-sm text-indigo-600 hover:text-indigo-800">View All</a>
        </div>
        <div class="p-6">
            <ul class="divide-y divide-gray-200">
                <?php foreach ($latest as $post): ?>
                    <li class="py-4 flex items-start">
                        <div class="flex-shrink-0">
                            <div class="h-10 w-10 rounded bg-indigo-100 flex items-center justify-center text-indigo-500">
                                <i class="bi bi-newspaper"></i>
                            </div>
                        </div>
                        <div class="ml-4 flex-1">
                            <div class="flex items-center justify-between">
                                <h3 class="text-sm font-medium text-gray-900"><?= esc($post['post_title']) ?></h3>
                                <span class="text-xs text-gray-500"><?= date('d M Y', strtotime($post['created_at'])) ?></span>
                            </div>
                            <p class="mt-1 text-sm text-gray-500"><?= character_limiter(strip_tags($post['post_content']), 100) ?></p>
                            <div class="mt-2 text-xs text-gray-500">
                                <i class="bi bi-eye mr-1"></i> <?= $post['post_counter'] ?>
                            </div>
                        </div>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>

    <!-- Recent Comments -->
    <div class="bg-white rounded-lg shadow overflow-hidden">
        <div class="p-6 border-b border-gray-200 flex justify-between">
            <h2 class="text-lg font-semibold text-gray-800">Recent Comments</h2>
            <a href="<?= base_url('blog/comment') ?>" class="text-sm text-indigo-600 hover:text-indigo-800">View All</a>
        </div>
        <div class="p-6">
            <ul class="divide-y divide-gray-200">
                <?php foreach ($comments as $cm): ?>
                    <li class="py-4 flex">
                        <div class="flex-shrink-0">
                            <div class="h-10 w-10 rounded-full bg-pink-100 flex items-center justify-center">
                                <span class="text-sm font-medium text-pink-800 uppercase"><?= substr($cm['comment_author'], 0, 2) ?></span>
                            </div>
                        </div>
                        <div class="ml-3">
                            <div class="flex items-center">
                                <h3 class="text-sm font-medium text-gray-900"><?= esc($cm['comment_author']) ?></h3>
                                <span class="ml-2 text-xs text-gray-500">on <?= esc($cm['comment_type']) ?> "<?= esc($cm['post_title']) ?>"</span>
                            </div>
                            <p class="text-sm text-gray-500 mt-1"><?= esc($cm['comment_content']) ?></p>
                            <div class="mt-2 flex items-center text-xs text-gray-500">
                                <span><?= date('d M Y H:i', strtotime($cm['created_at'])) ?></span>
                                <?php if ($cm['comment_status'] == 'approved'): ?>
                                    <span class="ml-2 px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                        Approved
                                    </span>
                                <?php else: ?>
                                    <span class="ml-2 px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                        Unread
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const dailyLabels = <?= json_encode(array_column($daily, 'label')) ?>;
    const dailyData = <?= json_encode(array_column($daily, 'total_visitors')) ?>;

    const weeklyLabels = <?= json_encode(array_column($weekly, 'label')) ?>;
    const weeklyData = <?= json_encode(array_column($weekly, 'total')) ?>;

    const monthlyLabels = <?= json_encode(array_column($monthly, 'label')) ?>;
    const monthlyData = <?= json_encode(array_column($monthly, 'total')) ?>;

    const yearlyLabels = <?= json_encode(array_column($yearly, 'label')) ?>;
    const yearlyData = <?= json_encode(array_column($yearly, 'total')) ?>;

    // Ambil data kategori dari PHP
    const categoriesLabels = <?= json_encode(array_column($categories, 'category_name')) ?>;
    const categoriesData = <?= json_encode(array_column($categories, 'post_count')) ?>;

    // Warna acak untuk setiap kategori
    const randomColors = categoriesLabels.map(() => {
        const r = Math.floor(Math.random() * 255);
        const g = Math.floor(Math.random() * 255);
        const b = Math.floor(Math.random() * 255);
        return `rgba(${r}, ${g}, ${b}, 0.6)`;
    });

    // Chart Content Distribution
    new Chart(document.getElementById('categoriesChart'), {
        type: 'doughnut',
        data: {
            labels: categoriesLabels,
            datasets: [{
                label: 'Jumlah Post',
                data: categoriesData,
                backgroundColor: [
                    'rgba(59, 130, 246, 0.8)',
                    'rgba(16, 185, 129, 0.8)',
                    'rgba(245, 158, 11, 0.8)',
                    'rgba(239, 68, 68, 0.8)'
                ],
                borderWidth: 0,
                borderColor: '#fff',
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'bottom'
                },
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            let label = context.label || '';
                            let value = context.raw || 0;
                            return `${label}: ${value} Post`;
                        }
                    }
                }
            }
        }
    });
    // Grafik Harian
    new Chart(document.getElementById('dailyChart'), {
        type: 'line',
        data: {
            labels: dailyLabels,
            datasets: [{
                label: 'Pengunjung Harian',
                data: dailyData,
                borderColor: 'blue',
                backgroundColor: 'rgba(0,0,255,0.1)',
                borderWidth: 2,
                tension: 0.3,
                fill: true
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: false
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    grid: {
                        display: true,
                        color: 'rgba(0, 0, 0, 0.05)'
                    }
                },
                x: {
                    grid: {
                        display: false
                    }
                }
            }
        }
    });

    // Grafik Mingguan
    new Chart(document.getElementById('weeklyChart'), {
        type: 'line',
        data: {
            labels: weeklyLabels,
            datasets: [{
                label: 'Pengunjung Mingguan',
                data: weeklyData,
                borderColor: 'green',
                backgroundColor: 'rgba(0,255,0,0.1)',
                borderWidth: 2,
                tension: 0.3,
                fill: true
            }]
        }
    });

    // Grafik Bulanan
    new Chart(document.getElementById('monthlyChart'), {
        type: 'line',
        data: {
            labels: monthlyLabels,
            datasets: [{
                label: 'Pengunjung Bulanan',
                data: monthlyData,
                borderColor: 'orange',
                backgroundColor: 'rgba(255,165,0,0.2)',
                fill: true
            }]
        }
    });

    // Grafik Tahunan
    new Chart(document.getElementById('yearlyChart'), {
        type: 'bar',
        data: {
            labels: yearlyLabels,
            datasets: [{
                label: 'Pengunjung Tahunan',
                data: yearlyData,
                backgroundColor: 'rgba(255,0,0,0.5)'
            }]
        }
    });
</script>
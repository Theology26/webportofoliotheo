<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            {{ __('Ringkasan Statistik Portofolio') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <!-- Statistik Projek -->
                <div class="glass-panel p-6 rounded-[2rem] text-white">
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 bg-cyan-500/20 rounded-xl flex items-center justify-center text-cyan-400">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                        </div>
                        <div>
                            <p class="text-sm text-gray-400">Total Projek</p>
                            <h3 class="text-2xl font-bold">{{ $stats['projects'] }}</h3>
                        </div>
                    </div>
                </div>

                <!-- Statistik Pengalaman -->
                <div class="glass-panel p-6 rounded-[2rem] text-white">
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 bg-blue-500/20 rounded-xl flex items-center justify-center text-blue-400">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                        </div>
                        <div>
                            <p class="text-sm text-gray-400">Pengalaman</p>
                            <h3 class="text-2xl font-bold">{{ $stats['experiences'] }}</h3>
                        </div>
                    </div>
                </div>

                <!-- Statistik Galeri -->
                <div class="glass-panel p-6 rounded-[2rem] text-white">
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 bg-purple-500/20 rounded-xl flex items-center justify-center text-purple-400">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                        </div>
                        <div>
                            <p class="text-sm text-gray-400">Foto Galeri</p>
                            <h3 class="text-2xl font-bold">{{ $stats['activities'] }}</h3>
                        </div>
                    </div>
                </div>

                <!-- Statistik Sosial Media -->
                <div class="glass-panel p-6 rounded-[2rem] text-white">
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 bg-emerald-500/20 rounded-xl flex items-center justify-center text-emerald-400">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"></path></svg>
                        </div>
                        <div>
                            <p class="text-sm text-gray-400">Social Media</p>
                            <h3 class="text-2xl font-bold">{{ $stats['social_medias'] }}</h3>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-8 glass-panel p-8 rounded-[2.5rem] text-white">
                <h3 class="text-lg font-bold mb-4">Selamat datang kembali, {{ Auth::user()->name ?? 'Admin' }}!</h3>
                <p class="text-gray-400">Gunakan menu navigasi di atas untuk mengelola konten portofolio Anda secara dinamis.</p>
            </div>

            <!-- GitHub Charts Section -->
            <div class="mt-8 grid grid-cols-1 lg:grid-cols-2 gap-6">
                <!-- Doughnut Chart: Languages -->
                <div class="glass-panel p-8 rounded-[2.5rem] text-white flex flex-col items-center">
                    <h3 class="text-xl font-bold mb-6 w-full text-left">Statistik Bahasa Pemrograman</h3>
                    <div class="w-full max-w-sm relative">
                        <canvas id="languageChart"></canvas>
                    </div>
                </div>

                <!-- Bar Chart: Top Repositories -->
                <div class="glass-panel p-8 rounded-[2.5rem] text-white flex flex-col items-center">
                    <h3 class="text-xl font-bold mb-6 w-full text-left">Top 5 Repositories (Stars)</h3>
                    <div class="w-full relative h-64">
                        <canvas id="repoChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Chart.js CDN -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Data GitHub
            const rawLanguageData = @json($githubData['languages'] ?? []);
            const topReposData = @json($githubData['top_repos'] ?? []);

            // Doughnut Chart Setup
            const langLabels = Object.keys(rawLanguageData);
            const langValues = Object.values(rawLanguageData);
            
            const ctxDoughnut = document.getElementById('languageChart').getContext('2d');
            new Chart(ctxDoughnut, {
                type: 'doughnut',
                data: {
                    labels: langLabels.length > 0 ? langLabels : ['No Data'],
                    datasets: [{
                        data: langValues.length > 0 ? langValues : [100],
                        backgroundColor: [
                            'rgba(6, 182, 212, 0.8)', // cyan-500
                            'rgba(59, 130, 246, 0.8)', // blue-500
                            'rgba(168, 85, 247, 0.8)', // purple-500
                            'rgba(16, 185, 129, 0.8)', // emerald-500
                            'rgba(245, 158, 11, 0.8)', // amber-500
                            'rgba(239, 68, 68, 0.8)'   // red-500
                        ],
                        borderWidth: 0,
                        hoverOffset: 4
                    }]
                },
                options: {
                    responsive: true,
                    cutout: '75%',
                    plugins: {
                        legend: {
                            position: 'bottom',
                            labels: { color: '#e5e7eb', padding: 20, font: { family: 'ui-sans-serif, system-ui, sans-serif' } }
                        }
                    }
                }
            });

            // Bar Chart Setup
            const repoLabels = topReposData.map(r => r.name);
            const repoStars = topReposData.map(r => r.stars);

            const ctxBar = document.getElementById('repoChart').getContext('2d');
            new Chart(ctxBar, {
                type: 'bar',
                data: {
                    labels: repoLabels.length > 0 ? repoLabels : ['No Data'],
                    datasets: [{
                        label: 'Stars',
                        data: repoStars.length > 0 ? repoStars : [0],
                        backgroundColor: 'rgba(6, 182, 212, 0.6)',
                        borderColor: 'rgba(6, 182, 212, 1)',
                        borderWidth: 1,
                        borderRadius: 8,
                        barPercentage: 0.6
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        y: {
                            beginAtZero: true,
                            grid: { color: 'rgba(255, 255, 255, 0.1)', drawBorder: false },
                            ticks: { color: '#9ca3af', stepSize: 1 }
                        },
                        x: {
                            grid: { display: false },
                            ticks: { color: '#9ca3af', maxRotation: 45, minRotation: 45 }
                        }
                    },
                    plugins: {
                        legend: { display: false }
                    }
                }
            });
        });
    </script>
</x-app-layout>

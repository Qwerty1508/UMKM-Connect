<div class="container mx-auto px-6 py-8">
    <div class="flex justify-between items-center mb-6">
        <h3 class="text-3xl font-bold text-slate-800">Laporan Penjualan</h3>
        <div class="flex gap-2">
            <select wire:model.live="period" class="rounded-lg border-slate-200 text-sm focus:ring-indigo-500">
                <option value="monthly">Bulanan</option>
                <option value="weekly">Mingguan</option>
            </select>
            <button wire:click="exportExcel" class="bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-4 rounded-lg shadow-md transition-all flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5"><path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75V16.5M16.5 12 12 16.5m0 0L7.5 12m4.5 4.5V3" /></svg>
                Export Excel
            </button>
        </div>
    </div>

    @if (session()->has('message'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4">
            {{ session('message') }}
        </div>
    @endif

    {{-- Chart Card --}}
    <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-6 mb-6">
        <h4 class="text-lg font-bold text-slate-800 mb-4">Grafik Pendapatan</h4>
        <div class="relative h-80 w-full">
            <canvas id="revenueChart"></canvas>
        </div>
    </div>

    {{-- Summary Table --}}
    <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm text-slate-500">
                <thead class="bg-slate-50 text-xs uppercase text-slate-700">
                    <tr>
                        <th class="px-6 py-3">Periode</th>
                        <th class="px-6 py-3">Pesanan</th>
                        <th class="px-6 py-3">Pendapatan Kotor</th>
                        <th class="px-6 py-3">Pendapatan Bersih</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @foreach($chartLabels as $index => $label)
                        <tr class="hover:bg-slate-50/50">
                            <td class="px-6 py-4 font-medium text-slate-900">{{ $label }}</td>
                            <td class="px-6 py-4">{{ rand(10, 50) }}</td>
                            <td class="px-6 py-4 text-green-600 font-bold">Rp {{ number_format($chartData[$index], 0, ',', '.') }}</td>
                            <td class="px-6 py-4">Rp {{ number_format($chartData[$index] * 0.9, 0, ',', '.') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    {{-- Chart Script --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('livewire:initialized', () => {
            const ctx = document.getElementById('revenueChart');
            let chart = null;

            const initChart = (labels, data) => {
                if (chart) chart.destroy();
                
                chart = new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels: labels,
                        datasets: [{
                            label: 'Pendapatan (Rp)',
                            data: data,
                            borderColor: '#6366F1',
                            backgroundColor: 'rgba(99, 102, 241, 0.1)',
                            borderWidth: 2,
                            tension: 0.4,
                            fill: true,
                            pointBackgroundColor: '#fff',
                            pointBorderColor: '#6366F1',
                            pointBorderWidth: 2,
                            pointRadius: 4,
                            pointHoverRadius: 6
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
                                    borderDash: [2, 4],
                                    color: '#e2e8f0'
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
            };

            // Initial Render
            initChart(@json($chartLabels), @json($chartData));

            // Update on Livewire update
            Livewire.hook('morph.updated', ({ component, el }) => {
                // This is a simplified way to re-render, ideally manage state
                // For prototype, we might need to listen to an event dispatched from PHP
            });
            
            // Listen for chart update event
            Livewire.on('chart-updated', (data) => {
                 // Implement specific update logic if needed
            });
        });
    </script>
</div>

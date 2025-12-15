<x-app title="Dashboard">
    @php
        function formatIdr($number) {
            $prefix = $number < 0 ? '-Rp ' : 'Rp ';
            return $prefix . number_format(abs($number), 0, ',', '.');
        }
    @endphp

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <x-stat-card 
            title="Total Income" 
            amount="{{ formatIdr($currentIncome) }}" 
            trend="{{ $incomeTrend > 0 ? '+' : '' }}{{ $incomeTrend }}%" 
            trendType="{{ $incomeTrend >= 0 ? 'up' : 'down' }}" 
        />

        <x-stat-card 
            title="Total Expense" 
            amount="{{ formatIdr($currentExpense) }}" 
            trend="{{ $expenseTrend > 0 ? '+' : '' }}{{ $expenseTrend }}%" 
            trendType="{{ $expenseTrend <= 0 ? 'up' : 'down' }}" 
        />

        <x-stat-card 
            title="Net Income" 
            amount="{{ formatIdr($currentNet) }}" 
            trend="{{ $netTrend > 0 ? '+' : '' }}{{ $netTrend }}%" 
            trendType="{{ $netTrend >= 0 ? 'up' : 'down' }}" 
        />
    </div>

    <div class="bg-dark-surface rounded-2xl border border-dark-border p-6 mb-8 shadow-lg">
        <div class="flex items-center justify-between mb-6">
            <h3 class="text-white font-semibold text-lg">Income vs Expense</h3>
            <button class="text-xs text-brand-500 bg-brand-500/10 px-3 py-1 rounded-full font-medium hover:bg-brand-500 hover:text-white transition-colors">
                Download Report
            </button>
        </div>
        <div id="financeChart" class="w-full h-80"></div>
    </div>

    <div class="bg-dark-surface rounded-2xl border border-dark-border p-6 shadow-lg">
        <div class="flex items-center justify-between mb-4">
            <h3 class="text-white font-semibold text-lg">Recent Transactions</h3>
            <a href="{{ route('transactions.index') }}" class="text-xs text-gray-400 hover:text-brand-500 transition-colors">View All</a>
        </div>

        <div class="space-y-3">
            @forelse($recentTransactions as $trx)
                <div class="flex items-center justify-between p-4 hover:bg-white/5 rounded-xl transition-all cursor-pointer group border border-transparent hover:border-white/5">
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 rounded-full flex items-center justify-center group-hover:scale-110 transition-transform
                            {{ $trx->type === 'income' ? 'bg-brand-500/20 text-brand-500' : 'bg-red-500/20 text-red-500' }}">
                            @if($trx->type === 'income')
                                <svg class="w-6 h-6 transform -rotate-45" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                                </svg>
                            @else
                                <svg class="w-6 h-6 transform rotate-45" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                                </svg>
                            @endif
                        </div>
                        <div>
                            <p class="text-white font-medium">{{ $trx->description }}</p>
                            <p class="text-xs text-gray-500">{{ $trx->category->name ?? 'Uncategorized' }}</p>
                        </div>
                    </div>
                    <div class="text-right">
                        <span class="block font-bold text-lg {{ $trx->type === 'income' ? 'text-brand-500' : 'text-red-500' }}">
                            {{ $trx->type === 'income' ? '+' : '-' }}{{ formatIdr($trx->amount) }}
                        </span>
                        <span class="text-xs text-gray-500">
                            {{ date('M d, Y', strtotime($trx->transaction_date)) }}
                        </span>
                    </div>
                </div>
            @empty
                <div class="text-center py-8 text-gray-500">No transactions found.</div>
            @endforelse
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var options = {
                series: [{
                    name: 'Amount',
                    data: @json($chartData)
                }],
                chart: {
                    type: 'bar',
                    height: 350,
                    toolbar: { show: false },
                    fontFamily: 'Inter, sans-serif',
                    background: 'transparent'
                },
                colors: [function({ value }) {
                    return value > 0 ? '#10B981' : '#EF4444'
                }],
                plotOptions: {
                    bar: {
                        borderRadius: 6,
                        columnWidth: '55%',
                        colors: {
                            ranges: [
                                { from: -10000000000, to: 0, color: '#EF4444' },
                                { from: 0, to: 10000000000, color: '#10B981' }
                            ]
                        }
                    }
                },
                dataLabels: { enabled: false },
                grid: {
                    borderColor: '#333333',
                    strokeDashArray: 4,
                    yaxis: { lines: { show: true } }
                },
                xaxis: {
                    categories: @json($chartCategories),
                    labels: { style: { colors: '#A1A1AA' } },
                    axisBorder: { show: false },
                    axisTicks: { show: false }
                },
                yaxis: {
                    labels: {
                        style: { colors: '#A1A1AA' },
                        formatter: (val) => (Math.abs(val) / 1000000).toFixed(1) + 'M'
                    }
                },
                tooltip: {
                    theme: 'dark',
                    y: {
                        formatter: (val) => {
                            let prefix = val < 0 ? '-Rp ' : 'Rp ';
                            return prefix + new Intl.NumberFormat('id-ID').format(Math.abs(val));
                        }
                    }
                },
                fill: {
                    type: 'gradient',
                    gradient: {
                        shade: 'dark',
                        type: "vertical",
                        opacityFrom: 1,
                        opacityTo: 0.6
                    }
                }
            };
            var chart = new ApexCharts(document.querySelector("#financeChart"), options);
            chart.render();
        });
    </script>

</x-app>
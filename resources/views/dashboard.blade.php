<x-app title="Dashboard">

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <x-stat-card title="Total Income" amount="Rp 15.700.000" trend="+12.5%" trendType="up" />
        <x-stat-card title="Total Expense" amount="Rp 8.420.000" trend="+8.2%" trendType="down" />
        <x-stat-card title="Net Income" amount="Rp 6.830.000" trend="+12.5%" trendType="up" />
    </div>

    <div class="bg-dark-surface rounded-2xl border border-dark-border p-6 mb-8 shadow-lg">
        <div class="flex items-center justify-between mb-6">
            <h3 class="text-white font-semibold text-lg">This Month's Overview</h3>
            <button
                class="text-xs text-brand-500 bg-brand-500/10 px-3 py-1 rounded-full font-medium hover:bg-brand-500 hover:text-white transition-colors">
                Download Report
            </button>
        </div>
        <div id="financeChart" class="w-full h-80"></div>
    </div>

    <div class="bg-dark-surface rounded-2xl border border-dark-border p-6 shadow-lg">
        <div class="flex items-center justify-between mb-4">
            <h3 class="text-white font-semibold text-lg">Recent Transactions</h3>
            <a href="{{ route('transactions.index') }}"
                class="text-xs text-gray-400 hover:text-brand-500 transition-colors">View All</a>
        </div>

        <div class="space-y-3">
            <div
                class="flex items-center justify-between p-4 hover:bg-white/5 rounded-xl transition-all cursor-pointer group border border-transparent hover:border-white/5">
                <div class="flex items-center gap-4">
                    <div
                        class="w-12 h-12 rounded-full bg-brand-500/20 text-brand-500 flex items-center justify-center group-hover:scale-110 transition-transform">
                        <svg class="w-6 h-6 transform -rotate-45" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M14 5l7 7m0 0l-7 7m7-7H3" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-white font-medium">Salary Payment</p>
                        <p class="text-xs text-gray-500">Received from PT Finwise Tech</p>
                    </div>
                </div>
                <div class="text-right">
                    <span class="block text-brand-500 font-bold text-lg">+Rp 15.000.000</span>
                    <span class="text-xs text-gray-500">Feb 28, 2024</span>
                </div>
            </div>

            <div
                class="flex items-center justify-between p-4 hover:bg-white/5 rounded-xl transition-all cursor-pointer group border border-transparent hover:border-white/5">
                <div class="flex items-center gap-4">
                    <div
                        class="w-12 h-12 rounded-full bg-red-500/20 text-red-500 flex items-center justify-center group-hover:scale-110 transition-transform">
                        <svg class="w-6 h-6 transform rotate-45" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M14 5l7 7m0 0l-7 7m7-7H3" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-white font-medium">Supermarket Monthly</p>
                        <p class="text-xs text-gray-500">Groceries & Supplies</p>
                    </div>
                </div>
                <div class="text-right">
                    <span class="block text-red-500 font-bold text-lg">-Rp 1.200.000</span>
                    <span class="text-xs text-gray-500">Feb 27, 2024</span>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var options = {
                series: [{
                    name: 'Amount',
                    data: [12000000, -5000000, 13000000, -5500000, 14500000, -6000000, 15500000, -
                        6500000
                    ]
                }],
                chart: {
                    type: 'bar',
                    height: 350,
                    toolbar: {
                        show: false
                    },
                    fontFamily: 'Inter, sans-serif',
                    background: 'transparent'
                },
                colors: [function({
                    value
                }) {
                    return value > 0 ? '#10B981' : '#EF4444'
                }],
                plotOptions: {
                    bar: {
                        borderRadius: 6,
                        columnWidth: '55%',
                        colors: {
                            ranges: [{
                                    from: -1e9,
                                    to: 0,
                                    color: '#EF4444'
                                },
                                {
                                    from: 0,
                                    to: 1e9,
                                    color: '#10B981'
                                }
                            ]
                        }
                    }
                },
                dataLabels: {
                    enabled: false
                },
                grid: {
                    borderColor: '#333333',
                    strokeDashArray: 4,
                    yaxis: {
                        lines: {
                            show: true
                        }
                    }
                },
                xaxis: {
                    categories: ['Jan', 'Exp', 'Feb', 'Exp', 'Mar', 'Exp', 'Apr', 'Exp'],
                    labels: {
                        style: {
                            colors: '#A1A1AA'
                        }
                    },
                    axisBorder: {
                        show: false
                    },
                    axisTicks: {
                        show: false
                    }
                },
                yaxis: {
                    labels: {
                        style: {
                            colors: '#A1A1AA'
                        },
                        formatter: (val) => val / 1000 + 'k'
                    }
                },
                tooltip: {
                    theme: 'dark',
                    y: {
                        formatter: (val) => "Rp " + val.toLocaleString()
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

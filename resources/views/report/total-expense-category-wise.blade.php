<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800  leading-tight">
            {{ __('Total expenses per category for the month.') }}
        </h2>
        <div>
            <form class="flex gap-2" action="" method="get">
                <select name="month" class="w-full aria-disabled:cursor-not-allowed outline-none focus:outline-none text-stone-800 dark:text-white placeholder:text-stone-600/60 ring-transparent border border-stone-200 transition-all ease-in disabled:opacity-50 disabled:pointer-events-none select-none text-sm py-2 px-2.5 ring shadow-sm bg-white rounded-lg duration-100 hover:border-stone-300 hover:ring-none focus:border-stone-400 focus:ring-none peer">
                    <option value="">Select Month</option>
                    @for ($month = 1; $month <= 12; $month++)
                        <option value="{{ $month }}" @selected($month == $selectedMonth)>
                            {{ \Carbon\Carbon::create()->month($month)->format('F') }}
                        </option>
                    @endfor
                </select>

                <select name="year" class="w-full aria-disabled:cursor-not-allowed outline-none focus:outline-none text-stone-800 dark:text-white placeholder:text-stone-600/60 ring-transparent border border-stone-200 transition-all ease-in disabled:opacity-50 disabled:pointer-events-none select-none text-sm py-2 px-2.5 ring shadow-sm bg-white rounded-lg duration-100 hover:border-stone-300 hover:ring-none focus:border-stone-400 focus:ring-none peer">
                    <option value="">Select Year</option>
                    @for ($year = $selectedYear - 3; $year <= $selectedYear + 3; $year++)
                        <option value="{{ $year }}" @selected($year == $selectedYear)>
                            {{ $year }}
                        </option>
                    @endfor
                </select>

                <button type="submit"
                    class="inline-flex items-center justify-center border align-middle select-none font-sans font-medium text-center duration-300 ease-in disabled:opacity-50 disabled:shadow-none disabled:cursor-not-allowed focus:shadow-none text-sm py-2 px-4 shadow-sm hover:shadow-md bg-stone-200 hover:bg-stone-100 relative bg-gradient-to-b from-white to-white border-stone-200 text-stone-700 rounded-lg hover:bg-gradient-to-b hover:from-stone-50 hover:to-stone-50 hover:border-stone-200 after:absolute after:inset-0 after:rounded-[inherit] after:box-shadow after:shadow-[inset_0_1px_0px_rgba(255,255,255,0.35),inset_0_-1px_0px_rgba(0,0,0,0.20)] after:pointer-events-none transition antialiased">Filter</button>
            </form>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white  overflow-hidden shadow-sm sm:rounded-lg">
                <div class="w-full p-4 bg-white rounded-lg shadow-sm">
                    <div class="mb-4">
                        <h3 class="text-sm text-stone-500 mb-1">Monthly Report</h3>
                    </div>
                    <div>
                        <canvas id="totalExpensePerCategoryMonthly"></canvas>
                    </div>
                </div>
            </div>
            <div class="bg-white  overflow-hidden shadow-sm sm:rounded-lg">
                <div class="w-full p-4 bg-white rounded-lg shadow-sm">
                    <div class="w-full overflow-hidden rounded-lg border border-stone-200">
                        <table class="w-full">
                            <thead class="border-b border-stone-200 bg-stone-100 text-sm font-medium text-stone-600 ">
                                <tr>
                                    <th class="px-2.5 py-2 text-start font-medium">Total Expense</th>
                                    <th class="px-2.5 py-2 text-start font-medium">Category</th>
                                    <th class="px-2.5 py-2 text-start font-medium">Month</th>
                                </tr>
                            </thead>
                            <tbody class="group text-sm text-stone-800 ">
                                @foreach ($categories as $category)
                                    <tr class="border-b border-stone-200 last:border-0">
                                        <td class="p-3 flex items-center gap-2">
                                            {{ $category->total ? '₹' . $category->total : '-' }}
                                        </td>
                                        <td class="p-3">
                                            {{ $category->name }}
                                        </td>
                                        <td class="p-3">

                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                            </tbody>
                        </table>

                        <script>
                            document.addEventListener('DOMContentLoaded', function() {
                                // Load Chart.js script dynamically
                                const script = document.createElement("script");
                                script.src = "https://cdn.jsdelivr.net/npm/chart.js";
                                script.async = true;
                                script.onload = () => {
                                    const ctx = document.getElementById('totalExpensePerCategoryMonthly');
                                    if (!ctx) return;

                                    new Chart(ctx, {
                                        type: 'line',
                                        data: {
                                            labels: @json($categoryNames),
                                            datasets: [{
                                                label: 'Expenses',
                                                data: @json($monthlyExpensesPerCategory),
                                                borderColor: '#22C55E',
                                                backgroundColor: 'rgba(34, 197, 94, 0.05)',
                                                borderWidth: 2,
                                                tension: 0.4,
                                                pointRadius: 0,
                                                fill: true,
                                            }]
                                        },
                                        options: {
                                            responsive: true,
                                            maintainAspectRatio: false,
                                            plugins: {
                                                legend: {
                                                    display: false
                                                },
                                                tooltip: {
                                                    enabled: true,
                                                    backgroundColor: 'white',
                                                    titleColor: '#1F2937',
                                                    bodyColor: '#1F2937',
                                                    borderColor: '#E5E7EB',
                                                    borderWidth: 1,
                                                    padding: 12,
                                                    displayColors: false,
                                                    callbacks: {
                                                        title: function() {
                                                            return 'Revenue Trends';
                                                        }
                                                    }
                                                }
                                            },
                                            scales: {
                                                x: {
                                                    grid: {
                                                        display: false
                                                    },
                                                    ticks: {
                                                        color: '#6B7280',
                                                        font: {
                                                            size: 10
                                                        }
                                                    },
                                                    border: {
                                                        display: false
                                                    }
                                                },
                                                y: {
                                                    min: 0,
                                                    max: @json($maxMonthlyExpensePerCategory * 2),
                                                    grid: {
                                                        color: '#F3F4F6',
                                                    },
                                                    ticks: {
                                                        color: '#6B7280',
                                                        stepSize: 40,
                                                        padding: 10,
                                                        font: {
                                                            size: 10
                                                        }
                                                    },
                                                    border: {
                                                        display: false
                                                    }
                                                }
                                            }
                                        }
                                    });
                                };
                                document.body.appendChild(script);
                            });
                        </script>

                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    @endpush

</x-app-layout>

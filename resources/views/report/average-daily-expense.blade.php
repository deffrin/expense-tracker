<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800  leading-tight">
            {{ __('Average daily expenses for the month') }}: ₹{{ round($averageDailySpent, 2) }}
        </h2>
        <div>
            <form class="flex gap-2" action="" method="get">
                <select name="month"
                    class="w-full aria-disabled:cursor-not-allowed outline-none focus:outline-none text-stone-800 dark:text-white placeholder:text-stone-600/60 ring-transparent border border-stone-200 transition-all ease-in disabled:opacity-50 disabled:pointer-events-none select-none text-sm py-2 px-2.5 ring shadow-sm bg-white rounded-lg duration-100 hover:border-stone-300 hover:ring-none focus:border-stone-400 focus:ring-none peer">
                    <option value="">Select Month</option>
                    @for ($month = 1; $month <= 12; $month++)
                        <option value="{{ $month }}" @selected($month == $selectedMonth)>
                            {{ \Carbon\Carbon::create()->month($month)->format('F') }}
                        </option>
                    @endfor
                </select>

                <select name="year"
                    class="w-full aria-disabled:cursor-not-allowed outline-none focus:outline-none text-stone-800 dark:text-white placeholder:text-stone-600/60 ring-transparent border border-stone-200 transition-all ease-in disabled:opacity-50 disabled:pointer-events-none select-none text-sm py-2 px-2.5 ring shadow-sm bg-white rounded-lg duration-100 hover:border-stone-300 hover:ring-none focus:border-stone-400 focus:ring-none peer">
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
                    <div class="w-full overflow-hidden rounded-lg border border-stone-200">
                        <table class="w-full">
                            <thead class="border-b border-stone-200 bg-stone-100 text-sm font-medium text-stone-600 ">
                                <tr>
                                    <th class="px-2.5 py-2 text-start font-medium">Total Expense</th>
                                    <th class="px-2.5 py-2 text-start font-medium">Spent At</th>
                                </tr>
                            </thead>
                            <tbody class="group text-sm text-stone-800 ">
                                @foreach ($allExpenses as $expense)
                                    <tr class="border-b border-stone-200 last:border-0">
                                        <td class="p-3">
                                            ₹{{ $expense->total }}
                                        </td>
                                        <td class="p-3 flex items-center gap-2">
                                            {{ $expense->spent_at->format('d M Y') }}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    @endpush

</x-app-layout>

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800  leading-tight">
            {{ __('My Expenses') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            @if ($expenses->count())
                <div class="p-4 sm:p-8 bg-white  shadow sm:rounded-lg">
                    <div class="pb-6 flex justify-end w-full">
                        <a href="/add-expense"
                            class="inline-flex items-center justify-center border align-middle select-none font-sans font-medium text-center duration-300 ease-in disabled:opacity-50 disabled:shadow-none disabled:cursor-not-allowed focus:shadow-none text-sm py-2 px-4 shadow-sm hover:shadow-md bg-stone-800 hover:bg-stone-700 border-stone-900 text-stone-50 rounded-lg transition antialiased">Add
                            an Expense</a>
                    </div>

                    <div class="w-full overflow-hidden rounded-lg border border-stone-200">
                        <table class="w-full">
                            <thead class="border-b border-stone-200 bg-stone-100 text-sm font-medium text-stone-600 ">
                                <tr>
                                    <th class="px-2.5 py-2 text-start font-medium">Amount</th>
                                    <th class="px-2.5 py-2 text-start font-medium">Description</th>
                                    <th class="px-2.5 py-2 text-start font-medium">Category</th>
                                    <th class="px-2.5 py-2 text-start font-medium">Date</th>
                                    <th class="px-2.5 py-2 text-start font-medium">Action</th>
                                </tr>
                            </thead>
                            <tbody class="group text-sm text-stone-800 ">
                                @foreach ($expenses as $expense)
                                    <tr class="border-b border-stone-200 last:border-0">
                                        <td class="p-3 flex items-start gap-2">
                                            <div>₹ {{ $expense->amount }}</div>
                                            <a class="w-6 h-6" href="{{ route('expense.show', $expense) }}">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                                    viewBox="0 0 24 20" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                    class="lucide lucide-eye-icon lucide-eye">
                                                    <path
                                                        d="M2.062 12.348a1 1 0 0 1 0-.696 10.75 10.75 0 0 1 19.876 0 1 1 0 0 1 0 .696 10.75 10.75 0 0 1-19.876 0" />
                                                    <circle cx="12" cy="12" r="3" />
                                                </svg>
                                            </a>
                                        </td>
                                        <td class="p-3">
                                            {{ $expense->description ? $expense->description : '-' }}
                                        </td>
                                        <td class="p-3">{{ $expense->category->name }}</td>
                                        <td class="p-3">{{ $expense->added_date->format('d/m/Y') }}</td>
                                        <td class="p-3">
                                            <a href="{{ route('expense.edit', $expense->id) }}"
                                                class="inline-flex items-center justify-center border align-middle select-none font-sans font-medium text-center duration-300 ease-in disabled:opacity-50 disabled:shadow-none disabled:cursor-not-allowed focus:shadow-none text-sm py-2 px-4 shadow-sm hover:shadow-md bg-stone-800 hover:bg-stone-700 border-stone-900 text-stone-50 rounded-lg transition antialiased">
                                                Edit Expense
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @else
                <div role="alert"
                    class="relative flex items-start w-full border rounded-md p-2 bg-transparent border-stone-800 text-stone-800">
                    <div class="w-full text-sm font-sans leading-none m-1.5 flex justify-between items-center">
                        You haven't added expenses yet.
                        <a href="/add-expense"
                            class="inline-flex items-center justify-center border align-middle select-none font-sans font-medium text-center duration-300 ease-in disabled:opacity-50 disabled:shadow-none disabled:cursor-not-allowed focus:shadow-none text-sm py-2 px-4 shadow-sm hover:shadow-md bg-stone-800 hover:bg-stone-700 border-stone-900 text-stone-50 rounded-lg transition antialiased">Add
                            an Expense</a>
                    </div>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>

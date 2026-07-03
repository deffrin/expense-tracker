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
                                    <th class="px-2.5 py-2 text-start font-medium">Spent At</th>
                                    <th class="px-2.5 py-2 text-start font-medium">Last Updated At</th>
                                    <th class="px-2.5 py-2 text-start font-medium">Action</th>
                                </tr>
                            </thead>
                            <tbody class="group text-sm text-stone-800 ">
                                @php
                                    $timezone = session('timezone', 'UTC');
                                @endphp
                                @foreach ($expenses as $expense)
                                    <tr class="border-b border-stone-200 last:border-0">
                                        <td class="p-3 flex items-center gap-2">
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
                                        <td class="p-3">
                                            {{ $expense->spent_at->timezone($timezone)->format('d/m/Y') }}</td>
                                        <td class="p-3">
                                            {{ $expense->updated_at->timezone($timezone)->format('d/m/Y h:i A') }}</td>
                                        <td class="p-3 flex">
                                            <a href="{{ route('expense.edit', $expense->id) }}"
                                                class="inline-flex items-center justify-center border align-middle select-none font-sans font-medium text-center duration-300 ease-in disabled:opacity-50 disabled:shadow-none disabled:cursor-not-allowed focus:shadow-none text-sm py-2 px-4 shadow-sm hover:shadow-md bg-stone-800 hover:bg-stone-700 border-stone-900 text-stone-50 rounded-lg transition antialiased mr-2">
                                                Edit Expense
                                            </a>
                                            <form class="delete-form" action="{{ route('expense.destroy', $expense) }}"
                                                method="post">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="inline-flex items-center justify-center border align-middle select-none font-sans font-medium text-center duration-300 ease-in disabled:opacity-50 disabled:shadow-none disabled:cursor-not-allowed focus:shadow-none text-sm py-2 px-4 shadow-sm hover:shadow-md bg-red-500 hover:bg-error-light relative bg-gradient-to-b from-red-500 to-red-600 border-red-600 text-stone-50 rounded-lg hover:bg-gradient-to-b hover:from-red-600 hover:to-red-600 hover:border-red-600 after:absolute after:inset-0 after:rounded-[inherit] after:box-shadow after:shadow-[inset_0_1px_0px_rgba(255,255,255,0.35),inset_0_-2px_0px_rgba(0,0,0,0.18)] after:pointer-events-none transition antialiased">Delete
                                                    Expense</button>
                                            </form>
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
                        You haven't added any expenses yet.
                        <a href="/add-expense"
                            class="inline-flex items-center justify-center border align-middle select-none font-sans font-medium text-center duration-300 ease-in disabled:opacity-50 disabled:shadow-none disabled:cursor-not-allowed focus:shadow-none text-sm py-2 px-4 shadow-sm hover:shadow-md bg-stone-800 hover:bg-stone-700 border-stone-900 text-stone-50 rounded-lg transition antialiased">Add
                            an Expense</a>
                    </div>
                </div>
            @endif
        </div>
    </div>

    @push('scripts')
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            document.querySelectorAll('.delete-form').forEach(form => {
                form.addEventListener('submit', function(e) {
                    e.preventDefault();

                    Swal.fire({
                        title: 'Delete expense?',
                        text: 'This action cannot be undone.',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonText: 'Yes, delete it',
                        cancelButtonText: 'Cancel',
                        confirmButtonColor: '#d33'
                    }).then(result => {
                        if (result.isConfirmed) {
                            form.submit();
                        }
                    });
                });
            });
        </script>
    @endpush
</x-app-layout>

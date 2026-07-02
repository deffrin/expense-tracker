<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800  leading-tight">
            {{ __('Expense') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="flex justify-end">
                <a href="{{ route('expense.index') }}"
                            class="inline-flex items-center justify-center border align-middle select-none font-sans font-medium text-center duration-300 ease-in disabled:opacity-50 disabled:shadow-none disabled:cursor-not-allowed focus:shadow-none text-sm py-2 px-4 shadow-sm hover:shadow-md bg-stone-200 hover:bg-stone-100 relative bg-gradient-to-b from-white to-white border-stone-200 text-stone-700 rounded-lg hover:bg-gradient-to-b hover:from-stone-50 hover:to-stone-50 hover:border-stone-200 after:absolute after:inset-0 after:rounded-[inherit] after:box-shadow after:shadow-[inset_0_1px_0px_rgba(255,255,255,0.35),inset_0_-1px_0px_rgba(0,0,0,0.20)] after:pointer-events-none transition antialiased mr-2">Go
                            Back</a>
                <a href="{{ route('expense.edit', $expense->id) }}"
                    class="inline-flex items-center justify-center border align-middle select-none font-sans font-medium text-center duration-300 ease-in disabled:opacity-50 disabled:shadow-none disabled:cursor-not-allowed focus:shadow-none text-sm py-2 px-4 shadow-sm hover:shadow-md bg-stone-800 hover:bg-stone-700 border-stone-900 text-stone-50 rounded-lg transition antialiased">
                    Edit Expense
                </a>
            </div>
            <div class="p-4 sm:p-8 bg-white  shadow sm:rounded-lg grid md:grid-cols-2 md:gap-8">

                <div class="flex flex-col">
                    <label class="text-sm">Amount</label>
                    <div class="text-md">
                        ₹{{ $expense->amount }}
                    </div>
                </div>

                <div class="text-md  flex flex-col">
                    <label class="text-sm">Description</label>
                    <div class="text-md">
                        {{ $expense->description ? $expense->description : '-' }}
                    </div>
                </div>

                <div class="text-md  flex flex-col">
                    <label class="text-sm">Category</label>
                    <div class="text-md">
                        {{ $expense->category->name }}
                    </div>
                </div>

                <div class="text-md  flex flex-col">
                    <label class="text-sm">Date</label>
                    <div class="text-md">
                        {{ $expense->added_date->format('d/m/Y') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
